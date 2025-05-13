<!DOCTYPE html>
<html lang="en">

<?php view('partials/head.php', ['title' => 'Dashboard']) ?>

<body>

    <?php view('partials/nav.php', ['links' => $links]); ?>

    <div class="container mx-4 my-3">
        <h2>Dashboard</h2>
    </div>

    <div class="container my-1">

        <?php if ($alert): ?>
            <div class="alert alert-<?= $alert['type'] ?> alert-dismissible fade show position-stiky" role="alert">
                <?= $alert['body'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <ul class="nav nav-tabs border-secondar-subtle" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-tab-pane" type="button" role="tab" aria-controls="users-tab-pane" aria-selected="true">Usuarios</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#mem-tab-pane" type="button" role="tab" aria-controls="mem-tab-pane" aria-selected="false">Membresias</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">

            <!-- usersTab -->
            <div class="tab-pane fade show active my-3" id="users-tab-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0"">
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
                                    <td><?= htmlspecialchars($user["userId"]) ?></td>
                                    <td><?= htmlspecialchars($user["name"]) ?></td>
                                    <td><?= htmlspecialchars($user["email"]) ?></td>
                                    <td><?= htmlspecialchars($user["rol"]) ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="/admin/dashboard/edituser/?id=<?= $user['userId'] ?>"><i class="fa-solid fa-pen"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/admin/dashboard/destuser/?id=<?= $user['userId'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">No hay usuarios todavia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>

            <!-- memTab -->
            <div class="tab-pane fade my-3" id="mem-tab-pane" role="tabpanel" aria-labelledby="mem-tab" tabindex="0"">
                
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
                            <th>Duracion</th>
                            <th>Valor</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($mems) : ?>
                            <?php foreach ($mems as $mem) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($mem["typeId"]) ?></td>
                                    <td><?php echo htmlspecialchars($mem["name"]) ?></td>
                                    <td><?php echo htmlspecialchars($mem["duration"]) ?></td>
                                    <td><?php echo htmlspecialchars($mem["value"]) ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="/admin/dashboard/editmem/id?<?= $mem['typeId'] ?>" ><i class="fa-solid fa-pen"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/admin/dashboard/destmem/?id=<?= $mem['typeId'] ?>" ><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td>No hay membresias todavia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>

        </div>

    </div>

    <!-- Modals -->

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



    <!-- Boostrapt -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/94b343effb.js" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Datatable -->
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.bootstrap5.js"></script>

    <script src="/main.js"></script>
</body>

</html>