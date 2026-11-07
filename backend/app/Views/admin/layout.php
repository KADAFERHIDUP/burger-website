<?php $admin = session('admin'); $unread = (new \App\Models\MessageModel())->where('is_read', 0)->countAllResults(); $newOrders = (new \App\Models\OrderModel())->where('status', 'baru')->countAllResults(); $path = uri_string(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title><?= esc($title ?? 'Admin') ?> | Admin <?= esc(config('Burger')->shopName) ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('images/logo.png') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
</head>
<body>
<div class="admin">
   <aside class="sidebar" id="sidebar">
      <a href="<?= site_url('admin') ?>" class="brand"><img src="<?= base_url('images/logo.png') ?>" alt="Logo"> <span>Admin</span></a>
      <nav>
         <a href="<?= site_url('admin') ?>" class="<?= $path === 'admin' ? 'active' : '' ?>"><i class="fas fa-chart-pie"></i> Dashboard</a>
         <a href="<?= site_url('admin/pesanan') ?>" class="<?= str_starts_with($path, 'admin/pesanan') ? 'active' : '' ?>"><i class="fas fa-receipt"></i> Pesanan <?php if ($newOrders): ?><span class="pill"><?= $newOrders ?></span><?php endif ?></a>
         <a href="<?= site_url('admin/menu') ?>" class="<?= str_starts_with($path, 'admin/menu') ? 'active' : '' ?>"><i class="fas fa-hamburger"></i> Menu</a>
         <a href="<?= site_url('admin/pesan') ?>" class="<?= str_starts_with($path, 'admin/pesan') && ! str_starts_with($path, 'admin/pesanan') ? 'active' : '' ?>"><i class="fas fa-envelope"></i> Pesan <?php if ($unread): ?><span class="pill"><?= $unread ?></span><?php endif ?></a>
      </nav>
      <div class="sidebar-foot">
         <a href="<?= base_url('/') ?>" target="_blank" rel="noopener"><i class="fas fa-external-link-alt"></i> Lihat website</a>
         <a href="<?= site_url('admin/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
   </aside>

   <main class="main">
      <header class="topbar">
         <button type="button" class="menu-toggle" aria-label="Buka menu" onclick="document.getElementById('sidebar').classList.toggle('open')"><i class="fas fa-bars"></i></button>
         <h1><?= esc($title ?? 'Admin') ?></h1>
         <span class="who"><i class="fas fa-user-circle"></i> <?= esc($admin['name'] ?? '') ?></span>
      </header>

      <?php if (session('success')): ?><div class="alert alert-success"><?= session('success') ?></div><?php endif ?>
      <?php if (session('error')): ?><div class="alert alert-error"><?= esc(session('error')) ?></div><?php endif ?>
      <?php if (session('errors')): ?>
         <div class="alert alert-error"><ul><?php foreach ((array) session('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach ?></ul></div>
      <?php endif ?>

      <?= $this->renderSection('content') ?>
   </main>
</div>
</body>
</html>
