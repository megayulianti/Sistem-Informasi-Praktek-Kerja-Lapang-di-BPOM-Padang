<?php
session_start();
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Cek apakah password dan konfirmasi cocok
    if ($password_baru !== $konfirmasi_password) {
        $_SESSION['error'] = "Konfirmasi password tidak sesuai!";
        header("Location: ../?page=akun/index");
        exit;
    }

    // Simpan password langsung tanpa hash (plain text)
    $query = "UPDATE user SET password='$password_baru' WHERE id_user='$id_user'";
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['success'] = "Password berhasil diubah!";
    } else {
        $_SESSION['error'] = "Gagal mengubah password!";
    }

    header("Location: ../?page=akun/index");
    exit;
}
?>
