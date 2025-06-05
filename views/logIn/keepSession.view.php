<?php view('partials/head.php', ['title' => 'confirm']) ?>


<div class="card w-25 m-auto mt-5">
    <div class="card-header">
        <h5 class="">Confirmar Sesión</h5>
    </div>
    <div class="card-body">
        <p>Hola <?= $user->__get('name'); ?>, deseas permanecer en esta sesion?</p>
        <?php if($alert): ?>
            <div class="alert alert-<?= $alert['type']; ?>"><?= $alert['body']; ?></div>
        <?php endif; ?>
    </div>
    <div class="card-footer">
        <form class="m-0" action="/recoversession" method="post">
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="email" value=<?= $user->__get('email'); ?>>
            <input type="hidden" name="rol" value=<?= $user->__get('rol'); ?>>
            <input type="hidden" name="userId" value=<?= $user->__get('userId'); ?>>
            <div class="text-end">
                <button type="submit" class="btn btn-sm btn-primary">Si, continuar</button>
                <a href="/logout" class="btn btn-sm btn-secondary">No, salir</a>
            </div>
        </form>
    </div>
</div>