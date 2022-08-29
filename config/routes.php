<?php

use Alura\Cursos\Controller\Exclusao;
use Alura\Cursos\Controller\FormularioEdicao;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\NovoCurso;
use Alura\Cursos\Controller\Persistencia;

$rotas = 
[
    // class = informa o nome da classe como string
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => NovoCurso::class,
    '/salvar-curso' => Persistencia::class,
    '/excluir-curso' => Exclusao::class,
    '/alterar-curso' => FormularioEdicao::class
];

// rotas serão devolvidas para o arquivo que chamar elas
return $rotas;