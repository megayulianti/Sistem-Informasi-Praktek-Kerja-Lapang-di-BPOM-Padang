<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Register Page">
  <meta name="author" content="RuangAdmin">
  <link href="img/logo/logo.png" rel="icon">
  <title>RuangAdmin - Register</title>
  
  <!-- Font Awesome & Bootstrap -->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/ruang-admin.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(90deg, #1cc88a 0%, #36b9cc 100%);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-login {
      max-width: 600px;
      padding: 30px;
    }

    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      background-color: #f8f9fc;
    }

    .login-form h1 {
      font-weight: bold;
      color: #4e73df;
    }

    .btn-primary {
      background-color: #4e73df;
      border: none;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #2e59d9;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .form-control {
      border-radius: 0.5rem;
      padding: 1rem;
      border: 1px solid #d1d3e2;
    }

    .form-control:focus {
      border-color: #4e73df;
      box-shadow: 0 0 10px rgba(78, 115, 223, 0.5);
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
  <!-- Register Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                  </div>
                  <form action="proses_register.php" method="POST">
                    <div class="form-group">
                      <label for="username">Username</label><br>
                      <input type="text" name="username" class="form-control" placeholder="Masukan Username" required>
                    </div>

                    <div class="form-group">
                      <label for="password">Password</label><br>
                      <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
                    </div>

                    <div class="form-group">
                      <label for="nama_lengkap">Nama Lengkap</label><br>
                      <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukan Nama Lengkap" required>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <hr>
                  </form>
                  <div class="text-center">
                    <a href="./index.php">Already have an account?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Register Content -->

  <!-- Script files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../assets/js/ruang-admin.min.js"></script>
</body>

</html>
