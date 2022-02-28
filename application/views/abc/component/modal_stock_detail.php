<style>
  .table.no-bordered th,
  .table.no-bordered td {
    border: none;
    /* padding: 0 10px; */
  }

  .tabbable-custom>.nav-tabs>li.active {
    border-top: 3px solid #f2784b;
  }
</style>

<div class="portlet light">
  <div class="portlet-body">
    <div class="row">
      <div class="col-md-3">
        <img src="<?= base_url('uploads/pictures/stock-pictures/') . $master['Photo'] ?>" alt="<?= $master['StockDescription'] ?> Photo" class="img-responsive">
      </div>
      <div class="col-md-9">
        <table class="table no-bordered">
          <tbody>
            <tr>
              <td class="bold uppercase font-yellow-casablanca" colspan="3" style="font-size: 18px;"><?= $master['StockDescription'] ?></td>
            </tr>
            <tr>
              <td width="35%">Stokcode</td>
              <td width="2%">:</td>
              <td><?= $master['Stockcode'] ?></td>
            </tr>
            <tr>
              <td width="35%">Stock On Hand</td>
              <td width="2%">:</td>
              <td><?= array_sum(array_column($storage, 'SOH')) ?></td>
            </tr>
            <tr>
              <td width="35%">Stock Group</td>
              <td width="2%">:</td>
              <td class="bg-grey bold"><?= $master['StockGroup'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tabbable-custom nav-justified">
          <ul class="nav nav-tabs nav-justified">
            <li class="active">
              <a href="#tab_storage" data-toggle="tab">Storage</a>
            </li>
            <li>
              <a href="#tab_history" data-toggle="tab">History</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_storage">
              <table class="table table-bordered">
                <thead>
                  <tr class="bg-font-blue-chambray bg-blue-chambray">
                    <th>Storage</th>
                    <th>Bin 1</th>
                    <th>Min</th>
                    <th>Max</th>
                    <th>SOH</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($storage as $row => $value) : ?>
                    <tr>
                      <td><?= $value['StorageName'] ?></td>
                      <td><?= $value['Bin1'] ?></td>
                      <td class="text-right"><?= $value['Min'] ?></td>
                      <td class="text-right"><?= $value['Max'] ?></td>
                      <td class="text-right"><?= $value['SOH'] ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="tab-pane" id="tab_history">
              <table class="table table-bordered">
                <thead>
                  <tr class="bg-font-blue-chambray bg-blue-chambray">
                    <th>No</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Qty</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($history) : ?>
                    <?php foreach ($history as $row => $value) : ?>
                      <tr>
                        <td><?= $row + 1 ?></td>
                        <td><?= $value['TransDate'] ?></td>
                        <td class="text-center">
                          <?php if ($value['Type'] == 'Receipt') : ?>
                            <span class="badge badge-roundless bg-blue-chambray bg-font-blue-chambray">
                              <?= $value['Type'] ?>
                            </span>
                          <?php else : ?>
                            <span class="badge badge-roundless bg-yellow-casablanca bg-font-yellow-casablanca">
                              <?= $value['Type'] ?>
                            </span>
                          <?php endif; ?>
                        </td>
                        <td class="text-right"><?= $value['Qty'] ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td colspan="4" class="bold text-center">No Data</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>