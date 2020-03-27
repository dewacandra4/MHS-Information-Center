<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin');?>">
    <div class="sidebar-brand-icon ">
      <i class="fas fa-home"></i>
    </div>
    <div class="sidebar-brand-text mx-3">MHS Information Center</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Applicant
  </div>
  <!-- Nav Item - Dashboard -->
  <li class="nav-item ">
    <a class="nav-link" href="<?= base_url('admin');?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    My Profile
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin/profile');?>">
      <i class="fas fa-fw fa-user"></i>
      <span>Profile</span>
    </a>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin/edit');?>">
      <i class="fas fa-fw fa-user-edit"></i>
      <span>Edit Profile</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menu
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link " href="<?= base_url('admin/setup_residence');?>">
      <i class="fas fa-fw fa-home"></i>
      <span>Setup Residence</span>
    </a>
    
  </li>

  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin/view_application');?>">
      <i class="fas fa-fw fa-file-alt"></i>
      <span>View Applications</span></a>
  </li>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin/allocate');?>">
      <i class="fas fa-fw fa-file-alt"></i>
      <span>Allocate Housing</span></a>
  </li>

  <hr class="sidebar-divider d-none d-md-block">
  <li class="nav-item">
    <a class="nav-link" href="<?=base_url('auth/logout');?>">
    <i class="fas fa-fw fa-sign-out-alt"></i>
    <span>Log Out</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">


