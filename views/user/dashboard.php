<!DOCTYPE html>
<html lang="en">

<?php view('partials/head.php', [
    'title' => 'Dashboard',
    'style' => 'userDash.css'
]) ?>

<body id="dashboard-user">

    <?php view('partials/nav.php', ['links' => $links]); ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar bg-info text-white pt-3" style="width: 200px; height: 100vh; position: fixed;">
            <h5 class="text-center">Menú</h5>

            <ul class="nav flex-column">
                <li class="nav-item side-item selected" id="item-d" onclick="showTab('dashboard-tab-pane', 'item-d')">
                    <a class="nav-link text-white active" href="#dashboard-tab-pane" data-bs-toggle="tab">
                        <i class="fa-solid fa-gauge-high"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item side-item" id="item-m" onclick="showTab('membership-tab-pane', 'item-m')">
                    <a class="nav-link text-white" href="#membership-tab-pane" data-bs-toggle="tab">
                        <i class="fa-solid fa-credit-card"></i> Membresia
                    </a>
                </li>

                <li class="nav-item side-item" id="item-a" onclick="showTab('asist-tab-pane', 'item-a')">
                    <a class="nav-link text-white" href="#asist-tab-pane" data-bs-toggle="tab">
                        <i class="fa-solid fa-user-check"></i>Asistencias
                    </a>
                </li>

                <li class="nav-item side-item" id="item-p" onclick="showTab('pays-tab-pane', 'item-p')">
                    <a class="nav-link text-white" href="#pays-tab-pane" data-bs-toggle="tab">
                        <i class="fa-solid fa-clock-rotate-left"></i> Historial de pagos
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar mobile -->
        <div class="offcanvas offcanvas-start bg-info text-white" tabindex="-1" id="sidebarOffcanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menú</h5>
                <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body p-0">
                <ul class="nav flex-column">
                    <li class="nav-item side-item selected mb-2" id="dashboard-item">
                        <a class="nav-link text-white active"
                            href="#dashboard-tab-pane"
                            data-bs-toggle="tab"
                            onclick="showTab('dashboard-tab-pane', 'dashboard-item')">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item side-item mb-2" id="membership-item">
                        <a class="nav-link text-white"
                            href="#membership-tab-pane"
                            data-bs-toggle="tab"
                            onclick="showTab('membership-tab-pane', 'membership-item')">
                            Mi Membresía
                        </a>
                    </li>
                    <li class="nav-item side-item mb-2" id="asists-item">
                        <a class="nav-link text-white"
                            href="#asists-tab-pane"
                            data-bs-toggle="tab"
                            onclick="showTab('asist-tab-pane', 'asists-item')">
                            Asistencias
                        </a>
                    </li>
                    <li class="nav-item side-item mb-2" id="payments-item">
                        <a class="nav-link text-white"
                            href="#payments-tab-pane"
                            data-bs-toggle="tab"
                            onclick="showTab('pays-tab-pane', 'payments-item')">
                            Pagos
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container-fluid main-content" style="margin-left: 200px;">

            <div class="tab-content" id="myTabContent-main">
                <!-- Dashboard -->
                <div class="tab-pane fade show active my-3 px-2" id="dashboard-tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="mb-3"><i class="fa-solid fa-gauge-high me-2"></i>Dashboard</h2>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <div class="panel welcome-panel shadow-sm">
                                <h2 class="mb-2">Hola, <?= $user->__get('name') ?>!</h2>
                                <p class="mb-3">¿Qué deseas hacer?</p>
                                <ul class="action-list">
                                    <li><a onclick="showTab('membership-tab-pane', 'item-m')">Gestionar membresía</a></li>
                                    <li><a onclick="showTab('asist-tab-pane', 'item-a')">Asistencias</a></li>
                                    <li><a onclick="showTab('pays-tab-pane', 'item-p')">Pagos</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="notifications-panel shadow-sm">

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
                                    <span class="stat-value"><?= $membership['membership_type'] ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="panel h-100 shadow-sm text-center stat-card">
                                <h5>Días restantes</h5>
                                <?php if (! $membership || $membership['status'] == 'vencida'): ?>
                                    <p class="text-secondary">No tienes una membresía activa.</p>
                                <?php else: ?>
                                    <span class="stat-value"><?= $membership['days_res'] ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="panel h-100 shadow-sm text-center stat-card">
                                <h5>Asistencias este mes</h5>
                                <?php if ($asists): ?>
                                    <span class="stat-value"><?= $count_asists ?></span>
                                <?php else: ?>
                                    <p class="text-secondary text-center mt-2">No hay asistencias registradas.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="panel h-100 shadow-sm text-center stat-card">
                                <h5>Último pago</h5>
                                <?php if ($pays): ?>
                                    <span class="stat-value"><?= $pays[0]['pay_date'] ?></span>
                                <?php else: ?>
                                    <p class="text-secondary text-center mt-2">No hay pagos registrados.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade my-3 px-2" id="membership-tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="mb-3"><i class="fa-solid fa-credit-card"></i> Membresia</h2>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Tu membresía actual</h5>
                            <?php if ($membership && $membership['status'] != 'vencida'): ?>
                                <p><strong>Tipo:</strong> <?= $membership['membership_type'] ?></p>
                                <p><strong>Estado:</strong> <span class="badge bg-success"><?= $membership['status'] ?></span></p>
                                <p><strong>Inicio:</strong> <?= stringToDate($membership['start_date']) ?? 'N/A' ?></p>
                                <p><strong>Fin:</strong> <?= $membership['end_date'] ?? 'N/A' ?></p>
                                <p><strong>Días restantes:</strong> <?= $membership['days_res'] ?></p>
                                <a href="/memberships/renew?id=<?= $user->__get('userId') ?>" class="btn btn-primary">Renovar</a>
                            <?php else: ?>
                                <p class="text-secondary">No tienes una membresía activa.</p>
                                <a href="/memberships?id=<?= $user->__get('userId') ?>" class="btn btn-primary">Adquirir Membresía</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade my-3 px-2" id="asist-tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="mb-3"><i class="fa-solid fa-user-check"></i> Asistencias</h2>
                        </div>
                    </div>

                    <table class="table table-striped" id="asist-table">
                        <thead>
                            <th>#</th>
                            <th>Fecha</th>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            <?php foreach ($asists as $asist): ?>
                                <tr>
                                    <td> <?= ++$i ?> </td>
                                    <td> <?= $asist['asistDate'] ?> </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>

                <div class="tab-pane fade my-3 px-2" id="pays-tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="mb-3"><i class="fa-solid fa-clock-rotate-left"></i> Pagos</h2>
                        </div>
                    </div>
                    <table id="pays-table" class="table table-striped">
                        <thead>
                            <th>Id</th>
                            <th>Membresia</th>
                            <th>Valor</th>
                            <th>Fecha</th>
                        </thead>
                        <tbody>
                            <?php foreach ($pays as $pay): ?>
                                <tr>
                                    <td> <?= $pay['pay_id'] ?> </td>
                                    <td> <?= $pay['mem_name'] ?> </td>
                                    <td> <?= number_format($pay['value']) ?> </td>
                                    <td> <?= $pay['pay_date'] ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- modal edit -->
    <div id="profile" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header d-flex flex-column align-items-start">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5><?= $user->__get('name') ?></h5>
                    <p class="m-0">cliente</p>
                    <p class="m-0"><?= $user->__get('email') ?></p>
                </div>

                <div class="modal-body">
                
                <div class="pb-2 border-bottom bottom-1 border-secondary-subtle">
                    <a href="/changepass" class="nav-link">Cambiar contraseña</a>
                </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Boostrapt -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/94b343effb.js" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Datatable -->
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.bootstrap5.js"></script>

    <script src="/user-dashboard.js"></script>

</body>

</html>