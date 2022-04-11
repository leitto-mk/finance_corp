<style>
	.table th {
		vertical-align: middle !important;
	}

	.col-box {
		width: 20%;
	}

	.col-box a {
		text-decoration: none;
	}

	@media only screen and (max-width: 768px) {
		.col-box {
			width: 100% !important;
		}
	}
</style>
<h1 class="page-title"><?= $title ?></h1>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="#">Home</a>
		</li>
	</ul>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="row widget-row">
			<div class="col-lg-3">
				<div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 widget-status">
					<h4 class="widget-thumb-heading">Approved</h4>
					<div class="widget-thumb-wrap">
						<i class="widget-thumb-icon bg-blue-chambray icon-check"></i>
						<div class="widget-thumb-body">
							<span class="widget-thumb-subtitle">Total</span>
							<span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= $approved ?>"><?= $approved ?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 widget-status">
					<h4 class="widget-thumb-heading">Declined</h4>
					<div class="widget-thumb-wrap">
						<i class="widget-thumb-icon bg-blue-chambray icon-ban"></i>
						<div class="widget-thumb-body">
							<span class="widget-thumb-subtitle">Total</span>
							<span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= $declined ?>"><?= $declined ?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 widget-status">
					<h4 class="widget-thumb-heading">Paid</h4>
					<div class="widget-thumb-wrap">
						<i class="widget-thumb-icon bg-blue-chambray icon-wallet"></i>
						<div class="widget-thumb-body">
							<span class="widget-thumb-subtitle">Total</span>
							<span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= $paid ?>"><?= $paid ?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 widget-status">
					<h4 class="widget-thumb-heading">Unpaid</h4>
					<div class="widget-thumb-wrap">
						<i class="widget-thumb-icon bg-blue-chambray icon-note"></i>
						<div class="widget-thumb-body">
							<span class="widget-thumb-subtitle">Total</span>
							<span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= $unpaid ?>"><?= $unpaid ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject bold uppercase">List Invoice Approval</span>
				</div>
				<div class="actions">
					<div class="btn-group">
						<a class="btn btn-sm blue dropdown-toggle" href="javascript:;" data-toggle="dropdown" aria-expanded="false"> Set Approval
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a name="set_approval" data-status="approve">
								<i class="fa fa-check"></i> Approve </a>
							</li>
							<li>
								<a name="set_approval" data-status="decline">
								<i class="fa fa-times"></i> Decline </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<?php $this->load->view('financecorp/ar/invoice/component/table_invoice_approval'); ?>
			</div>
		</div>
	</div>
</div>