<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
    $id_mahasiswa = mysqli_real_escape_string($koneksi, $_POST['id_mahasiswa']);
    $nama_pkl = mysqli_real_escape_string($koneksi, $_POST['nama_pkl']);
    $bidang_bagian = mysqli_real_escape_string($koneksi, $_POST['bidang_bagian']);

    $query = mysqli_query($koneksi, "INSERT INTO pemilihan_bagian_tempat (id_mahasiswa, nama_pkl, bidang_bagian) 
                                     VALUES ('$id_mahasiswa', '$nama_pkl', '$bidang_bagian')");

    if ($query) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            window.location.href = '../?page=pemilihan-bagian-tempat/index';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Gagal menambahkan data: " . mysqli_real_escape_string($koneksi, mysqli_error($koneksi)) . "');
            window.location.href = '../?page=pemilihan-bagian-tempat/index';
        </script>";
        exit;
    }
} else {
    echo "<script>
        alert('Akses tidak valid.');
        window.location.href = '../?page=pemilihan-bagian-tempat/index';
    </script>";
    exit;
}
