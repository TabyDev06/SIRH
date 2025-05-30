<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Departamento</title>
    <link rel="stylesheet" href="../public/css/admin/departamento/editar_departamento.css" />
</head>
<body class="dark-body">
    <div class="form-container dark-card">
        <h2 class="form-title">Editar Departamento</h2>
        <form method="POST" action="index.php?controller=Departamento&action=actualizar">
            <input type="hidden" name="id" value="<?= htmlspecialchars($departamento['id']) ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($departamento['nombre']) ?>" required>

            <button type="submit" class="btn-dark">Actualizar</button>
        </form>
    </div>
</body>
</html>
