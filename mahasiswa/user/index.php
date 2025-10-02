<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data User</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="#">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Data User</a>
        </li>
      </ul>
    </div>


    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="card-title">Data User</h4>
              <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#modal-tambah">
                  Tambah Data
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="add-row" class="display table table-bordered table-striped table-hover">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
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
                    <tr class="text-center">
                      <td><?php echo $no++ ?></td>
                      <td><?= $data['username'] ?></td>
                      <td><?= $data['nama_lengkap'] ?></td>
                      <td>
                        <img src='user/gambar/<?= $data['foto'] ?>' style='width: 200px; height: 200px; object-fit: cover;' alt='<?= $data['username'] ?>'>
                      </td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="#" 
                            class="btn btn-success btn-sm mr-2" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modal-ubah" 
                            data-id="<?= $data['id_user'] ?>" 
                            data-username="<?= $data['username'] ?>" 
                            data-nama="<?= $data['nama_lengkap'] ?>" 
                            data-password="<?= $data['password'] ?>" 
                            data-foto="<?= $data['foto'] ?>">
                            <i class="fa fa-pencil-alt"></i>
                          </a>
                          <a onclick="return confirm('Yakin ingin dihapus?')" 
                            href="user/hapus.php?page=user/ubah&id_user=<?= $data['id_user'] ?>" 
                            class="btn btn-danger btn-sm">
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
  </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Tambah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="user/proses_tambah.php" enctype="multipart/form-data">
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
            <label for="foto" class="form-label">Foto</label>
            <input type="file" id="foto" name="foto" class="form-control" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ubah Data -->
<div class="modal fade" id="modal-ubah" tabindex="-1" aria-labelledby="modalUbahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUbahLabel">Ubah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="user/proses_ubah.php" enctype="multipart/form-data">
          <input type="hidden" id="id_user_ubah" name="id_user">
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
            <label for="foto_ubah" class="form-label">Foto</label>
            <input type="file" id="foto_ubah" name="foto" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var modalUbah = document.getElementById('modal-ubah');
    modalUbah.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var idUser = button.getAttribute('data-id');
      var username = button.getAttribute('data-username');
      var namaLengkap = button.getAttribute('data-nama');
      var password = button.getAttribute('data-password');
      var foto = button.getAttribute('data-foto');

      var inputIdUser = modalUbah.querySelector('#id_user_ubah');
      var inputUsername = modalUbah.querySelector('#username_ubah');
      var inputNamaLengkap = modalUbah.querySelector('#nama_lengkap_ubah');
      var inputPassword = modalUbah.querySelector('#password_ubah');
      var inputFoto = modalUbah.querySelector('#foto_ubah');

      inputIdUser.value = idUser;
      inputUsername.value = username;
      inputNamaLengkap.value = namaLengkap;
      inputPassword.value = password;
      inputFoto.setAttribute('src', 'user/gambar/' + foto);
    });
  });
</script>


<?php if (isset($_SESSION['save_success'])): ?>
  <script>
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: '<?= $_SESSION['save_success'] ?>',
      showConfirmButton: false,
      timer: 1500
    });
  </script>
  <?php unset($_SESSION['save_success']); ?>
<?php endif; ?>


<?php if (isset($_SESSION['update_success'])): ?>
  <script>
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: '<?= $_SESSION['update_success'] ?>',
      showConfirmButton: false,
      timer: 1500
    });
  </script>
  <?php unset($_SESSION['update_success']); ?>
<?php endif; ?>


<?php if (isset($_SESSION['delete_success'])): ?>
  <script>
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: '<?= $_SESSION['delete_success'] ?>',
      showConfirmButton: false,
      timer: 1500
    });
  </script>
  <?php unset($_SESSION['delete_success']); ?>
<?php endif; ?>
