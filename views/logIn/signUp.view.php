<!DOCTYPE html>
<html lang="en">

<?php view('partials/head.php', ['title' => 'Registro', 'style' => 'login.css']) ?>

<body class="overflow-hidden">
    
    <?php view('partials/nav.php', ['links' => $links]); ?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="p-4" style="width: 100%; max-width: 400px;">
        <h4 class="text-center mb-3">Crear cuenta</h4>
        <form action="/signup" method="POST">
            <input type="hidden" name="_method" value="POST">

            <div class="mb-3">
                <input type="number" class="form-control border-secondary-subtle" name="id" placeholder="Id">
            </div>

            <div class="mb-3">
                <input type="text" class="form-control border-secondary-subtle" name="name" placeholder="Nombre">
            </div>

            <div class="mb-3">
                <input type="email" class="form-control border-secondary-subtle" name="email" placeholder="Email">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control border-secondary-subtle" name="pass" placeholder="Contraseña">
            </div>

            <button type="submit" class="btn bg-info text-light fw-bold w-100">Crear</button>

            <?php if ($alert): ?>
                <div class="mt-3 alert alert-<?= $alert['type'] ?> "><?= $alert['body'] ?></div>
            <?php endif; ?>
        </form>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>