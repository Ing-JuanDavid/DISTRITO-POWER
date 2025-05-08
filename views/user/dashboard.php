<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <?php view('partials/nav.php'); ?>
    <h2>Bienvenida <?php echo $user ?> has iniciado sesion como <?php echo $_SESSION["rol"] ?></h2><hr>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores eum, a perspiciatis inventore praesentium nemo aliquid alias? Id provident eveniet ex beatae error, hic adipisci nisi consectetur? Praesentium, quisquam illum.</p>
    <a href="/logout">Salir</a>
</body>
</html>