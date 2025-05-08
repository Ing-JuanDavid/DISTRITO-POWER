<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar</title>
</head>
<body>
    <?php view('partials/nav.php'); ?>
    <h2>Recuperar contraseña</h2>
    <form action="/recover" method="post">
        <input type="hidden" name="_method" value = 'POST'>
        <label for="">Email</label>
        <input type="email" name="email">
        <input type="submit" value="Recuperar">
        <?php if($alert): ?>
            <?= $alert['body'] ?>
        <?php endif; ?>
    </form>
</body>
</html>