<?php
include '../koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $tanggal_pelaksanaan = $_POST['tanggal_pelaksanaan'];
    $nama_supervisor = mysqli_real_escape_string($koneksi, $_POST['nama_supervisor']);
    $jabatan_supervisor = mysqli_real_escape_string($koneksi, $_POST['jabatan_supervisor']);
    $nilai = $_POST['nilai'];

    if (count($nilai) !== 10) {
        echo "<script>alert('Semua aspek harus dinilai.'); window.history.back();</script>";
        exit;
    }

    $total_skor = array_sum($nilai);
    $nilai_supervisor = $total_skor / count($nilai);

    // Aspek penilaian
    $aspek_list = [
        "Kedisiplinan", "Kejujuran", "Kemampuan bersosialisasi", "Komunikasi (lisan & tulisan)",
        "Kemampuan manajerial", "Kerjasama dalam tim", "Aplikasi ilmu komputer", "Ilmu penunjang",
        "Kualitas hasil kerja", "Motivasi mempelajari hal baru"
    ];
    $aspek_text = "";
    foreach ($nilai as $i => $val) {
        $aspek_text .= $aspek_list[$i] . ": " . $val . "\n";
    }

    // Handle upload file surat (jika ada)
    $nama_file = "";
    if (isset($_FILES['file_surat']) && $_FILES['file_surat']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['file_surat']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['pdf'])) {
            $nama_file = uniqid('surat_') . '.' . $ext;
            $tujuan = '../surat-nilai/' . $nama_file;
            if (!move_uploaded_file($_FILES['file_surat']['tmp_name'], $tujuan)) {
                echo "<script>alert('Gagal mengupload file.'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('File harus berupa PDF.'); window.history.back();</script>";
            exit;
        }
    }

    // Simpan ke database
    $query = "INSERT INTO penilaian 
        (id_mahasiswa, tanggal_pelaksanaan, nama_supervisor, jabatan_supervisor, aspek, total_skor, nilai_supervisor, file_surat_nilai)
        VALUES 
        ('$id_mahasiswa', '$tanggal_pelaksanaan', '$nama_supervisor', '$jabatan_supervisor', '$aspek_text', '$total_skor', '$nilai_supervisor', '$nama_file')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            window.location.href = '../?page=penilaian/index';
        </script>";
        exit;
    } else {
        echo "<script>alert('Gagal menyimpan data ke database: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        exit;
    }

} else {
    header("Location: ../?page=penilaian/index");
    exit;
}
