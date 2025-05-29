<?php
require_once __DIR__ . '/../../config/Database.php';

class Usuario
{
    private $db;

    public function __construct()
    {
        $this->db = Database::conectar();
    }

    public function obtenerPorCorreo($correo)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE correo = :correo LIMIT 1");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
