<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>Login Admin | <?= esc(config('Burger')->shopName) ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('images/logo.png') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>">
</head>
<body class="login-body">
   <form action="<?= site_url('admin/login') ?>" method="post" class="login-card">
      <?= csrf_field() ?>
      <img src="<?= base_url('images/logo.png') ?>" alt="Logo" class="login-logo">
      <h1>Login Admin</h1>
      <?php if (session('error')): ?><p class="alert alert-error"><?= esc(session('error')) ?></p><?php endif ?>
      <?php if (session('success')): ?><p class="alert alert-success"><?= esc(session('success')) ?></p><?php endif ?>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= old('email') ?>" required autocomplete="username" autofocus>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required autocomplete="current-password">
      <button type="submit" class="button button-primary">Masuk</button>
      <a href="<?= base_url('/') ?>" class="back-link">&larr; Kembali ke website</a>
   </form>
</body>
</html>
