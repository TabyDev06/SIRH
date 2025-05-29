<h2>Editar Departamento</h2>
<form method="POST" action="index.php?controller=Departamento&action=actualizar">
    <input type="hidden" name="id" value="<?= $departamento['id'] ?>">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= $departamento['nombre'] ?>" required><br><br>
    <button type="submit">Actualizar</button>
</form>
