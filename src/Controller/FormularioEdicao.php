<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class FormularioEdicao implements InterfaceControladorRequisicao
{
    use RenderizadorDeHtmlTrait;
    
    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if(is_null($id) || $id === false){
            header('Location: /listar-cursos');
            return;
        }

        $curso = $this->entityManager->find(Curso::class, $id);

        if($curso == null){
            header('Location: /listar-cursos');
            return;
        }

        echo $this->renderizaHtml('cursos/novo-curso.php', [
            'curso' => $curso,
            'titulo' => 'Alterar curso ' . $curso->getDescricao()
        ]);
    }
}
