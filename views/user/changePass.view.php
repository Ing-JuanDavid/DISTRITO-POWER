<!DOCTYPE html>
<html lang="en">

<?php view('partials/head.php', ['title' => 'Cambiar', 'style' => 'login.css']) ?>

<body class="overflow-hidden">
    
    <?php view('partials/nav.php', ['links' => $links]); ?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="p-4" style="width: 100%; max-width: 400px;">
        <h4 class="text-center mb-3">Cambiar contraseña</h4>
        <form action="/changepass" method="POST">
            <input type="hidden" name="_method" value="POST">

            <div class="mb-3">
                <input type="password" class="form-control border-secondary-subtle" name="currentPass" placeholder="Contraseña">
            </div>
            
            <div class="mb-3">
                <input type="password" class="form-control border-secondary-subtle" name="newPass" placeholder="Nueva contraseña">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control border-secondary-subtle" name="passConfirmation" placeholder="Confirma tu contraseña">
            </div>

            <button type="submit" class="btn bg-info text-light fw-bold w-100">Cambiar</button>

            <?php if ($alert): ?>
                <div class="mt-3 alert alert-<?= $alert['type'] ?> "><?= $alert['body'] ?></div>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Bootstrapt -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>