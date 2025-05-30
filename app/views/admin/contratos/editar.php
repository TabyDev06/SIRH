<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Contrato</title>
    <link rel="stylesheet" href="../public/css/admin/contrato/editar_contrato.css">
</head>
<body class="dark-body">
    <div class="form-container dark-card">
        <h2 class="form-title">Editar Contrato</h2>

        <form method="POST" action="../public/index.php?controller=Contrato&action=actualizar">
            <input type="hidden" name="id" value="<?= $contrato['id'] ?>">

            <label>Empleado:</label>
            <select name="empleado_id" required>
                <option value="">Seleccione empleado</option>
                <?php foreach ($empleados as $empleado): ?>
                    <option value="<?= $empleado['id'] ?>" <?= $contrato['empleado_id'] == $empleado['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($empleado['nombre'] . ' ' . $empleado['apellido']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Fecha Inicio:</label>
            <input type="date" name="fecha_inicio" value="<?= $contrato['fecha_inicio'] ?>" required>

            <label>Fecha Fin:</label>
            <input type="date" name="fecha_fin" value="<?= $contrato['fecha_fin'] ?>" required>

            <label>Salario Base:</label>
            <input type="number" step="0.01" name="salario_base" value="<?= $contrato['salario_base'] ?>" required>

            <button type="submit" class="btn-dark">Actualizar</button>
        </form>

        <a href="../public/index.php?controller=Contrato&action=index" class="volver">Volver al listado</a>
    </div>
</body>
</html>
