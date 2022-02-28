<style>
  h4.bo-description,
  h3.bo-description {
    margin: 0;
    color: #2C3E50;
  }
</style>
<div class="row">
  <div class="col-lg-4">
    <div class="portlet light" style="margin-bottom: 0;">
      <div class="portlet-title">
        <div class="caption">
          <span class="caption-subject bold uppercase">Detail</span>
        </div>
      </div>
      <div class="portlet-body">
        <div class="form-group">
          <label for="bo_doc_no" class="control-label">Document Number</label>
          <h4 class="bo-description bold">
            <?= $master['DocNo'] ?>
          </h4>
        </div>
        <div class="form-group">
          <label for="bo_reg_by" class="control-label">Registered By</label>
          <h4 class="bo-description bold">
            <?= $master['RegBy'] ?>
          </h4>
        </div>
        <div class="form-group">
          <label for="bo_reg_date" class="control-label">Registered Date</label>
          <h4 class="bo-description bold">
            <?= $master['Date'] ?>
          </h4>
        </div>
        <div class="form-group">
          <label for="bo_master_remarks" class="control-label">Remarks</label>
          <h4 class="bo-description bold">
            <?= $master['Description'] ?>
          </h4>
        </div>
        <?php if (isset($master['ApprovedBy'])) : ?>
          <div class="form-group">
            <label for="bo_reg_by" class="control-label">Approved By</label>
            <h4 class="bo-description bold">
              <?= $master['ApprovedBy'] ?>
            </h4>
          </div>
        <?php endif; ?>
        <?php if (isset($master['ApprovedDate'])) : ?>
          <div class="form-group">
            <label for="bo_reg_date" class="control-label">Approved Date</label>
            <h4 class="bo-description bold">
              <?= $master['ApprovedDate'] ?>
            </h4>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-lg-8">
    <div class="portlet light" style="margin-bottom: 0;">
      <div class="portlet-title tabbable-line">
        <div class="caption">
          <span class="caption-subject bold uppercase">Book</span>
        </div>
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab-ordered" data-toggle="tab">Ordered</a></li>
          <li><a href="#tab-received" data-toggle="tab">Received</a></li>
        </ul>
      </div>
      <div class="portlet-body" id="portlet-book">
        <div class="tab-content">
          <div class="tab-pane active" id="tab-ordered">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="bg-blue-chambray bg-font-blue-chambray">
                  <tr>
                    <th>Stockcode</th>
                    <th>Description</th>
                    <th>Ordered</th>
                    <th>Invoice</th>
                    <th>Outstanding</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($detail as $row => $value) : ?>
                    <tr>
                      <td><?= $value['Stockcode'] ?></td>
                      <td><?= $value['BookName'] ?></td>
                      <td class="text-right"><?= $value['Ordered'] ?></td>
                      <td class="text-right"><?= $value['Invoice'] ?></td>
                      <td class="text-right"><?= $value['Outstanding'] ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane" id="tab-received">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="bg-blue-chambray bg-font-blue-chambray">
                  <tr>
                    <th>Stockcode</th>
                    <th>Description</th>
                    <th>Transferred</th>
                    <th>Received</th>
                    <th>Outstanding</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($transferred) : ?>
                    <?php foreach ($transferred as $row => $value) : ?>
                      <tr>
                        <td><?= $value['Stockcode'] ?></td>
                        <td><?= $value['BookName'] ?></td>
                        <td class="text-right"><?= $value['Transferred'] ?></td>
                        <td class="text-right"><?= $value['Received'] ?></td>
                        <td class="text-right"><?= $value['Transferred'] - $value['Received'] ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td class="text-center" colspan="5">This Transaction is on progress</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <?php if (isset($master['ApprovedBy']) && $received_btn) : ?>
              <hr>
              <div class="row">
                <div class="col-lg-12">
                  <div class="pull-right">
                    <a href="#receive-bo-modal" id="action-receive-bo" data-id="<?= $master['CtrlNo'] ?>" data-toggle="modal" class="btn yellow-casablanca">Receive</a>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>