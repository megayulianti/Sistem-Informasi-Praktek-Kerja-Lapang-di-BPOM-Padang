<?php
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_surat = $_POST['id_surat_balasan'];

    if (isset($_FILES['file_surat']) && $_FILES['file_surat']['error'] === UPLOAD_ERR_OK) {
        $file_tmp  = $_FILES['file_surat']['tmp_name'];
        $file_name = $_FILES['file_surat']['name'];
        $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed   = ['pdf', 'doc', 'docx'];

        if (in_array($file_ext, $allowed)) {
            $upload_dir = '../../surat-balasan/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $new_filename = 'surat_' . time() . '.' . $file_ext;
            $upload_path = $upload_dir . $new_filename;

            if (move_uploaded_file($file_tmp, $upload_path)) {
                $update = mysqli_query($koneksi, "UPDATE surat_balasan SET file_surat = '$new_filename' WHERE id_surat_balasan = '$id_surat'");
                
                if ($update) {
                    echo "<script>
                        alert('File berhasil diupload!');
                        window.location.href = '../?page=surat-balasan-pkl/index';
                    </script>";
                    exit;
                } else {
                    echo "<script>
                        alert('Gagal menyimpan data ke database.');
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
                alert('Format file tidak didukung! Gunakan PDF, DOC, atau DOCX.');
                window.history.back();
            </script>";
            exit;
        }
    } else {
        echo "<script>
            alert('File belum dipilih atau terjadi kesalahan upload.');
            window.history.back();
        </script>";
        exit;
    }
} else {
    echo "<script>
        alert('Metode request tidak valid!');
        window.history.back();
    </script>";
    exit;
}
