<?php
require('../fpdf/fpdf.php');
include '../koneksi.php';

// Ambil dan validasi filter bulan dan tahun dari GET (karena form method="get")
$bln = isset($_GET['bln']) && $_GET['bln'] != 'all' && is_numeric($_GET['bln']) && $_GET['bln'] >= 1 && $_GET['bln'] <= 12
    ? str_pad($_GET['bln'], 2, '0', STR_PAD_LEFT)
    : 'all';

$thn = isset($_GET['thn']) && is_numeric($_GET['thn']) && strlen($_GET['thn']) == 4
    ? $_GET['thn']
    : date('Y');

$bulan = [
    '01' => "January", '02' => "February", '03' => "March", '04' => "April",
    '05' => "May", '06' => "June", '07' => "July", '08' => "August",
    '09' => "September", '10' => "October", '11' => "November", '12' => "December"
];

// Query berdasarkan filter
$where_clause = "";
if ($bln != 'all') {
    $where_clause = "WHERE MONTH(sm.tanggal_masuk_surat) = '$bln' AND YEAR(sm.tanggal_masuk_surat) = '$thn'";
} else {
    $where_clause = "WHERE YEAR(sm.tanggal_masuk_surat) = '$thn'";
}

$query = mysqli_query($koneksi, "SELECT sm.*, m.nama_lengkap 
    FROM surat_balasan sm
    JOIN mahasiswa m ON sm.id_mahasiswa = m.id_mahasiswa
    $where_clause
    ORDER BY sm.id_surat_balasan DESC");

// Inisialisasi PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

// === KOP SURAT ===
$pdf->Image('gambar/logo.png', 20, 10, 25);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 7, 'BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI PADANG', 0, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 6, 'Jalan Gajah Mada, Gunung Pangilun, Nanggalo, Gn. Pangilun, Kec. Padang Utara,', 0, 1, 'C');
$pdf->Cell(0, 6, 'Kota Padang, Sumatera Barat 25173, Telp. (0751) 7055213', 0, 1, 'C');
$pdf->Cell(0, 6, 'Website: www.pom.go.id  |  Email: bbpom-padang@pom.go.id', 0, 1, 'C');

$pdf->SetLineWidth(1);
$pdf->Line(10, $pdf->GetY() + 3, 287, $pdf->GetY() + 3);
$pdf->Ln(10);

// === JUDUL LAPORAN ===
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Laporan Surat Balasan PKL', 0, 1, 'C');

$judul_filter = ($bln == 'all') ? "Tahun $thn" : $bulan[$bln] . " $thn";
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, "Filter: $judul_filter", 0, 1, 'C');
$pdf->Ln(5);

// === HEADER TABEL ===
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255);
$pdf->SetDrawColor(50, 50, 100);

$pdf->Cell(10, 9, 'No', 1, 0, 'C', true);
$pdf->Cell(35, 9, 'No. Surat', 1, 0, 'C', true);
$pdf->Cell(20, 9, 'Lampiran', 1, 0, 'C', true);
$pdf->Cell(50, 9, 'Perihal', 1, 0, 'C', true);
$pdf->Cell(35, 9, 'Kepala Kampus', 1, 0, 'C', true);
$pdf->Cell(35, 9, 'Tujuan Kampus', 1, 0, 'C', true);
$pdf->Cell(25, 9, 'Tgl Masuk', 1, 0, 'C', true);
$pdf->Cell(25, 9, 'Tgl Mulai', 1, 0, 'C', true);
$pdf->Cell(25, 9, 'Tgl Berakhir', 1, 1, 'C', true);

// === ISI TABEL ===
$pdf->SetFont('Arial', '', 9);
$no = 1;
while ($data = mysqli_fetch_array($query)) {
    $pdf->Cell(10, 7, $no++, 1, 0, 'C');
    $pdf->Cell(35, 7, substr($data['nomor_surat'], 0, 30), 1, 0, 'L'); 
    $pdf->Cell(20, 7, $data['lampiran'], 1, 0, 'C');
    $pdf->Cell(50, 7, substr($data['perihal'], 0, 50), 1, 0, 'L');
    $pdf->Cell(35, 7, substr($data['kepala_kampus'], 0, 30), 1, 0, 'L');
    $pdf->Cell(35, 7, substr($data['tujuan_kampus'], 0, 30), 1, 0, 'L');
    $pdf->Cell(25, 7, date('d-m-Y', strtotime($data['tanggal_masuk_surat'])), 1, 0, 'C');
    $pdf->Cell(25, 7, date('d-m-Y', strtotime($data['tanggal_mulai'])), 1, 0, 'C');
    $pdf->Cell(25, 7, date('d-m-Y', strtotime($data['tanggal_berakhir'])), 1, 1, 'C');
}

// === TANDA TANGAN ===
$pdf->Ln(15);
$pdf->SetX(190);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 6, 'Padang, ' . date('d-m-Y'), 0, 1, 'L');
$pdf->SetX(190);
$pdf->Cell(0, 6, 'Kepala Balai Besar', 0, 1, 'L');
$pdf->SetX(190);
$pdf->Cell(0, 6, 'Pengawas Obat dan Makanan', 0, 1, 'L');
$pdf->Ln(20);
$pdf->SetX(190);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 6, 'Dra. Hilda Murni, Apt., M.M.', 0, 1, 'L');

// Output PDF
$pdf->Output('I', 'laporan_surat_balasan_' . $bln . '_' . $thn . '.pdf');
?>
