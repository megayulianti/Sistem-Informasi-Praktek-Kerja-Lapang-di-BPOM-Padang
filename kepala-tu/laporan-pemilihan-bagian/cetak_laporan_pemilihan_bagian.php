<?php
require('../fpdf/fpdf.php'); // Pastikan path FPDF sesuai
include '../koneksi.php';   // Path include koneksi disesuaikan

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query tanpa filter bulan dan tahun
$query = "SELECT pbt.*, m.nama_lengkap FROM pemilihan_bagian_tempat pbt 
          JOIN mahasiswa m ON pbt.id_mahasiswa = m.id_mahasiswa
          ORDER BY pbt.id_bagian DESC";
$result = mysqli_query($koneksi, $query);

// Mulai PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);

// === KOP SURAT ===
// Logo kiri atas, ukuran dan posisi disesuaikan
$pdf->Image('gambar/logo.png', 15, 10, 25);

// Posisi teks kop surat (kanan logo)
$pdf->SetXY(45, 10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,7,'BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI PADANG',0,1);

$pdf->SetFont('Arial','',10);
$pdf->SetX(45);
$pdf->MultiCell(0,5,"Jalan Gajah Mada, Gunung Pangilun, Nanggalo, Gn. Pangilun, Kec. Padang Utara, Kota Padang, Sumatera Barat 25173, Telp. (0751) 7055213");

$pdf->SetX(45);
$pdf->MultiCell(0,5,"Website: www.pom.go.id    Email: bbpom-padang@pom.go.id");
// Garis bawah kop, dibuat lebih tebal dan spasi antar garis pas
$pdf->Ln(3);
$pdf->SetLineWidth(0.9);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->SetLineWidth(0.3);
$pdf->Line(10, $pdf->GetY() + 2, 200, $pdf->GetY() + 2);

$pdf->Ln(10);

// === JUDUL LAPORAN ===
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'LAPORAN PENGUMUMAN', 0, 1, 'C');
$pdf->Ln(3);

// === HEADER TABEL ===
$pdf->SetFont('Arial', 'B', 11);
// Lebar kolom disesuaikan agar proporsional
$pdf->SetFillColor(200, 220, 255); // warna background header tabel
$pdf->Cell(10, 10, 'No', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Nama Mahasiswa', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Nama PKL', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Bidang Bagian', 1, 1, 'C', true);

// === ISI TABEL ===
$pdf->SetFont('Arial', '', 10);
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 10, $no++, 1, 0, 'C');
    $pdf->Cell(60, 10, $row['nama_lengkap'], 1);
    $pdf->Cell(50, 10, $row['nama_pkl'], 1);
    $pdf->Cell(60, 10, $row['bidang_bagian'], 1);
    $pdf->Ln();
}

// === TANDA TANGAN ===
$pdf->Ln(15);
$pdf->SetFont('Arial', '', 11);

// Posisi tanda tangan ke kanan, dengan jarak spasi baris lebih rapat
$pdf->SetX(120);
$pdf->Cell(0, 6, 'Padang, ' . date('d-m-Y'), 0, 1, 'L');
$pdf->SetX(120);
$pdf->Cell(0, 6, 'Kepala Balai Besar', 0, 1, 'L');
$pdf->SetX(120);
$pdf->Cell(0, 6, 'Pengawas Obat dan Makanan', 0, 1, 'L');
$pdf->Ln(20);

$pdf->SetX(120);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 6, 'Dra. Hilda Murni, Apt., M.M.', 0, 1, 'L');

$pdf->Output('I', 'laporan_pemilihan.pdf');
?>
