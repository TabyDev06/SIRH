<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crear Departamento</title>
    <link rel="stylesheet" href="../public/css/admin/departamento/crear_departamento.css" />
</head>
<body class="dark-body">
    <div class="form-container dark-card">
        <h2 class="form-title">Crear Departamento</h2>
        <form method="POST" action="index.php?controller=Departamento&action=guardar">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" required>

            <button type="submit" class="btn-dark">Guardar</button>
        </form>
    </div>
</body>
</html>

