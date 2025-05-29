<h2>Editar Contrato</h2>

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
    <br>s

    <label>Fecha Inicio:</label>
    <input type="date" name="fecha_inicio" value="<?= $contrato['fecha_inicio'] ?>" required>
    <br>

    <label>Fecha Fin:</label>
    <input type="date" name="fecha_fin" value="<?= $contrato['fecha_fin'] ?>" required>
    <br>

    <label>Salario Base:</label>
    <input type="number" step="0.01" name="salario_base" value="<?= $contrato['salario_base'] ?>" required>
    <br>


    <button type="submit">Actualizar</button>
</form>
