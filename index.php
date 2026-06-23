<?php
session_start();
require_once("config/koneksi.php");
if (isset($_SESSION['username'])) {
  $page = $_GET['page'] ?? '';


?>
  <!DOCTYPE html>
  <!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko AAA | Kasir</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

<style>
.main-sidebar {
    background-color: #230434 !important;
   
}
.main-sidebar,
.main-sidebar::after {
    background-color: #230434 !important;
}
.brand-link {
    background-color: #673eb4 !important;
}

.nav-sidebar .nav-link.active {
    background-color: #8b68cc !important;
    color: white !important;
}

.nav-sidebar .nav-link-title.active {
    background-color: #7a5cb3 !important;
    color: white !important;
}

.nav-sidebar .nav-link:hover {
    background-color: #512995 !important;
    color: white !important;
}

.main-header {
    background-color: #673eb4 !important; 
    border-bottom: 1px solid #4b2e83 !important;
}

.main-header .nav-link {
    color: #ffffff !important;
}

.main-header .nav-link:hover {
    color: #d1c4e9 !important;
}

.navbar-search-block .form-control {
    background-color: #f5f5f5;
}

.main-footer {
    background-color: #673eb4 !important;  
    color: white !important;
    color: #ffffff !important;
    border-top: 1px solid #4b2e83 !important;
    border-bottom: 1px solid #4b2e83 !important;

}

.main-footer a {
    color: #d1c4e9 !important;
}

.main-footer a:hover {
    color: #ffffff !important;
}

.main-footer::before {
    content: "";
    position: fixed;
    left: 0;
    bottom: 0;
    width: 250px;
    height: 57px;
    background: #230434;
}
.btn-primary {
    background-color: #673eb4 !important;
    border-color: #673eb4 !important;
}

.btn-primary:hover {
    background-color: #512995 !important;
    border-color: #512995 !important;
}

.btn-primary:focus,
.btn-primary:active {
    background-color: #4b2e83 !important;
    border-color: #4b2e83 !important;
    box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25) !important;
}


.btn-info {
    background-color: #8b68cc !important;  
    border-color: #8b68cc !important;
    color: white !important;
}

.btn-info:hover {
    background-color: #835ef3 !important; 
    border-color: #835ef3 !important;
    color: white !important;
}

.btn-info:focus,
.btn-info:active {
    background-color: #7a4dff !important;
    border-color: #7a4dff !important;
    box-shadow: 0 0 0 0.2rem rgba(155, 123, 255, 0.3) !important;
}

</style>

  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">

            <a href="index.php?page=dashboard" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>


        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-purple elevation-4">
        <!-- Brand Logo -->
          <a href="index3.html" class="brand-link bg-purple">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Toko AAA</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="dist/img/user4-128x128.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['username'] ?></a>
              </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Master
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="index.php?page=barang" class="nav-link <?php echo ($page == 'barang' || $page == 'edit_barang' || $page == 'tambah_barang' || $page == 'cetak_struk') ? 'active' : '' ?>">
                        <i class="fas fa-box nav-icon"></i>
                        <p>Barang</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item menu-open">
                  <a href="" class="nav-link">
                    <i class="fas fa-wallet nav-icon"></i>
                    <p>
                      Transaksi
                      <i class="right fas fa-angle-left "></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="index.php?page=pesanan" class="nav-link <?php echo ($page == 'pesanan' || $page == 'edit_pesanan' || $page == 'tambah_pesanan') ? 'active' : '' ?>">
                        <i class="fas fa-shopping-cart nav-icon"></i>
                        <p>Pesanan</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="index.php?page=pembayaran" class="nav-link <?php echo (isset($page) && $page == 'pembayaran' || $page == 'edit_pembayaran' || $page == 'tambah_pembayaran') ? 'active' : '' ?>">
                        <i class="fas fa-credit-card nav-icon"></i>
                        <p>Pembayaran</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="logout.php" class="nav-link" onmouseover="this.style.color='#6f42c1'" onmouseout="this.style.color=''"">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>Logout</p>
                  </a>
                </li>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <div class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Dashboard</h5>

                      <p class="card-text">
                        <?php
                        if (isset($_GET['page'])) {
                          $page = $_GET['page'];
                        } else {
                          $page = "";
                        }
                        if ($page == "") {
                          include "page/dashboard.php";
                        } elseif (!file_exists("page/$page.php")) {
                          echo "File tidak ditemukan";
                        } else {
                          include "page/$page.php";
                        }
                        ?>
                      </p>

                    </div>
                  </div>

                </div>
                <!-- /.col-md-6 -->

              </div>
              <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar sidebar-dark-purple">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
  </body>

  </html>
<?php
} else {
  echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}
?>