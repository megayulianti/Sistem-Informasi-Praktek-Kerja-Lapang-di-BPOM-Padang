<?php

$koneksi = mysqli_connect("localhost", "root", "", "news_web");

// // Check connection
// if (!$koneksi) {
//     die("Connection failed: " . mysqli_connect_error());
// }


$kategori_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM kategori"))['count'];
$berita_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM berita"))['count'];
$tim_count = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM tim_kami"))['count'];
$kontak_count =mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM kontak"))['count'];
?>