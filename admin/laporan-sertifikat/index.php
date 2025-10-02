<?php
include 'koneksi.php';
session_start();

// Ambil data mahasiswa dari DB
$query_mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa");

// Bulan array
$bulan = [
  1 => "January", 2 => "February", 3 => "March", 4 => "April",
  5 => "May", 6 => "June", 7 => "July", 8 => "August",
  9 => "September", 10 => "October", 11 => "November", 12 => "December"
];

// Tahun sekarang
$now = date('Y');

// Ambil nilai filter dari form jika ada
$bln_filter = $_POST['bln'] ?? 'all';
$thn_filter = $_POST['thn'] ?? $now;

// Query sertifikat berdasarkan filter
$no = 1;
if (isset($_POST['tampilkan'])) {
  if ($bln_filter == 'all') {
    $query = mysqli_query($koneksi, "SELECT s.*, m.nama_lengkap 
              FROM sertifikat_pkl s 
              JOIN mahasiswa m ON s.id_mahasiswa = m.id_mahasiswa 
              WHERE YEAR(s.tanggal_mulai) = '$thn_filter' 
              ORDER BY s.id_sertifikat DESC");
  } else {
    $query = mysqli_query($koneksi, "SELECT s.*, m.nama_lengkap 
              FROM sertifikat_pkl s 
              JOIN mahasiswa m ON s.id_mahasiswa = m.id_mahasiswa 
              WHERE MONTH(s.tanggal_mulai) = '$bln_filter' AND YEAR(s.tanggal_mulai) = '$thn_filter' 
              ORDER BY s.id_sertifikat DESC");
  }
} else {
  $query = mysqli_query($koneksi, "SELECT s.*, m.nama_lengkap 
            FROM sertifikat_pkl s 
            JOIN mahasiswa m ON s.id_mahasiswa = m.id_mahasiswa 
            ORDER BY s.id_sertifikat DESC");
}
?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Sertifikat PKL</h3>
    </div>
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daftar Sertifikat</h4>
      </div>
      <div class="card-body">

        <!-- Form Filter Bulan & Tahun -->
        <form action="" method="post" class="mb-3">
          <div class="row g-2">
            <div class="col-md-4">
              <label>Bulan</label>
              <select class="form-control" name="bln">
                <option value="all" <?= $bln_filter == 'all' ? 'selected' : '' ?>>ALL</option>
                <?php foreach ($bulan as $key => $value) : ?>
                  <option value="<?= $key ?>" <?= $bln_filter == $key ? 'selected' : '' ?>><?= $value ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-3">
              <label>Tahun</label>
              <select name="thn" class="form-control">
                <?php for ($a = 2020; $a <= $now; $a++) : ?>
                  <option value="<?= $a ?>" <?= $thn_filter == $a ? 'selected' : '' ?>><?= $a ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
              <button type="submit" class="btn btn-primary" name="tampilkan">Tampilkan Data</button>
            </div>
          </div>
        </form>

        <!-- Form Cetak PDF -->
        <form action="laporan-sertifikat/cetak_laporan_sertifikat.php" method="post" target="_blank">
          <div class="row g-2">
            <div class="col-md-4">
              <select class="form-control" name="bln">
                <option value="all" selected>ALL</option>
                <?php foreach ($bulan as $key => $value) : ?>
                  <option value="<?= $key ?>"><?= $value ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-3">
              <select name="thn" class="form-control">
                <?php for ($a = 2020; $a <= $now; $a++) : ?>
                  <option value="<?= $a ?>"><?= $a ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
              <button type="submit" class="btn btn-danger">Cetak PDF</button>
            </div>
          </div>
        </form>

        <div class="table-responsive mt-4">
          <table id="tabelSertifikat" class="table table-bordered table-striped">
            <thead class="text-center">
              <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Berakhir</th>
                <th>Nama Supervisor</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                <tr class="text-center">
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                  <td><?= htmlspecialchars($row['tanggal_mulai']) ?></td>
                  <td><?= htmlspecialchars($row['tanggal_berakhir']) ?></td>
                  <td><?= htmlspecialchars($row['nama_supervisor']) ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function() {
    $('#tabelSertifikat').DataTable({
      lengthMenu: [[10, 20, 30, 40, 50, 100], [10, 20, 30, 40, 50, 100]],
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ data per halaman",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        paginate: {
          previous: "Sebelumnya",
          next: "Berikutnya"
        }
      }
    });
  });
</script>
