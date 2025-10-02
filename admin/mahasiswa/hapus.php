<?php
include '../koneksi.php';
session_start();

$id = $_GET['id_mahasiswa'];

// Hapus file foto dulu jika ada
$query_foto = mysqli_query($koneksi, "SELECT foto FROM mahasiswa WHERE id_mahasiswa='$id'");
$data = mysqli_fetch_assoc($query_foto);
$foto = $data['foto'];

if ($foto != "" && file_exists("../mahasiswa/foto_mahasiswa/" . $foto)) {
    unlink("../mahasiswa/foto_mahasiswa/" . $foto);
}

// Hapus dari database
$query = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mahasiswa='$id'");

if ($query) {
    $_SESSION['delete_success'] = 'Data mahasiswa berhasil dihapus!';
}
header("Location: ../?page=mahasiswa/index");
