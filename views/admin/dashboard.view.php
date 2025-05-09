<!DOCTYPE html>
<html lang="en">

<?php view('partials/head.php', ['title' => 'Dashboard']) ?>

<body class="overflow-hidden">
    
    <?php view('partials/nav.php', ['links' => $links]); ?>
    
    <h2>Panel de control</h1>
    <h3>Acciones</h3>

    <?php if ($alert): ?>
        <?= $alert['body'] ?>
    <?php endif; ?>

    <h5>Agregar usuario</h5>
        <form action="/admin/dashboard/adduser" method="post">
            <input type="hidden" name="_method" value="POST">
            <label for="userId">Id</label>
            <input type="number" name="id" id="userId">
            <label for="userName">Nombre</label>
            <input type="text" name="name" id="userName">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" id="pass">
            <select name="rol" id="">
                <option value="user">Rol</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <input type="submit" value="Crear">
        </form>

        <h5>Usuarios</h3>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($users) : ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user["userId"]) ?></td>
                            <td><?php echo htmlspecialchars($user["name"]) ?></td>
                            <td><?php echo htmlspecialchars($user["email"]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td>No hay usuarios todavia</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h5>Crear membresia</h5>
        <form action="/admin/dashboard/addmem" method="post">
            <input type="hidden" name="_method" value="POST">
            <label for="memId">Id</label>
            <input type="number" name="typeId" id="memId">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name">
            <label for="duration">Duracion</label>
            <input type="number" name="duration" id="duration">
            <label for="value">Valor</label>
            <input type="number" name="value" id="value">
            <input type="submit" value="Crear">
        </form>

        <h5>Membresias</h5>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Duracion</th>
                    <th>Valor</th>
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
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td>No hay membresias todavia</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>