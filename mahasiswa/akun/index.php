<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['gmail'])) {
  header("Location: login.php");
  exit;
}

$gmail = $_SESSION['gmail'];
$nama_lengkap = $_SESSION['nama_lengkap'];

// Ambil data dari tabel mahasiswa berdasarkan gmail
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE gmail = '$gmail'");
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
          <form action="akun/proses_ubah_password.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="gmail" class="form-label">Gmail</label>
                <input type="text" class="form-control" id="gmail" value="<?= htmlspecialchars($data['gmail']) ?>" readonly>
              </div>
              <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" value="<?= htmlspecialchars($data['nama_lengkap']) ?>" readonly>
              </div>

              <hr>
              <h5>Ubah Password</h5>

              <input type="hidden" name="gmail" value="<?= htmlspecialchars($data['gmail']) ?>">

              <div class="mb-3">
                <label>Password Baru</label>
                <input type="password" name="password_baru" class="form-control">
              </div>
              <div class="mb-3">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="konfirmasi_password" class="form-control">
              </div>

              <hr>
              <h5>Ubah Foto Profil</h5>
              <div class="mb-3">
                <label for="foto_baru" class="form-label">Upload Foto Baru</label>
                <input type="file" name="foto_baru" id="foto_baru" class="form-control" accept="image/*">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                <div class="mt-2">
                  <img id="preview_foto" src="http://localhost/si-pkl/admin/mahasiswa/foto/<?= htmlspecialchars($data['foto'] ?? 'userr.png') ?>" alt="Preview Foto" style="max-width:150px; max-height:150px; object-fit:cover; border-radius:8px;">
                </div>
              </div>

              <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </form>

            <script>
              document.getElementById('foto_baru').addEventListener('change', function(event){
                const [file] = this.files;
                if (file) {
                  document.getElementById('preview_foto').src = URL.createObjectURL(file);
                }
              });
            </script>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>
