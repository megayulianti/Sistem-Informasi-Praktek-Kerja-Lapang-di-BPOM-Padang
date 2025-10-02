<?php
include '../../koneksi.php';

$term = isset($_GET['term']) ? $_GET['term'] : '';

$query = mysqli_query($koneksi, "SELECT id_mahasiswa AS id, nama_lengkap AS text FROM mahasiswa 
                                 WHERE nama_lengkap LIKE '%$term%' 
                                 ORDER BY nama_lengkap ASC");

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);
