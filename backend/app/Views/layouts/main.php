<?php $shop = config('Burger'); $cartCount = (new \App\Libraries\Cart())->count(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Burger') ?> | <?= esc($shop->shopName) ?></title>
    <meta name="description" content="Burger daging tebal dan keju lumer di <?= esc($shop->mapsQuery) ?>. Pesan online, bayar di tempat.">
    <meta name="author" content="<?= esc($shop->owner) ?>">
    <meta name="theme-color" content="#000000">
    <link rel="icon" type="image/png" href="<?= base_url('images/logo.png') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body>

<header class="header">
   <div id="menu-btn" class="fas fa-bars icons" role="button" tabindex="0" aria-label="Buka menu navigasi"></div>
   <div id="search-btn" class="fas fa-search icons" role="button" tabindex="0" aria-label="Cari menu"></div>

   <nav class="navbar">
      <a href="<?= base_url('#home') ?>">beranda</a>
      <a href="<?= base_url('#menu') ?>">menu</a>
      <a href="<?= base_url('#about') ?>">tentang</a>
      <span class="space"></span>
      <a href="<?= base_url('#order') ?>">cara pesan</a>
      <a href="<?= base_url('#contact') ?>">kontak</a>
      <a href="<?= base_url('#gallery') ?>">galeri</a>
   </nav>

   <a href="<?= site_url('keranjang') ?>" class="fas fa-shopping-cart icons cart-link" aria-label="Keranjang (<?= $cartCount ?> item)">
      <?php if ($cartCount > 0): ?><span class="cart-badge"><?= $cartCount ?></span><?php endif ?>
   </a>

   <a href="<?= base_url('/') ?>" class="logo"><img src="<?= base_url('images/logo.png') ?>" alt="Logo <?= esc($shop->shopName) ?>"></a>

   <form action="<?= base_url('/') ?>" method="get" class="search-form" role="search">
      <input type="search" name="q" value="<?= esc($search ?? '') ?>" placeholder="cari menu, misalnya: chicken" id="search-box" autocomplete="off">
      <label for="search-box" class="fas fa-search icons" aria-label="Cari"></label>
   </form>
</header>

<?= $this->include('partials/flash') ?>

<?= $this->renderSection('content') ?>

<section class="footer">
   <div class="links">
      <a href="<?= base_url('#home') ?>" class="btn">beranda</a>
      <a href="<?= base_url('#menu') ?>" class="btn">menu</a>
      <a href="<?= base_url('#about') ?>" class="btn">tentang</a>
      <a href="<?= base_url('#order') ?>" class="btn">cara pesan</a>
      <a href="<?= base_url('#contact') ?>" class="btn">kontak</a>
      <a href="<?= base_url('#gallery') ?>" class="btn">galeri</a>
   </div>
   <p class="credit">&copy; <?= date('Y') ?> <?= esc($shop->shopName) ?>. Dibuat oleh <span><a href="<?= esc($shop->instagram) ?>" target="_blank" rel="noopener"><?= esc($shop->owner) ?></a></span>.</p>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="<?= base_url('js/script.js') ?>"></script>
</body>
</html>
