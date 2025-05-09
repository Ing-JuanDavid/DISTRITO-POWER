<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
</head>

<body>
    <header>
        <navbar>
            <ul>
                <li><a href="/admin/dashboard">Dashboard</a></li>
                <li><a href="/admin/pays">Pagos</a></li>
                <li><a href="/logout">Salir</a></li>
            </ul>
        </navbar>
    </header>
    <h1>Pagos</h1>

    <h2>Registrar</h2>
    <form action="/admin/pays/addpay" method="post">
        <input type="hidden" name="_method" value="POST">
        <label for="">Id usuario</label>
        <input type="number" name="userId" id="">
        <label for="">Membresia</label>
        <select name="typeId" id="">
            <option value="" disable selected>Selecciona una membresia</option>
            <?php foreach($mems as $mem): ?>
                <?= "<option value='" . $mem['typeId'] .  "'" . ">".$mem['name'] ."</option>" ?>
            <?php endforeach;?>
        </select>
        <input type="submit" value="Registrar">
        <?php if ($alert): ?>
            <?= $alert['body'] ?>
        <?php endif; ?>
    </form>

    <h3>Miembros</h3>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Membresia</th>
                <th>Dias restantes</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($members) : ?>
                <?php foreach ($members as $mem) : ?>
                    <tr>
                        <td><?= htmlspecialchars($mem["user_name"]) ?></td>
                        <td><?= htmlspecialchars($mem["membership_type"]) ?></td>
                        <td><?= htmlspecialchars($mem["days_res"]) ?></td>
                        <td><?= htmlspecialchars($mem["status"]) ?></td>
                        <td><a href=<?= '/admin/pays/asistencia?id='.$mem['mem_id'] ?>>asistencia</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td>No hay miembros todavia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>