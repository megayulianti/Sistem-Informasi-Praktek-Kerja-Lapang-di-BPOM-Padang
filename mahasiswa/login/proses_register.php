<?php
include '../../koneksi.php'; // ganti sesuai path koneksi database

if (isset($_POST['register'])) {
    $nama_lengkap   = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $nim            = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $gmail          = mysqli_real_escape_string($koneksi, $_POST['gmail']);
    $alamat         = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $jenis_kelamin  = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $no_hp          = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $kampus         = mysqli_real_escape_string($koneksi, $_POST['kampus']);
    $jurusan        = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $password       = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Proses upload foto
    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    $folder_upload = "../../uploads/";

    // Pastikan folder upload ada
    if (!is_dir($folder_upload)) {
        mkdir($folder_upload, 0777, true);
    }

    $nama_foto = uniqid() . "_" . $foto;
    $path_foto = $folder_upload . $nama_foto;

    if (move_uploaded_file($tmp, $path_foto)) {
        // Simpan ke database
        $query = "INSERT INTO mahasiswa 
            (nama_lengkap, nim, gmail, foto, alamat, jenis_kelamin, no_hp, kampus, jurusan, password) 
            VALUES 
            ('$nama_lengkap', '$nim', '$gmail', '$nama_foto', '$alamat', '$jenis_kelamin', '$no_hp', '$kampus', '$jurusan', '$password')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data ke database.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Gagal mengupload foto.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid!'); window.location='register_mahasiswa.php';</script>";
}
?>
