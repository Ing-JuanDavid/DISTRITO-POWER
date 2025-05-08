<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <?php view('partials/nav.php'); ?>
    <h2>Crear cuenta</h2>
    <form action="/signup" method="post">
        <input type="hidden" name="_method" value="POST">
        <label for="">Id</label>
        <input type="number" name="id" id="">
        <label for="">Nombre</label>
        <input type="text" name="name" id="">
        <label for="">Email</label>
        <input type="email" name="email">
        <label for="">Contraseña</label>
        <input type="password" name="pass" id="">
        <input type="submit" value="Crear">
        <?php if($alert): ?>
            <?= $alert['body'] ?>
        <?php endif; ?>
    </form>
</body>
</html>