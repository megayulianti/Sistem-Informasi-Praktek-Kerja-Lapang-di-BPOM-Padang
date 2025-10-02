<?php
include '../koneksi.php';
session_start();

$id = $_GET['id'];

$query = "DELETE FROM sertifikat_pkl WHERE id_sertifikat = '$id'";

if (mysqli_query($koneksi, $query)) {
    $_SESSION['success'] = "Data sertifikat berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus data.";
}

header("Location: ./?page=sertifikat/index");
exit();
