<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;

class ListarCursos implements InterfaceControladorRequisicao
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
        echo $this->renderizaHtml('cursos/listar-cursos.php', [
            'cursos' => $this->repositorioDeCursos->findAll(),
            'titulo' => "Lista de cursos"
        ]);

        //Todas as variáveis do meu arquivo atual vamos estar acessíveis no arquivo que dei require
        // require __DIR__ . '/../view/cursos/listar-cursos.php';
    }
}
