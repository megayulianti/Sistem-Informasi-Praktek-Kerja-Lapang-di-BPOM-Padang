<?php
session_start();
$_SESSION['save_success'] = 'Data berhasil disimpan!';

// Sisipkan file koneksi
include "../koneksi.php";

// Ambil data dari form
$username      = $_POST['username'];
$password      = $_POST['password'];
$nama_lengkap  = $_POST['nama_lengkap'];
$level         = $_POST['level']; // ✅ Tambahkan level

$foto = $_FILES['foto']['name'];

// Pindahkan file foto yang diupload ke folder gambar
move_uploaded_file($_FILES['foto']['tmp_name'], "gambar/$foto");

// Query insert ke database dengan tambahan field level
$tambah = mysqli_query($koneksi, "INSERT INTO user (username, password, nama_lengkap, level, foto) 
VALUES ('$username', '$password', '$nama_lengkap', '$level', '$foto')");

if($tambah){
    // Jika query berhasil
    echo "<script>
    alert('Data Berhasil Ditambahkan'); 
    window.location.href='../?page=user/index';
    </script>";
}else{
    // Jika query gagal
    echo "<script>
    alert('Data Gagal Ditambahkan'); 
    window.location.href='../?page=user/tambah';
    </script>";
}
?>
