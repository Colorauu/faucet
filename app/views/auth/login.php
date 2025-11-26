<?php ob_start(); ?>
<div class="login-box" style="max-width:420px;margin:40px auto">
  <div class="card card-outline card-primary">
    <div class="card-header text-center"><a class="h1">IRON FAUCET</a></div>
    <div class="card-body">
      <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <form method="post" action="/login">
        <input type="hidden" name="csrf" value="<?php echo Security::csrfToken(); ?>" />
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Senha" name="password" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
        </div>
        <div class="row">
          <div class="col-8"><a href="/">Voltar</a></div>
          <div class="col-4"><button type="submit" class="btn btn-primary btn-block">Entrar</button></div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $content = ob_get_clean(); require_once __DIR__ . '/../layout/main.php'; ?>
