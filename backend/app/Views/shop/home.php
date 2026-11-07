<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php $shop = config('Burger'); ?>

<section class="home" id="home">
   <div class="content">
      <img data-aos="fade-up" data-aos-delay="150" src="<?= base_url('images/burger-baner.webp') ?>" alt="Burger daging dobel dengan keju lumer" width="700" height="700">
      <h3 data-aos="fade-up" data-aos-delay="300">Daging tebal, rasa bikin nagih</h3>
      <p data-aos="fade-up" data-aos-delay="450">Burger dengan daging tebal, keju lumer, dan sayuran segar. Masukkan ke keranjang, isi alamat, dan pesananmu langsung kami proses.</p>
      <a data-aos="fade-up" data-aos-delay="600" href="#menu" class="btn">lihat menu</a>
   </div>
</section>

<section class="service">
   <div class="box" data-aos="fade-up" data-aos-delay="150">
      <i class="fas fa-hamburger"></i>
      <h3>kualitas terbaik</h3>
      <p>Daging pilihan, roti lembut, dan sayuran segar di setiap burger.</p>
   </div>
   <div class="box" data-aos="fade-up" data-aos-delay="300">
      <i class="fas fa-shipping-fast"></i>
      <h3>siap antar</h3>
      <p>Pesan dari rumah, burger diantar ke tempatmu di sekitar Lhokseumawe.</p>
   </div>
   <div class="box" data-aos="fade-up" data-aos-delay="450">
      <i class="fas fa-shopping-basket"></i>
      <h3>pesan online</h3>
      <p>Pilih menu, masukkan ke keranjang, lalu checkout dalam satu menit.</p>
   </div>
</section>

<section class="menu" id="menu">
   <div class="heading">
      <img src="<?= base_url('images/title-img.png') ?>" alt="">
      <h3>menu kami</h3>
   </div>

   <?php if ($search !== ''): ?>
      <p class="search-info">Hasil pencarian "<?= esc($search) ?>": <?= count($menus) ?> menu. <a href="<?= base_url('#menu') ?>">Tampilkan semua</a></p>
   <?php endif ?>

   <div class="box-container">
      <?php foreach ($menus as $i => $menu): ?>
      <div class="box" data-aos="fade-up" data-aos-delay="<?= 150 * (($i % 6) + 1) ?>">
         <img src="<?= base_url($menu['image'] ?: 'images/burger-baner.webp') ?>" alt="<?= esc($menu['name']) ?>" loading="lazy">
         <div class="content">
            <div class="stars">
               <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
            </div>
            <h3><?= esc($menu['name']) ?></h3>
            <?php if ($menu['description']): ?><p class="desc"><?= esc($menu['description']) ?></p><?php endif ?>
            <div class="price"><?= rupiah($menu['price']) ?></div>
            <form action="<?= site_url('keranjang/tambah') ?>" method="post" class="add-form">
               <?= csrf_field() ?>
               <input type="hidden" name="menu_id" value="<?= $menu['id'] ?>">
               <button type="submit" class="btn"><i class="fas fa-cart-plus"></i> tambah ke keranjang</button>
            </form>
         </div>
      </div>
      <?php endforeach ?>
   </div>

   <p class="no-result" id="no-result" <?= $menus ? 'hidden' : '' ?>>Menu tidak ditemukan. Coba kata lain, misalnya "beef" atau "chicken".</p>
</section>

<section class="about" id="about">
   <div class="image" data-aos="fade-right" data-aos-delay="150">
      <img src="<?= base_url('images/about-img.webp') ?>" alt="Burger dengan selada, tomat, bawang, dan daging sapi" width="700" height="700" loading="lazy">
   </div>
   <div class="content" data-aos="fade-left" data-aos-delay="300">
      <h3 class="title">Selamat datang di surga burger</h3>
      <p>Kami membuat burger yang sederhana tapi serius soal rasa: daging yang juicy, keju yang lumer, roti yang dipanggang, dan sayuran segar. Cocok untuk makan siang, nongkrong bareng teman, atau teman begadang.</p>
      <div class="icons">
         <h3> <i class="fas fa-check"></i> harga bersahabat </h3>
         <h3> <i class="fas fa-check"></i> pelayanan ramah </h3>
         <h3> <i class="fas fa-check"></i> bahan segar </h3>
         <h3> <i class="fas fa-check"></i> roti panggang </h3>
         <h3> <i class="fas fa-check"></i> keju lumer </h3>
         <h3> <i class="fas fa-check"></i> pilihan ayam & sapi </h3>
      </div>
      <a href="#menu" class="btn">lihat menu</a>
   </div>
</section>

