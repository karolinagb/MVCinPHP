<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class Deslogar implements InterfaceControladorRequisicao
{
    public function processaRequisicao(): void
    {
        //destruiu/desvalidar a sessao do usuario
        session_destroy();
        header('Location: /login');
    }
}
