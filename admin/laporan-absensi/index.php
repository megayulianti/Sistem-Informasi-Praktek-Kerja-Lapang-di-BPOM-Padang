<?php include '../koneksi.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Absensi</title>
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
    .filter-container {
      margin-top: 20px;
    }
    .filter-form {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    .print-btn {
      margin-left: auto;
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

      <!-- Form Filter Bulan & Tahun -->
      <?php
        $selected_bulan = $_POST['bln'] ?? 'all';
        $selected_tahun = $_POST['thn'] ?? date('Y');

        $bulan_arr = [
          1 => "January", 2 => "February", 3 => "March", 4 => "April",
          5 => "May", 6 => "June", 7 => "July", 8 => "August",
          9 => "September", 10 => "October", 11 => "November", 12 => "December"
        ];
      ?>

      <form action="" method="post" class="mb-3">
        <div class="row g-2">
          <div class="col-md-4">
            <label>Bulan</label>
            <select class="form-control" name="bln">
              <option value="all" <?= $selected_bulan == 'all' ? 'selected' : '' ?>>ALL</option>
              <?php
              foreach ($bulan_arr as $key => $value) {
                $selected = ($selected_bulan == $key) ? 'selected' : '';
                echo "<option value=\"$key\" $selected>$value</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-3">
            <label>Tahun</label>
            <select name="thn" class="form-control">
              <?php
              $now = date('Y');
              for ($a = 2020; $a <= $now; $a++) {
                $selected = ($selected_tahun == $a) ? 'selected' : '';
                echo "<option value='$a' $selected>$a</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary" name="tampilkan">Tampilkan Data</button>
          </div>
        </div>
      </form>

      <!-- Form Cetak PDF -->
      <form action="laporan-absensi/cetak_laporan_absensi.php" method="post" target="_blank">
        <div class="row g-2">
          <div class="col-md-4">
            <select class="form-control" name="bln">
              <option value="all" <?= $selected_bulan == 'all' ? 'selected' : '' ?>>ALL</option>
              <?php
              foreach ($bulan_arr as $key => $value) {
                $selected = ($selected_bulan == $key) ? 'selected' : '';
                echo "<option value=\"$key\" $selected>$value</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-3">
            <select name="thn" class="form-control">
              <?php
              for ($a = 2020; $a <= $now; $a++) {
                $selected = ($selected_tahun == $a) ? 'selected' : '';
                echo "<option value='$a' $selected>$a</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-danger">Cetak PDF</button>
          </div>
        </div>
      </form>

      <!-- TABLE -->
      <div class="table-responsive mt-3">
        <table id="dataTable" class="table table-bordered table-hover align-middle">
          <thead class="text-center">
            <tr>
              <th>No</th>
              <th>NIM</th>
              <th>Nama</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $query = "SELECT absensi.*, mahasiswa.nim, mahasiswa.nama_lengkap 
                      FROM absensi 
                      JOIN mahasiswa ON absensi.id_mahasiswa = mahasiswa.id_mahasiswa";

            if (isset($_POST['tampilkan'])) {
              if ($selected_bulan != 'all') {
                $query .= " WHERE MONTH(tanggal) = '$selected_bulan' AND YEAR(tanggal) = '$selected_tahun'";
              } else {
                $query .= " WHERE YEAR(tanggal) = '$selected_tahun'";
              }
            }

            $query .= " ORDER BY tanggal DESC, jam DESC";
            $data = mysqli_query($koneksi, $query);

            while ($d = mysqli_fetch_array($data)) {
              echo "<tr>
               <td class='text-center'>" . $no++ . "</td>
                <td>{$d['nim']}</td>
                <td>{$d['nama_lengkap']}</td>
                <td>{$d['tanggal']}</td>
                <td>{$d['jam']}</td>
                <td>{$d['status']}</td>
              </tr>";
            }
            ?>
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
      "lengthMenu": [[10, 20, 30, 40, 50, 100], [10, 20, 30, 40, 50, 100]],
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
