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
    <title>Editar Empleado</title>
</head>
<body>
    <h1>Editar empleado</h1>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="../public/index.php?controller=Empleado&action=actualizar" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($empleado['id']) ?>">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required value="<?= htmlspecialchars($empleado['nombre']) ?>"><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" required value="<?= htmlspecialchars($empleado['apellido']) ?>"><br><br>

        <label>Fecha de nacimiento:</label><br>
        <input type="date" name="fecha_nacimiento" required value="<?= htmlspecialchars($empleado['fecha_nacimiento']) ?>"><br><br>

        <label>Departamento ID:</label><br>
        <input type="number" name="departamento_id" required value="<?= htmlspecialchars($empleado['departamento_id']) ?>"><br><br>

        <label>Foto actual:</label><br>
        <?php if ($empleado['foto']): ?>
            <img src="../public/<?= htmlspecialchars($empleado['foto']) ?>" alt="Foto" width="100"><br><br>
        <?php else: ?>
            No hay foto<br><br>
        <?php endif; ?>

        <label>Cambiar foto (opcional):</label><br>
        <input type="file" name="foto" accept="image/jpeg,image/png"><br><br>

        <button type="submit">Actualizar</button>
    </form>
    <br>
    <a href="../public/index.php?controller=Empleado&action=index">Volver al listado</a>
</body>
</html>
