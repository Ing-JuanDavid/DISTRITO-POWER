<!DOCTYPE html>
<html lang="en">


<?php view('partials/head.php', [
    'title' => 'Membresias',
    'style' => 'memberships.css',
]); ?>


<body>
    <?php view('partials/nav.php', ['links' => $links]); ?>
    <main class="container my-3">
        <h4>Planes disponibles</h4>
        <div class="flex-container">
            <?php foreach ($memberships as $membership) : ?>
                <div class="membership">
                    <h5><?= $membership['name'] ?></h5>
                    <p>Desde</p>
                    <span>$<?= number_format($membership['value'], 0) ?></span>
                    <p>Duración</p>
                    <span><?= $membership['duration'] ?> días</span>
                    <form action="/membership/create" method="post">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="userId" value="<?=$_GET['id']?>">
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
    </main>

</body>

</html>