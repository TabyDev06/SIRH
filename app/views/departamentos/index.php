<h2>Departamentos</h2>
<a href="index.php?controller=Departamento&action=crear">Nuevo Departamento</a>
<table border="1">
    <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
    <?php foreach ($departamentos as $dep): ?>
        <tr>
            <td><?= $dep['id'] ?></td>
            <td><?= $dep['nombre'] ?></td>
            <td>
                <a href="index.php?controller=Departamento&action=editar&id=<?= $dep['id'] ?>">Editar</a>
                <a href="index.php?controller=Departamento&action=eliminar&id=<?= $dep['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
