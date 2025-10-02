<?php
include '../koneksi.php';

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['id_bagian']);
    $id_mahasiswa = mysqli_real_escape_string($koneksi, $_POST['id_mahasiswa']);
    $nama_pkl = mysqli_real_escape_string($koneksi, $_POST['nama_pkl']);
    $bidang_bagian = mysqli_real_escape_string($koneksi, $_POST['bidang_bagian']);

    $query = "UPDATE pemilihan_bagian_tempat SET
                id_mahasiswa = '$id_mahasiswa',
                nama_pkl = '$nama_pkl',
                bidang_bagian = '$bidang_bagian'
              WHERE id_bagian = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
            alert('Data mahasiswa berhasil diupdate!');
            window.location.href = '../?page=pemilihan-bagian-tempat/index';
        </script>";
        exit;
    } else {
        $error = mysqli_real_escape_string($koneksi, mysqli_error($koneksi));
        echo "<script>
            alert('Gagal mengubah data: $error');
            window.location.href = '../?page=pemilihan-bagian-tempat/index';
        </script>";
        exit;
    }
} else {
    echo "<script>
        alert('Akses tidak valid!');
        window.location.href = '../?page=pemilihan-bagian-tempat/index';
    </script>";
    exit;
}
