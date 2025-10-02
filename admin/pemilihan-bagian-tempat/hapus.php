<?php
session_start();  // Penting agar bisa menggunakan $_SESSION
include '../koneksi.php';

if (isset($_GET['id_bagian'])) {
    // Tangkap dan escape id_bagian dari URL
    $id_bagian = mysqli_real_escape_string($koneksi, $_GET['id_bagian']);

    // Query hapus data
    $query = "DELETE FROM pemilihan_bagian_tempat WHERE id_bagian = '$id_bagian'";

    if (mysqli_query($koneksi, $query)) {
        // Set session notifikasi sukses
        $_SESSION['delete_success'] = 'Data berhasil dihapus!';
        header('Location: ../?page=pemilihan-bagian-tempat/index');
        exit;
    } else {
        // Set session notifikasi error
        $_SESSION['delete_error'] = 'Gagal menghapus data: ' . mysqli_error($koneksi);
        header('Location: ../?page=pemilihan-bagian-tempat/index');
        exit;
    }
} else {
    // Jika tidak ada id_bagian di URL, langsung redirect
    header('Location: ../?page=pemilihan-bagian-tempat/index');
    exit;
}
