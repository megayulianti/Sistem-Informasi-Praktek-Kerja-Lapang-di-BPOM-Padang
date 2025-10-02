<?php
include '../koneksi.php';

$id_mahasiswa = $_POST['id_mahasiswa'];
$tanggal_mulai = $_POST['tanggal_mulai'];
$tanggal_berakhir = $_POST['tanggal_berakhir'];
$nama_supervisor = $_POST['nama_supervisor'];

$query = "INSERT INTO sertifikat_pkl (id_mahasiswa, tanggal_mulai, tanggal_berakhir, nama_supervisor)
          VALUES ('$id_mahasiswa', '$tanggal_mulai', '$tanggal_berakhir', '$nama_supervisor')";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
        alert('Data sertifikat berhasil ditambahkan.');
        window.location.href = '../?page=sertifikat/index';
    </script>";
} else {
    $error = mysqli_real_escape_string($koneksi, mysqli_error($koneksi));
    echo "<script>
        alert('Gagal menambahkan data: $error');
        window.location.href = '../?page=sertifikat/index';
    </script>";
}
exit;
