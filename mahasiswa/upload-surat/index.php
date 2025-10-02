<?php
// Ambil data mahasiswa yang sedang login
session_start();
include 'koneksi.php';
$id_mahasiswa = $_SESSION['id_mahasiswa']; // pastikan session ini di-set saat login

$query = mysqli_query($koneksi, "SELECT * FROM pendaftaran_magang WHERE id_mahasiswa = '$id_mahasiswa'");
$data = mysqli_fetch_array($query);
?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Pendaftaran Magang</h3>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Upload Surat PKL</h4>
            <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#modal-upload">
              Upload Surat
            </button>
          </div>
          <div class="card-body">
            <?php if ($data): ?>
              <p><strong>Tempat Magang:</strong> <?= $data['tempat_magang'] ?></p>
              <p><strong>Tanggal:</strong> <?= $data['tanggal_mulai'] ?> s/d <?= $data['tanggal_selesai'] ?></p>
              <p><strong>Status:</strong> <?= $data['status'] ?></p>
              <p><strong>Surat PKL:</strong><br>
                <a href="/si-pkl/uploads/<?= $data['surat_pkl'] ?>" target="_blank" class="btn btn-sm btn-info mt-2">Lihat Surat</a>
              </p>
              <p><strong>Hapus Data:</strong><br>
                <a href="hapus_pendaftaran.php?id=<?= $data['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger mt-2">Hapus</a>
              </p>
            <?php else: ?>
              <p class="text-muted">Belum ada data pendaftaran magang.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Upload Surat -->
<div class="modal fade" id="modal-upload" tabindex="-1" aria-labelledby="modalUploadLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="upload-surat/proses_tambah.php" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Surat PKL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_mahasiswa" value="<?= $id_mahasiswa ?>">
        <div class="mb-3">
          <label for="tempat_magang" class="form-label">Tempat Magang</label>
          <input type="text" name="tempat_magang" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
          <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
          <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="surat_pkl" class="form-label">Upload Surat PKL (PDF)</label>
          <input type="file" name="surat_pkl" accept="application/pdf" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Kirim</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>
