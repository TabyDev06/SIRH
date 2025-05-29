<?php
require_once __DIR__ . '/../../config/Database.php';

class Empleado
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Database::conectar();
    }

    public function obtenerTodos()
    {
        $sql = "SELECT e.*, d.nombre AS departamento_nombre
                FROM empleado e
                LEFT JOIN departamento d ON e.departamento_id = d.id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $apellido, $fecha_nacimiento, $edad, $foto, $departamento_id)
    {
        $sql = "INSERT INTO empleado (nombre, apellido, fecha_nacimiento, edad, foto, departamento_id) 
                VALUES (:nombre, :apellido, :fecha_nacimiento, :edad, :foto, :departamento_id)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
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
        $sql = "UPDATE empleado SET nombre = :nombre, apellido = :apellido, fecha_nacimiento = :fecha_nacimiento, 
                edad = :edad, foto = :foto, departamento_id = :departamento_id WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':edad' => $edad,
            ':foto' => $foto,
            ':departamento_id' => $departamento_id
        ]);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM empleado WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function obtenerPorId($id)
    {
        $sql = "SELECT e.*, d.nombre AS departamento_nombre
                FROM empleado e
                LEFT JOIN departamento d ON e.departamento_id = d.id
                WHERE e.id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}
?>
