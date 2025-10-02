<?php

session_start();
$_SESSION['save_success'] = 'Data berhasil disimpan!';
// sisipkan file koneksi
include "../koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$nama_lengkap = $_POST['nama_lengkap'];

$foto = $_FILES['foto']['name'];

move_uploaded_file($_FILES['foto']['tmp_name'], "gambar/$foto");
// query insert ke database
$tambah = mysqli_query($koneksi, "INSERT INTO user (username,password,nama_lengkap, foto) 
VALUES ('$username', '$password', '$nama_lengkap','$foto')");

if($tambah){
    // jika query berhasil
    echo "<script>
    alert('Data Berhasil Ditambahkan') 
    window.location.href='../?page=user/index'
    </script>";
}else{
    // jika query gagal
    echo "<script>
    alert('Data Gagal Ditambahkan') 
    window.location.href='../?page=user/tambah'
    </script>";
}

?>