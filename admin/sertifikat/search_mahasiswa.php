<?php
include '../../koneksi.php';

$term = isset($_GET['term']) ? $_GET['term'] : '';

$query = mysqli_query($koneksi, "SELECT id_mahasiswa, nama_lengkap FROM mahasiswa WHERE nama_lengkap LIKE '%$term%' ORDER BY nama_lengkap ASC");

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = [
        'id' => $row['id_mahasiswa'],
        'text' => $row['nama_lengkap']
    ];
}

echo json_encode($data);
