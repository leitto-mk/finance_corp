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
			<input type="text" name="coa_name" id="coa_name" class="form-control" value="<?= isset($coa['Acc_Name']) ? $coa['Acc_Name'] : null ?>" required>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label for="coa_type" class="control-label bold">Account Type</label>
			<select type="text" name="coa_type" id="coa_type" class="form-control" required>
				<option value="">-- Select Account Type --</option>
				<?php for($i=0; $i < count($acc_types); $i++) : ?>
					<?php if(isset($coa['Acc_Type'])) : ?>
						<?php if($acc_types[$i]['id'] == $coa['Acc_Type']) : ?>
							<option value="<?= $acc_types[$i]['id'] ?>" selected><?= $acc_types[$i]['text'] ?></option>
						<?php else : ?>
							<option value="<?= $acc_types[$i]['id'] ?>"><?= $acc_types[$i]['text'] ?></option>
						<?php endif; ?>
					<?php else : ?>
						<option value="<?= $acc_types[$i]['id'] ?>"><?= $acc_types[$i]['text'] ?></option>
					<?php endif; ?>
				<?php endfor; ?>
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label for="coa_group" class="control-label bold">Account Group</label>
			<select type="text" name="coa_group" id="coa_group" class="form-control">
				<option value="">-- Select Account Group --</option>
				<?php if($type == "edit") : ?>
					<option id="coa_group" <?= ($transgroup == 'CA' ? 'selected' : '') ?> value="CA">CA - Cash Advance</option>
					<option id="coa_group" <?= ($transgroup == 'CB' ? 'selected' : '') ?> value="CB">CB - Cash Bank</option>
					<option id="coa_group" <?= ($transgroup == 'SG' ? 'selected' : '') ?> value="SG">SG - Sales Goods</option>
					<option id="coa_group" <?= ($transgroup == 'SS' ? 'selected' : '') ?> value="SS">SS - Sales Services</option>
					<option id="coa_group" <?= ($transgroup == 'DIS' ? 'selected' : '') ?> value="DIS">DIS - Discount Total</option>
					<option id="coa_group" <?= ($transgroup == 'VAT' ? 'selected' : '') ?> value="VAT">VAT - VAT</option>
					<option id="coa_group" <?= ($transgroup == 'PPH' ? 'selected' : '') ?> value="PPH">PPH - PPh 23</option>
					<option id="coa_group" <?= ($transgroup == 'FRE' ? 'selected' : '') ?> value="FRE">FRE - Freight</option>
					<option id="coa_group" <?= ($transgroup == 'AR' ? 'selected' : '') ?> value="AR">AR - Total Amount</option>
					<option id="coa_group" <?= ($transgroup == 'INV' ? 'selected' : '') ?> value="INV">INV - Inventory</option>
					<option id="coa_group" <?= ($transgroup == 'COGS' ? 'selected' : '') ?> value="COGS">COGS - Cost Of Goods Sold</option>
					<option id="coa_group" <?= ($transgroup == 'H1' ? 'selected' : '') ?> value="H1">H1 - Header Level 1</option>
					<option id="coa_group" <?= ($transgroup == 'H2' ? 'selected' : '') ?> value="H2">H2 - Header Level 2</option>
					<option id="coa_group" <?= ($transgroup == 'H3' ? 'selected' : '') ?> value="H3">H3 - Header Level 3</option>
					<option id="coa_group" <?= ($transgroup == 'H4' ? 'selected' : '') ?> value="H4">H4 - Header Level 4</option>
				<?php else : ?>
					<option id="coa_group" value="CA">CA - Cash Advance</option>
					<option id="coa_group" value="CB">CB - Cash Bank</option>
					<option id="coa_group" value="SG">SG - Sales Goods</option>
					<option id="coa_group" value="SS">SS - Sales Service</option>
					<option id="coa_group" value="DIS">DIS - Discount Total</option>
					<option id="coa_group" value="VAT">VAT - VAT</option>
					<option id="coa_group" value="PPH">PPH - PPh 23</option>
					<option id="coa_group" value="FRE">FRE - Freight</option>
					<option id="coa_group" value="AR">AR - Total Amount</option>
					<option id="coa_group" value="INV">INV - Inventory</option>
					<option id="coa_group" value="COGS">COGS - Cost Of Goods Sold</option>
					<option id="coa_group" value="H1">H1 - Header Level 1</option>
					<option id="coa_group" value="H2">H2 - Header Level 2</option>
					<option id="coa_group" value="H3">H3 - Header Level 3</option>
					<option id="coa_group" value="H4">H4 - Header Level 4</option>
				<?php endif; ?>
			</select>
		</div>
	</div>
</div>