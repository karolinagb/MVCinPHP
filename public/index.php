<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\NovoCurso;
use Alura\Cursos\Controller\ListarCursos;

//pega o caminho buscado na url
switch($_SERVER['PATH_INFO']){
    case '/listar-cursos':
        $controlador = new ListarCursos;
        $controlador->processaRequisicao();
        break;
    case '/novo-curso':
        $controlador = new NovoCurso();
        $controlador->processaRequisicao();
        break;
    default:
        echo "Erro 404";
        break;
}