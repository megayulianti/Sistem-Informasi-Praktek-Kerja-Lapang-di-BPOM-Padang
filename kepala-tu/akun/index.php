<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: login/index.php");
  exit;
}

$id_user = $_SESSION['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'");
$data = mysqli_fetch_assoc($query);
?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Akun</h3>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Ubah Password</h4>
          </div>

          <div class="card-body">
            <form action="akun/proses_ubah_password.php" method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" value="<?= $data['username'] ?>" readonly>
              </div>
              <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" value="<?= $data['nama_lengkap'] ?>" readonly>
              </div>
              <hr>
              <h5>Ubah Password</h5>
              <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
              <div class="mb-3">
                <label>Password Baru</label>
                <input type="password" name="password_baru" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="konfirmasi_password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </form>
          </div>
<!-- Notifikasi SweetAlert -->
    <?php if (isset($_SESSION['success'])): ?>
      <script>
        Swal.fire({
          icon: 'success',
          title: '<?= $_SESSION['success'] ?>',
          showConfirmButton: false,
          timer: 1500
        });
      </script>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

