<?php
include 'koneksi.php';

// Ambil filter dari POST atau default
$filter_bulan = $_POST['bln'] ?? 'all';
$filter_tahun = $_POST['thn'] ?? date('Y');

// Query filter
$where = "1=1";
if ($filter_bulan != 'all') {
    $where .= " AND MONTH(pm.tanggal_mulai) = " . intval($filter_bulan);
}
if ($filter_tahun != 'all') {
    $where .= " AND YEAR(pm.tanggal_mulai) = " . intval($filter_tahun);
}

// Ambil data pendaftaran magang
$query = mysqli_query($koneksi, "SELECT pm.*, m.nama_lengkap 
                                 FROM pendaftaran_magang pm
                                 JOIN mahasiswa m ON pm.id_mahasiswa = m.id_mahasiswa
                                 WHERE $where
                                 ORDER BY pm.id DESC");

// Bulan array
$bulan_arr = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];

// Ambil tahun unik dari tabel
$tahun_result = mysqli_query($koneksi, "SELECT DISTINCT YEAR(tanggal_mulai) as tahun FROM pendaftaran_magang ORDER BY tahun DESC");
$tahun_arr = [];
while ($t = mysqli_fetch_assoc($tahun_result)) {
    $tahun_arr[] = $t['tahun'];
}
?>

<!-- DataTables CSS/JS -->
<link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Verifikasi Pendaftaran</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Data Verifikasi Pendaftaran</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header"><h4 class="card-title">Data Verifikasi Pendaftaran</h4></div>
          <div class="card-body">

            <!-- Filter Bulan & Tahun -->
            <form action="" method="post" class="mb-3">
              <div class="row g-2">
                <div class="col-md-4">
                  <label>Bulan</label>
                  <select class="form-control" name="bln">
                    <option value="all" <?= $filter_bulan == 'all' ? 'selected' : '' ?>>ALL</option>
                    <?php
                    foreach ($bulan_arr as $key => $value) {
                      $selected = ($filter_bulan == $key) ? 'selected' : '';
                      echo "<option value=\"$key\" $selected>$value</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Tahun</label>
                  <select name="thn" class="form-control">
                    <option value="all" <?= $filter_tahun == 'all' ? 'selected' : '' ?>>ALL</option>
                    <?php
                    foreach ($tahun_arr as $tahun) {
                      $selected = ($filter_tahun == $tahun) ? 'selected' : '';
                      echo "<option value=\"$tahun\" $selected>$tahun</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                  <button type="submit" class="btn btn-primary">Tampilkan Data</button>
                </div>
              </div>
            </form>

            <!-- Form Cetak PDF -->
            <form action="laporan-pendaftaran-magang/cetak_laporan_pendaftaran_magang.php" method="post" target="_blank">
              <div class="row g-2">
                <div class="col-md-4">
                  <select class="form-control" name="bln">
                    <option value="all">ALL</option>
                    <?php
                    foreach ($bulan_arr as $key => $value) {
                        echo "<option value=\"$key\">$value</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <select name="thn" class="form-control">
                    <?php
                    foreach ($tahun_arr as $tahun) {
                        echo "<option value=\"$tahun\">$tahun</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                  <button type="submit" class="btn btn-danger">Cetak PDF</button>
                </div>
              </div>
            </form>

            <!-- Tabel -->
            <div class="table-responsive mt-4">
              <table id="dataTable" class="table table-bordered table-striped table-hover text-center">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Tempat Magang</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  while ($data = mysqli_fetch_assoc($query)) {
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= htmlspecialchars($data['nama_lengkap']) ?></td>
                      <td><?= htmlspecialchars($data['tempat_magang']) ?></td>
                      <td><?= htmlspecialchars($data['tanggal_mulai']) ?></td>
                      <td><?= htmlspecialchars($data['tanggal_selesai']) ?></td>
                      <td><?= htmlspecialchars($data['status']) ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- DataTables Init -->
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable({
      "lengthMenu": [[10, 20, 30, 50, 100], [10, 20, 30, 50, 100]],
      "language": {
        "search": "Cari:",
        "lengthMenu": "Tampilkan _MENU_ data per halaman",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        "infoEmpty": "Tidak ada data tersedia",
        "zeroRecords": "Data tidak ditemukan",
        "paginate": {
          "first": "Pertama",
          "last": "Terakhir",
          "next": "Berikutnya",
          "previous": "Sebelumnya"
        }
      }
    });
  });
</script>
