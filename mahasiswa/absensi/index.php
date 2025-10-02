<?php
session_start();
include 'koneksi.php';

// Ambil id_mahasiswa dan nama_lengkap dari session (pastikan sudah login)
$id_mahasiswa = $_SESSION['id_mahasiswa'];
$nama_lengkap = $_SESSION['nama_lengkap'];
?>

<!-- Tambahkan CSS DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Absensi</h3>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Data Absensi</h4>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-tambah">+ Ambil Absensi</button>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="tabelAbsensi" class="table table-bordered table-hover">
                <thead class="text-center">
                  <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    // Ambil data absensi hanya untuk mahasiswa yang login
                    $query = mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_mahasiswa = '$id_mahasiswa' ORDER BY tanggal DESC, jam DESC");
                    while ($data = mysqli_fetch_assoc($query)) {
                  ?>
                    <tr class="text-center">
                      <td><?= $no++ ?></td>
                      <td><?= htmlspecialchars($data['nama_lengkap']) ?></td>
                      <td><?= date('d-m-Y', strtotime($data['tanggal'])) ?></td>
                      <td><?= date('H:i', strtotime($data['jam'])) ?></td>
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

<!-- Modal Tambah Absensi -->
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="absensi/proses_tambah.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahLabel">Tambah Absensi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_mahasiswa" value="<?= $id_mahasiswa ?>">
          <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($nama_lengkap) ?>" readonly>
          </div>
          <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
              <option value="">-- Pilih Status --</option>
              <option value="Hadir">Hadir</option>
              <option value="Izin">Izin</option>
              <option value="Sakit">Sakit</option>
              <option value="Alpa">Alpa</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
  $('#tabelAbsensi').DataTable({
    language: {
      search: "",
      searchPlaceholder: "Cari data..."
    },
    dom: '<"row mb-2"<"col-md-6"l><"col-md-6 text-end"f>>tip'
  });
});
</script>
