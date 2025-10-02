<?php
include '../../koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = mysqli_query($koneksi, "DELETE FROM pendaftaran_magang WHERE id = $id");

    if ($query) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href='../../index.php?page=pendaftaran-magang/index';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data!');
                window.location.href='../../index.php?page=pendaftaran-magang/index';
              </script>";
    }
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href='../../index.php?page=pendaftaran-magang/index';
          </script>";
}
?>
