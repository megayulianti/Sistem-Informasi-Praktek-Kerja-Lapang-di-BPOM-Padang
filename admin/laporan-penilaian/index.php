<?php
include 'koneksi.php';
session_start();

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

// Query penilaian berdasarkan filter
$no = 1;
if (isset($_POST['tampilkan'])) {
  if ($bln_filter == 'all') {
    $query = mysqli_query($koneksi, "SELECT p.*, m.nama_lengkap 
      FROM penilaian p 
      JOIN mahasiswa m ON p.id_mahasiswa = m.id_mahasiswa 
      WHERE YEAR(p.tanggal_pelaksanaan) = '$thn_filter' 
      ORDER BY p.id DESC");
  } else {
    $query = mysqli_query($koneksi, "SELECT p.*, m.nama_lengkap 
      FROM penilaian p 
      JOIN mahasiswa m ON p.id_mahasiswa = m.id_mahasiswa 
      WHERE MONTH(p.tanggal_pelaksanaan) = '$bln_filter' AND YEAR(p.tanggal_pelaksanaan) = '$thn_filter' 
      ORDER BY p.id DESC");
  }
} else {
  $query = mysqli_query($koneksi, "SELECT p.*, m.nama_lengkap 
    FROM penilaian p 
    JOIN mahasiswa m ON p.id_mahasiswa = m.id_mahasiswa 
    ORDER BY p.id DESC");
}
?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Surat Nilai PKL</h3>
    </div>
    <div class="card">
      <div class="card-body">
        
        <div class="table-responsive">
          <form method="post" action="" class="mb-3 row g-2 align-items-end">
            <div class="col-md-2">
              <label class="form-label">Bulan</label>
              <select name="bln" class="form-control">
                <option value="all" <?= $bln_filter == 'all' ? 'selected' : '' ?>>ALL</option>
                <?php foreach ($bulan as $key => $value): ?>
                  <option value="<?= $key ?>" <?= $bln_filter == $key ? 'selected' : '' ?>><?= $value ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <label class="form-label">Tahun</label>
              <select name="thn" class="form-control">
                <?php for ($a = 2020; $a <= $now; $a++): ?>
                  <option value="<?= $a ?>" <?= $thn_filter == $a ? 'selected' : '' ?>><?= $a ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" name="tampilkan" class="btn btn-primary w-100">Tampilkan</button>
            </div>
          </form>

          <form method="post" action="laporan-penilaian/cetak_laporan_penilaian.php" target="_blank" class="mb-3 row g-2 align-items-end">
            <div class="col-md-2">
              <select name="bln" class="form-control">
                <option value="all" <?= $bln_filter == 'all' ? 'selected' : '' ?>>ALL</option>
                <?php foreach ($bulan as $key => $value): ?>
                  <option value="<?= $key ?>" <?= $bln_filter == $key ? 'selected' : '' ?>><?= $value ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-2">
              <select name="thn" class="form-control">
                <?php for ($a = 2020; $a <= $now; $a++): ?>
                  <option value="<?= $a ?>" <?= $thn_filter == $a ? 'selected' : '' ?>><?= $a ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-danger w-100">Cetak PDF</button>
            </div>
          </form>

          <table id="tabelPenilaian" class="table table-bordered table-striped">
            <thead class="text-center">
              <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Nama Supervisor</th>
                <th>Total Skor</th>
                <th>Nilai Supervisor</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                <tr class="text-center">
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                  <td><?= htmlspecialchars($row['tanggal_pelaksanaan']) ?></td>
                  <td><?= htmlspecialchars($row['nama_supervisor']) ?></td>
                  <td><?= htmlspecialchars($row['total_skor']) ?></td>
                  <td><?= htmlspecialchars($row['nilai_supervisor']) ?></td>
                  <td><?= htmlspecialchars($row['tanggal']) ?></td>
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
    $('#tabelPenilaian').DataTable({
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
