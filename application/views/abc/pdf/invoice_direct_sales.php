<table cellpadding="2">
  <thead>
    <tr>
      <td align="left" width="10%">Dibeli Oleh</td>
      <td width="3%">:</td>
      <td align="left" width="37%"><?= $master_sales['Customer'] ?></td>
      <td align="left" width="10%">Nomor :</td>
      <td width="3%">:</td>
      <td align="left" width="37%"><?= $master_sales['DocNo'] ?></td>
    </tr>
    <tr>
      <td align="left" width="10%">ADP</td>
      <td width="3%">:</td>
      <td align="left" width="37%"><?= $master_sales['Supervisor'] ?></td>
      <td align="left" width="10%">Tanggal</td>
      <td width="3%">:</td>
      <td align="left" width="37%"><?= date('Y-m-d', strtotime($master_sales['SaleDate'])) ?></td>
    </tr>
    <tr>
      <td colspan="6" width="100%">Keterangan</td>
    </tr>
    <tr>
      <td colspan="6" width="100%"><?= $master_sales['Remarks'] ?></td>
    </tr>
  </thead>
</table>
<br><br>
<table cellpadding="2">
  <thead>
    <tr>
      <td border="0.5" align="center" width="3%">No</td>
      <td border="0.5" align="center" width="10%">Stockcode</td>
      <td border="0.5" align="center" width="37%">Stock Description</td>
      <td border="0.5" align="center" width="5%">Qty</td>
      <td border="0.5" align="center" width="5%">UOM</td>
      <td border="0.5" align="center" width="20%">Price</td>
      <td border="0.5" align="center" width="20%">Total</td>
    </tr>
  </thead>
  <tbody>
    <?= $content ?>
  </tbody>
</table>