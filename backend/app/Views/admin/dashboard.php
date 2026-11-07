<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="stats">
   <a href="<?= site_url('admin/pesanan?status=baru') ?>" class="stat highlight"><span class="label">Pesanan baru</span><span class="value"><?= $newOrders ?></span></a>
   <a href="<?= site_url('admin/pesanan') ?>" class="stat"><span class="label">Total pesanan</span><span class="value"><?= $totalOrders ?></span></a>
   <div class="stat"><span class="label">Pendapatan<small>diproses, diantar, selesai</small></span><span class="value"><?= rupiah($revenue) ?></span></div>
   <a href="<?= site_url('admin/menu') ?>" class="stat"><span class="label">Menu</span><span class="value"><?= $menuCount ?></span></a>
   <a href="<?= site_url('admin/pesan') ?>" class="stat"><span class="label">Pesan belum dibaca</span><span class="value"><?= $unread ?></span></a>
</div>

<section class="card">
   <div class="card-head"><h2>Pesanan terbaru</h2><a href="<?= site_url('admin/pesanan') ?>">Lihat semua &rarr;</a></div>
   <?php if ($latest === []): ?>
      <p class="empty">Belum ada pesanan. Coba pesan dari halaman website untuk mengetes.</p>
   <?php else: ?>
      <?= view('admin/orders/_table', ['orders' => $latest]) ?>
   <?php endif ?>
</section>

<?= $this->endSection() ?>
