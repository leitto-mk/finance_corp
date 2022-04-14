<h1 class="page-title"><?= $title ?></h1>
<form method="POST" id="form_new_invoice">
	<div class="row">
		<div class="col-lg-4">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject bold uppercase">Detail</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="form-group">
						<label for="no" class="control-label">Invoice No.</label>
						<input type="text" name="invoice_no" id="invoice_no" class="form-control" readonly value="<?= $invoice_no ?>">
					</div>
					<div class="form-group">
						<label for="customer" class="control-label">Customer</label>
						<select name="customer" id="customer" class="form-control" data-value="" required>
							<option value="">-- Select Customer --</option>
							<?php if (!empty($customer)) : ?>
								<?php for ($i = 0; $i < count($customer); $i++) : ?>
									<option value="<?= $customer[$i]['CustomerCode'] ?>"><?= $customer[$i]['CustomerName'] ?></option>
								<?php endfor; ?>
							<?php endif; ?>
						</select>
						<span class="help-block hidden"></span>
					</div>
					<div class="form-group">
						<label for="reference_no" class="control-label">Quote / Order No</label>
						<input type="text" name="reference_no" id="reference_no" class="form-control" value="">
						<span class="help-block hidden"></span>
					</div>
					<div class="form-group">
						<label for="remark" class="control-label">Remarks</label>
						<textarea type="text" name="remark" id="remark" class="form-control"></textarea>
						<span class="help-block hidden"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject bold uppercase">Bill & Shipping</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="bill_to" class="control-label">Bill To</label>
								<input type="text" name="bill_to" id="bill_to" class="form-control" value="" required>
								<span class="help-block hidden"></span>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="ship_to" class="control-label">Ship To</label>
								<input type="text" name="ship_to" id="ship_to" class="form-control" value="" required>
								<span class="help-block hidden"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="storage" class="control-label">Storage</label>
						<select name="storage" id="storage" class="form-control" required>
							<option value="">-- Select Storage --</option>
							<?php if (!empty($storage)) : ?>
								<?php for ($i = 0; $i < count($storage); $i++) : ?>
									<option value="<?= $storage[$i]['StorageCode'] ?>"><?= $storage[$i]['StorageName'] ?></option>
								<?php endfor; ?>
							<?php endif; ?>
						</select>
						<span class="help-block hidden"></span>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="freight" class="control-label">Freight</label>
								<input type="text" name="freight" id="freight" class="form-control" value="" required>
								<span class="help-block hidden"></span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group" class="control-label" style="margin-bottom: 0px;">
								<label for="shipment">Shipment Via</label>
								<div class="mt-checkbox-inline">
									<label class="mt-checkbox">
										<input type="checkbox" name="ship_via_air" id="ship_via_air">
										Air
										<span></span>
									</label>
									<label class="mt-checkbox">
										<input type="checkbox" name="ship_via_sea" id="ship_via_sea">
										Sea
										<span></span>
									</label>
									<label class="mt-checkbox">
										<input type="checkbox" name="ship_via_land" id="ship_via_land">
										Land
										<span></span>
									</label>
								</div>
								<span class="help-block hidden"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="freight_info" class="control-label">Freight Info</label>
						<textarea type="text" name="freight_info" id="freight_info" class="form-control"></textarea>
						<span class="help-block hidden"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject bold uppercase">Raise Info</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="form-group">
						<label for="branch" class="control-label">Branch</label>
						<select name="branch" id="branch" class="form-control" required>
							<option value="">-- Select Branch --</option>
							<?php for($i=0; $i<count($branch); $i++) : ?>) : ?>
								<option value="<?= $branch[$i]['BranchCode'] ?>"><?= $branch[$i]['BranchName'] ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<!-- <div class="form-group">
						<label for="raised_by" class="control-label">Raised By</label>
						<input type="text" name="raised_by" id="raised_by" class="form-control" readonly value="<?= date('Y-m-d') ?>">
					</div> -->
					<div class="form-group">
						<label for="ref_docno" class="control-label">Reference Doc No</label>
						<input type="text" name="ref_docno" id="ref_docno" class="form-control" value="">
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="raised_date" class="control-label">Raised Date</label>
								<input type="date" name="raised_date" id="raised_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
								<span class="help-block hidden"></span>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="term_days" class="control-label">Term Day(s)</label>
								<input type="number" name="term_days" id="term_days" class="form-control" min="0" value="0">
								<span class="help-block hidden"></span>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="due_date" class="control-label">Due Date</label>
								<input type="date" name="due_date" id="due_date" class="form-control" min="<?= date('Y-m-d') ?>" required readonly>
								<span class="help-block hidden"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="contract_no" class="control-label">Contract No</label>
								<input type="text" name="contract_no" id="contract_no" class="form-control" value="" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group" style="margin-bottom: 37px">
								<label for="sales_resp" class="control-label">Sales Resp</label>
								<input type="text" name="sales_resp" id="sales_resp" class="form-control" value="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject bold uppercase">Order List</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover" style="margin-bottom: 8px;" id="table-form-so">
							<thead>
								<tr>
									<th width="3%" class="text-center">Item</th>
									<th width="15%" class="text-center">Stockcode</th>
									<th width="25%" class="text-center">Remark</th>
									<th width="5%" class="text-center">UOM</th>
									<th width="5%" class="text-center">Currency</th>
									<th width="6%" class="text-center">Qty</th>
									<th width="13%" class="text-center">Price</th>
									<th width="5%" class="text-center">Discount</th>
									<th width="13%" class="text-center">Total</th>
								</tr>
							</thead>
							<tbody id="tbody_invoice">
								<tr>
									<td class="text-center">
										<a href="#" name="item_no" class="btn blue-chambray">
											1
										</a>
									</td>
									<td>
										<div class="form-group">
											<select name="stockcode[]" class="form-control so-stockcode" required>
												<option value="">-- Select Stockcode --</option>
												<?php if (!empty($stockcode)) : ?>
													<?php for ($i = 0; $i < count($stockcode); $i++) : ?>
														<option value="<?= $stockcode[$i]['Stockcode'] ?>" data-uom="<?= $stockcode[$i]['UOM'] ?>" data-uom-qty="<?= $stockcode[$i]['UOMQty']?>"><?= $stockcode[$i]['Stockcode'] ?> | <?= $stockcode[$i]['StockDescription'] ?></option>
													<?php endfor; ?>
												<?php endif; ?>
											</select>
											<span class="help-block hidden"></span>
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="text" name="order_remark[]" class="form-control so-remark" required>
											<span class="help-block hidden"></span>
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="text" name="uom[]" class="form-control so-uom" readonly required>
											<span class="help-block hidden"></span>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select name="currency[]" class="form-control so-currency" required>
												<?php foreach ($currency as $cur) : ?>
													<option value="<?= $cur->Currency ?>" <?= ($cur->Currency == 'IDR' ? 'selected' : '') ?>><?= $cur->Currency ?></option>
												<?php endforeach; ?>
											</select>
											<span class="help-block hidden"></span>
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="number" name="qty[]" class="form-control text-right so-qty" min="1" value="1" required>
											<span class="help-block hidden"></span>
										</div>
									</td>
									<td>
										<div class="input-group">
											<span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">IDR</span>
											<input type="text" name="price[]" class="form-control text-right so-price" min="0" value="0" required>
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="number" name="discount[]" class="form-control text-right so-discount" min="0" value="0" step="0.01">
											<span class="help-block hidden"></span>
										</div>
									</td>
									<td>
										<div class="input-group">
											<span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">Rp.</span>
											<input type="text" name="total[]" class="form-control text-right so-total" min="0" readonly value="0" required>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<a href="javascript:;" id="add_row" class="btn blue-chambray pull-right">Add Item</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-4"></div>
		<div class="col-lg-4">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						<span class="caption-subject bold uppercase">Payment Details</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="form-group">
						<label for="payment_sub_total" class="control-label">Subtotal</label>
						<div class="input-group">
							<input type="text" name="payment_sub_total" id="payment_sub_total" class="form-control text-right" readonly value="" required>
							<a name="select_accno" id="payment_sub_total_accno_label" class="input-group-addon bg-blue-chambray sbold font-red-sunglo">Acc No</a>
							<input type="text" id="payment_sub_total_accno" name="payment_sub_total_accno" value="" hidden>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="payment_discount" class="control-label">Discount</label>
								<div class="input-group">
									<input type="number" name="payment_discount" id="payment_discount" class="form-control text-right" min="0" value="0" step="0.01">
									<a name="select_accno" id="payment_discount_accno_label" class="input-group-addon bg-blue-chambray sbold font-red-sunglo">Acc No</a>
									<input type="text" id="payment_discount_accno" name="payment_discount_accno" value="" hidden>
								</div>
								<span class="help-block hidden"></span>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="payment_discount" class="control-label">Amount Discount</label>
								<input type="text" name="amount_discount" id="amount_discount" class="form-control text-right" disabled>
								<span class="help-block hidden"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Net - Subtotal</label>
						<div class="input-group">
							<span class="input-group-addon bg-default bg-default">Rp.</span>
							<input type="text" name="payment_net_subtotal" id="payment_net_subtotal" class="form-control text-right" readonly value="0" required>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-7">
							<div class="form-group">
								<label for="payment_vat" class="control-label">VAT | Inclusive</label>
								<div class="input-group">
									<input type="number" name="payment_vat" id="payment_vat" class="form-control text-right" min="0" value="11" step="0.1">
									<a name="select_accno" id="payment_vat_accno_label" class="input-group-addon bg-blue-chambray sbold font-red-sunglo">Acc No</a>
									<input type="text" id="payment_vat_accno" name="payment_vat_accno" value="" hidden>
									<a class="input-group-addon bg-blue-chambray bg-font-blue-chambray">
		                        		<label class="mt-checkbox" style="margin-left: 15px">
		                            		<input id="payment_vat_inclusive" name="payment_vat_inclusive" type="checkbox">
		                            		<span></span>
		                        		</label>
									</a>
								</div>
								<span class="help-block hidden"></span>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label for="payment_discount" class="control-label">Amount VAT</label>
								<input type="text" name="amount_vat" id="amount_vat" class="form-control text-right" disabled>
								<span class="help-block hidden"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-7">
							<div class="form-group">
								<label for="payment_pph" class="control-label">PPh 23</label>
								<div class="input-group">
									<input type="number" name="payment_pph" id="payment_pph" class="form-control text-right" min="0" value="2" step="0.1">
									<a name="select_accno" id="payment_pph_accno_label" class="input-group-addon bg-blue-chambray sbold font-red-sunglo">Acc No</a>
									<input type="text" id="payment_pph_accno" name="payment_pph_accno" value="" hidden>
								</div>
								<span class="help-block hidden"></span>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label for="payment_discount" class="control-label">Amount PPh</label>
								<input type="text" name="amount_pph" id="amount_pph" class="form-control text-right" disabled>
								<span class="help-block hidden"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="payment_freight" class="control-label">Freight</label>
						<div class="input-group">
							<input type="text" name="payment_freight" id="payment_freight" class="form-control text-right">
							<a name="select_accno" id="payment_freight_accno_label" class="input-group-addon bg-blue-chambray sbold font-red-sunglo">Acc No</a>
							<input type="text" id="payment_freight_accno" name="payment_freight_accno" value="" hidden>
						</div>
					</div>
					<div class="form-group">
						<label for="payment_total_amount" class="control-label">Total Amount</label>
						<div class="input-group">
							<input type="text" name="payment_total_amount" id="payment_total_amount" class="form-control text-right" readonly required>
							<a name="select_accno" id="payment_total_amount_accno_label" class="input-group-addon bg-blue-chambray sbold font-red-sunglo">Acc No</a>
							<input type="text" id="payment_total_amount_accno" name="payment_total_amount_accno" value="" hidden>
						</div>
					</div>
					<hr style="margin-top: 40px;">
					<div class="form-group">
						<label for="dp_payment_type" class="control-label">Payment Method</label>
						<div class="mt-radio-inline">
							<label class="mt-radio">
								<input type="radio" id="radio-cash" name="dp_payment_type" value="cash" checked>
								<span></span>
								Cash
							</label>
							<label class="mt-radio">
								<input type="radio" id="radio-debit" name="dp_payment_type" value="debit">
								<span></span>
								Debit
							</label>
							<label class="mt-radio">
								<input type="radio" id="radio-credit" name="dp_payment_type" value="credit">
								<span></span>
								Credit
							</label>
							<label class="mt-radio">
								<input type="radio" id="radio-credit" name="dp_payment_type" value="credit_sales">
								<span></span>
								Credit Sales
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="dp_payment_card_text" class="control-label">Card Number</label>
						<input type="text" name="dp_payment_card_text" id="dp_payment_card_text" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label for="dp_payment_bank" class="control-label">Bank</label>
						<select name="dp_payment_bank" id="dp_payment_bank" class="form-control" disabled>
							<option value="">-- Select Bank --</option>
							<option value="artha_graha">Artha Graha</option>
							<option value="bri">BRI</option>
							<option value="mandiri">Mandiri</option>
							<option value="bni">BNI</option>
							<option value="bca">BCA</option>
							<option value="btn">BTN</option>
							<option value="cimb">CIMB Niaga</option>
							<option value="danamon">Danamon</option>
							<option value="hsbc">HSBC</option>
							<option value="maybank">Maybank</option>
							<option value="mega">Mega</option>
							<option value="permata">Permata</option>
							<option value="uob">UOB</option>
						</select>
					</div>
					<br>
					<div class="form-group">
						<label for="payment_total" class="control-label">Payment</label>
						<div class="input-group">
							<span class="input-group-addon bg-blue-chambray bg-font-blue-chambray">Rp.</span>
							<input type="text" name="payment_total" id="payment_total" class="form-control text-right">
						</div>
					</div>
				</div>
				<div class="portlet-footer text-right">
					<button type="submit" class="btn blue-chambray">Submit</button>
				</div>
			</div>
		</div>
	</div>
</form>