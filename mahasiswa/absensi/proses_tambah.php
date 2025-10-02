<?php
session_start();
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke WIB

    $id_mahasiswa = $_POST['id_mahasiswa'];
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Ambil NIM dari tabel mahasiswa berdasarkan id_mahasiswa
    $query_nim = mysqli_query($koneksi, "SELECT nim FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa' LIMIT 1");
    if (mysqli_num_rows($query_nim) > 0) {
        $data_nim = mysqli_fetch_assoc($query_nim);
        $nim = $data_nim['nim'];
    } else {
        // Jika nim tidak ditemukan
        echo "<script>
                alert('NIM tidak ditemukan. Silakan periksa data mahasiswa.');
                window.history.back();
              </script>";
        exit;
    }

    $tanggal = date('Y-m-d');
    $jam = date('H:i:s');

    // Cek apakah sudah absen hari ini untuk mahasiswa ini
    $cek_absen = mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_mahasiswa='$id_mahasiswa' AND tanggal='$tanggal'");

    if (mysqli_num_rows($cek_absen) > 0) {
        echo "<script>
                alert('Kamu sudah melakukan absensi hari ini.');
                window.location = '../index.php?page=absensi/index';
              </script>";
        exit;
    }

    // Insert data absensi dengan nim
    $insert = mysqli_query($koneksi, "INSERT INTO absensi (id_mahasiswa, nim, nama_lengkap, tanggal, jam, status) 
    VALUES ('$id_mahasiswa', '$nim', '$nama_lengkap', '$tanggal', '$jam', '$status')");

    if ($insert) {
        echo "<script>
                alert('Absensi berhasil dicatat.');
                window.location = '../index.php?page=absensi/index';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mencatat absensi.');
                window.history.back();
              </script>";
    }
}
?>
