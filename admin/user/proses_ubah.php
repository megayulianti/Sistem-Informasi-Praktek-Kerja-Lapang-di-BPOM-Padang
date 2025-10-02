<?php
session_start();
$_SESSION['update_success'] = 'Data berhasil ter update!';

// Sisipkan file koneksi
include "../koneksi.php";

// Ambil data dari form
$id_user       = $_POST['id_user'];
$username      = $_POST['username'];
$password      = $_POST['password'];
$nama_lengkap  = $_POST['nama_lengkap'];
$level         = $_POST['level']; // ✅ Tambahkan level

$foto = $_FILES['foto']['name'];

if (!empty($foto)) {
    // Pindahkan file gambar yang diupload ke folder gambar
    move_uploaded_file($_FILES['foto']['tmp_name'], "gambar/$foto");
    
    // ✅ Update data termasuk foto dan level
    $sql = "UPDATE user SET 
                username='$username', 
                password='$password',
                nama_lengkap='$nama_lengkap', 
                level='$level',
                foto='$foto' 
            WHERE id_user=$id_user";
} else {
    // ✅ Update data tanpa mengganti foto
    $sql = "UPDATE user SET 
                username='$username',
                password='$password',
                nama_lengkap='$nama_lengkap',
                level='$level'
            WHERE id_user=$id_user";
}

// Eksekusi query
$ubah = mysqli_query($koneksi, $sql);

// Jika query berhasil
if ($ubah) {
    echo "<script>
            alert('Data Berhasil Diupdate');
            window.location.href='../?page=user/index';
          </script>";
} else {
    // Jika query gagal
    echo "<script>
            alert('Data Gagal Diupdate');
            window.location.href='../?page=user/ubah&id_user=$id_user';
          </script>";
}
?>
