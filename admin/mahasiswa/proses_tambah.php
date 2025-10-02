<?php
include '../koneksi.php';

$nama_lengkap   = $_POST['nama_lengkap'];
$gmail          = $_POST['gmail'];
$password       = password_hash($_POST['password'], PASSWORD_DEFAULT);
$alamat         = $_POST['alamat'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$no_hp          = $_POST['no_hp'];
$kampus         = $_POST['kampus'];
$jurusan        = $_POST['jurusan'];

$foto = $_FILES['foto']['name'];
$tmp  = $_FILES['foto']['tmp_name'];

// Upload file foto ke folder /mahasiswa/foto/
$upload = move_uploaded_file($tmp, "foto/$foto");

if ($upload) {
    $query = mysqli_query($koneksi, "INSERT INTO mahasiswa 
        (nama_lengkap, gmail, password, foto, alamat, jenis_kelamin, no_hp, kampus, jurusan) 
        VALUES 
        ('$nama_lengkap', '$gmail', '$password', '$foto', '$alamat', '$jenis_kelamin', '$no_hp', '$kampus', '$jurusan')");

    if ($query) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            window.location.href = '../?page=mahasiswa/index';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menyimpan data ke database!');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('Upload foto gagal!');
        window.history.back();
    </script>";
}
?>
