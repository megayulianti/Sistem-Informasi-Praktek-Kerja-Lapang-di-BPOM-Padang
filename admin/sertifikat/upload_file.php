<?php
include '../../koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id_sertifikat'];

  if (isset($_FILES['file_sertifikat']) && $_FILES['file_sertifikat']['error'] === UPLOAD_ERR_OK) {
    $tmp  = $_FILES['file_sertifikat']['tmp_name'];
    $name = $_FILES['file_sertifikat']['name'];
    $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $allowed = ['pdf', 'doc', 'docx'];

    if (in_array($ext, $allowed)) {
      $dir = '../../sertifikat/';
      if (!is_dir($dir)) mkdir($dir, 0777, true);
      $newName = 'sertifikat_' . time() . '.' . $ext;

      if (move_uploaded_file($tmp, $dir . $newName)) {
        $update = mysqli_query($koneksi, "UPDATE sertifikat_pkl SET file_sertifikat = '$newName' WHERE id_sertifikat = '$id'");
        echo "<script>alert('File berhasil diupload!'); window.location.href='../?page=sertifikat/index';</script>";
      } else {
        echo "<script>alert('Gagal menyimpan file.'); window.history.back();</script>";
      }
    } else {
      echo "<script>alert('Format file tidak didukung.'); window.history.back();</script>";
    }
  } else {
    echo "<script>alert('File belum dipilih.'); window.history.back();</script>";
  }
}
?>
