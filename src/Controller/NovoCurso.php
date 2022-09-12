<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;

class NovoCurso implements InterfaceControladorRequisicao
{
    use RenderizadorDeHtmlTrait;
    
    private $repositorioDeCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }
    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('cursos/novo-curso.php', [
            'titulo' => "Novo curso"
        ]);
    }
}
