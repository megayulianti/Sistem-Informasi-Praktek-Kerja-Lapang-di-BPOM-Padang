<?php
include '../../koneksi.php'; // Atur path jika beda lokasi

$term = isset($_GET['term']) ? $_GET['term'] : '';

$data = [];

if (!empty($term)) {
    $query = mysqli_query($koneksi, "SELECT id_mahasiswa, nama_lengkap FROM mahasiswa WHERE nama_lengkap LIKE '%$term%' ORDER BY nama_lengkap ASC");

    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = [
            "id" => $row['id_mahasiswa'],
            "text" => $row['nama_lengkap']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($data);
