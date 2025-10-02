<?php
session_start();
include 'koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_mahasiswa'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location.href = 'login.php';</script>";
    exit;
}

$id_mahasiswa = $_SESSION['id_mahasiswa'];

// Ambil data surat balasan berdasarkan id_mahasiswa
$query = mysqli_query($koneksi, "SELECT * FROM surat_balasan WHERE id_mahasiswa = '$id_mahasiswa'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Surat Balasan Magang</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="container mt-4">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Surat Balasan PKL</h3>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Unduh Surat Balasan</h4>
          </div>
          <div class="card-body">

            <?php if ($data && !empty($data['file_surat'])): ?>
              <p><strong>File Surat Balasan:</strong></p>
              <a href="/si-pkl/surat-balasan/<?= htmlspecialchars($data['file_surat']); ?>" 
                 class="btn btn-info btn-sm" target="_blank">
                <i class="fa fa-download"></i> Unduh Surat Balasan
              </a>
            <?php else: ?>
              <p class="text-muted">Belum ada surat balasan yang tersedia.</p>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
