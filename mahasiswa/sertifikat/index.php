<?php
session_start();
include 'koneksi.php';

// Cek apakah mahasiswa sudah login
if (!isset($_SESSION['id_mahasiswa'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
    exit;
}

$id_mahasiswa = $_SESSION['id_mahasiswa'];

// Ambil data sertifikat berdasarkan id_mahasiswa
$query = mysqli_query($koneksi, "SELECT * FROM sertifikat_pkl WHERE id_mahasiswa = '$id_mahasiswa'");
$data = mysqli_fetch_array($query); // Ambil satu baris data
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sertifikat PKL</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container mt-4">
  <div class="page-inner">
    <div class="page-header mb-4">
      <h3 class="fw-bold">Sertifikat PKL</h3>
    </div>

    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Sertifikat Anda</h5>
      </div>
      <div class="card-body">
        <?php if ($data && !empty($data['file_sertifikat'])): ?>
            <p><strong>Sertifikat Anda:</strong></p>
            <a href="/si-pkl/sertifikat/<?= htmlspecialchars($data['file_sertifikat']); ?>"  class="btn btn-info btn-sm" target="_blank">
              <i class="fa fa-download"></i> Unduh Sertifikat
            </a>
          <?php else: ?>
            <p class="text-danger">File sertifikat tidak ditemukan di server.</p>
          <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<!-- Optional: Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
