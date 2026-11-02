<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Sistem Inventory</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <!-- <link rel="icon" href="<?php echo e(asset('dist/assets/img/kaiadmin/favicon.ico')); ?>" type="image/x-icon" /> -->

  <!-- Fonts and icons -->
  <script src="<?php echo e(asset('dist/assets/js/plugin/webfont/webfont.min.js')); ?>"></script>
  <script>
    WebFont.load({
      google: { families: ["Public Sans:300,400,500,600,700"] },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["<?php echo e(asset('dist/assets/css/fonts.min.css')); ?>"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="<?php echo e(asset('dist/assets/css/bootstrap.min.css')); ?>" />
  <link rel="stylesheet" href="<?php echo e(asset('dist/assets/css/plugins.min.css')); ?>" />
  <link rel="stylesheet" href="<?php echo e(asset('dist/assets/css/kaiadmin.min.css')); ?>" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="<?php echo e(asset('dist/assets/css/demo.css')); ?>" />
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="index.html" class="logo text-decoration-none d-flex align-items-center gap-2">
            <h4 class="toko m-0 text-white fw-bold">Sifabrik</h4>
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">

            <!-- DASHBOARD (semua role) -->
            <li class="nav-section">
              <h4 class="text-section">Utama</h4>
            </li>


            <!-- ADMIN -->
            <?php if(Auth::user()->role == 'admin'): ?>
          <li class="nav-item">
            <a href="<?php echo e(route('admin.dashboard.index')); ?>">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-section">
            <h4 class="text-section">Data Master</h4>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('admin.user.index')); ?>">
            <i class="fas fa-users-cog"></i>
            <p>Data User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('admin.barang.index')); ?>">
            <i class="fas fa-boxes"></i>
            <p>Data Barang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('admin.kategori.index')); ?>">
            <i class="fas fa-th-large"></i>
            <p>Data Kategori</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('admin.supplier.index')); ?>">
            <i class="fas fa-truck"></i>
            <p>Data Suplier</p>
            </a>
          </li>
          <li class="nav-section">
            <h4 class="text-section">Transaksi</h4>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('admin.barang-masuk.index')); ?>">
            <i class="fas fa-cart-plus"></i>
            <p>Barang Masuk</p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?php echo e(route('Datapenjualan.index')); ?>">
            <i class="fas fa-truck"></i>
            <p>Riwayat Penjualan</p>
            </a>
          </li>
          <!-- <li class="nav-item">
          <a href="<?php echo e(route('admin.pengeluaran.index')); ?>">
          <i class="fas fa-money-bill-wave"></i>
          <p>Data Pengeluaran</p>
          </a>
        </li> -->

          <li class="nav-section">
            <h4 class="text-section">Laporan</h4>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('laporan.barang')); ?>">
            <i class="fas fa-clipboard-list"></i>
            <p>Laporan Stok Barang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('laporan.masuk')); ?>">
            <i class="fas fa-dolly-flatbed"></i>
            <p>Laporan Barang Masuk</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('laporan.penjualan.admin')); ?>">
            <i class="fas fa-chart-bar"></i>
            <p>Laporan Penjualan</p>
            </a>
          </li>
      <?php endif; ?>

            <!-- KASIR -->
            <?php if(Auth::user()->role == 'kasir'): ?>
        <li class="nav-item">
          <a href="<?php echo e(route('kasir.dashboard.index')); ?>">
          <i class="fas fa-home"></i>
          <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-section">
          <h4 class="text-section">Menu Kasir</h4>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(route('penjualan.index')); ?>">
          <i class="fas fa-exchange-alt"></i>
          <p>Penjualan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(route('Riwayatpenjualan.index')); ?>">
          <i class="fas fa-exchange-alt"></i>
          <p>Riwayat Penjualan</p>
          </a>
        </li>
      <?php endif; ?>
            <!-- PIMPINAN -->
            <?php if(Auth::user()->role == 'pimpinan'): ?>
        <li class="nav-item">
          <a href="<?php echo e(route('pimpinan.dashboard.index')); ?>">
          <i class="fas fa-home"></i>
          <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-section">
          <h4 class="text-section">Laporan Pimpinan</h4>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(route('laporan.stok')); ?>">
          <i class="fas fa-clipboard-list"></i>
          <p>Laporan Stok Barang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(route('laporan.barang-masuk')); ?>">
          <i class="fas fa-dolly-flatbed"></i>
          <p>Laporan Barang Masuk</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(route("laporan.penjualan")); ?>">
          <i class="fas fa-chart-bar"></i>
          <p>Laporan Penjualan</p>
          </a>
        </li>
      <?php endif; ?>

            <!-- LOGOUT -->
            <!-- <li class="nav-section">
              <h4 class="text-section">Akun</h4>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('logout')); ?>">
                 <i class="fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li> -->

          </ul>
        </div>
      </div>


    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="<?php echo e(asset('dist/assets/img/kaiadmin/logo_light.svg')); ?>" alt="navbar brand" class="navbar-brand"
                height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto me-4 align-items-center">

              <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <div class="avatar-sm">
                    <img
                      src="<?php echo e(Auth::user()->foto ? asset(Auth::user()->foto) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=ff6f00&color=fff&size=120'); ?>"
                      alt="Foto Profil" class="avatar-img rounded-circle"
                      style="width: 40px; height: 40px; object-fit: cover;">
                  </div>
                  <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold"><?php echo e(Auth::user()->name); ?></span>
                  </span>
                </a>

                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box text-center">
                        <div class="avatar-lg mx-auto mb-2">
                          <img
                            src="<?php echo e(Auth::user()->foto ? asset(Auth::user()->foto) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=ff6f00&color=fff&size=120'); ?>"
                            alt="Foto Profil" class="avatar-img rounded-circle"
                            style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="u-text">
                          <h4><?php echo e(Auth::user()->name); ?></h4>
                          <p class="text-muted"><?php echo e(Auth::user()->email); ?></p>
                          <a href="<?php echo e(route('profile')); ?>" class="btn btn-sm btn-secondary">Lihat Profil</a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                      </a>

                      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                      </form>
                    </li>
                  </div>
                </ul>
              </li>

            </ul>
          </div>
        </nav>


        <!-- End Navbar -->
      </div>

      <!-- content -->
      <?php echo $__env->yieldContent('content'); ?>

      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
          <div class="copyright">
            <?php echo e(date('Y')); ?>, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="https://github.com/rendy28" target="_blank">Rendy</a>
          </div>
          <div>
            <a target="_blank" href="https://github.com/rendy28/Sifabrik">SIFABRIC - Sistem Informasi Gudang Fabrikasi</a>
          </div>
        </div>
      </footer>
    </div>


  </div>
  <!--   Core JS Files   -->

  <script src=" <?php echo e(asset('dist/assets/js/core/jquery-3.7.1.min.js')); ?>"></script>
  <script src=" <?php echo e(asset('dist/assets/js/core/popper.min.js')); ?>"></script>
  <script src=" <?php echo e(asset('dist/assets/js/core/bootstrap.min.js')); ?>"></script>

  <!-- jQuery Scrollbar -->
  <script src=" <?php echo e(asset('dist/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')); ?>"></script>

  <!-- Chart JS -->
  <script src=" <?php echo e(asset('dist/assets/js/plugin/chart.js/chart.min.js')); ?>"></script>

  <!-- jQuery Sparkline -->
  <script src=" <?php echo e(asset('dist/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')); ?>"></script>

  <!-- Chart Circle -->
  <script src=" <?php echo e(asset('dist/assets/js/plugin/chart-circle/circles.min.js')); ?>"></script>

  <!-- Datatables -->
  <script src=" <?php echo e(asset('dist/assets/js/plugin/datatables/datatables.min.js')); ?>"></script>

  <!-- Bootstrap Notify -->
  <script src=" <?php echo e(asset('dist/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>

  <!-- jQuery Vector Maps -->
  <script src=" <?php echo e(asset('dist/assets/js/plugin/jsvectormap/jsvectormap.min.js')); ?>"></script>
  <script src=" <?php echo e(asset('dist/assets/js/plugin/jsvectormap/world.js')); ?>"></script>

  <!-- Sweet Alert -->
  <script src=" <?php echo e(asset('dist/assets/js/plugin/sweetalert/sweetalert.min.js')); ?>"></script>

  <!-- Kaiadmin JS -->
  <script src=" <?php echo e(asset('dist/assets/js/kaiadmin.min.js')); ?>"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#177dff",
      fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#f3545d",
      fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#ffa534",
      fillColor: "rgba(255, 165, 52, .14)",
    });
  </script>
  <script>
    document.querySelectorAll('.rupiah').forEach(function (el) {
      el.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      });
    });
  </script>
  <?php if(session('modal')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById("<?php echo e(session('modal')); ?>"));
            myModal.show();
        });
    </script>
<?php endif; ?>

  <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH D:\laragon\www\Sifabrik\resources\views/layout/main.blade.php ENDPATH**/ ?>