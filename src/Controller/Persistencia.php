<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class Persistencia implements InterfaceControladorRequisicao
{
    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }
    public function processaRequisicao(): void
    {
        //pegar dados do formulario

        //montar modelo curso
        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );

        $curso = new Curso();
        $curso->setDescricao($descricao);

        //inserir no banco
        $this->entityManager->persist($curso);
        $this->entityManager->flush();
    }
}
