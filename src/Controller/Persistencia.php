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
        $descricao = strip_tags(
            $_POST['descricao']
        );

        $curso = new Curso();
        $curso->setDescricao($descricao);

        //inserir no banco
        $this->entityManager->persist($curso);
        $this->entityManager->flush();

        // O servidor só redireciona
        // Para exibir os dados antes de redirecionar
            // Tem que usar uma tecnologia do lado do cliente
            // como JS
        // echo "Curso $descricao salvo com sucesso";

        //true (opcional)= pode substituir outro location que tiver no header 
        //302 = status para redirecionamento - opcional
        header(
            'Location: /listar-cursos',
            true,
            302
        );
    }
}
