<!DOCTYPE html>
<html lang="en">

<?php view('partials/head.php', ['title' => 'Dashboard']) ?>

<body>
    
    <?php view('partials/nav.php', ['links' => $links]); ?>

    <h2>Bienvenida <?php echo $user ?> has iniciado sesion como <?php echo $_SESSION["rol"] ?></h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores eum, a perspiciatis inventore praesentium nemo aliquid alias? Id provident eveniet ex beatae error, hic adipisci nisi consectetur? Praesentium, quisquam illum.</p>
    <a href="/logout">Salir</a>
</body>
</html>