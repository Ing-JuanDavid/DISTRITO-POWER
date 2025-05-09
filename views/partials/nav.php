<header>
    <nav class="navbar navbar-expand-lg bg-body border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Logo</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    
                    <?php if ($links) : ?>
                        <?php foreach($links as $link): ?>
                            <li class="nav-item"><a class="nav-link" href=<?= $link['route'] ?>><?= $link['name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Debe definir los enlaces</p>
                    <?php endif;?>
                    
                </ul>
            </div>
        </div>
    </nav>
</header>
