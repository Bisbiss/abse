<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url().'/assets/img/yasfika.png' ?>" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
          $db = db_connect();
          $logo = $db->query("SELECT logo FROM `identitas`")->getRow();
          ?>
          <img src="<?= base_url().'/assets/img/'.$logo->logo ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <span class="d-block text-light">Absensi</span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!-- dashboard -->
        <li class="nav-item">
          <a href="/admin" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <!-- dashboard -->
        <li class="nav-item menu-close">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Siswa
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url().'admin/datasiswa' ?>" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Data Siswa</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url().'admin/importdatasiswa' ?>" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Import Data Siswa</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Kelas -->
        <li class="nav-item">
          <a href="/admin/datakelas" class="nav-link">
            <i class="nav-icon fas fa-building"></i>
            <p>
              Kelas
            </p>
          </a>
        </li>

        <!-- Guru -->
        <li class="nav-item">
          <a href="/admin/dataguru" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Guru
            </p>
          </a>
        </li>

        <!-- Absensi -->
        <li class="nav-item">
          <a href="/admin/dataabsen" class="nav-link">
            <i class="nav-icon fas fa-clipboard"></i>
            <p>
              Absensi
            </p>
          </a>
        </li>

        <!-- Invalid Card -->
        <li class="nav-item">
          <a href="/admin/invalidcard" class="nav-link">
            <i class="nav-icon fas fa-exclamation"></i>
            <p>
              Invalid Card
            </p>
          </a>
        </li>
        <li class="nav-item menu-close">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-pdf"></i>
            <p>
              Laporan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="data_laporan.php" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Mingguan</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="data_laporan1.php" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Bulanan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="/admin/pengaturan" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Pengaturan Sekolah
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Keluar
            </p>
          </a>
        </li>

      </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>