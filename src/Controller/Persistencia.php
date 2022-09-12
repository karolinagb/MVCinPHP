<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Helper\FlashMessageTrait;

class Persistencia implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }
    public function processaRequisicao(): void
    {

        //pegar dados do formulario

        //montar modelo curso
        $descricao = strip_tags(
            $_POST['descricao']
        );
        
        $curso = new Curso();
        
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        $tipo = 'success';
        if(!is_null($id) && $id !== false){

            $curso = $this->entityManager->find(Curso::class, $id);
            //atualizar
            if($curso !== null){
                // var_dump($id, $descricao);
                // // exit();
                $curso->setDescricao($descricao);
                $this->defineMensagem($tipo, 'Curso atualizado com sucesso');
            }
            else{
                $this->defineMensagem('danger', 'Curso inexistente');
            }
        }
        else{
            //inserir no banco
            $curso->setDescricao($descricao);
            $this->entityManager->persist($curso);
            $this->defineMensagem($tipo, 'Curso inserido com sucesso');
        }

        $this->entityManager->flush();


        // O servidor só redireciona
        // Para exibir os dados antes de redirecionar
            // Tem que usar uma tecnologia do lado do cliente
            // como JS
        // echo "Curso $descricao salvo com sucesso";

         

        //true (opcional)= pode substituir outro location que tiver no header 
        //302 = status para redirecionamento - opcional
        header(
            'Location: /listar-cursos',
            true,
            302
        );
    }
}
