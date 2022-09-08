<?php

namespace Alura\Cursos\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Curso;

class Exclusao implements InterfaceControladorRequisicao
{
    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (is_null($id) || $id === false) {
            header('Location: /listar-cursos');
            return;
        }

        $curso = $this->entityManager->find(Curso::class, $id);

        if($curso == null){
            $_SESSION['tipo_mensagem'] = 'danger';
            $_SESSION['mensagem'] = "Curso inexistente";
            header('Location: /listar-cursos');
            return;
        }

        $this->entityManager->remove($curso);
        $this->entityManager->flush();

        $_SESSION['tipo_mensagem'] = 'success';
        $_SESSION['mensagem'] = "Curso excluído com sucesso";

        header('Location: /listar-cursos');
    }
}
