<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Departamentos</title>
    <link rel="stylesheet" href="../public/css/admin/empleados/index_departamento.css" />
</head>
<body class="dark-body">
    <div class="container">
        <h2>Departamentos</h2>
        <a href="index.php?controller=Departamento&action=crear" class="btn-dark">Nuevo Departamento</a>

        <table class="dark-table" border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departamentos as $dep): ?>
                    <tr>
                        <td><?= $dep['id'] ?></td>
                        <td><?= htmlspecialchars($dep['nombre']) ?></td>
                        <td>
                            <a href="index.php?controller=Departamento&action=editar&id=<?= $dep['id'] ?>" class="action-link">Editar</a>
                            <a href="index.php?controller=Departamento&action=eliminar&id=<?= $dep['id'] ?>" onclick="return confirm('¿Eliminar?')" class="action-link danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
