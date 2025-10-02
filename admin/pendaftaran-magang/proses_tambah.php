<?php
// koneksi ke database
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input
    $id_mahasiswa    = mysqli_real_escape_string($koneksi, $_POST['id_mahasiswa']);
    $tempat_magang   = mysqli_real_escape_string($koneksi, $_POST['tempat_magang']);
    $tanggal_mulai   = mysqli_real_escape_string($koneksi, $_POST['tanggal_mulai']);
    $tanggal_selesai = mysqli_real_escape_string($koneksi, $_POST['tanggal_selesai']);
    $status          = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Cek file surat PKL
    if (isset($_FILES['surat_pkl']) && $_FILES['surat_pkl']['error'] === 0) {
        $nama_file = $_FILES['surat_pkl']['name'];
        $tmp_file  = $_FILES['surat_pkl']['tmp_name'];

        $folder_uploads = "../../uploads/";
        if (!is_dir($folder_uploads)) {
            mkdir($folder_uploads, 0755, true);
        }

        $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $allowed_ext = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowed_ext)) {
            echo "<script>alert('Format file tidak diperbolehkan.'); window.history.back();</script>";
            exit;
        }

        $nama_baru = uniqid('surat_') . '.' . $ext;

        if (move_uploaded_file($tmp_file, $folder_uploads . $nama_baru)) {
            // Simpan ke DB
            $query = mysqli_query($koneksi, "INSERT INTO pendaftaran_magang 
                (id_mahasiswa, tempat_magang, tanggal_mulai, tanggal_selesai, surat_pkl, status) 
                VALUES 
                ('$id_mahasiswa', '$tempat_magang', '$tanggal_mulai', '$tanggal_selesai', '$nama_baru', '$status')");

            if ($query) {
                echo "<script>
                    alert('Data berhasil ditambahkan!');
                    window.location.href = '../?page=pendaftaran-magang/index';
                </script>";
                exit;
            } else {
                echo "Gagal menyimpan data ke database. Error: " . mysqli_error($koneksi);
            }
        } else {
            echo "<script>alert('Gagal mengupload file.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('File surat belum dipilih atau gagal diupload.'); window.history.back();</script>";
    }
} else {
    header("Location: ../?page=pendaftaran-magang/index");
    exit;
}
?>
