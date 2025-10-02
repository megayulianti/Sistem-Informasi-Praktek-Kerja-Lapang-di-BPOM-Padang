<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id_absensi = $_GET['id'];

    // Hapus data pegawai
    $query = "DELETE FROM absensi WHERE id_absensi='$id_absensi'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('absensi berhasil dihapus!'); window.location='../?page=absensi/index'
        </script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='../?page=absensi/index'
        </script>";
    }
}
?>
