<li class="nav-item <?= $this->uri->segment(2) === 'dashboard' ? 'active' : '' ?>">
  <a href="<?= site_url('abc/dashboard') ?>" class="nav-link nav-toggle">
    <i class="icon-grid"></i>
    <span class="title uppercase">Dashboard</span>
  </a>
</li>
<li class="nav-item <?= $this->uri->segment(2) === 'sales' ? 'active' : '' ?>">
  <a href="#" class="nav-link nav-toggle">
    <i class="icon-wallet"></i>
    <span class="title uppercase">Sales</span>
    <span class="arrow <?= $this->uri->segment(2) === 'sales' ? 'open' : '' ?>"></span>
  </a>
  <ul class="sub-menu">
    <li class="nav-item <?= $this->uri->segment(3) === 'direct_sales' ? 'active' : '' ?>">
      <a href="<?= site_url('abc/sales/direct_sales') ?>" class="nav-link">
        <i class="fa <?= $this->uri->segment(3) === 'direct_sales' ? 'fa-circle' : 'fa-circle-o' ?>"></i> Direct Sales
      </a>
    </li>
    <li class="nav-item <?= $this->uri->segment(3) === 'sales_order' ? 'active' : '' ?>">
      <a href="<?= site_url('abc/sales/sales_order') ?>" class="nav-link">
        <i class="fa <?= $this->uri->segment(3) === 'sales_order' ? 'fa-circle' : 'fa-circle-o' ?>"></i> Sales Order
      </a>
    </li>
    <li class="nav-item <?= $this->uri->segment(3) === 'sales_return' ? 'active' : '' ?>">
      <a href="<?= site_url('abc/sales/sales_return') ?>" class="nav-link">
        <i class="fa <?= $this->uri->segment(3) === 'sales_return' ? 'fa-circle' : 'fa-circle-o' ?>"></i> Sales Return
      </a>
    </li>
  </ul>
</li>
<li class="nav-item <?= $this->uri->segment(1) === 'purchase' ? 'active' : '' ?>">
  <a href="#" class="nav-link nav-toggle">
    <i class="icon-basket"></i>
    <span class="title uppercase">Purchase</span>
    <span class="arrow <?= $this->uri->segment(1) === 'purchase' ? 'open' : '' ?>"></span>
  </a>
  <ul class="sub-menu">
    <li class="nav-item <?= $this->uri->segment(2) === 'direct_purchase' ? 'active' : '' ?>">
      <a href="<?= site_url('purchase/direct_purchase') ?>" class="nav-link">
        <i class="fa <?= $this->uri->segment(2) === 'direct_purchase' ? 'fa-circle' : 'fa-circle-o' ?>"></i> Direct Purchase
      </a>
    </li>
    <li class="nav-item <?= $this->uri->segment(2) === 'purchase_order' ? 'active' : '' ?>">
      <a href="<?= site_url('abc/purchase/purchase_order') ?>" class="nav-link">
        <i class="fa <?= $this->uri->segment(2) === 'purchase_order' ? 'fa-circle' : 'fa-circle-o' ?>"></i> Purchase Order
      </a>
    </li>
    <li class="nav-item <?= $this->uri->segment(2) === 'purchase_return' ? 'active' : '' ?>">
      <a href="<?= site_url('abc/purchase/purchase_return') ?>" class="nav-link">
        <i class="fa <?= $this->uri->segment(2) === 'purchase_return' ? 'fa-circle' : 'fa-circle-o' ?>"></i> Purchase Return
      </a>
    </li>
  </ul>
</li>
<li class="nav-item <?= $this->uri->segment(2) === 'inventory' ? 'active' : '' ?>">
  <a href="#" class="nav-link nav-toggle ">
    <i class="icon-briefcase"></i>
    <span class="title uppercase">Inventory</span>
    <span class="arrow <?= $this->uri->segment(2) === 'inventory' ? 'open' : '' ?>"></span>
  </a>
  <ul class="sub-menu">
    <li class="nav-item <?= $this->uri->segment(2) === 'inventory' && $this->uri->segment(3) === 'monthly' ? 'active' : '' ?>">
      <a href="<?= site_url('abc/inventory/stock') ?>" class="nav-link">
        <i class="fa <?= $this->uri->segment(2) === 'inventory' && $this->uri->segment(3) === 'stock' ? 'fa-circle' : 'fa-circle-o' ?>"></i> Inventory Stock
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="fa fa-circle-o"></i> Stock Return
      </a>
    </li>
  </ul>
</li>
<li class="nav-item <?= $this->uri->segment(2) === 'report' ? 'active' : '' ?>">
  <a href="javascript:;" class="nav-link nav-toggle">
    <i class="icon-notebook"></i>
    <span class="title uppercase">Report</span>
    <span class="arrow <?= $this->uri->segment(2) === 'open' ? 'active' : '' ?>"></span>
  </a>
  <ul class="sub-menu">
    <li class="nav-item <?= $this->uri->segment(3) === 'stockcard' ? 'active' : '' ?>">
      <a href="<?= site_url('abc/report/stockcard') ?>" class="nav-link">
        <i class="fa <?= $this->uri->segment(3) === 'stockcard' ? 'fa-circle' : 'fa-circle-o' ?>"></i> Stockcard Report
      </a>
    </li>
    <li class="nav-item <?= $this->uri->segment(3) === 'sales' ? 'active' : '' ?>">
      <a href="<?= site_url('abc/report/sales/transaction') ?>" class="nav-link">
        <i class="fa <?= $this->uri->segment(3) === 'sales' ? 'fa-circle' : 'fa-circle-o' ?>"></i> Sales Transaction
      </a>
    </li>
    <li class="nav-item <?= $this->uri->segment(3) === 'purchase' ? 'active' : '' ?>">
      <a href="<?= site_url('abc/report/purchase/transaction') ?>" class="nav-link">
        <i class="fa <?= $this->uri->segment(3) === 'purchase' ? 'fa-circle' : 'fa-circle-o' ?>"></i> Purchase Transaction
      </a>
    </li>
    <li class="nav-item hide">
      <a href="#" class="nav-link">
        <i class="fa fa-circle-o"></i> Sales Report
      </a>
    </li>
  </ul>
</li>
<li class="nav-item <?= $this->uri->segment(1) === 'master' ? 'active' : '' ?>">
  <a href="<?= site_url('Cmaster') ?>" class="nav-link nav-toggle">
    <i class="icon-settings"></i>
    <span class="title uppercase">Master</span>
  </a>
</li>