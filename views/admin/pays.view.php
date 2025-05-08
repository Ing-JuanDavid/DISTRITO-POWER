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
    <form action="../router.php?action=addPay" method="post">
        <label for="">Id usuario</label>
        <input type="number" name="userId" id="">
        <label for="">Id membresia</label>
        <input type="number" name="typeId" id="">
        <input type="submit" value="Registrar">
    </form>

    <h3>Miembros</h3>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Membresia</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($members) : ?>
                <?php foreach ($members as $mem) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($mem["user_name"]) ?></td>
                        <td><?php echo htmlspecialchars($mem["membership_type"]) ?></td>
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