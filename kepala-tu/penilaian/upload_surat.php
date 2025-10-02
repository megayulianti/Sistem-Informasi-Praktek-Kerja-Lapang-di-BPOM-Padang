<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if (isset($_FILES['file_surat']) && $_FILES['file_surat']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['file_surat']['tmp_name'];
        $nama_file = $_FILES['file_surat']['name'];
        $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $allowed = ['pdf'];

        if (in_array($ext, $allowed)) {
            $folder = '../../surat-nilai/';
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $nama_baru = 'surat_nilai_' . time() . '.' . $ext;
            $path = $folder . $nama_baru;

            if (move_uploaded_file($tmp, $path)) {
                $update = mysqli_query($koneksi, "UPDATE penilaian SET file_surat_nilai = '$nama_baru' WHERE id = '$id'");

                if ($update) {
                    echo "<script>
                        alert('File berhasil diupload!');
                        window.location.href = '../?page=penilaian/index';
                    </script>";
                    exit;
                } else {
                    echo "<script>
                        alert('Gagal menyimpan file ke database.');
                        window.history.back();
                    </script>";
                    exit;
                }
            } else {
                echo "<script>
                    alert('Gagal menyimpan file ke server.');
                    window.history.back();
                </script>";
                exit;
            }
        } else {
            echo "<script>
                alert('Format file tidak didukung! Hanya PDF yang diizinkan.');
                window.history.back();
            </script>";
            exit;
        }
    } else {
        echo "<script>
            alert('File belum dipilih atau terjadi kesalahan saat upload.');
            window.history.back();
        </script>";
        exit;
    }
} else {
    echo "<script>
        alert('Metode request tidak valid.');
        window.history.back();
    </script>";
    exit;
}
