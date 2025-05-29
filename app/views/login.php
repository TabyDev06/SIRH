<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Iniciar Sesión</h2>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST" action="index.php?controller=Auth&action=login">
    <input type="email" name="correo" required placeholder="Correo">
    <input type="password" name="contrasena" required placeholder="Contraseña">
    <button type="submit">Iniciar sesión</button>
</form>

</body>
</html>
