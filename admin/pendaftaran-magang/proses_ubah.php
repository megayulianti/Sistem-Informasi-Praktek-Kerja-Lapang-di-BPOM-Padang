<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id              = mysqli_real_escape_string($koneksi, $_POST['id']);
    $id_mahasiswa    = mysqli_real_escape_string($koneksi, $_POST['id_mahasiswa']);
    $tempat_magang   = mysqli_real_escape_string($koneksi, $_POST['tempat_magang']);
    $tanggal_mulai   = mysqli_real_escape_string($koneksi, $_POST['tanggal_mulai']);
    $tanggal_selesai = mysqli_real_escape_string($koneksi, $_POST['tanggal_selesai']);
    $status          = mysqli_real_escape_string($koneksi, $_POST['status']);

    $folder_uploads = "../../uploads/";
    if (!is_dir($folder_uploads)) {
        mkdir($folder_uploads, 0755, true);
    }

    $query = "";

    // Cek apakah ada file baru diunggah
    if (isset($_FILES['surat_pkl']) && $_FILES['surat_pkl']['error'] === 0) {
        $nama_file = $_FILES['surat_pkl']['name'];
        $tmp_file  = $_FILES['surat_pkl']['tmp_name'];

        $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $allowed_ext = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowed_ext)) {
            echo "<script>alert('Format file tidak diperbolehkan.'); window.history.back();</script>";
            exit;
        }

        $nama_baru = uniqid('surat_') . '.' . $ext;

        if (move_uploaded_file($tmp_file, $folder_uploads . $nama_baru)) {
            // Hapus file lama (jika ada)
            $result = mysqli_query($koneksi, "SELECT surat_pkl FROM pendaftaran_magang WHERE id = '$id'");
            if ($result && mysqli_num_rows($result) > 0) {
                $old = mysqli_fetch_assoc($result);
                if (!empty($old['surat_pkl']) && file_exists($folder_uploads . $old['surat_pkl'])) {
                    unlink($folder_uploads . $old['surat_pkl']);
                }
            }

            // Update termasuk file baru
            $query = "UPDATE pendaftaran_magang SET 
                        id_mahasiswa = '$id_mahasiswa',
                        tempat_magang = '$tempat_magang',
                        tanggal_mulai = '$tanggal_mulai',
                        tanggal_selesai = '$tanggal_selesai',
                        surat_pkl = '$nama_baru',
                        status = '$status'
                      WHERE id = '$id'";
        } else {
            echo "<script>alert('Upload file gagal.'); window.history.back();</script>";
            exit;
        }
    } else {
        // Update tanpa mengganti file
        $query = "UPDATE pendaftaran_magang SET 
                    id_mahasiswa = '$id_mahasiswa',
                    tempat_magang = '$tempat_magang',
                    tanggal_mulai = '$tanggal_mulai',
                    tanggal_selesai = '$tanggal_selesai',
                    status = '$status'
                  WHERE id = '$id'";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
            alert('Data berhasil diupdate!');
            window.location.href = '../?page=pendaftaran-magang/index';
        </script>";
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: ../?page=pendaftaran-magang/index");
    exit;
}
?>
