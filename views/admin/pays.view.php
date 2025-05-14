<!DOCTYPE html>
<html lang="en">

<?php view('partials/head.php', ['title' => 'Pagos']) ?>

<body class="overflow-hidden">
    
    <?php view('partials/nav.php', ['links' => $links]); ?>

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

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>