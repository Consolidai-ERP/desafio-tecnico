<?php
namespace App\Models;

use App\Core\Database;

class User
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Metódo responsável por buscar o usuário pelo email
     */
    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}