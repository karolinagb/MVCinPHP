<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\NovoCurso;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Persistencia;

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
    case '/salvar-curso':
        $controlador = new Persistencia();
        $controlador->processaRequisicao();
        break;
    default:
        echo "Erro 404";
        break;
}