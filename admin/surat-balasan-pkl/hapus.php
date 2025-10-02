<?php
include('../../koneksi.php');
session_start();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    // Cek apakah data ada
    $cek = mysqli_query($koneksi, "SELECT * FROM surat_balasan WHERE id_surat_balasan='$id'");
    if (mysqli_num_rows($cek) > 0) {
        // Hapus data surat_balasan
        $query = "DELETE FROM surat_balasan WHERE id_surat_balasan='$id'";
        if (mysqli_query($koneksi, $query)) {
            $_SESSION['delete_success'] = "Data berhasil dihapus!";
        } else {
            $_SESSION['delete_error'] = "Gagal menghapus data: " . mysqli_error($koneksi);
        }
    } else {
        $_SESSION['delete_error'] = "Data tidak ditemukan.";
    }
} else {
    $_SESSION['delete_error'] = "ID tidak valid.";
}

header("Location: ../?page=surat-balasan-pkl/index");
exit;
?>
