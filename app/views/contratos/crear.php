<h2>Crear Contrato</h2>

<form method="POST" action="../public/index.php?controller=Contrato&action=guardar">
    <label>Empleado:</label>
    <select name="empleado_id" required>
        <option value="">Seleccione empleado</option>
        <?php foreach ($empleados as $empleado): ?>
            <option value="<?= $empleado['id'] ?>"><?= htmlspecialchars($empleado['nombre'] . ' ' . $empleado['apellido']) ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <label>Fecha Inicio:</label>
    <input type="date" name="fecha_inicio" required>
    <br>

    <label>Fecha Fin:</label>
    <input type="date" name="fecha_fin" required>
    <br>

    <label>Salario Base:</label>
    <input type="number" step="0.01" name="salario_base" required>
    <br>

    <label>Departamento:</label>
    <input type="text" name="departamento" required>
    <br>

    <button type="submit">Guardar</button>
</form>
