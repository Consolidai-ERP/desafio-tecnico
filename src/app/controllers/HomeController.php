<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Client;

class HomeController extends Controller
{
    public function index()
    {
        $clientModel = new Client();
        $clients = $clientModel->getAllClients();

        $this->view('home', [
            'title' => 'Dashboard',
            'pageTitle' => 'Bem-vindo ao Painel Administrativo',
            'activePage' => 'home',
            'clientes' => $clients
        ]);
    }
}
