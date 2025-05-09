<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Acceder</title>
</head>

<body class="overflow-hidden">
    <?php

    view('partials/nav.php'); ?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="p-4" style="width: 100%; max-width: 400px;">
        <h4 class="text-center mb-3">Bienvenidos</h4>
        <form action="/login" method="POST">
            <input type="hidden" name="_method" value="POST">

            <div class="mb-3">
                <input type="email" class="form-control border-secondary-subtle" name="email" placeholder="Email">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control border-secondary-subtle" name="pass" placeholder="Contraseña">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input border-secondary-subtle" id="remember" name="remember">
                <label class="form-check-label text-secondary" for="remember">Recordar sesión</label>
            </div>

            <button type="submit" class="btn btn-info text-light fw-bold w-100">Iniciar Sesión</button>

            <div class="mt-3 d-flex flex-column align-items-center">
                <a href="/recover" class="text-info text-decoration-none">¿Olvidaste tu contraseña?</a>
                <a href="/signup" class="text-secondary text-decoration-none">¿Sin cuenta? <span class="text-info">creala</span></a>
            </div>

            <?php if ($alert): ?>
                <div class="mt-3 alert alert-<?= $alert['type'] ?> "><?= $alert['body'] ?></div>
            <?php endif; ?>
        </form>
    </div>
</div>


    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>