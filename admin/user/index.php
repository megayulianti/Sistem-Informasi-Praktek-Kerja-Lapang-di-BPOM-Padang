<?php
session_start();
include "koneksi.php"; // koneksi ke database
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data User</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

<div class="container my-4">
  <div class="page-inner">
    <div class="page-header mb-4">
      <h3 class="fw-bold">Data User</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home d-inline-block me-1"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="separator d-inline-block me-1"><i class="fas fa-arrow-right"></i></li>
        <li class="nav-item d-inline-block">Data User</li>
      </ul>
    </div>

    <div class="card shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title m-0">Data User</h4>
        <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#modal-tambah">
          Tambah Data
        </button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="add-row" class="display table table-bordered table-striped table-hover text-center" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Level</th>
                <th>Foto</th>
                <th style="width: 30%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_user DESC");
                while ($data = mysqli_fetch_array($query)) {
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($data['username']) ?></td>
                  <td><?= htmlspecialchars($data['nama_lengkap']) ?></td>
                  <td><?= htmlspecialchars($data['level']) ?></td>
                  <td>
                    <img src="user/gambar/<?= htmlspecialchars($data['foto']) ?>" alt="<?= htmlspecialchars($data['username']) ?>" style="width: 200px; height: 200px; object-fit: cover;">
                  </td>
                  <td>
                    <div class="d-flex justify-content-center gap-2">
                      <button 
                        class="btn btn-success btn-sm btn-edit" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modal-ubah"
                        data-id="<?= $data['id_user'] ?>"
                        data-username="<?= htmlspecialchars($data['username']) ?>"
                        data-nama="<?= htmlspecialchars($data['nama_lengkap']) ?>"
                        data-password="<?= htmlspecialchars($data['password']) ?>"
                        data-level="<?= htmlspecialchars($data['level']) ?>"
                        data-foto="<?= htmlspecialchars($data['foto']) ?>"
                      >
                        <i class="fa fa-pencil-alt"></i>
                      </button>
                      <a href="user/hapus.php?page=user/ubah&id_user=<?= $data['id_user'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus?')">
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
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="user/proses_tambah.php" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahLabel">Tambah User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <select id="level" name="level" class="form-select" required>
              <option value="">-- Pilih Level --</option>
              <option value="admin">Admin</option>
              <option value="kepala_dinas">Kepala Dinas</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" id="foto" name="foto" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Ubah Data -->
<div class="modal fade" id="modal-ubah" tabindex="-1" aria-labelledby="modalUbahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="user/proses_ubah.php" enctype="multipart/form-data">
        <input type="hidden" id="id_user_ubah" name="id_user" />
        <div class="modal-header">
          <h5 class="modal-title" id="modalUbahLabel">Ubah User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="username_ubah" class="form-label">Username</label>
            <input type="text" id="username_ubah" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="nama_lengkap_ubah" class="form-label">Nama Lengkap</label>
            <input type="text" id="nama_lengkap_ubah" name="nama_lengkap" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password_ubah" class="form-label">Password</label>
            <input type="password" id="password_ubah" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="level_ubah" class="form-label">Level</label>
            <select id="level_ubah" name="level" class="form-select" required>
              <option value="admin">Admin</option>
              <option value="kepala_dinas">Kepala Dinas</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="foto_ubah" class="form-label">Foto <small>(Kosongkan jika tidak diubah)</small></label>
            <input type="file" id="foto_ubah" name="foto" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap & DataTables JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function () {
    $('#add-row').DataTable({
      lengthMenu: [[10, 20, 30], [10, 20, 30]],
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ data per halaman",
        zeroRecords: "Data tidak ditemukan",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
        infoFiltered: "(disaring dari _MAX_ total data)",
        paginate: {
          first: "Pertama",
          last: "Terakhir",
          next: "Berikutnya",
          previous: "Sebelumnya"
        }
      }
    });

    $('#modal-ubah').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var modal = $(this);

      modal.find('#id_user_ubah').val(button.data('id'));
      modal.find('#username_ubah').val(button.data('username'));
      modal.find('#nama_lengkap_ubah').val(button.data('nama'));
      modal.find('#password_ubah').val(button.data('password'));
      modal.find('#level_ubah').val(button.data('level'));
    });
  });
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_SESSION['save_success'])): ?>
  <script>
    Swal.fire({ icon: 'success', title: 'Data berhasil disimpan!', showConfirmButton: false, timer: 1800 });
  </script>
  <?php unset($_SESSION['save_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['update_success'])): ?>
  <script>
    Swal.fire({ icon: 'success', title: 'Data berhasil diubah!', showConfirmButton: false, timer: 1800 });
  </script>
  <?php unset($_SESSION['update_success']); ?>
<?php endif; ?>

</body>
</html>
