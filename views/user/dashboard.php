<!DOCTYPE html>
<html lang="en">

<?php view('partials/head.php', [
    'title' => 'Dashboard',
    'style' => 'userDash.css'
]) ?>

<body id="dashboard-user">

    <?php view('partials/nav.php', ['links' => $links]); ?>


    <div class="container py-4" id="dashboard-user">
        <h4 class="mb-4">Dashboard</h4>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <div class="panel welcome-panel shadow-sm">
                    <h2 class="mb-2">Hola, <?= $user->__get('name') ?>!</h2>
                    <p class="mb-3">¿Qué deseas hacer?</p>
                    <ul class="action-list">
                        <li><a href="membresia">Gestionar membresía</a></li>
                        <li><a href="asistencias">Asistencias</a></li>
                        <li><a href="pagos">Pagos</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="panel shadow-sm">
                    
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="me-2 fs-3">🔔</span>
                        <p class="m-0">Notificaciones</p>
                    </div>

                    <?php if ($alert): ?>
                        <div class="alert alert-<?= $alert['type'] ?> alert-dismissible fade show position-stiky" role="alert">
                            <?= $alert['body'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row mt-4 g-4">
            <div class="col-12 col-md-3">
                <div class="panel h-100 shadow-sm text-center stat-card">
                    <h5>Membresía</h5>
                    <?php if (! $membership || $membership['status'] == 'vencida'): ?>
                        <p class="text-secondary">No tienes una membresía activa.</p>
                        <a href="/memberships?id=<?= $user->__get('userId') ?>" class="btn btn-primary mt-2">Adquirir Membresía</a>
                    <?php else: ?>
                        <span class="fs-2 text-primary"><?= $membership['membership_type'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="panel h-100 shadow-sm text-center stat-card">
                    <h5>Días restantes</h5>
                    <?php if (! $membership || $membership['status'] == 'vencida'): ?>
                        <p class="text-secondary">No tienes una membresía activa.</p>
                    <?php else: ?>
                        <span class="fs-2 text-success"><?= $membership['days_res'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="panel h-100 shadow-sm text-center stat-card">
                    <h5>Última asistencia</h5>
                    <?php if ($asists): ?>
                        <span class="fs-2 text-secondary"><?= $asists[0]['asistDate'] ?></span>
                    <?php else: ?>
                        <p class="text-secondary text-center mt-2">No hay asistencias registradas.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="panel h-100 shadow-sm text-center stat-card">
                    <h5>Último pago</h5>
                    <?php if ($pays): ?>
                        <span class="fs-2 text-secondary"><?= $pays[0]['payDate'] ?></span>
                    <?php else: ?>
                        <p class="text-secondary text-center mt-2">No hay pagos registrados.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Boostrapt -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        
</body>

</html>