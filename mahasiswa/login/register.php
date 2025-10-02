<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Pendaftaran Mahasiswa</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
     background: url('../assets/img/logo1.png') no-repeat center center fixed;
  background-size: cover;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

    .form-container {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

    .form-label {
      font-weight: 600;
      margin-bottom: 6px;
    }

    .form-control {
      padding: 0.6rem 0.9rem;
      border-radius: 0.4rem;
    }

    .form-group {
      margin-bottom: 1.2rem;
    }

    .btn-primary {
      padding: 0.6rem 2rem;
      font-size: 1.1rem;
      border-radius: 8px;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h4 class="text-center mb-4 font-weight-bold">Form Pendaftaran Mahasiswa</h4>
  <form action="proses_register.php" method="POST" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap" required>
      </div>
      <div class="form-group col-md-6">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="gmail" class="form-label">Gmail</label>
        <input type="email" name="gmail" class="form-control" placeholder="Masukkan Gmail Aktif" required>
      </div>
      <div class="form-group col-md-6">
        <label for="no_hp" class="form-label">No HP</label>
        <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No HP Aktif" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
          <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="foto" class="form-label">Upload Foto</label>
        <input type="file" name="foto" class="form-control" required>
      </div>
      <div class="form-group col-md-6">
        <label for="kampus" class="form-label">Nama Kampus</label>
        <input type="text" name="kampus" class="form-control" placeholder="Masukkan Nama Kampus" required>
      </div>
      <div class="form-group col-md-6">
        <label for="jurusan" class="form-label">Jurusan</label>
        <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Nama Jurusan" required>
      </div>
    </div>

    <div class="form-group">
      <label for="alamat" class="form-label">Alamat Lengkap</label>
      <textarea name="alamat" rows="3" class="form-control" placeholder="Masukkan Alamat Lengkap" required></textarea>
    </div>

    <div class="form-group">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
    </div>

    <div class="text-center mt-4">
      <button type="submit" name="register" class="btn btn-primary">Daftar Sekarang</button>
    </div>
  </form>
</div>

</body>
</html>
