<?php

use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\NovoCurso;
use Alura\Cursos\Controller\Persistencia;

$rotas = 
[
    // class = informa o nome da classe como string
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => NovoCurso::class,
    '/salvar-curso' => Persistencia::class
];

// rotas serão devolvidas para o arquivo que chamar elas
return $rotas;