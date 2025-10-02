<?php
session_start();
include '../koneksi.php';

// Cek apakah form dikirim dengan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gmail = $_POST['gmail'];
    $password_baru = $_POST['password_baru'] ?? '';
    $konfirmasi_password = $_POST['konfirmasi_password'] ?? '';

    // VALIDASI PASSWORD (hanya jika user isi password baru)
    if (!empty($password_baru) || !empty($konfirmasi_password)) {
        if ($password_baru !== $konfirmasi_password) {
            echo "<script>
                    alert('Konfirmasi password tidak cocok!');
                    window.history.back();
                  </script>";
            exit;
        }
        $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
    }

    // PROSES UPLOAD FOTO
    $fotoUpdated = false;
    if (isset($_FILES['foto_baru']) && $_FILES['foto_baru']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto_baru']['tmp_name'];
        $fileName = $_FILES['foto_baru']['name'];
        $fileSize = $_FILES['foto_baru']['size'];
        $fileType = $_FILES['foto_baru']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Tentukan ekstensi yang diperbolehkan
        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Buat nama file baru unik, misal: gmail_timestamp.ext
            $newFileName = preg_replace('/[^a-zA-Z0-9_-]/', '', $gmail) . '_' . time() . '.' . $fileExtension;

            // Path folder upload (sesuaikan dengan struktur foldermu)
            $uploadFileDir = __DIR__ . '/../../admin/mahasiswa/foto/';
            $dest_path = $uploadFileDir . $newFileName;

            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $fotoUpdated = true;
            } else {
                echo "<script>
                        alert('Terjadi kesalahan saat mengupload foto.');
                        window.history.back();
                      </script>";
                exit;
            }
        } else {
            echo "<script>
                    alert('Format file foto tidak diperbolehkan. Gunakan jpg, jpeg, png, atau gif.');
                    window.history.back();
                  </script>";
            exit;
        }
    }

    // SIAPKAN QUERY UPDATE
    if ($fotoUpdated && !empty($password_baru)) {
        // Update password dan foto
        $query = "UPDATE mahasiswa SET password = '$password_hash', foto = '$newFileName' WHERE gmail = '$gmail'";
    } elseif ($fotoUpdated) {
        // Hanya update foto
        $query = "UPDATE mahasiswa SET foto = '$newFileName' WHERE gmail = '$gmail'";
    } elseif (!empty($password_baru)) {
        // Hanya update password
        $query = "UPDATE mahasiswa SET password = '$password_hash' WHERE gmail = '$gmail'";
    } else {
        // Tidak ada perubahan password dan foto
        echo "<script>
                alert('Tidak ada perubahan yang dilakukan.');
                window.history.back();
              </script>";
        exit;
    }

    $update = mysqli_query($koneksi, $query);

    if ($update) {
        echo "<script>
                alert('Data berhasil diperbarui!');
                window.location = '../index.php?page=akun/index';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui data!');
                window.history.back();
              </script>";
    }
} else {
    // Jika bukan request POST
    header("Location: ../index.php?page=akun/index");
    exit;
}
