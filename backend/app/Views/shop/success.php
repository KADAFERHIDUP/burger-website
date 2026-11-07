<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="page success-page">
   <div class="success-card">
      <i class="fas fa-check-circle big"></i>
      <h3>pesanan diterima!</h3>
      <p>Kode pesananmu:</p>
      <div class="order-code"><?= esc($order['code']) ?></div>
      <p>Status: <span class="status status-<?= esc($order['status']) ?>"><?= status_label($order['status']) ?></span></p>

      <div class="order-summary">
         <?php foreach ($items as $item): ?>
            <div class="line"><span><?= $item['qty'] ?>x <?= esc($item['menu_name']) ?></span><span><?= rupiah($item['subtotal']) ?></span></div>
         <?php endforeach ?>
         <div class="line total"><span>Total</span><span><?= rupiah($order['total']) ?></span></div>
      </div>

      <p class="hint">Kirim konfirmasi lewat WhatsApp supaya pesananmu langsung kami proses. Simpan halaman ini untuk mengecek status pesanan.</p>
      <a href="<?= esc($waUrl) ?>" target="_blank" rel="noopener" class="btn btn-primary"><i class="fab fa-whatsapp"></i> konfirmasi via whatsapp</a>
      <a href="<?= base_url('#menu') ?>" class="btn btn-outline">kembali ke menu</a>
   </div>
</section>

<?= $this->endSection() ?>
