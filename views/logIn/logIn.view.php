<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceder</title>
</head>
<body>
    <?php

use Core\Response;

    view('partials/nav.php'); ?>

    <h2>Bienvenidos</h2>
    <form action="/login" method="POST">
        <input type="hidden" name="_method" value="POST">
        <label for="">Email</label>
        <input type="email" name="email">
        <label for="">Contraseña</label>
        <input type="password" name="pass" id="">
        <label for="remember">Recordar sesion</label>
        <input type="checkbox" name="remember" id="remember">
        <input type="submit" value="Ingresar">
        <a href="/recover">Olvidaste tu Contraseña?</a>
        <a href="/signup">No tienes cuenta? creala</a>
        <?php if($alert): ?>
            <?= $alert['body'] ?>
        <?php endif; ?>
    </form>
</body>
</html>