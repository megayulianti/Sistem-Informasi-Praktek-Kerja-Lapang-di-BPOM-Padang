<?php
include('../../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $nomor_surat = $_POST['nomor_surat'];
    $lampiran = $_POST['lampiran'];
    $perihal = $_POST['perihal'];
    $kepala_kampus = $_POST['kepala_kampus'];
    $tujuan_kampus = $_POST['tujuan_kampus'];
    $tanggal_masuk_surat = $_POST['tanggal_masuk_surat'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_berakhir = $_POST['tanggal_berakhir'];

    // Mahasiswa
    $nama_1 = $_POST['nama_1'];
    $nim_1 = $_POST['nim_1'];
    $jurusan_1 = $_POST['jurusan_1'];

    // Optional mahasiswa lainnya
    $nama_2 = $_POST['nama_2'] ?? '';
    $nim_2 = $_POST['nim_2'] ?? '';
    $jurusan_2 = $_POST['jurusan_2'] ?? '';
    $nama_3 = $_POST['nama_3'] ?? '';
    $nim_3 = $_POST['nim_3'] ?? '';
    $jurusan_3 = $_POST['jurusan_3'] ?? '';
    $nama_4 = $_POST['nama_4'] ?? '';
    $nim_4 = $_POST['nim_4'] ?? '';
    $jurusan_4 = $_POST['jurusan_4'] ?? '';
    $nama_5 = $_POST['nama_5'] ?? '';
    $nim_5 = $_POST['nim_5'] ?? '';
    $jurusan_5 = $_POST['jurusan_5'] ?? '';

    // Query simpan
    $query = mysqli_query($koneksi, "INSERT INTO surat_balasan (
        id_mahasiswa, nomor_surat, lampiran, perihal,
        kepala_kampus, tujuan_kampus, tanggal_masuk_surat,
        tanggal_mulai, tanggal_berakhir,
        nama_1, nim_1, jurusan_1,
        nama_2, nim_2, jurusan_2,
        nama_3, nim_3, jurusan_3,
        nama_4, nim_4, jurusan_4,
        nama_5, nim_5, jurusan_5,
        status
    ) VALUES (
        '$id_mahasiswa', '$nomor_surat', '$lampiran', '$perihal',
        '$kepala_kampus', '$tujuan_kampus', '$tanggal_masuk_surat',
        '$tanggal_mulai', '$tanggal_berakhir',
        '$nama_1', '$nim_1', '$jurusan_1',
        '$nama_2', '$nim_2', '$jurusan_2',
        '$nama_3', '$nim_3', '$jurusan_3',
        '$nama_4', '$nim_4', '$jurusan_4',
        '$nama_5', '$nim_5', '$jurusan_5',
        'pending'
    )");

    if ($query) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = '../?page=surat-balasan-pkl/index';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan data ke database!');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('Metode tidak valid.');
            window.location.href = '../?page=surat-balasan-pkl/index';
          </script>";
}
?>
