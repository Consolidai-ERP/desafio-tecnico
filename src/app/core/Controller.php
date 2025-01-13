<?php

namespace App\Core;

class Controller
{
    /**
     * Metódo responsável por renderizar a view
     * @param string
     * @param array
     */
    public function view($view, $data = [])
    {
        $viewFile = "../app/views/{$view}.php";

        if (file_exists($viewFile)) {

            /* Extrai dados para variáveis acessíveis na view */
            extract($data);

            /* Captura o conteúdo da view específica */
            ob_start();
            require_once $viewFile;

            if ($view != 'login') {
                $content = ob_get_clean();
                /* Inclui o template principal, passando o conteúdo da view */
                require_once "../app/views/template.php";
            }
        } else {
            die("View {$view} not found.");
        }
    }
}
