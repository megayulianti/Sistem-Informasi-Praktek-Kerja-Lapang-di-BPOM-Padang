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

                    <form method="post" action="laporan-sertifikat/cetak_pdf.php" target="_blank" class="mb-3 row g-2 align-items-end">
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
