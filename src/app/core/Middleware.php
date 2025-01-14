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
    }

    /**
     * Metódo responsável por verificar o csrf
     * @param string
     * @param string
     * @return bool
     */
    public static function veriry_csrf($csrf_session, $csrf_post)
    {
        if (!hash_equals($csrf_session, $csrf_post)) {
            return false;
        }
        return true;
    }
}
