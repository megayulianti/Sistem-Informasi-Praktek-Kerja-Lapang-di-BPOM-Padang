<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>SI PKL</title>
  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport" />
  <link
    rel="icon"
    href="assets/img/kaiadmin/favicon.ico"
    type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />



  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


  <!-- Sweart alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css" />
</head>


<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="#" class="logo">
            <img
              src="assets/img/logo.png"
              alt="navbar brand"
              class="navbar-brand"
              height="50" />
            <span style="color: white;">PKL</span><br>
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
            <li class="nav-item active">
              <a href="index.php">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#dataMagangCollapse" role="button" aria-expanded="false" aria-controls="dataMagangCollapse" class="nav-link">
                <i class="far fa-address-card"></i>
                <p>Data Daftar PKL</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="dataMagangCollapse">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="?page=mahasiswa/index">Data Mahasiswa</a>
                  </li>
                  <li>
                    <a href="?page=pendaftaran-magang/index">Data Pendaftaran PKL</a>
                  </li>
                  <li>
                    <a href="?page=surat-balasan-pkl/index">Data Surat Balasan</a>
                  </li>
                  <li>
                    <a href="?page=pemilihan-bagian-tempat/index">Pengumuman</a>
                  </li>
                </ul>
              </div>
            </li>


            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#dataAbsensiCollapse" role="button" aria-expanded="false" aria-controls="dataAbsensiCollapse" class="nav-link">
                <i class="far fa-address-card"></i>
                <p>Data Pengelolaan PKL</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="dataAbsensiCollapse">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="?page=absensi/index">Absensi</a>
                  </li>
                  
                  <li>
                    <a href="?page=sertifikat/index">Sertifikat</a>
                  </li>
                </ul>
              </div>
            </li>


            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#laporanCollapse" role="button" aria-expanded="false" aria-controls="laporanCollapse" class="nav-link">
                <i class="fas fa-envelope"></i>
                <p>Laporan</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="laporanCollapse">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="?page=laporan-mahasiswa/index">Laporan Data Mahasiswa </a>
                  </li>
                  <li>
                    <a href="?page=laporan-absensi/index">Laporan Data Absensi</a>
                  </li>
                  <li>
                    <a href="?page=laporan-pendaftaran-PKL/index">Laporan Pendaftaran Magang</a>
                  </li>
                  <li>
                    <a href="?page=laporan-surat-balasan/index">Laporan Data Surat Balasan</a>
                  </li>
                  <li>
                    <a href="?page=laporan-pemilihan-bagian/index">Laporan Data Pengumuman</a>
                  </li>
                  <li>
                    <a href="?page=laporan-penilaian/index">Laporan Data Surat Nilai</a>
                  </li>
                  <li>
                    <a href="?page=laporan-sertifikat/index">Laporan Data Sertifikat Magang</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="?page=user/index">
                <i class="fas fa-user"></i>
                <span>Data Pengguna</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="login/logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
              </a>
            </li>


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
                <img
                  src="assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
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
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
               
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li
                  class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
                >
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                  >
                    <i class="fa fa-search"></i>
                  </a>
                 
                </li>
                
              
           

               <li class="nav-item topbar-user dropdown hidden-caret">
    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
        <div class="avatar-sm">
            <img src="assets/img/userr.png" alt="..." class="avatar-img rounded-circle" />
        </div>
        <span class="profile-username">
            <span class="op-7">Hi,</span>
            <span class="fw-bold">
                <?php echo isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : 'Guest'; ?>
            </span>
        </span>
    </a>
    <ul class="dropdown-menu dropdown-user animated fadeIn">
        <div class="dropdown-user-scroll scrollbar-outer">
            <li>
                <div class="user-box">
                    <div class="avatar-lg">
                        <img src="assets/img/userr.png" alt="image profile" class="avatar-img rounded" />
                    </div>
                    <div class="u-text">
                        <h4><?php echo isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : 'Guest'; ?></h4>
                      
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown-divider"></div>
                <!-- Periksa apakah user adalah admin berdasarkan username -->
                <?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'kepala sekolah'): ?>
                    <a class="dropdown-item" href="admin_dashboard.php">Admin Dashboard</a>
                <?php endif; ?>
                <a class="dropdown-item" href="login/logout.php">Logout</a>
            </li>
        </div>
    </ul>
</li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

