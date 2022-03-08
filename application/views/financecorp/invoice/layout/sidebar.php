<style>
  .page-sidebar .page-sidebar-menu>li.active>a>i {
    color: #F2784B !important;
  }
</style>
<li class="nav-item <?= $this->uri->segment(1) === 'Invoice' ? 'active' : '' ?>">
  <a href="<?= site_url('Invoice') ?>" class="nav-link nav-toggle">
    <i class="icon-grid"></i>
    <span class="title">Dashboard</span>
  </a>
</li>
<li class="nav-item">
  <a href="<?= site_url('Invoice/view_create_invoice') ?>" class="nav-link nav-toggle" target="_blank">
    <i class="icon-plus"></i>
    <span class="title">Create New Invoice</span>
  </a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link nav-toggle">
    <i class="icon-plus"></i>
    <span class="title">Create Service Invoice</span>
  </a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link nav-toggle">
    <i class="icon-settings"></i>
    <span class="title">Invoice Mastery</span>
  </a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link nav-toggle">
    <i class="icon-notebook"></i>
    <span class="title">Invoice History</span>
  </a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link nav-toggle">
    <i class="icon-wallet"></i>
    <span class="title">Invoice Payment</span>
  </a>
</li>