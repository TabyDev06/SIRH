<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="../public/css/admin/empleados/index.css" />
</head>
<body class="dark-body">
    <div class="table-container dark-card">
        
        <a class="btn-logout" href="../public/index.php?controller=Auth&action=logout">Cerrar sesión</a>

        <h1 class="form-title">Lista de Empleados</h1>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de nacimiento</th>
                    <th>Departamento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleados as $empleado): ?>
                    <tr>
                        <td><?= htmlspecialchars($empleado['nombre']) ?></td>
                        <td><?= htmlspecialchars($empleado['apellido']) ?></td>
                        <td><?= htmlspecialchars($empleado['fecha_nacimiento']) ?></td>
                        <td><?= htmlspecialchars($empleado['departamento_nombre']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>
