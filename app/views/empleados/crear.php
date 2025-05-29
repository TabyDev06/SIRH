<?php
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'Administrador') {
    header('Location: ../public/index.php?controller=Auth&action=login_form');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Empleado</title>
</head>
<body>
    <h1>Crear nuevo empleado</h1>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="../public/index.php?controller=Empleado&action=guardar" method="POST" enctype="multipart/form-data">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" required><br><br>

        <label>Fecha de nacimiento:</label><br>
        <input type="date" name="fecha_nacimiento" required><br><br>

        <label>Departamento ID:</label><br>
        <input type="number" name="departamento_id" required><br><br>

        <label>Foto:</label><br>
        <input type="file" name="foto" accept="image/jpeg,image/png" />

        <button type="submit">Guardar</button>
    </form>
    <br>
    <a href="../public/index.php?controller=Empleado&action
