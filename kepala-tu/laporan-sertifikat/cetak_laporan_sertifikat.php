<?php
require('../koneksi.php');
require('../fpdf/fpdf.php');

$bulan = isset($_POST['bln']) ? $_POST['bln'] : 'all';
$tahun = isset($_POST['thn']) ? $_POST['thn'] : date('Y');

$bulan_indo = [
  '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
  '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
  '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
];

if ($bulan == 'all') {
  $query = mysqli_query($koneksi, "
    SELECT s.*, m.nama_lengkap 
    FROM sertifikat_pkl s 
    JOIN mahasiswa m ON s.id_mahasiswa = m.id_mahasiswa 
    WHERE YEAR(s.tanggal_mulai) = '$tahun'
    ORDER BY s.tanggal_mulai ASC
  ");
  $judul = "Tahun: $tahun";
} else {
  $query = mysqli_query($koneksi, "
    SELECT s.*, m.nama_lengkap 
    FROM sertifikat_pkl s 
    JOIN mahasiswa m ON s.id_mahasiswa = m.id_mahasiswa 
    WHERE MONTH(s.tanggal_mulai) = '$bulan' AND YEAR(s.tanggal_mulai) = '$tahun'
    ORDER BY s.tanggal_mulai ASC
  ");
  $judul = "Bulan: " . $bulan_indo[$bulan] . " $tahun";
}

// Portrait A4
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// KOP
$pdf->Image('gambar/logo.png', 10, 8, 20);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 6, 'BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI PADANG', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 5, 'Jl. Gajah Mada, Gn. Pangilun, Kec. Padang Utara, Padang, Sumatera Barat 25173', 0, 1, 'C');
$pdf->Cell(0, 5, 'Telp: (0751) 7055213 | Website: www.pom.go.id | Email: bbpom-padang@pom.go.id', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetLineWidth(0.5);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->SetLineWidth(0.2);
$pdf->Line(10, $pdf->GetY() + 1, 200, $pdf->GetY() + 1);
$pdf->Ln(6);

// Judul
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, 'LAPORAN SERTIFIKAT PKL', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 6, $judul, 0, 1, 'C');
$pdf->Ln(4);

// Tabel
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(10, 8, 'No', 1, 0, 'C', true);
$pdf->Cell(50, 8, 'Nama Mahasiswa', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Tgl Mulai', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Tgl Berakhir', 1, 0, 'C', true);
$pdf->Cell(65, 8, 'Nama Supervisor', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 9);
$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
  $pdf->Cell(10, 8, $no++, 1, 0, 'C');
  $pdf->Cell(50, 8, $row['nama_lengkap'], 1);
  $pdf->Cell(30, 8, date('d-m-Y', strtotime($row['tanggal_mulai'])), 1);
  $pdf->Cell(30, 8, date('d-m-Y', strtotime($row['tanggal_berakhir'])), 1);
  $pdf->Cell(65, 8, $row['nama_supervisor'], 1, 1);
}

// Tanda Tangan
$pdf->Ln(10);
$pdf->SetX(120);
$pdf->Cell(70, 6, 'Padang, ' . date('d') . ' ' . $bulan_indo[date('m')] . ' ' . date('Y'), 0, 1, 'C');
$pdf->SetX(120);
$pdf->Cell(70, 6, 'Kepala Balai Besar', 0, 1, 'C');
$pdf->SetX(120);
$pdf->Cell(70, 6, 'Pengawas Obat dan Makanan', 0, 1, 'C');
$pdf->Ln(20);
$pdf->SetX(120);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 6, 'Dra. Hilda Murni, Apt., M.M.', 0, 1, 'C');

// Output
$pdf->Output('I', 'Laporan_Sertifikat_' . $bulan . '_' . $tahun . '.pdf');
?>
