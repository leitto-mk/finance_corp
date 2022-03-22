<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="coa_accno" class="control-label bold">Account No</label>
      <input type="text" name="coa_accno" id="coa_accno" class="form-control" <?= isset($coa['Acc_No']) && isset($type) ? '' : null ?> value="<?= isset($coa['Acc_No']) ? $coa['Acc_No'] : null ?>">
    </div>
  </div>
</div>
<div class=" row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="coa_name" class="control-label bold">Account Name</label>
      <input type="text" name="coa_name" id="coa_name" class="form-control"  value="<?= isset($coa['Acc_Name']) ? $coa['Acc_Name'] : null ?>" required>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="coa_type" class="control-label bold">Account Type</label>
      <input type="text" name="coa_type" id="coa_type" class="form-control" value="<?= isset($coa['Acc_Type']) ? $coa['Acc_Type'] : null ?>" required>
    </div>
  </div>
</div>
<!-- <div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="cash_bank" class="control-label bold">Cash Bank</label>
      <input type="text" name="cash_bank" id="cash_bank" class="form-control" value="<?= isset($coa['CashBank']) ? $coa['CashBank'] : "No" ?>">
      <select type="text" name="cash_bank" id="cash_bank"  class="form-control">
            <option value="<?= isset($coa['CashBank']) ? $coa['CashBank'] : "No" ?>"><?= isset($coa['CashBank']) ? $coa['CashBank'] : "No" ?></option>
            <option id="coa_group" value="No">No</option>
            <option id="coa_group" value="Yes">Yes</option>
      </select>
    </div>
  </div>
</div> -->
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="coa_group" class="control-label bold">Account Group</label>
      <select type="text" name="coa_group" id="coa_group"  class="form-control">
            <option value="<?= isset($coa['TransGroup']) ? $coa['TransGroup'] : null ?>"><?= isset($coa['TransGroup']) ? $coa['TransGroup'] : null ?></option>
            <option id="coa_group" value="Null">Null</option>
            <option id="coa_group" value="CA">CA - Cash Advance</option>
            <option id="coa_group" value="CB">CB - Cash Bank</option>
            <option id="coa_group" value="H1">H1 - Header Level 1</option>
            <option id="coa_group" value="H2">H2 - Header Level 2</option>
            <option id="coa_group" value="H3">H3 - Header Level 3</option>
            <option id="coa_group" value="H4">H4 - Header Level 4</option>
      </select>
      <!-- <input type="text" name="coa_group" id="coa_group" class="form-control" placeholder="Insert Account Group" value="<?= isset($coa['TransGroup']) ? $coa['TransGroup'] : null ?>"> -->
    </div>
  </div>
</div>