<section class="reviews" id="order">
   <div class="heading">
      <img src="<?= base_url('images/title-img.png') ?>" alt="">
      <h3>cara pesan</h3>
   </div>
   <div class="box-container">
      <div class="box" data-aos="fade-up" data-aos-delay="150">
         <i class="fas fa-cart-plus"></i>
         <h3>1. pilih menu</h3>
         <p>Tekan "tambah ke keranjang" pada burger yang kamu mau. Bisa lebih dari satu.</p>
      </div>
      <div class="box" data-aos="fade-up" data-aos-delay="300">
         <i class="fas fa-clipboard-list"></i>
         <h3>2. checkout</h3>
         <p>Buka keranjang, atur jumlahnya, lalu isi nama, nomor HP, dan alamat.</p>
      </div>
      <div class="box" data-aos="fade-up" data-aos-delay="450">
         <i class="fab fa-whatsapp"></i>
         <h3>3. konfirmasi</h3>
         <p>Kamu dapat kode pesanan. Kirim konfirmasi lewat WhatsApp, lalu tunggu burgernya sampai.</p>
      </div>
   </div>
</section>

<section class="contact" id="contact">
   <div class="heading">
      <img src="<?= base_url('images/title-img.png') ?>" alt="">
      <h3>hubungi kami</h3>
   </div>
   <div class="row">
      <div class="map-box" data-aos="fade-up" data-aos-delay="150">
         <iframe class="map" title="Peta lokasi <?= esc($shop->mapsQuery) ?>" src="https://www.google.com/maps?q=<?= rawurlencode($shop->mapsQuery) ?>&amp;z=15&amp;output=embed" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         <a class="btn map-link" href="https://www.google.com/maps/search/?api=1&amp;query=<?= rawurlencode($shop->mapsQuery) ?>" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt"></i> buka di google maps</a>
      </div>
      <div class="form">
         <div class="icons-container">
            <div class="icons" data-aos="fade-up" data-aos-delay="150">
               <i class="fas fa-map"></i>
               <h3>alamat :</h3>
               <p><?= esc($shop->address) ?></p>
            </div>
            <div class="icons" data-aos="fade-up" data-aos-delay="300">
               <i class="fas fa-envelope"></i>
               <h3>email :</h3>
               <p class="raw"><a href="mailto:<?= esc($shop->email) ?>"><?= esc($shop->email) ?></a></p>
            </div>
            <div class="icons" data-aos="fade-up" data-aos-delay="450">
               <i class="fas fa-phone"></i>
               <h3>telepon / wa :</h3>
               <p class="raw"><a href="<?= wa_url() ?>" target="_blank" rel="noopener"><?= esc($shop->phoneDisplay) ?></a></p>
            </div>
         </div>

         <form action="<?= site_url('kontak') ?>" method="post" id="contact-form">
            <?= csrf_field() ?>
            <input type="text" name="name" value="<?= old('name') ?>" placeholder="nama lengkap" class="box" autocomplete="name" required maxlength="100">
            <input type="email" name="email" value="<?= old('email') ?>" placeholder="email (opsional)" class="box" autocomplete="email">
            <input type="tel" name="phone" value="<?= old('phone') ?>" placeholder="nomor hp (opsional)" class="box" autocomplete="tel" inputmode="tel">
            <textarea name="message" placeholder="pesan" class="box" rows="8" required maxlength="2000"><?= old('message') ?></textarea>
            <input type="submit" value="kirim pesan" class="btn">
         </form>
      </div>
   </div>
</section>

<section class="blogs" id="gallery">
   <div class="heading">
      <img src="<?= base_url('images/title-img.png') ?>" alt="">
      <h3>galeri</h3>
   </div>
   <div class="box-container">
      <?php foreach ([
          ['blog-1.webp', 'burger & kentang', 'Paduan klasik yang selalu pas: burger hangat dan kentang goreng renyah.', 'Burger dengan kentang goreng'],
          ['blog-2.webp', 'disajikan hangat', 'Setiap burger dibuat saat dipesan supaya tetap hangat sampai di tanganmu.', 'Burger di atas papan kayu dengan saus'],
          ['blog-3.webp', 'porsi mengenyangkan', 'Daging tebal dan isian lengkap, cukup untuk mengganjal lapar seharian.', 'Burger dengan tomat, bawang, dan kentang goreng'],
      ] as $i => [$img, $heading, $text, $alt]): ?>
      <div class="box" data-aos="fade-up" data-aos-delay="<?= 150 * ($i + 1) ?>">
         <div class="image">
            <img src="<?= base_url('images/' . $img) ?>" alt="<?= esc($alt) ?>" width="626" height="417" loading="lazy">
         </div>
         <div class="content">
            <h3><?= esc($heading) ?></h3>
            <p><?= esc($text) ?></p>
         </div>
      </div>
      <?php endforeach ?>
   </div>
</section>

<?= $this->endSection() ?>
