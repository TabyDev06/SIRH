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
    <title>Lista de Contratos</title>
    <link rel="stylesheet" href="../public/css/admin/empleados/contratos.css">
</head>
<body class="dark-body">

<div class="container">
    <h2 class="title">Lista de Contratos</h2>

    <div class="actions">
        <a class="btn" href="../public/index.php?controller=Contrato&action=crear">Crear Nuevo Contrato</a>
        <a class="btn-secondary" href="../public/index.php?controller=Empleado&action=index">← Volver</a>
    </div>

    <table class="dark-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Salario Base</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contratos as $contrato): ?>
            <tr>
                <td><?= $contrato['id'] ?></td>
                <td><?= htmlspecialchars($contrato['nombre'] . ' ' . $contrato['apellido']) ?></td>
                <td><?= $contrato['fecha_inicio'] ?></td>
                <td><?= $contrato['fecha_fin'] ?></td>
                <td>S/ <?= number_format($contrato['salario_base'], 2) ?></td>
                <td>
                    <a class="action-link" href="../public/index.php?controller=Contrato&action=editar&id=<?= $contrato['id'] ?>">Editar</a> |
                    <a class="action-link danger" href="../public/index.php?controller=Contrato&action=eliminar&id=<?= $contrato['id'] ?>" onclick="return confirm('¿Seguro que quieres eliminar?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
