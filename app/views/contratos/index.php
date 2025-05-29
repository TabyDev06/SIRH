<h2>Lista de Contratos</h2>

<a href="../public/index.php?controller=Contrato&action=crear">Crear Nuevo Contrato</a>
<a href="../public/index.php?controller=Empleado&action=index">Volver</a>


<table border="1" cellpadding="5" cellspacing="0">
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
            <td><?= $contrato['salario_base'] ?></td>
            <td>
                <a href="../public/index.php?controller=Contrato&action=editar&id=<?= $contrato['id'] ?>">Editar</a> |
                <a href="../public/index.php?controller=Contrato&action=eliminar&id=<?= $contrato['id'] ?>" onclick="return confirm('¿Seguro que quieres eliminar?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
