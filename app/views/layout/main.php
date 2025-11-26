<!doctype html><html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Iron Faucet - Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav"><li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li></ul>
    <ul class="navbar-nav ms-auto"><li class="nav-item"><a class="nav-link" href="/admin/logout">Logout</a></li></ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/admin" class="brand-link text-center"><span class="brand-text">IRON FAUCET</span></a>
    <div class="sidebar"><nav class="mt-2"><ul class="nav nav-pills nav-sidebar flex-column" role="menu">
      <li class="nav-item"><a href="/admin" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a></li>
      <li class="nav-item"><a href="/admin/users" class="nav-link"><i class="nav-icon fas fa-users"></i><p>Usuários</p></a></li>
      <li class="nav-item"><a href="/admin/settings" class="nav-link"><i class="nav-icon fas fa-cogs"></i><p>Settings</p></a></li>
      <li class="nav-item"><a href="/admin/payouts" class="nav-link"><i class="nav-icon fas fa-money-bill"></i><p>Payouts</p></a></li>
    </ul></nav></div>
  </aside>

  <div class="content-wrapper p-3">
    <?php echo $content; ?>
  </div>

  <footer class="main-footer text-center"><strong>Iron Faucet</strong></footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
