<?php

namespace App\Core;

use App\Core\Middleware;

class App
{
    protected $controller = 'LoginController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (!empty($url[0])) {

            Middleware::authentication($url[0]);

            /* Se o arquivo existe o atributo recebe o nome da view solicitada */
            if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . 'Controller.php')) {
                $this->controller = $url[0] . 'Controller';
                unset($url[0]);
            } else {
                //redirecionar 404
                // Middleware::isLogin();
            }

            /* É instanciado o objeto do controller solicidado */
            $this->controller = "App\\Controllers\\" . $this->controller;
            $this->controller = new $this->controller;

            if (isset($url[1]) && method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }

            $this->params = $url ? array_values($url) : [];

            /* Chama o método do controller */
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            header('Location: /painel/login');
        }
    }

    /**
     * Metódo responsável por retornar os pedaços da requisição url
     * @param void
     * @return array
     */
    protected function parseUrl()
    {
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

        $url = str_replace('/painel', '', $url);

        /* Remove qualquer query string (como ?url=...) */
        $url = strtok($url, '?');

        return explode('/', trim($url, '/'));
    }
}
