<?php ob_start(); ?>

<h1 class="mb-4"><i class="fa fa-coins"></i> Faucet funcionando!</h1>

<div class="alert alert-success">
    Sistema MVC + AdminLTE carregado com sucesso.
</div>

<?php $content = ob_get_clean();
require_once __DIR__ . '/../layout/main.php';
