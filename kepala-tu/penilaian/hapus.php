<?php
include '../koneksi.php';
session_start();

if (!isset($_GET['id'])) {
  $_SESSION['error'] = "ID penilaian tidak ditemukan.";
  header("Location: ../penilaian.php");
  exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "DELETE FROM penilaian WHERE id = $id");

if ($query) {
  $_SESSION['success'] = "Data penilaian berhasil dihapus.";
} else {
  $_SESSION['error'] = "Gagal menghapus data: " . mysqli_error($koneksi);
}

header("Location: ../?page=penilaian/index");
exit;
