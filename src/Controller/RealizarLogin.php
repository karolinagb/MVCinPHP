<?php

namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;

class RealizarLogin implements InterfaceControladorRequisicao
{
    private $repositorioDeUsuarios;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeUsuarios = $entityManager->getRepository(Usuario::class);
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


        
        if(is_null($email) || $email === false)
        {
            echo "E-mail inválido";
            return;
        }
        
        // $senha = strip_tags(
        //     $_POST['senha']
        // );

        $senha = htmlspecialchars($_POST['senha']);

        /** @var Usuario $usuario */
        $usuario = $this->repositorioDeUsuarios->findOneBy([
            'email' => $email
        ]);

        if(is_null($usuario) || !$usuario->senhaEstaCorreta($senha))
        {
            echo "E-mail ou senha inválidos";
            return;
        }

        //antes de armazenar dados na sessão, tenho que informar que vou usar sessão
            //inicializar
        // session_start(); - vamos colocar isso no ponto único de entrada da aplicação

        //informar que tem um usuário logado
        $_SESSION['logado'] = true;

        header('Location: /listar-cursos');

        //OBS: O PHP sempre armazena sempre separados por usuário/id de sessão (que fica no cookie do navegador)
        //em um arquivo de texto. A gente consegue ensinar o php a salvar os dados em um banco, por exemplo.
        //Esse cookie com os dados da sessão é enviado ao servidor toda vez que é feita uma requisição,
        //identificando assim aquele usuário.
    }
}
