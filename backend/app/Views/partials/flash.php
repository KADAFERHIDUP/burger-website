<?php $errors = session('errors'); ?>
<?php if (session('success') || session('error') || $errors): ?>
<div class="flash-wrap" id="flash">
   <?php if (session('success')): ?>
      <!-- Pesan sukses dibuat oleh aplikasi sendiri; input pengguna di dalamnya sudah di-escape -->
      <div class="flash flash-success" role="status"><i class="fas fa-check-circle"></i> <span><?= session('success') ?></span></div>
   <?php endif ?>
   <?php if (session('error')): ?>
      <div class="flash flash-error" role="alert"><i class="fas fa-exclamation-circle"></i> <span><?= esc(session('error')) ?></span></div>
   <?php endif ?>
   <?php if ($errors): ?>
      <div class="flash flash-error" role="alert"><i class="fas fa-exclamation-circle"></i>
         <ul><?php foreach ((array) $errors as $e): ?><li><?= esc($e) ?></li><?php endforeach ?></ul>
      </div>
   <?php endif ?>
   <button type="button" class="flash-close" aria-label="Tutup notifikasi" onclick="this.parentElement.remove()">&times;</button>
</div>
<?php endif ?>
