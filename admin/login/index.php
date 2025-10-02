<?php
// untuk memulai session
session_start();

//jika sudah login
if (isset($_SESSION['id_user'])) {
    echo "<script> 
    alert ('Anda telah login');
    window.location.href='../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Login Page">
  <meta name="author" content="RuangAdmin">
  <link href="img/logo/logo.png" rel="icon">
  <title>RuangAdmin - Login Admin</title>
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/ruang-admin.min.css" rel="stylesheet">
  <style>
         body {
  background: url('../assets/img/logo.png') no-repeat center center fixed;
  background-size: cover;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

    .container-login {
      max-width: 500px;
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

    .btn-primary {
      background-color: #4e73df;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #375a7f;
    }

    .form-control {
      border-radius: 0.5rem;
      padding: 1rem;
    }

    .text-gray-900 {
      color: #3a3b45;
    }

    .bg-gradient-login {
      background-color: #f8f9fc;
      border-radius: 1rem;
      padding: 2rem;
    }

    .text-center a {
      color: #1cc88a;
      font-weight: bold;
    }

    .text-center a:hover {
      color: #17a673;
    }
  </style>
</head>

<body>
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form bg-gradient-login">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Admin</h1>
                  </div>
                  <form class="user" action="proses_login.php" method="POST">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                    </div>
                    <br>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                    </div>
                    <br>
                    <div class="form-group text-center">
                      <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <hr>
                  </form>
                 <div class="text-center mt-3">
                    <a href="../../index.php" class="btn btn-secondary">← Kembali ke Beranda</a>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
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
