<?php
require_once __DIR__ . '/../../config/Database.php';

class Contrato
{
    private $db;

    public function __construct()
    {
        $this->db = Database::conectar();
    }

    public function obtenerTodos()
    {
        $stmt = $this->db->prepare("SELECT contrato.*, empleado.nombre, empleado.apellido FROM contrato JOIN empleado ON contrato.empleado_id = empleado.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM contrato WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($data)
    {
        $stmt = $this->db->prepare("INSERT INTO contrato (empleado_id, fecha_inicio, fecha_fin, salario_base) VALUES (:empleado_id, :fecha_inicio, :fecha_fin, :salario_base)");
        $stmt->bindParam(':empleado_id', $data['empleado_id']);
        $stmt->bindParam(':fecha_inicio', $data['fecha_inicio']);
        $stmt->bindParam(':fecha_fin', $data['fecha_fin']);
        $stmt->bindParam(':salario_base', $data['salario_base']);
        return $stmt->execute();
    }

    public function actualizar($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE contrato SET empleado_id = :empleado_id, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, salario_base = :salario_base WHERE id = :id");
        $stmt->bindParam(':empleado_id', $data['empleado_id']);
        $stmt->bindParam(':fecha_inicio', $data['fecha_inicio']);
        $stmt->bindParam(':fecha_fin', $data['fecha_fin']);
        $stmt->bindParam(':salario_base', $data['salario_base']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM contrato WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
