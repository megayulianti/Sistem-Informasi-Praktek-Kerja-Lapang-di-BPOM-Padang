<?php
include '../koneksi.php';
session_start();


// Query data mahasiswa tanpa filter
$queryStr = "SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC";
$query = mysqli_query($koneksi, $queryStr);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Mahasiswa</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

<div class="container my-4">
  <div class="page-inner">
    <div class="page-header mb-4">
      <h3 class="fw-bold">Data Mahasiswa</h3>
    </div>

    <div class="card">
      <div class="card-header d-flex flex-column align-items-start">
        <h4 class="card-title mb-2">Data Mahasiswa</h4>
        <a href="laporan-mahasiswa/cetak_laporan_mahasiswa.php" target="_blank" class="btn btn-primary btn-md">
          <i class="fa fa-print me-2"></i> Cetak Laporan / PDF
        </a>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="datatable" class="table table-bordered table-striped table-hover" style="width: 100%;">
            <thead>
              <tr class="text-center">
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Gmail</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>No HP</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($data = mysqli_fetch_array($query)) {
              ?>
                <tr class="text-center">
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($data['nama_lengkap']) ?></td>
                  <td><?= htmlspecialchars($data['gmail']) ?></td>
                  <td><?= htmlspecialchars($data['alamat']) ?></td>
                  <td><?= htmlspecialchars($data['jenis_kelamin']) ?></td>
                  <td><?= htmlspecialchars($data['no_hp']) ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap Bundle JS (Popper + Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
  $('#datatable').DataTable({
    lengthMenu: [[10, 20, 30, 40, 50, 100], [10, 20, 30, 40, 50, 100]],
    pageLength: 10,
    ordering: false,
    language: {
      search: "Cari:",
      lengthMenu: "Tampilkan _MENU_ data per halaman",
      zeroRecords: "Data tidak ditemukan",
      info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
      infoEmpty: "Tidak ada data",
      infoFiltered: "(difilter dari _MAX_ total data)",
      paginate: {
        previous: "Sebelumnya",
        next: "Berikutnya"
      }
    }
  });
});
</script>

</body>
</html>
