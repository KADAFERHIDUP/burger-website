<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="page checkout-page">
   <div class="heading">
      <img src="<?= base_url('images/title-img.png') ?>" alt="">
      <h3>checkout</h3>
   </div>

   <div class="checkout-grid">
      <form action="<?= site_url('checkout') ?>" method="post" class="checkout-form">
         <?= csrf_field() ?>
         <h4>data pengiriman</h4>
         <label for="customer_name">nama lengkap</label>
         <input type="text" id="customer_name" name="customer_name" value="<?= old('customer_name') ?>" class="box" required maxlength="100" autocomplete="name">

         <label for="phone">nomor hp / whatsapp</label>
         <input type="tel" id="phone" name="phone" value="<?= old('phone') ?>" class="box" required inputmode="tel" autocomplete="tel" placeholder="contoh: 0812-3456-7890">

         <label for="address">alamat lengkap</label>
         <textarea id="address" name="address" class="box" rows="4" required maxlength="500" placeholder="nama jalan, nomor rumah, patokan"><?= old('address') ?></textarea>

         <label for="note">catatan (opsional)</label>
         <textarea id="note" name="note" class="box" rows="3" maxlength="500" placeholder="contoh: tanpa bawang, saus dipisah"><?= old('note') ?></textarea>

         <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> buat pesanan</button>
         <p class="hint">Pembayaran tunai saat burger sampai (COD).</p>
      </form>

      <aside class="order-summary">
         <h4>ringkasan pesanan</h4>
         <?php foreach ($cart['items'] as $item): ?>
            <div class="line"><span><?= $item['qty'] ?>x <?= esc($item['name']) ?></span><span><?= rupiah($item['subtotal']) ?></span></div>
         <?php endforeach ?>
         <div class="line total"><span>Total</span><span><?= rupiah($cart['total']) ?></span></div>
         <a href="<?= site_url('keranjang') ?>" class="edit-link"><i class="fas fa-pen"></i> ubah keranjang</a>
      </aside>
   </div>
</section>

<?= $this->endSection() ?>
