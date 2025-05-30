<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crear Contrato</title>
    <link rel="stylesheet" href="../public/css/admin/empleados/nuevo_contrato.css">
</head>
<body class="dark-body">

    <div class="form-container dark-card">
        <h2 class="form-title">Crear Contrato</h2>
        <form method="POST" action="../public/index.php?controller=Contrato&action=guardar">
            <label for="empleado_id">Empleado:</label>
            <select name="empleado_id" id="empleado_id" required>
                <option value="">Seleccione empleado</option>
                <?php foreach ($empleados as $empleado): ?>
                    <option value="<?= $empleado['id'] ?>">
                        <?= htmlspecialchars($empleado['nombre'] . ' ' . $empleado['apellido']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="fecha_inicio">Fecha Inicio:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" required>

            <label for="fecha_fin">Fecha Fin:</label>
            <input type="date" name="fecha_fin" id="fecha_fin" required>

            <label for="salario_base">Salario Base:</label>
            <input type="number" step="0.01" name="salario_base" id="salario_base" required>

            <button type="submit" class="btn-dark">Guardar</button>
        </form>
    </div>

</body>
</html>
