<?php
require_once __DIR__ . '/../../config/Database.php';

class Empleado
{
    private $db;

    public function __construct()
    {
        $this->db = Database::conectar();
    }

    public function obtenerTodos()
    {
        $stmt = $this->db->prepare("SELECT * FROM empleado");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM empleado WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $apellido, $fecha_nacimiento, $edad, $foto, $departamento_id)
    {
        $sql = "INSERT INTO empleado (nombre, apellido, fecha_nacimiento, edad, foto, departamento_id) 
                VALUES (:nombre, :apellido, :fecha_nacimiento, :edad, :foto, :departamento_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':edad' => $edad,
            ':foto' => $foto,
            ':departamento_id' => $departamento_id
        ]);
    }


    public function actualizar($id, $nombre, $apellido, $fecha_nacimiento, $edad, $foto, $departamento_id)
    {
        $stmt = $this->db->prepare("UPDATE empleado SET nombre = :nombre, apellido = :apellido, fecha_nacimiento = :fecha_nacimiento, edad = :edad, foto = :foto, departamento_id = :departamento_id WHERE id = :id");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':edad', $edad);
        $stmt->bindParam(':foto', $foto);
        $stmt->bindParam(':departamento_id', $departamento_id);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM empleado WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
