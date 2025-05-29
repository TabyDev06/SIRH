<?php
require_once __DIR__ . '/../../config/Database.php';

class Usuario
{
    private $db;

    public function __construct()
    {
        // Asumiendo que Database::conectar() retorna una instancia PDO
        $this->db = Database::conectar();
    }

    public function obtenerPorCorreo($correo)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE correo = :correo LIMIT 1");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

public function crear($id, $correo, $contrasena, $rol)
{
    // Verificar si ya existe el correo
    $existe = $this->obtenerPorCorreo($correo);
    if ($existe) {
        // Retornamos false o puedes lanzar excepción o manejar el error como prefieras
        return false;
    }

    $sql = "INSERT INTO usuario (id, correo, contrasena, rol) VALUES (:id, :correo, :contrasena, :rol)";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
        ':id' => $id,
        ':correo' => $correo,
        ':contrasena' => $contrasena,
        ':rol' => $rol,
    ]);
}

}
