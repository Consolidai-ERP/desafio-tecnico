<?php

namespace App\Core;

class Middleware
{   
    /**
     * Metódo responsável por verificar se o usuário está com a sessão ativa
     * @param string
     */
    public static function authentication(string $view)
    {   
        if (!isset($_SESSION['user']) && $view != 'login') {
            header('Location: /painel/login');
            session_destroy();
            exit();
        } 
        // else {
        //     if (isset($_SESSION['user']) && $view == 'login') {
        //         header('Location: /painel/home');
        //         exit();
        //     }
        // }
    }
}
