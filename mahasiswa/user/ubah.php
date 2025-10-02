<?php
// include "./koneksi.php";
$id_user = $_GET['id_user'];
$ubah = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");
$data = mysqli_fetch_array($ubah);
?>


<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class=" mb-0 text-gray-800">Ubah Data User</h5>
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
                    <h6 class="m-0 font-weight-bold text-primary">Ubah Data User</h6>
                    <a href="?page=user/index" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="user/proses_ubah.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Masukan Username" value="<?= $data['username']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Masukan Password" required>
                            </div>

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                    placeholder="Masukan Nama Lengkap" value="<?= $data['nama_lengkap']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto:</label>
                                <input type="file" name="foto" id="foto" class="form-control-file">
                                <?php if ($data['foto']): ?>
                                <img src="user/gambar/<?= $data['foto']?>" alt="Foto Lama" class="img-fluid mt-2"
                                    style="max-width: 200px;">
                                <?php endif; ?>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" title="Simpan Data">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>


    </div>
    <!--Row-->



</div>
<!---Container Fluid-->