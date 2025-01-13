<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('login');
    }

    /** Metódo responsável por buscar autenticar o usuário
     * @param void
     * @return json
     */
    public function auth()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

            $userModel = new User();
            $user = $userModel->getUserByEmail($email);

            if ($user) {

                if (password_verify($password, $user['password'])) {

                    if (!isset($_SESSION['csrf_token']) || empty($_SESSION['csrf_token'])) {
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    }

                    $_SESSION['user'] = $user['nome'];

                    $data = array(
                        'success' => true,
                        'message' => 'Credenciais inválidas.'
                    );
                    echo json_encode($data);
                    exit;
                } else {
                    $data = array(
                        'success' => false,
                        'message' => 'Credenciais inválidas.'
                    );
                    echo json_encode($data);
                    exit;
                }
            } else {
                $data = array(
                    'success' => false,
                    'message' => 'Credenciais inválidas.'
                );
                echo json_encode($data);
                exit;
            }
        }
    }
}
