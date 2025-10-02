<?php
session_start();
include '../koneksi.php'; // sesuaikan koneksi db

if (isset($_POST['login'])) {
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];

    // Prepared statement untuk keamanan
    $stmt = $koneksi->prepare("SELECT * FROM mahasiswa WHERE gmail = ? LIMIT 1");
    $stmt->bind_param("s", $gmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // Simpan session user
            $_SESSION['id_mahasiswa'] = $row['id_mahasiswa'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
            $_SESSION['gmail'] = $row['gmail'];
            $_SESSION['foto'] = $row['foto'];  // Pastikan kolom foto ada di DB dan berisi nama file foto

            echo "<script>
                    alert('Selamat datang, " . addslashes($row['nama_lengkap']) . "! Anda berhasil login.');
                    window.location.href = '../index.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Password salah');
                    window.location.href = 'index.php';
                  </script>";
            exit;
        }
    } else {
        echo "<script>
                alert('Gmail tidak ditemukan');
                window.location.href = 'index.php';
              </script>";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>
