<header>
    <nav class="navbar navbar-expand-lg bg-body border-bottom">
        <div class="container-fluid">
            <?php if(isUri('/user/dashboard')):?>
                <button class="btn btn-info d-md-none ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-label="Menú">
                    ☰
                </button>
            <?php endif; ?>
            <a class="navbar-brand fw-bolder" href="#">DISTRITO<span class="text-info">POWER</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <?php if ($links) : ?>
                        <?php foreach ($links as $link): ?>
                            <li class="nav-item"><a class="nav-link" href=<?= $link['route'] ?>><?= $link['name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Debe definir los enlaces</p>
                    <?php endif; ?>

                    <?php if(isUri('/user/dashboard')) :?>
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profile">Perfil</a>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
</header>