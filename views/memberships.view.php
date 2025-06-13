<!DOCTYPE html>
<html lang="en">


<?php view('partials/head.php', ['title' => 'Planes', 'style' => 'memberships.css',]); ?>


<body class="min-vh-100 d-flex flex-column">
    <?php view('partials/nav.php', ['links' => $links]); ?>
    <div class="container flex-grow-1">
        <h3 class="text-center mt-3">
            Planes disponibles en DISTRITO<span class="text-info">POWER</span>
        </h3>
        <p class="text-center text-muted">
            No esperes a mañana, tu mejor versión empieza hoy
        </p>
        
        <div class="flex-container py-4">
            <?php foreach ($memberships as $membership) : ?>
                <div class="membership">
                    <h4><?= $membership['name'] ?></h4>
                    <p>Desde</p>
                    <span>$<?= number_format($membership['value'], 0) ?></span>
                    <p>Duración</p>
                    <span><?= $membership['duration'] ?> días</span>
                    <form action="/membership/create" method="post">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="userId" value="<?= $_GET['id'] ?? null ?>">
                        <input type="hidden" name="typeId" value="<?= $membership['typeId'] ?>">
                        <button type="submit" id="membership-btn" class="btn w-100">COMPRAR</button>
                    </form>

                    <p>Incluye:</p>
                    <ul>
                        <li>Todas las areas del gym</li>
                        <li>Hidratacion</li>
                        <li>Orientacion personalizada</li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <?php view('partials/footer.php') ?>
    <!-- Boostrapt -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>

</html>