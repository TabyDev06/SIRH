<?php
class Database
{
    private static $conexion = null;

    public static function conectar()
    {
        if (self::$conexion === null) {
            try {
                $host = 'localhost';
                $db = 'sirh';
                $usuario = 'root';
                $contraseña = '';
                $origen = "mysql:host=$host;dbname=$db;charset=utf8mb4";

                self::$conexion = new PDO($origen, $usuario, $contraseña);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Error de conexion " . $e->getMessage());
            }
        }
        return self::$conexion;
    }
}
?>
