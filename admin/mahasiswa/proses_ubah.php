<?php
session_start();
include '../koneksi.php';

// Ambil data dari form
$id_mahasiswa   = $_POST['id_mahasiswa'];
$nama_lengkap   = $_POST['nama_lengkap'];
$gmail          = $_POST['gmail'];
$alamat         = $_POST['alamat'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$no_hp          = $_POST['no_hp'];
$kampus         = $_POST['kampus'];
$jurusan        = $_POST['jurusan'];
$foto           = $_FILES['foto']['name'];

// Siapkan bagian update foto jika diunggah
$update_foto = '';
if (!empty($foto)) {
    $tujuan = "../mahasiswa/foto/" . $foto;
    move_uploaded_file($_FILES['foto']['tmp_name'], $tujuan);
    $update_foto = ", foto='$foto'";
}

// Siapkan bagian update password jika diisi
$update_password = '';
if (!empty($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $update_password = ", password='$password'";
}

// Eksekusi query UPDATE
$query = mysqli_query($koneksi, "UPDATE mahasiswa SET 
    nama_lengkap='$nama_lengkap', 
    gmail='$gmail', 
    alamat='$alamat', 
    jenis_kelamin='$jenis_kelamin', 
    no_hp='$no_hp', 
    kampus='$kampus', 
    jurusan='$jurusan'
    $update_password
    $update_foto
    WHERE id_mahasiswa='$id_mahasiswa'");

// Tampilkan alert dan redirect
if ($query) {
    echo "<script>
        alert('Data berhasil diupdate!');
        window.location.href = '../?page=mahasiswa/index';
    </script>";
} else {
    echo "<script>
        alert('Gagal memperbarui data!');
        window.history.back();
    </script>";
}
?>
