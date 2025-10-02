<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Login Page" />
  <meta name="author" content="RuangAdmin" />
  <link href="img/logo/logo.png" rel="icon" />
  <title>RuangAdmin - Login Mahasiswa</title>
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/ruang-admin.min.css" rel="stylesheet" />
  <style>
    body {
      background: url('../assets/img/logo1.png') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }

    .container-login {
      max-width: 480px;
      width: 90%;
      padding: 20px;
    }

    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .login-form h1 {
      font-weight: 700;
      color: #4e73df;
    }

    form.mahasiswa {
      width: 100%;
      max-width: 100%;
    }

    .form-group {
      margin-bottom: 1.2rem;
    }

   .form-control {
  border-radius: 0.5rem;
  padding: 0.75rem 1rem;
  width: 80%;          /* dikurangi dari 100% jadi 80% */
  max-width: 350px;    /* maksimal lebar input */
  font-size: 1rem;
  display: block;
  margin: 0 auto;      /* supaya input center */
}


    .btn-primary {
      background-color: #4e73df;
      border: none;
      padding: 0.5rem 2rem;
      font-size: 1rem;
      transition: background-color 0.3s ease;
      border-radius: 0.5rem;
    }

    .btn-primary:hover {
      background-color: #375a7f;
    }

    /* Tombol login tengah dan ukuran sedang */
    .btn-login {
      display: block;
      margin: 0 auto;
      width: auto;
      min-width: 150px;
    }

    .bg-gradient-login {
      background-color: #f8f9fc;
      border-radius: 1rem;
      padding: 2rem 2.5rem;
    }

    .text-center a {
      color: #1cc88a;
      font-weight: bold;
      text-decoration: none;
    }

    .text-center a:hover {
      color: #17a673;
      text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 576px) {
      .container-login {
        max-width: 100%;
        padding: 15px;
      }

      .bg-gradient-login {
        padding: 1.5rem 1.5rem;
      }
    }
    .text-center {
  text-align: center;
}

  </style>
</head>

<body>
  <!-- Login Content -->
  <div class="container-login">
    <div class="card shadow-sm my-5">
      <div class="card-body p-0">
        <div class="login-form bg-gradient-login">
          <div class="text-center mb-4">
            <h1 class="h4 text-gray-900">Login Mahasiswa</h1>
          </div>
          <form class="mahasiswa" action="proses_login.php" method="POST" novalidate>
            <div class="form-group">
              <input type="text" name="gmail" class="form-control" placeholder="Masukkan Gmail" required />
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required />
            </div>
            <div class="form-group text-center">
              <button type="submit" name="login" class="btn btn-primary btn-login">Login</button>
            </div>
          </form>

          <div class="text-center mt-3">
            <a href="../../index.php" class="btn btn-secondary">← Kembali ke Beranda</a>
          </div>

          <hr />

          <div class="text-center mt-3">
            <a href="register.php">Belum Punya akun? <br />Daftar di sini</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->

  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../assets/js/ruang-admin.min.js"></script>
</body>

</html>
