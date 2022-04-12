<style>
	td i.fa {
		width: 12px;
	}

	td a.btn-xs {
		margin-bottom: 5px;
	}
</style>
<table class="table table-bordered table-hover" id="table-approval">
	<thead class="bg-blue-chambray bg-font-blue-chambray">
		<tr>
			<th width="1%">
				<div class="md-checkbox">
					<input type="checkbox" name="invoice_check_all[]" value="${row.InvoiceNo}" id="invoice_check_all" class="md-check">
					<label for="invoice_check_all">
						<span class="inc"></span>
						<span class="check"></span>
						<span class="box"></span>
					</label>
				</div>
			</th>
			<th class="text-center" width="3%">No.</th>
			<th class="text-center" width="5%">Invoice No.</th>
			<th class="text-center" width="3%">Approved Status</th>
			<th class="text-center" width="25%">Customer</th>
			<th class="text-center" width="3%">Invoice Date</th>
			<th class="text-center" width="3%">Payment Due</th>
			<th class="text-center" width="15%">Invoice Amount</th>
			<th class="text-center" width="15%">Paid</th>
			<th class="text-center" width="15%">Balance</th>
			<th class="text-center" width="7%">Action</th>
		</tr>
	</thead>
	<tbody>

	</tbody>
</table>