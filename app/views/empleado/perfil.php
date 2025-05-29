<!-- app/views/empleados/perfil.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Perfil del Empleado</title>
</head>
<body>
    <h1>Perfil de <?= htmlspecialchars($empleado['nombre']) ?> <?= htmlspecialchars($empleado['apellido']) ?></h1>

    <p><strong>Fecha de nacimiento:</strong> <?= htmlspecialchars($empleado['fecha_nacimiento']) ?></p>
    <p><strong>Edad:</strong> <?= htmlspecialchars($empleado['edad']) ?> años</p>
    <p><strong>Departamento:</strong> <?= htmlspecialchars($empleado['departamento_nombre']) ?></p>

    <?php if (!empty($empleado['foto'])): ?>
        <img src="../public/<?= htmlspecialchars($empleado['foto']) ?>" alt="Foto de perfil" width="150" />
    <?php endif; ?>

    <br><br>
    <a href="../public/index.php?controller=Empleado&action=index">Volver al listado</a>
</body>
</html>
