<div class="app-menu navbar-menu">
  <!-- LOGO -->
  <div class="navbar-brand-box">
    <!-- Dark Logo-->
    <a href="index.html" class="logo logo-dark">
      <span class="logo-sm">
        <img src="" alt="">
      </span>
      <span class="logo-lg">
        <img src="" alt="" height="17">
      </span>
    </a>
    <!-- Light Logo-->
    <a href="index.html" class="logo logo-light">
      <span class="logo-sm">
        <img src="Assets/images/isotipo-blanco.svg" alt="" height="24" style="margin-top: 5px;">
      </span>
      <span class="logo-lg">
        <!-- Logo normal -->
        <img src="Assets/images/empire.png" alt="" width="160px;" style="margin-top:8px;">
      </span>
    </a>
    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
      <i class="ri-record-circle-line"></i>
    </button>
  </div>

  <div id="scrollbar">
    <div class="container-fluid">

      <div id="two-column-menu">
      </div>
      <ul class="navbar-nav" id="navbar-nav">
        <li class="menu-title"><span data-key="t-menu">Menu</span></li>

        <li class="nav-item">
          <a href="<?= base_url(); ?>clientes" class="nav-link menu-link">
            <i class="ri-group-line"></i> <span data-key="t-layout">Customers</span>
          </a>
        </li>

        <!-- CATALOGOS -->
        <li class="nav-item">
          <a href="<?= base_url(); ?>material" class="nav-link menu-link">
            <i class="ri-booklet-line"></i> <span data-key="t-layout">Materials</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url(); ?>seguimiento" class="nav-link menu-link">
            <i class="ri-survey-line"></i> <span data-key="t-layout">Order info</span>
          </a>
        </li>

      </ul>
    </div>
    <!-- Sidebar -->
  </div>

  <div class="sidebar-background"></div>
</div>