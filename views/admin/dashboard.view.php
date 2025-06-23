<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrapt -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="/styles/adminDash.css">
    <title>Dashboard</title>
</head>

<body>

    <?php view('partials/nav.php', ['links' => $links]); ?>


    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-info text-white pt-3" style="width: 250px; height: 100vh; position: fixed;">
            <h5 class="center">Menu</h5>
            <ul class="nav flex-column">

                <li class="nav-item side-item selected">
                    <a class="nav-link text-white active" href="#dashboard-tab-pane" data-bs-toggle="tab">
                        <i class="fa-solid fa-gauge-high"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item side-item">
                    <a class="nav-link text-white" href="#users-tab-pane" data-bs-toggle="tab">
                        <i class="fa-solid fa-users"></i> Gestionar Usuarios
                    </a>
                </li>

                <li class="nav-item side-item">
                    <a class="nav-link text-white" href="#mems-tab-pane" data-bs-toggle="tab">
                        <i class="fa-solid fa-credit-card"></i> Gestionar Membresias
                    </a>
                </li>

                <li class="nav-item side-item">
                    <a class="nav-link text-white" href="#members-tab-pane" data-bs-toggle="tab">
                        <i class="fa-solid fa-user-check"></i> Miembros y Asistencia
                    </a>
                </li>

                <li class="nav-item side-item">
                    <a class="nav-link text-white" href="#payments-tab-pane" data-bs-toggle="tab">
                        <i class="fa-solid fa-money-bill"></i> Pagos
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid" style="margin-left: 250px;">

            <div class="tab-content" id="myTabContent-main">
                <!-- Dashboard -->
                <div class="tab-pane fade show active my-3" id="dashboard-tab-pane" role="tabpanel">
                    <div class="row mb-4">
                        <div class="col-7">
                            <h2 class="mb-3"><i class="fa-solid fa-gauge-high me-2"></i>Dashboard</h2>
                        </div>
                        <div class="col-5">
                            <?php if ($alert): ?>
                                <div class="alert alert-<?= $alert['type'] ?> alert-dismissible fade show position-stiky m-0" role="alert">
                                    <?= $alert['body'] ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <i class="fa-solid fa-users fa-2x text-primary mb-2"></i>
                                    <h6 class="card-title text-secondary">Usuarios registrados</h6>
                                    <span class="fs-3 fw-bold text-primary"><?= $stats['users'] ?? 0 ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <i class="fa-solid fa-id-card fa-2x text-success mb-2"></i>
                                    <h6 class="card-title text-secondary">Membresías activas</h6>
                                    <span class="fs-3 fw-bold text-success"><?= $stats['active_mems'] ?? 0 ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <i class="fa-solid fa-money-bill-wave fa-2x text-info mb-2"></i>
                                    <h6 class="card-title text-secondary">Pagos este mes</h6>
                                    <span class="fs-3 fw-bold text-info"><?= $stats['pays_month'] ?? 0 ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <i class="fa-solid fa-calendar-check fa-2x text-warning mb-2"></i>
                                    <h6 class="card-title text-secondary">Asistencias hoy</h6>
                                    <span class="fs-3 fw-bold text-warning"><?= $stats['asists_today'] ?? 0 ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold mb-3">Evolución de membresías (últimos <?= sizeof($chartMems)?> meses)</h6>
                                    <canvas id="chartMems"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold mb-3">Ingresos mensuales</h6>
                                    <canvas id="chartPays"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Sección de Usuarios -->
                <div class="tab-pane fade my-3" id="users-tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="mb-1"><i class="fa-solid fa-users"></i> Gestionar Usuarios</h2>
                        </div>
                    </div>
                    <!-- usersTable -->
                    <div class=" d-flex justify-content-end align-items-center mb-3">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <i class="fa-solid fa-plus"></i> Agregar Usuario
                        </button>
                    </div>

                    <table id="users" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if ($users) : ?>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user["user_id"]) ?></td>
                                        <td><?= htmlspecialchars($user["name"]) ?></td>
                                        <td><?= htmlspecialchars($user["email"]) ?></td>
                                        <td><?= htmlspecialchars($user["rol"]) ?></td>
                                        <td>
                                            <a
                                                class="btn btn-sm btn-warning editUser"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUser"
                                                data-userId="<?= $user['user_id'] ?>"
                                                data-name="<?= $user['name'] ?>"
                                                data-email="<?= $user['email'] ?>"
                                                data-rol="<?= $user['rol'] ?>">
                                                <i class="fa-solid fa-pen"></i>

                                            </a>

                                            <a class="btn btn-sm btn-danger" href="/admin/dashboard/destuser/?id=<?= $user['user_id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Sección de Membresias -->
                <div class="tab-pane fade my-3" id="mems-tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="mb-1"><i class="fa-solid fa-credit-card"></i> Gestionar Membresias</h2>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-end align-items-center mb-3">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addMemModal">
                            <i class="fa-solid fa-plus"></i> Agregar Membresia
                        </button>
                    </div>

                    <table id="memberships" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Duracion (Dias)</th>
                                <th>Valor</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if ($mems) : ?>
                                <?php foreach ($mems as $mem) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($mem["type_id"]) ?></td>
                                        <td><?= htmlspecialchars($mem["name"]) ?></td>
                                        <td><?= htmlspecialchars($mem["duration"]) ?></td>
                                        <td>$<?= htmlspecialchars(number_format($mem["value"]), 3) ?></td>
                                        <td>
                                            <a
                                                class="btn btn-sm btn-warning editMem"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editMem"
                                                data-typeId="<?= $mem['type_id'] ?>"
                                                data-name="<?= $mem['name'] ?>"
                                                data-duration="<?= $mem['duration'] ?>"
                                                data-value="<?= $mem['value'] ?>">
                                                <i class="fa-solid fa-pen"></i>

                                            </a>

                                            <a class="btn btn-sm btn-danger" href="/admin/dashboard/destmem/?id=<?= $mem['type_id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Sección de Miembros -->
                <div class="tab-pane fade my-3" id="members-tab-pane" role="tabpanel">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="mb-3"><i class="fa-solid fa-user-check"></i> Miembros y Asistencia</h2>
                        </div>
                    </div>
                    <table class="table table-striped" id="members">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Membresia</th>
                                <th>Dias restantes</th>
                                <th>Estado</th>
                                <th>Tomar asistencia</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if ($members) : ?>
                                <?php foreach ($members as $mem) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($mem["user_name"]) ?></td>
                                        <td><?= htmlspecialchars($mem["membership_type"]) ?></td>
                                        <td><?= htmlspecialchars($mem["days_res"]) ?></td>
                                        <td>
                                            <div class="<?= ($mem['status'] === 'activa') ? 'bg-success' : 'bg-danger' ?> status"><?= htmlspecialchars($mem["status"]) ?></div>
                                        </td>
                                        <td><a href=<?= '/admin/pays/asistencia?id=' . $mem['mem_id'] ?>> <?= ($mem['status'] != 'vencida') ? "<i class='fa-solid fa-check'></i>" : '' ?></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Sección de Pagos -->
                <div class="tab-pane fade my-3" id="payments-tab-pane" role="tabpanel">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="mb-3"><i class="fa-solid fa-money-bill"></i> Pagos</h2>
                        </div>
                    </div>
                    <table class="table table-striped" id="pays">
                        <thead>
                            <tr>
                                <th>Id pago</th>
                                <th>Id usuario</th>
                                <th>Nombre</th>
                                <th>Membresia</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($pays) : ?>
                                <?php foreach ($pays as $pay) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($pay["pay_id"]) ?></td>
                                        <td><?= htmlspecialchars($pay["user_id"]) ?></td>
                                        <td><?= htmlspecialchars($pay["user_name"]) ?></td>
                                        <td><?= htmlspecialchars($pay["mem_name"]) ?></td>
                                        <td><?= htmlspecialchars($pay["pay_date"]) ?></td>
                                        <td>$<?= htmlspecialchars(number_format($pay["value"], 2)) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>


                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPayModal">Registrar Pago</button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#makeReport">Generar reporte</button>


                </div>
            </div>

        </div>
    </div>


    <!-- Modals add -->

    <!-- Add user -->
    <div id="addUserModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Agregar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="" action="/admin/dashboard/adduser" method="post">
                        <input type="hidden" name="_method" value="POST">
                        <div class="mb-3">
                            <label for="userId">Id</label>
                            <input class="form-control" type="number" name="id" id="userId">
                        </div>

                        <div class="mb-3">
                            <label for="userName">Nombre</label>
                            <input class="form-control" type="text" name="name" id="userName">
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email">
                        </div>

                        <div class="mb-3">
                            <label for="pass">Contraseña</label>
                            <input class="form-control" type="password" name="pass" id="pass">
                        </div>

                        <div class="mb-3 w-25">
                            <select class="form-control" name="rol" id="">
                                <option value="user">Rol</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-md btn-primary" type="submit">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add membership -->
    <div id="addMemModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Agregar membresia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="" action="/admin/dashboard/addmem" method="post">
                        <input type="hidden" name="_method" value="POST">
                        <div class="mb-3">
                            <label for="memId">Id</label>
                            <input class="form-control" type="number" name="typeId" id="memId">
                        </div>

                        <div class="mb-3">
                            <label for="name">Nombre</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>

                        <div class="mb-3">
                            <label for="duration">Duracion</label>
                            <input class="form-control" type="number" name="duration" id="duration">
                        </div>

                        <div class="mb-3">
                            <label for="value">Valor</label>
                            <input class="form-control" type="number" name="value" id="value">
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-md btn-primary" type="submit">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add pay -->
    <div id="addPayModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Agregar pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="" action="/membership/create" method="post">
                        <input type="hidden" name="_method" value="POST">

                        <div class="mb-3">
                            <label for="userId">Id</label>
                            <input class="form-control" type="number" name="userId" id="userId">
                        </div>

                        <select class="form-control w-50" name="typeId" id="">
                            <option value="" disable selected>Selecciona una membresia</option>
                            <?php foreach ($mems as $mem): ?>
                                <?= "<option value='" . $mem['type_id'] .  "'" . ">" . $mem['name'] . "</option>" ?>
                            <?php endforeach; ?>
                        </select>

                        <div class="text-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-md btn-primary" type="submit">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Make report -->
    <div id="makeReport" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Generar reporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="" action="/admin/dashboard/report" method="post" target="_blank">
                        <input type="hidden" name="_method" value="POST">

                        <select class="form-control w-50" name="date" id="">
                            <option value="<?= $payMonths[0] ?>" disable selected>Selecciona un mes</option>
                            <?php $payMonths = array_reverse($payMonths) ?>
                            <?php foreach ($payMonths as $date): ?>
                                <?= "<option value='" . $date .  "'" . ">" . $date . "</option>" ?>
                            <?php endforeach; ?>
                        </select>

                        <div class="text-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-md btn-primary" type="submit">Generar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modals edit -->

    <!-- Edit user -->

    <div id="editUser" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="" action="/admin/dashboard/edituser" method="post">
                        <input type="hidden" name="_method" value="POST">

                        <input class="field-edit-user" type="hidden" name="userId" value="">

                        <div class="mb-3">
                            <label for="edit-name">Nombre</label>
                            <input class="form-control field-edit-user" type="text" name="name" id="edit-name" value="">
                        </div>

                        <div class="mb-3">
                            <label for="edit-email">Email</label>
                            <input class="form-control field-edit-user" type="email" name="email" id="edit-email" value="">
                        </div>

                        <div class="mb-3 w-25">
                            <select class="form-control field-edit-user" name="rol">
                                <option value="">Rol</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-md btn-primary" type="submit">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit membership -->
    <div id="editMem" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Editar membresia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="" action="/admin/dashboard/editmem" method="post">
                        <input type="hidden" name="_method" value="POST">

                        <input class="field-edit-mem" type="hidden" name="typeId" value="">

                        <div class="mb-3">
                            <label for="edit-mem-name">Nombre</label>
                            <input class="form-control field-edit-mem" type="text" name="name" id="edit-mem-name" value="">
                        </div>

                        <div class="mb-3">
                            <label for="edit-duration">Duracion (dias)</label>
                            <input class="form-control field-edit-mem" type="number" name="duration" id="edit-duration" value="">
                        </div>

                        <div class="mb-3">
                            <label for="edit-value">Valor</label>
                            <input class="form-control field-edit-mem" type="number" name="value" id="edit-value" value="">
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-md btn-primary" type="submit">Editar</button>
                        </div>
                    </form>
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

    <!-- Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        // Convierte los arrays asociativos en dos arrays: uno de labels y otro de datos
        var payLabels = <?= json_encode(array_keys($chartPays)) ?>; // ['Enero', 'Febrero', ...]
        var memsLabels = <?= json_encode($chartMems) ?>;
        var chartPaysData = <?= json_encode(array_values($chartPays)) ?>; // [10, 15, ...]
        var chartMemsData = <?= json_encode($memsData) ?>; // [12, 18, ...]
    </script>
    <script src="/main.js"></script>
</body>

</html>