<?php
namespace Alura\Cursos\Helper;

trait RenderizadorDeHtmlTrait
{
    public function renderizaHtml(string $caminhoTemplate, array $dados): string
    {
        //extrai as chaves de um arrau para uma variavel
            //A partir da chamada desse método já posso acessar a variável $titulo por exemplo
        extract($dados);

        //output buffer = o que vai ser exibido quando o php terminar de executar
        //output buffer start = inicializar o buffer de saída
            //Ele guar tudo o que vai ser exibido
            //Nesse caso ele vai pegar o html que será exibido
            //Agora o require não vai exibir o html diretamente, mas vai jogar para um buffer
        ob_start();

        require __DIR__ . '/../view/' . $caminhoTemplate;

        //Caso eu queira pegar os dados desse buffer eu chamo essa função:
            //obg_get_clean = função 2 em 1 que retorna os dados e ja limpa
        $html = ob_get_clean();

        //depois que peguei o html, posso limpar esse buffer:
        // ob_clean();

        return $html;

    }
}