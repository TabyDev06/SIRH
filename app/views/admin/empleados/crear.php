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
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="../public/css/admin/empleados/crear.css">
</head>
<body class="dark-body">

<div class="form-container dark-card">
    <h1 class="form-title">Crear Usuario</h1>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="../public/index.php?controller=Empleado&action=guardar" method="POST" enctype="multipart/form-data">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Apellido:</label>
        <input type="text" name="apellido" required>

        <label>Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" required>

        <label>Departamento:</label>
        <select name="departamento_id" required>
            <option value="">-- Seleccione un departamento --</option>
            <?php foreach ($departamentos as $dep): ?>
                <option value="<?= $dep['id'] ?>">
                    <?= htmlspecialchars($dep['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Foto:</label>
        <input type="file" name="foto" accept="image/jpeg,image/png">

        <label>Correo electrónico:</label>
        <input type="email" name="correo" required>

        <label>Contraseña:</label>
        <input type="password" name="contrasena" required>

        <label>Rol:</label>
        <select name="rol" required>
            <option value="">-- Seleccione un rol --</option>
            <option value="Empleado">Empleado</option>
            <option value="Administrador">Administrador</option>
        </select>

        <button type="submit" class="btn-dark">Guardar</button>
    </form>

    <a class="volver" href="../public/index.php?controller=Empleado&action=index">← Volver al listado</a>
</div>

</body>
</html>
