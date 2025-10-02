<?php
session_start();
include 'koneksi.php';

if (!isset($_GET['id'])) {
  echo "ID tidak ditemukan.";
  exit;
}

$id = $_GET['id'];

// Ambil nama file sebelum menghapus
$query = mysqli_query($koneksi, "SELECT surat_pkl FROM pendaftaran_magang WHERE id_pendaftaran = '$id'");
$data = mysqli_fetch_assoc($query);

if ($data) {
  $file = $data['surat_pkl'];

  // Hapus data dari database
  $delete = mysqli_query($koneksi, "DELETE FROM pendaftaran_magang WHERE id_pendaftaran = '$id'");

  if ($delete) {
    // Hapus file dari folder jika ada
    $file_path = __DIR__ . "/uploads/" . $file;
    if (file_exists($file_path)) {
      unlink($file_path);
    }

    // Redirect kembali ke halaman utama
    header("Location: ../?page=upload-surat/index?hapus=berhasil");
    exit;
  } else {
    echo "Gagal menghapus data.";
  }
} else {
  echo "Data tidak ditemukan.";
}
?>
