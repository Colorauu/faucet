<?php ob_start(); ?>
<div class="container">
  <h2>Admin Dashboard</h2>
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <h5>Usuários</h5>
          <p>Gerencie usuários e estatísticas.</p>
          <a class="btn btn-sm btn-primary" href="/admin/users">Ver usuários</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <h5>Payouts</h5>
          <p>Fila de pagamentos e histórico</p>
          <a class="btn btn-sm btn-primary" href="/admin/payouts">Ver payouts</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $content = ob_get_clean(); require_once __DIR__ . '/../layout/main.php'; ?>
