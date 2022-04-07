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
  <a href="<?= site_url('Invoice/new') ?>" class="nav-link nav-toggle" target="_blank">
    <i class="icon-plus"></i>
    <span class="title">Create New Invoice</span>
  </a>
</li>
<!-- <li class="nav-item">
  <a href="#" class="nav-link nav-toggle">
    <i class="icon-plus"></i>
    <span class="title">Create Service Invoice</span>
  </a>
</li> -->
<li class="nav-item">
  <a href="<?php echo site_url('Invoice/list') ?>" class="nav-link nav-toggle">
    <i class="icon-list"></i>
    <span class="title">Invoice List</span>
  </a>
</li>
<li class="nav-item">
  <a href="<?php echo site_url('Invoice/aging') ?>" target="_blank" class="nav-link nav-toggle">
    <i class="icon-notebook"></i>
    <span class="title">Invoice Aging</span>
  </a>
</li>