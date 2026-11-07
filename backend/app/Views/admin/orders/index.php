<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<nav class="tabs" aria-label="Filter status">
   <a href="<?= site_url('admin/pesanan') ?>" class="<?= $status === '' ? 'active' : '' ?>">Semua</a>
   <?php foreach (order_statuses() as $key => $label): ?>
      <a href="<?= site_url('admin/pesanan?status=' . $key) ?>" class="<?= $status === $key ? 'active' : '' ?>"><?= esc($label) ?></a>
   <?php endforeach ?>
</nav>

<section class="card">
   <?php if ($orders === []): ?>
      <p class="empty">Tidak ada pesanan<?= $status ? ' dengan status ' . esc(status_label($status)) : '' ?>.</p>
   <?php else: ?>
      <?= view('admin/orders/_table', ['orders' => $orders]) ?>
      <div class="pager"><?= $pager->links() ?></div>
   <?php endif ?>
</section>

<?= $this->endSection() ?>
