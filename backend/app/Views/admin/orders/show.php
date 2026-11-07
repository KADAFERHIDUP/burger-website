<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<a href="<?= site_url('admin/pesanan') ?>" class="back-link">&larr; Semua pesanan</a>

<div class="detail-grid">
   <section class="card">
      <div class="card-head"><h2 class="mono"><?= esc($order['code']) ?></h2><span class="status status-<?= esc($order['status']) ?>"><?= status_label($order['status']) ?></span></div>
      <dl class="info">
         <dt>Pelanggan</dt><dd><?= esc($order['customer_name']) ?></dd>
         <dt>No. HP</dt><dd><?= esc($order['phone']) ?></dd>
         <dt>Alamat</dt><dd><?= nl2br(esc($order['address'])) ?></dd>
         <dt>Catatan</dt><dd><?= $order['note'] ? nl2br(esc($order['note'])) : '<span class="muted">-</span>' ?></dd>
         <dt>Dipesan</dt><dd><?= esc(date('d M Y H:i', strtotime($order['created_at']))) ?></dd>
      </dl>
      <?php $digits = preg_replace('/\D/', '', $order['phone']); $waPhone = str_starts_with($digits, '0') ? '62' . substr($digits, 1) : $digits; ?>
      <a href="https://wa.me/<?= esc($waPhone) ?>?text=<?= rawurlencode('Halo ' . $order['customer_name'] . ', pesanan ' . $order['code'] . ' sedang kami proses.') ?>" target="_blank" rel="noopener" class="button"><i class="fab fa-whatsapp"></i> Chat pelanggan</a>
   </section>

   <section class="card">
      <h2>Item</h2>
      <div class="table-wrap">
      <table>
         <thead><tr><th>Menu</th><th class="num">Harga</th><th class="num">Jumlah</th><th class="num">Subtotal</th></tr></thead>
         <tbody>
         <?php foreach ($items as $item): ?>
            <tr><td><?= esc($item['menu_name']) ?></td><td class="num"><?= rupiah($item['price']) ?></td><td class="num"><?= $item['qty'] ?></td><td class="num"><?= rupiah($item['subtotal']) ?></td></tr>
         <?php endforeach ?>
         </tbody>
         <tfoot><tr><th colspan="3">Total</th><th class="num"><?= rupiah($order['total']) ?></th></tr></tfoot>
      </table>
      </div>

      <form action="<?= site_url('admin/pesanan/' . $order['id'] . '/status') ?>" method="post" class="status-form">
         <?= csrf_field() ?>
         <label for="status">Ubah status</label>
         <select name="status" id="status">
            <?php foreach (order_statuses() as $key => $label): ?>
               <option value="<?= $key ?>" <?= $order['status'] === $key ? 'selected' : '' ?>><?= esc($label) ?></option>
            <?php endforeach ?>
         </select>
         <button type="submit" class="button button-primary">Simpan</button>
      </form>
   </section>
</div>

<?= $this->endSection() ?>
