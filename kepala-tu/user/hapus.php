<?php

session_start();
$_SESSION['delete_success'] = 'Data berhasil di hapus!';

include "../koneksi.php";

$id_user = $_GET['id_user'];


// query insert ke database
$hapus =mysqli_query($koneksi,"DELETE FROM  user WHERE id_user='$id_user'");

if($hapus){
    // jika query berhasil
    echo "<script>
    alert('Data Berhasil Dihapus') 
    window.location.href='../?page=user/index'
    </script>";
}else{
    // jika query gagal
    echo "<script>
    alert('Data Gagal Dihapus') 
    window.location.href='../?page=user/index'
    </script>";
}

?>