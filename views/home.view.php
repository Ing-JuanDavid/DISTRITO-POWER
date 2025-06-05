<!DOCTYPE html>
<html lang="en">

<?php view('partials/head.php', ['title' => 'Inicio', 'style' => 'home.css']) ?>

<body class="min-vh-100 d-flex flex-column">
    
    <?php view('partials/nav.php', ['links' => $links]); ?>

    <h2>Inicio</h2>
    <div class="container flex-grow-1">

    </div>
    

    <?php view('partials/footer.php') ?>

    <!-- Bootstrapt -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>