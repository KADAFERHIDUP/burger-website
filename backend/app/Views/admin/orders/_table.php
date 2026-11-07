<div class="table-wrap">
<table>
   <thead><tr><th>Kode</th><th>Pelanggan</th><th>Total</th><th>Status</th><th>Waktu</th><th></th></tr></thead>
   <tbody>
   <?php foreach ($orders as $o): ?>
      <tr>
         <td class="mono"><?= esc($o['code']) ?></td>
         <td><?= esc($o['customer_name']) ?><br><small><?= esc($o['phone']) ?></small></td>
         <td class="num"><?= rupiah($o['total']) ?></td>
         <td><span class="status status-<?= esc($o['status']) ?>"><?= status_label($o['status']) ?></span></td>
         <td><small><?= esc(date('d M Y H:i', strtotime($o['created_at']))) ?></small></td>
         <td><a href="<?= site_url('admin/pesanan/' . $o['id']) ?>" class="button button-small">Detail</a></td>
      </tr>
   <?php endforeach ?>
   </tbody>
</table>
</div>
