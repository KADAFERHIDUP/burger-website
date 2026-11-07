<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="page cart-page">
   <div class="heading">
      <img src="<?= base_url('images/title-img.png') ?>" alt="">
      <h3>keranjang</h3>
   </div>

   <?php if ($cart['items'] === []): ?>
      <div class="empty-box">
         <i class="fas fa-shopping-cart"></i>
         <p>Keranjangmu masih kosong.</p>
         <a href="<?= base_url('#menu') ?>" class="btn">pilih menu</a>
      </div>
   <?php else: ?>
      <form action="<?= site_url('keranjang/ubah') ?>" method="post" id="cart-form">
         <?= csrf_field() ?>
         <div class="cart-list">
            <?php foreach ($cart['items'] as $item): ?>
            <div class="cart-item">
               <img src="<?= base_url($item['image'] ?: 'images/burger-baner.webp') ?>" alt="<?= esc($item['name']) ?>">
               <div class="info">
                  <h3><?= esc($item['name']) ?></h3>
                  <p><?= rupiah($item['price']) ?> / porsi</p>
               </div>
               <label class="qty">
                  <span>jumlah</span>
                  <input type="number" name="qty[<?= $item['menu_id'] ?>]" value="<?= $item['qty'] ?>" min="0" max="<?= \App\Libraries\Cart::MAX_QTY ?>">
               </label>
               <div class="subtotal"><?= rupiah($item['subtotal']) ?></div>
               <button type="submit" class="remove" formaction="<?= site_url('keranjang/hapus/' . $item['menu_id']) ?>" aria-label="Hapus <?= esc($item['name']) ?>"><i class="fas fa-trash"></i></button>
            </div>
            <?php endforeach ?>
         </div>

         <div class="cart-summary">
            <button type="submit" class="btn btn-outline"><i class="fas fa-sync-alt"></i> perbarui jumlah</button>
            <div class="total">Total: <strong><?= rupiah($cart['total']) ?></strong></div>
            <a href="<?= site_url('checkout') ?>" class="btn btn-primary">checkout <i class="fas fa-arrow-right"></i></a>
         </div>
      </form>
   <?php endif ?>
</section>

<?= $this->endSection() ?>
