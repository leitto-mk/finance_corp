<?php if ($data) : ?>
  <?php foreach ($data['detail'] as $row => $value) : ?>
    <tr nobr="true">
      <td border="0.5" align="center" width="3%"><?= $row + 1 ?></td>
      <td border="0.5" align="center" width="10%"><?= $value['Stockcode'] ?></td>
      <td border="0.5" width="37%"><?= $value['StockDescription'] ?></td>
      <td border="0.5" align="right" width="5%"><?= $value['Qty'] ?></td>
      <td border="0.5" align="center" width="5%"><?= $value['UOM'] ?></td>
      <td border="0.5" align="right" width="20%"><?= convertRupiah($value['Price']) ?></td>
      <td border="0.5" align="right" width="20%"><?= convertRupiah($value['Amount']) ?></td>
    </tr>
  <?php endforeach; ?>
  <tr>
    <td colspan="5" rowspan="6">
      Terbilang<br>
      <b><i><?= terbilang($data['master']['GrandTotal'], 2) ?> Rupiah</i></b>
    </td>
    <td border="0.5" align="right">Sub Total</td>
    <td border="0.5" align="right"><?= convertRupiah($data['master']['SubTotal']) ?></td>
  </tr>
  <tr>
    <td border="0.5" align="right">Perpuluhan</td>
    <td border="0.5" align="right"><?= convertRupiah($data['master']['Tax']) ?></td>
  </tr>
  <tr>
    <td border="0.5" align="right">Sur Charge</td>
    <td border="0.5" align="right">0</td>
  </tr>
  <tr>
    <td border="0.5" align="right">Total</td>
    <td border="0.5" align="right"><?= convertRupiah($data['master']['GrandTotal']) ?></td>
  </tr>
<?php else : ?>
  <tr>
    <td border="0.5" align="center" width="3%">1</td>
    <td border="0.5" align="center" width="10%">S-123</td>
    <td border="0.5" width="37%">Bersama Allah di Waktu Fajar</td>
    <td border="0.5" align="right" width="5%">2</td>
    <td border="0.5" align="center" width="5%">EA</td>
    <td border="0.5" align="right" width="20%">10.000</td>
    <td border="0.5" align="right" width="20%">20.000</td>
  </tr>
  <tr>
    <td colspan="5" rowspan="6">
      Terbilang<br>
      <b><i><?= terbilang(22000, 2) ?> Rupiah</i></b>
    </td>
    <td border="0.5" align="right">Sub Total</td>
    <td border="0.5" align="right">20.000</td>
  </tr>
  <tr>
    <td border="0.5" align="right">Perpuluhan</td>
    <td border="0.5" align="right">2.000</td>
  </tr>
  <tr>
    <td border="0.5" align="right">Sur Charge</td>
    <td border="0.5" align="right">0</td>
  </tr>
  <tr>
    <td border="0.5" align="right">Total</td>
    <td border="0.5" align="right">22.000</td>
  </tr>
<?php endif; ?>