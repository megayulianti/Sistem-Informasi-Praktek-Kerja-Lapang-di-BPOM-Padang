<?php
session_start();
include '../koneksi.php';

$id_mahasiswa = $_POST['id_mahasiswa'] ?? '';
$tempat = $_POST['tempat_magang'] ?? '';
$mulai = $_POST['tanggal_mulai'] ?? '';
$selesai = $_POST['tanggal_selesai'] ?? '';

if (empty($id_mahasiswa)) {
    echo "<script>
            alert('Data mahasiswa tidak ditemukan');
            window.history.back();
          </script>";
    exit;
}

$filename = $_FILES['surat_pkl']['name'] ?? '';
$tmpname = $_FILES['surat_pkl']['tmp_name'] ?? '';
$folder = '../../uploads/';
$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
$newname = uniqid() . '.' . $ext;

// Validasi file harus PDF
if ($ext !== 'pdf') {
    echo "<script>
            alert('File harus berupa PDF!');
            window.history.back();
          </script>";
    exit;
}

// Pindahkan file upload
if (!move_uploaded_file($tmpname, $folder . $newname)) {
    echo "<script>
            alert('Gagal mengunggah file.');
            window.history.back();
          </script>";
    exit;
}

// Insert data ke database
$query = mysqli_query($koneksi, "INSERT INTO pendaftaran_magang (id_mahasiswa, tempat_magang, tanggal_mulai, tanggal_selesai, surat_pkl, status) VALUES ('$id_mahasiswa', '$tempat', '$mulai', '$selesai', '$newname', 'Pending')");

if ($query) {
    echo "<script>
            alert('Data berhasil di upload');
            window.location = '../?page=upload-surat/index';
          </script>";
} else {
    echo "<script>
            alert('Gagal menambahkan data');
            window.history.back();
          </script>";
}
