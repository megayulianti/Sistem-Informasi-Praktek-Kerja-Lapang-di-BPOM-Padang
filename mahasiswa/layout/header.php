<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PKL-Mahasiswa</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
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
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
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
              src="assets/img/logo1.png"
              alt="navbar brand"
              class="navbar-brand"
              height="50"
            />
            <span style="color: white;">PKL-Mahasiswa</span><br>
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
                  <p>Daftar PKL</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="dataMagangCollapse">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="?page=upload-surat/index">Ajukan pendaftaran syarat</a>
                    </li>
                    <li>
                      <a href="?page=surat-balasan/index">Data Surat Balasan</a>
                    </li>
                    <li>
                      <a href="?page=pemilihan-bagian/index">Pengumuman</a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dataPklCollapse" role="button" aria-expanded="false" aria-controls="dataPklCollapse" class="nav-link">
                  <i class="far fa-address-card"></i>
                  <p>PKL</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="dataPklCollapse">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="?page=absensi/index">Absensi</a>
                    </li>
                    <li>
                      <a href="?page=sertifikat/index">Sertifikat</a>
                    </li>
                    <li>
                      <a href="?page=nilai/index">Nilai PKL</a>
                    </li>
                  </ul>
                </div>
              </li>


              <li class="nav-item">
                <a class="nav-link" href="?page=akun/index">
                  <i class="fas fa-user-check"></i>
                  <span>Akun</span>
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
          
               
        
<?php
$fotoName = isset($_SESSION['foto']) && !empty(trim($_SESSION['foto'])) ? trim($_SESSION['foto']) : '';
$nama = isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : 'Guest';

$fotoDir = __DIR__ . '/../../admin/mahasiswa/foto/';
$fotoFilePath = $fotoDir . $fotoName;
$fotoURL = 'http://localhost/si-pkl/admin/mahasiswa/foto/' . $fotoName;



if (empty($fotoName) || !file_exists($fotoFilePath)) {
    $fotoURL = 'http://localhost/si-pkl/admin/mahasiswa/foto/userr.png';
}
?>

<li class="nav-item topbar-user dropdown hidden-caret">
    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
        <div class="avatar-sm">
            <img src="<?php echo $fotoURL . '?t=' . time(); ?>" alt="Profile" class="avatar-img rounded-circle" style="width:50px; height:50px; object-fit:cover;" />
        </div>
        <span class="profile-username">
            <span class="op-7">Hi,</span>
            <span class="fw-bold"><?php echo htmlspecialchars($nama); ?></span>
        </span>
    </a>
   <ul class="dropdown-menu dropdown-user animated fadeIn">
    <div class="dropdown-user-scroll scrollbar-outer">
        <li>
            <div class="user-box">
                <div class="avatar-lg">
                    <img src="<?php echo $fotoURL . '?t=' . time(); ?>" alt="image profile" class="avatar-img rounded" style="width:80px; height:80px; object-fit:cover;" />
                </div>
                <div class="u-text">
                    <h4><?php echo htmlspecialchars($nama); ?></h4>
                </div>
            </div>
        </li>
        <li>
            <div class="dropdown-divider"></div>
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


       