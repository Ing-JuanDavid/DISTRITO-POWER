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
        <nav class="bg-info text-white pt-3" style="width: 200px; height: 100vh; position: fixed;">
            <h5 class="text-center">Menu</h5>

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
                        <i class="fa-solid fa-user-check"></i> Asistencias
                    </a>
                </li>

                <li class="nav-item side-item" id="item-p" onclick="showTab('pays-tab-pane', 'item-p')">
                    <a class="nav-link text-white" href="#pays-tab-pane" data-bs-toggle="tab">
                        <i class="fa-solid fa-clock-rotate-left"></i> Historial de pagos
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid" style="margin-left: 200px;">

            <div class="tab-content" id="myTabContent-main">
                <!-- Dashboard -->
                <div class="tab-pane fade show active my-3 px-2" id="dashboard-tab-pane" role="tabpanel">
                    <h3>Dashboard</h3>

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
                                <h5>Asistencias este mes</h5>
                                <?php if ($asists): ?>
                                    <span class="fs-2 text-secondary"><?= $count_asists ?></span>
                                <?php else: ?>
                                    <p class="text-secondary text-center mt-2">No hay asistencias registradas.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="panel h-100 shadow-sm text-center stat-card">
                                <h5>Último pago</h5>
                                <?php if ($pays): ?>
                                    <span class="fs-2 text-secondary"><?= $pays[0]['pay_date'] ?></span>
                                <?php else: ?>
                                    <p class="text-secondary text-center mt-2">No hay pagos registrados.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade my-3 px-2" id="membership-tab-pane" role="tabpanel">
                    <h3>Membresia</h3>
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
                    <h3>Asistencias</h3>

                    <div class="table-container">
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

                </div>

                <div class="tab-pane fade my-3 px-2" id="pays-tab-pane" role="tabpanel">
                    <h3>Historial de pagos</h3>
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