<?php
require_once __DIR__ . '/../../config/Database.php';

class Departamento
{
    private $db;

    public function __construct()
    {
        $this->db = Database::conectar();
    }

    public function obtenerTodos()
    {
        $stmt = $this->db->query("SELECT * FROM departamento");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM departamento WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre)
    {
        $stmt = $this->db->prepare("INSERT INTO departamento (nombre) VALUES (:nombre)");
        $stmt->bindParam(':nombre', $nombre);
        return $stmt->execute();
    }

    public function actualizar($id, $nombre)
    {
        $stmt = $this->db->prepare("UPDATE departamento SET nombre = :nombre WHERE id = :id");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM departamento WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
