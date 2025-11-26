<?php ob_start(); ?>
<div class="container">
  <h3>Usuários</h3>
  <table class="table table-striped">
    <thead><tr><th>ID</th><th>Usuário</th><th>Email</th><th>Criado</th></tr></thead>
    <tbody>
      <?php foreach($users as $u): ?>
      <tr>
        <td><?=htmlspecialchars($u['id'])?></td>
        <td><?=htmlspecialchars($u['username'])?></td>
        <td><?=htmlspecialchars($u['email'])?></td>
        <td><?=htmlspecialchars($u['created_at'])?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php $content = ob_get_clean(); require_once __DIR__ . '/../layout/main.php'; ?>
