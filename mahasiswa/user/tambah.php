  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h5 class=" mb-0 text-gray-800">Tambah Data User</h5>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Data User</li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Data User</li>
          </ol>
      </div>

      <div class="row">
          <div class="col-lg-6">
              <!-- Form Basic -->
              <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Tambah Data User</h6>
                      <a href="?page=user/index" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                  </div>
                  <div class="card-body">
                      <form method="POST" action="user/proses_tambah.php" enctype="multipart/form-data">


                          <div class="form-group mb-3">
                              <label for="username">Username</label>
                              <input type="text" id="username" name="username" class="form-control" required>
                          </div>

                          <div class="form-group mb-3">
                              <label for="password">Password</label>
                              <input type="password" id="password" name="password" class="form-control" required>
                          </div>

                          <div class="form-group mb-3">
                              <label for="nama_lengkap">Nama Lengkap</label>
                              <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required>
                          </div>

                          <div class="form-group mb-3">
                              <label for="foto">Foto</label>
                              <input type="file" id="foto" name="foto" class="form-control-file" required>
                          </div>

                          <button type="submit" class="btn btn-primary">Tambah</button>
                      </form>
                  </div>
              </div>

              

          </div>


      </div>
      <!--Row-->



  </div>
  <!---Container Fluid-->