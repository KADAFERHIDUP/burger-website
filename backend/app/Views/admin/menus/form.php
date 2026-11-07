<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?php $isEdit = $menu !== null; $v = static fn (string $field, $default = '') => old($field, $menu[$field] ?? $default, false); ?>

<a href="<?= site_url('admin/menu') ?>" class="back-link">&larr; Semua menu</a>

<form action="<?= site_url($isEdit ? 'admin/menu/' . $menu['id'] : 'admin/menu') ?>" method="post" enctype="multipart/form-data" class="card form">
   <?= csrf_field() ?>

   <label for="name">Nama menu</label>
   <input type="text" id="name" name="name" value="<?= esc($v('name')) ?>" required maxlength="100">

   <div class="form-row">
      <div>
         <label for="category">Kategori</label>
         <select id="category" name="category">
            <option value="sapi" <?= $v('category', 'sapi') === 'sapi' ? 'selected' : '' ?>>Sapi</option>
            <option value="ayam" <?= $v('category') === 'ayam' ? 'selected' : '' ?>>Ayam</option>
         </select>
      </div>
      <div>
         <label for="price">Harga (Rp)</label>
         <input type="number" id="price" name="price" value="<?= esc($v('price')) ?>" min="1" step="500" required>
      </div>
   </div>

   <label for="description">Deskripsi</label>
   <textarea id="description" name="description" rows="3" maxlength="500"><?= esc($v('description')) ?></textarea>

   <label for="image">Foto <?= $isEdit ? '(kosongkan jika tidak diganti)' : '' ?></label>
   <?php if ($isEdit && $menu['image']): ?><img src="<?= base_url($menu['image']) ?>" alt="Foto sekarang" class="preview"><?php endif ?>
   <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/webp" <?= $isEdit ? '' : 'required' ?>>
   <small>PNG, JPG, atau WebP, maksimal 2 MB. Foto dengan latar transparan paling cocok.</small>

   <label class="check"><input type="checkbox" name="is_available" value="1" <?= $v('is_available', 1) ? 'checked' : '' ?>> Tersedia untuk dipesan</label>

   <button type="submit" class="button button-primary"><?= $isEdit ? 'Simpan perubahan' : 'Tambah menu' ?></button>
</form>

<?= $this->endSection() ?>
