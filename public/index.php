<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\InterfaceControladorRequisicao;

// pega o caminho buscado na url
$caminho = $_SERVER['PATH_INFO'];

// chamo como se fosse uma funcao pq o arquivo tem retorno
$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho, $rotas)) {
    //Informando o status para o chrome exibir a pagina dele para 404
    http_response_code(404);
    exit();
}

//qualquer controlador que for executador vai ter a sessão já inicializada
session_start();

// pega o nome da classe
$nomeClasseControlador = $rotas[$caminho];
// com isso posso instanciar
/** @var InterfaceControladorRequisicao */
$controlador = new $nomeClasseControlador();
$controlador->processaRequisicao();
