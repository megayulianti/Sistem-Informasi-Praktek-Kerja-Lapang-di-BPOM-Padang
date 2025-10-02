<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Absensi </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    th, td {
      vertical-align: middle !important;
    }
    .table td {
      padding: 0.5rem;
    }
    body {
      background-color: #f8f9fa;
    }
    .card {
      margin-top: 40px;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="d-flex justify-content-between mb-4 align-items-center">
    <h3 class="fw-bold">Data Absensi</h3>
    <span class="text-muted">Login sebagai: <strong><?= $_SESSION['username']; ?></strong></span>
  </div>

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title mb-0">Data Absensi</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover align-middle">
          <thead class="text-center">
            <tr>
              <th>No</th>
              <th>Nim</th>
              <th>Nama</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $data = mysqli_query($koneksi, "
                          SELECT absensi.*, mahasiswa.nim, mahasiswa.nama_lengkap 
                          FROM absensi 
                          JOIN mahasiswa ON absensi.id_mahasiswa = mahasiswa.id_mahasiswa 
                          ORDER BY tanggal DESC, jam DESC
                        ");
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $d['nim']; ?></td>
                <td><?= $d['nama_lengkap']; ?></td>
                <td><?= $d['tanggal']; ?></td>
                <td><?= $d['jam']; ?></td>
                <td><?= $d['status']; ?></td>
                <td class="text-center">
                  <div class="d-flex justify-content-center gap-1">
                    <a href="absensi/hapus.php?id=<?= $d['id_absensi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                  </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#dataTable').DataTable({
      "lengthMenu": [[10, 25, 50], [10, 25, 50]],
      "language": {
        "search": "Cari Data:",
        "lengthMenu": "Tampilkan _MENU_ data per halaman",
        "zeroRecords": "Data tidak ditemukan",
        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        "infoEmpty": "Tidak ada data tersedia",
        "infoFiltered": "(disaring dari total _MAX_ data)"
      }
    });
  });
</script>
</body>
</html>
