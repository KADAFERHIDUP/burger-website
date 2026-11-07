<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<section class="card">
   <?php if ($messages === []): ?>
      <p class="empty">Belum ada pesan masuk.</p>
   <?php else: ?>
      <div class="messages">
      <?php foreach ($messages as $m): ?>
         <article class="message <?= $m['is_read'] ? '' : 'unread' ?>">
            <header>
               <strong><?= esc($m['name']) ?></strong>
               <small><?= esc(date('d M Y H:i', strtotime($m['created_at']))) ?></small>
            </header>
            <p class="contact-line">
               <?php if ($m['email']): ?><a href="mailto:<?= esc($m['email']) ?>"><i class="fas fa-envelope"></i> <?= esc($m['email']) ?></a><?php endif ?>
               <?php if ($m['phone']): ?><span><i class="fas fa-phone"></i> <?= esc($m['phone']) ?></span><?php endif ?>
            </p>
            <p><?= nl2br(esc($m['message'])) ?></p>
            <div class="actions">
               <?php if (! $m['is_read']): ?>
                  <form action="<?= site_url('admin/pesan/' . $m['id'] . '/dibaca') ?>" method="post"><?= csrf_field() ?><button type="submit" class="button button-small">Tandai dibaca</button></form>
               <?php endif ?>
               <form action="<?= site_url('admin/pesan/' . $m['id'] . '/hapus') ?>" method="post" onsubmit="return confirm('Hapus pesan ini?')"><?= csrf_field() ?><button type="submit" class="button button-small button-danger">Hapus</button></form>
            </div>
         </article>
      <?php endforeach ?>
      </div>
      <div class="pager"><?= $pager->links() ?></div>
   <?php endif ?>
</section>

<?= $this->endSection() ?>
