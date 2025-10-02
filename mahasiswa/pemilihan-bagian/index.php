<?php
// Ambil data mahasiswa yang sedang login
session_start();
include 'koneksi.php';
$id_mahasiswa = $_SESSION['id_mahasiswa']; // pastikan session ini di-set saat login

// Ambil data pemilihan bagian tempat
$query_bagian = mysqli_query($koneksi, "SELECT id_bagian, id_mahasiswa, nama_pkl, bidang_bagian FROM pemilihan_bagian_tempat WHERE id_mahasiswa = '$id_mahasiswa'");
?>

<!-- Tambahkan link CSS DataTables di <head> (jika ini bagian HTML penuh) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Pengumuman</h3>
    </div>

    <div class="row">
      <div class="col-md-12">

        <!-- TABEL PEMILIHAN BAGIAN TEMPAT -->
        <?php if (mysqli_num_rows($query_bagian) > 0): ?>
          <div class="card mt-4">
            <div class="card-header">
              <h4 class="card-title">Data Pengumuman</h4>
            </div>
            <div class="card-body">
              <table id="tabelBagian" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nama PKL</th>
                    <th>Bidang Bagian</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($query_bagian)) : ?>
                    <tr>
                      <td><?= htmlspecialchars($row['nama_pkl']) ?></td>
                      <td><?= htmlspecialchars($row['bidang_bagian']) ?></td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php else: ?>
          <div class="alert alert-warning mt-4">Belum ada data pemilihan bagian tempat.</div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<!-- Include jQuery dan DataTables JS di bagian bawah body -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#tabelBagian').DataTable({
      "lengthMenu": [ [10, 20, 30, 40, 50, 100], [10, 20, 30, 40, 50, 100] ],
      "language": {
        "search": "Pencarian:",
        "lengthMenu": "Tampilkan _MENU_ data per halaman",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        "paginate": {
          "first": "Awal",
          "last": "Akhir",
          "next": "Selanjutnya",
          "previous": "Sebelumnya"
        },
        "zeroRecords": "Data tidak ditemukan",
        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
        "infoFiltered": "(disaring dari _MAX_ total data)"
      }
    });
  });
</script>
