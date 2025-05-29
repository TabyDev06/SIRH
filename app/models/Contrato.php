<?php
require_once __DIR__ . '/../../config/Database.php';

class Contrato {
    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function obtenerTodos() {
        $sql = "SELECT c.*, e.nombre AS empleado_nombre, e.apellido AS empleado_apellido 
                FROM contrato c
                JOIN empleado e ON c.empleado_id = e.id
                ORDER BY c.fecha_inicio DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM contrato WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($datos) {
        $sql = "INSERT INTO contrato (empleado_id, fecha_inicio, fecha_fin, salario_base, departamento) 
                VALUES (:empleado_id, :fecha_inicio, :fecha_fin, :salario_base, :departamento)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($datos);
    }

    public function actualizar($id, $datos) {
        $sql = "UPDATE contrato SET empleado_id = :empleado_id, fecha_inicio = :fecha_inicio, 
                fecha_fin = :fecha_fin, salario_base = :salario_base, departamento = :departamento WHERE id = :id";
        $datos['id'] = $id;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($datos);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM contrato WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
