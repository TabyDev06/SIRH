<?php
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'Administrador') {
    header('Location: ../public/index.php?controller=Auth&action=login_form');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
</head>
<body>
    <h1>Bienvenido al Panel de Administración</h1>

    <ul>
        <li><a href="../public/index.php?controller=Empleado&action=index">Gestión de Empleados</a></li>
        <li><a href="../public/index.php?controller=Contrato&action=index">Gestión de Contratos</a></li>
        <li><a href="../public/index.php?controller=Departamento&action=index">Gestión de Departamentos</a></li>
        <li><a href="../public/index.php?controller=Auth&action=logout">Cerrar sesión</a></li>
    </ul>
</body>
</html>
