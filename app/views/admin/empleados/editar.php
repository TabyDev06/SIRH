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
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="../public/css/admin/empleados/editar.css">
</head>
<body class="dark-body">
    <div class="form-container dark-card">
        <h1 class="form-title">Editar Empleado</h1>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="../public/index.php?controller=Empleado&action=actualizar" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($empleado['id']) ?>">

            <label>Nombre:</label>
            <input type="text" name="nombre" required value="<?= htmlspecialchars($empleado['nombre']) ?>">

            <label>Apellido:</label>
            <input type="text" name="apellido" required value="<?= htmlspecialchars($empleado['apellido']) ?>">

            <label>Fecha de nacimiento:</label>
            <input type="date" name="fecha_nacimiento" required value="<?= htmlspecialchars($empleado['fecha_nacimiento']) ?>">

            <label>Departamento:</label>
            <select name="departamento_id" required>
                <option value="">-- Seleccione un departamento --</option>
                <?php foreach ($departamentos as $dep): ?>
                    <option value="<?= $dep['id'] ?>" <?= ($empleado['departamento_id'] == $dep['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dep['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Foto actual:</label>
            <?php if (!empty($empleado['foto'])): ?>
                <img src="../public/<?= htmlspecialchars($empleado['foto']) ?>" alt="Foto" width="100">
            <?php else: ?>
                <p>No hay foto</p>
            <?php endif; ?>

            <label>Cambiar foto (opcional):</label>
            <input type="file" name="foto" accept="image/jpeg,image/png">

            <button type="submit" class="btn-dark">Actualizar</button>
        </form>

        <a href="../public/index.php?controller=Empleado&action=index" class="volver">Volver al listado</a>
    </div>
</body>
</html>
