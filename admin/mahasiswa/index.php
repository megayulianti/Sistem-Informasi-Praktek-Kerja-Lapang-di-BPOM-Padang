<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>

<div class="container py-4">
  <h3 class="fw-bold mb-3">Data Mahasiswa</h3>

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title m-0">Data Mahasiswa</h4>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah">
        Tambah Data
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="add-row" class="table table-bordered table-striped">
          <thead class="text-center">
            <tr>
              <th>No</th>
              <th>Nama Lengkap</th>
              <th>Gmail</th>
              <th>Foto</th>
              <th>Alamat</th>
              <th>Jenis Kelamin</th>
              <th>No HP</th>
              <th>Kampus</th>
              <th>Jurusan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include 'koneksi.php';
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
            while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr class="text-center">
              <td><?= $no++ ?></td>
              <td><?= $data['nama_lengkap'] ?></td>
              <td><?= $data['gmail'] ?></td>
              <td><img src="mahasiswa/foto/<?= $data['foto'] ?>" style="width:80px; height:80px; object-fit:cover;"></td>
              <td><?= $data['alamat'] ?></td>
              <td><?= $data['jenis_kelamin'] ?></td>
              <td><?= $data['no_hp'] ?></td>
              <td><?= $data['kampus'] ?></td>
              <td><?= $data['jurusan'] ?></td>
              <td>
                <div class="d-flex justify-content-center gap-2">
                  <a href="#" class="btn btn-success btn-sm"
                     data-bs-toggle="modal"
                     data-bs-target="#modal-ubah"
                     data-id="<?= $data['id_mahasiswa'] ?>"
                     data-nama="<?= $data['nama_lengkap'] ?>"
                     data-gmail="<?= $data['gmail'] ?>"
                     data-alamat="<?= $data['alamat'] ?>"
                     data-jenkel="<?= $data['jenis_kelamin'] ?>"
                     data-nohp="<?= $data['no_hp'] ?>"
                     data-kampus="<?= $data['kampus'] ?>"
                     data-jurusan="<?= $data['jurusan'] ?>"
                     data-password="<?= $data['password'] ?>">
                    <i class="fa fa-pencil-alt"></i>
                  </a>
                  <a onclick="return confirm('Yakin ingin menghapus?')" href="mahasiswa/hapus.php?id_mahasiswa=<?= $data['id_mahasiswa'] ?>" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i>
                  </a>
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

<!-- Modal Tambah Mahasiswa -->
<div class="modal fade" id="modal-tambah" tabindex="-1">
  <div class="modal-dialog">
    <form action="mahasiswa/proses_tambah.php" method="POST" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Mahasiswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="nama_lengkap" class="form-control" required></div>
        <div class="mb-3"><label>Gmail</label><input type="email" name="gmail" class="form-control" required></div>
        <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
        <div class="mb-3"><label>Foto</label><input type="file" name="foto" class="form-control" required></div>
        <div class="mb-3"><label>Alamat</label><textarea name="alamat" class="form-control" required></textarea></div>
        <div class="mb-3">
          <label>Jenis Kelamin</label>
          <select name="jenis_kelamin" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div class="mb-3"><label>No HP</label><input type="text" name="no_hp" class="form-control" required></div>
        <div class="mb-3"><label>Kampus</label><input type="text" name="kampus" class="form-control" required></div>
        <div class="mb-3"><label>Jurusan</label><input type="text" name="jurusan" class="form-control" required></div>
      </div>
      <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
    </form>
  </div>
</div>

<!-- Modal Ubah Mahasiswa -->
<div class="modal fade" id="modal-ubah" tabindex="-1">
  <div class="modal-dialog">
    <form action="mahasiswa/proses_ubah.php" method="POST" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Mahasiswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_mahasiswa" id="id_mahasiswa_ubah">
        <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="nama_lengkap" id="nama_lengkap_ubah" class="form-control" required></div>
        <div class="mb-3"><label>Gmail</label><input type="email" name="gmail" id="gmail_ubah" class="form-control" required></div>
        <div class="mb-3"><label>Foto Baru (Opsional)</label><input type="file" name="foto" class="form-control"></div>
        <div class="mb-3"><label>Alamat</label><textarea name="alamat" id="alamat_ubah" class="form-control" required></textarea></div>
        <div class="mb-3">
          <label>Jenis Kelamin</label>
          <select name="jenis_kelamin" id="jenkel_ubah" class="form-control" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div class="mb-3"><label>No HP</label><input type="text" name="no_hp" id="nohp_ubah" class="form-control" required></div>
        <div class="mb-3"><label>Kampus</label><input type="text" name="kampus" id="kampus_ubah" class="form-control" required></div>
        <div class="mb-3"><label>Jurusan</label><input type="text" name="jurusan" id="jurusan_ubah" class="form-control" required></div>
<div class="mb-3">
  <label>Password</label>
  <input type="password" name="password" id="password_ubah" class="form-control">
</div>
      </div>
      <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan Perubahan</button></div>
    </form>
  </div>
</div>

<!-- Isi otomatis data ubah -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  var modalUbah = document.getElementById('modal-ubah');
  modalUbah.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    document.getElementById('id_mahasiswa_ubah').value = button.getAttribute('data-id');
    document.getElementById('nama_lengkap_ubah').value = button.getAttribute('data-nama');
    document.getElementById('gmail_ubah').value = button.getAttribute('data-gmail');
    document.getElementById('alamat_ubah').value = button.getAttribute('data-alamat');
    document.getElementById('jenkel_ubah').value = button.getAttribute('data-jenkel');
    document.getElementById('nohp_ubah').value = button.getAttribute('data-nohp');
    document.getElementById('kampus_ubah').value = button.getAttribute('data-kampus');
    document.getElementById('jurusan_ubah').value = button.getAttribute('data-jurusan');

    // Kosongkan input password saat modal dibuka
    document.getElementById('password_ubah').value = '';
  });
});

</script>

<!-- DataTables -->
<script>
$(document).ready(function() {
  $('#add-row').DataTable({
    lengthMenu: [[10, 20, 30, 50, 100], [10, 20, 30, 50, 100]],
    pageLength: 10,
    language: {
      search: "Cari:",
      lengthMenu: "Tampilkan _MENU_ data per halaman",
      zeroRecords: "Data tidak ditemukan",
      info: "Menampilkan halaman _PAGE_ dari _PAGES_",
      infoEmpty: "Tidak ada data tersedia",
      infoFiltered: "(difilter dari total _MAX_ data)"
    }
  });
});
</script>

</body>
</html>
