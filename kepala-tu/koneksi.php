<?php

$koneksi = mysqli_connect("localhost", "root", "", "pkl");

// // Check connection
// if (!$koneksi) {
//     die("Connection failed: " . mysqli_connect_error());
// 
$surat_balasan_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM surat_balasan"))['count'];
$mahasiswa_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM mahasiswa"))['count'];
$absensi_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM absensi"))['count'];
$pendaftaran_magang_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM pendaftaran_magang"))['count'];
$pemilihan_bagian_tempat_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM pemilihan_bagian_tempat"))['count'];
$penilaian_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM penilaian"))['count'];
$sertifikat_pkl_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM sertifikat_pkl"))['count'];
?>