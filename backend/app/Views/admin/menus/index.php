<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="toolbar"><a href="<?= site_url('admin/menu/tambah') ?>" class="button button-primary"><i class="fas fa-plus"></i> Tambah menu</a></div>

<section class="card">
   <?php if ($menus === []): ?>
      <p class="empty">Belum ada menu.</p>
   <?php else: ?>
   <div class="table-wrap">
   <table>
      <thead><tr><th>Foto</th><th>Nama</th><th>Kategori</th><th class="num">Harga</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($menus as $m): ?>
         <tr class="<?= $m['is_available'] ? '' : 'is-off' ?>">
            <td><img src="<?= base_url($m['image'] ?: 'images/burger-baner.webp') ?>" alt="" class="thumb"></td>
            <td><strong><?= esc($m['name']) ?></strong><br><small><?= esc(character_limiter((string) $m['description'], 60)) ?></small></td>
            <td><?= esc(ucfirst($m['category'])) ?></td>
            <td class="num"><?= rupiah($m['price']) ?></td>
            <td><span class="status <?= $m['is_available'] ? 'status-selesai' : 'status-batal' ?>"><?= $m['is_available'] ? 'Tersedia' : 'Habis' ?></span></td>
            <td class="actions">
               <a href="<?= site_url('admin/menu/' . $m['id'] . '/edit') ?>" class="button button-small">Edit</a>
               <form action="<?= site_url('admin/menu/' . $m['id'] . '/toggle') ?>" method="post"><?= csrf_field() ?><button type="submit" class="button button-small"><?= $m['is_available'] ? 'Tandai habis' : 'Tersedia' ?></button></form>
               <form action="<?= site_url('admin/menu/' . $m['id'] . '/hapus') ?>" method="post" onsubmit="return confirm('Hapus menu <?= esc($m['name'], 'js') ?>?')"><?= csrf_field() ?><button type="submit" class="button button-small button-danger">Hapus</button></form>
            </td>
         </tr>
      <?php endforeach ?>
      </tbody>
   </table>
   </div>
   <?php endif ?>
</section>

<?= $this->endSection() ?>
