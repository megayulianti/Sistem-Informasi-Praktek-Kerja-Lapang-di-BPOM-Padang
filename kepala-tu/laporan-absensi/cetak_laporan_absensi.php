<?php
require('../fpdf/fpdf.php');
include '../../koneksi.php';

// Validasi parameter POST
if (!isset($_POST['bln']) || !isset($_POST['thn'])) {
    die("Parameter bulan dan tahun harus diisi!");
}

$bulan = $_POST['bln'];
$tahun = $_POST['thn'];

$nama_bulan = [
    1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April",
    5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus",
    9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"
];

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('gambar/logo.png', 10, 10, 25);
        // Kop
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 6, 'BALAI BESAR PENGAWASAN OBAT DAN MAKANAN DI PADANG', 0, 1, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 6, 'BALAI BESAR POM DI PADANG', 0, 1, 'C');
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 6, 'Jalan Gajah Mada, Gunung Pangilun, Nanggalo, Kota Padang, Sumatera Barat 25173 - Telp: (0751) 7055213', 0, 1, 'C');
        $this->Ln(5);
        // Garis
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(8);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Halaman ' . $this->PageNo(),0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,7,'LAPORAN ABSENSI MAHASISWA', 0, 1, 'C');

// Subjudul
$pdf->SetFont('Arial','',11);
if ($bulan != 'all') {
    $judul = "Bulan " . $nama_bulan[(int)$bulan] . " Tahun $tahun";
} else {
    $judul = "Tahun $tahun (Semua Bulan)";
}
$pdf->Cell(0,7, $judul, 0, 1, 'C');
$pdf->Ln(5);

// Table Header
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(10, 8, 'No', 1, 0, 'C', true);
$pdf->Cell(25, 8, 'NIM', 1, 0, 'C', true);
$pdf->Cell(50, 8, 'Nama Lengkap', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Tanggal', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Jam', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Status', 1, 1, 'C', true);

// Data
$pdf->SetFont('Arial','',10);
$no = 1;
$query = "SELECT absensi.*, mahasiswa.nim, mahasiswa.nama_lengkap 
          FROM absensi 
          JOIN mahasiswa ON absensi.id_mahasiswa = mahasiswa.id_mahasiswa";

if ($bulan != 'all') {
    $query .= " WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'";
} else {
    $query .= " WHERE YEAR(tanggal) = '$tahun'";
}

$query .= " ORDER BY tanggal DESC, jam DESC";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(10, 8, $no++, 1, 0, 'C');
        $pdf->Cell(25, 8, $row['nim'], 1, 0);
        $pdf->Cell(50, 8, $row['nama_lengkap'], 1, 0);
        $pdf->Cell(30, 8, $row['tanggal'], 1, 0);
        $pdf->Cell(30, 8, $row['jam'], 1, 0);
        $pdf->Cell(35, 8, $row['status'], 1, 1);
    }
} else {
    $pdf->Cell(180, 8, "Tidak ada data ditemukan.", 1, 1, 'C');
}

// Tambahkan tanda tangan
$pdf->Ln(15);

// Tanggal cetak sekarang
$tanggal_cetak = date('d') . ' ' . $nama_bulan[(int)date('m')] . ' ' . date('Y');

// Tanda tangan
$pdf->SetFont('Arial','',10);
$pdf->Cell(130); // Geser ke kanan
$pdf->Cell(0, 6, "Padang, $tanggal_cetak", 0, 1, 'L');
$pdf->Cell(130);
$pdf->Cell(0, 6, "Mengetahui,", 0, 1, 'L');
$pdf->Ln(20); // Jarak untuk tanda tangan

$pdf->Cell(130);
$pdf->Cell(0, 6, "____________________", 0, 1, 'L'); // Garis tanda tangan
$pdf->Cell(130);
$pdf->Cell(0, 6, "Nama Penandatangan", 0, 1, 'L'); // Ganti dengan nama asli
$pdf->Cell(130);
$pdf->Cell(0, 6, "NIP. 123456789012345678", 0, 1, 'L'); // Ganti dengan NIP asli

// Output PDF
$pdf->Output('I', 'Laporan_Absensi.pdf');
