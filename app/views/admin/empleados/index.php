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
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="../public/css/admin/empleados/index.css">
</head>
<body>
    <h1>Empleados</h1>

    <a href="../public/index.php?controller=Auth&action=logout">Cerrar sesión</a>
    <a href="../public/index.php?controller=Empleado&action=crear">Crear nuevo empleado</a>
    <a href="../public/index.php?controller=Contrato&action=index">Gestión de Contratos</a>
    <a href="../public/index.php?controller=Departamento&action=index">Gestión de Departamentos</a>

    <table border="1" cellpadding="5" cellspacing="0" style="margin-top:10px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Nacimiento</th>
                <th>Edad</th>
                <th>Departamento</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado): ?>
            <tr>
                <td><?= htmlspecialchars($empleado['id']) ?></td>
                <td><?= htmlspecialchars($empleado['nombre']) ?></td>
                <td><?= htmlspecialchars($empleado['apellido']) ?></td>
                <td><?= htmlspecialchars($empleado['fecha_nacimiento']) ?></td>
                <td><?= htmlspecialchars($empleado['edad']) ?></td>
                <td><?= htmlspecialchars($empleado['departamento_nombre'] ?? 'Sin departamento') ?></td>
                <td>
                    <?php if (!empty($empleado['foto'])): ?>
                        <img src="../public/<?= htmlspecialchars($empleado['foto']) ?>" alt="Foto" width="50" />
                    <?php else: ?>
                        Sin foto
                    <?php endif; ?>
                </td>
                <td>
                    <a href="../public/index.php?controller=Empleado&action=editar&id=<?= $empleado['id'] ?>">Editar</a> | 
                    <a href="../public/index.php?controller=Empleado&action=eliminar&id=<?= $empleado['id'] ?>" onclick="return confirm('¿Seguro que desea eliminar este empleado?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
