<?php
require('../koneksi.php');
require('../fpdf/fpdf.php');

// Ambil filter dari POST (sesuai form filter kamu)
$filter_bulan = isset($_POST['bln']) ? $_POST['bln'] : 'all';
$filter_tahun = isset($_POST['thn']) ? $_POST['thn'] : date('Y');

$where = [];
if ($filter_bulan !== 'all' && $filter_bulan !== '') {
    $where[] = "MONTH(tanggal_pelaksanaan) = " . intval($filter_bulan);
}
if ($filter_tahun !== '') {
    $where[] = "YEAR(tanggal_pelaksanaan) = " . intval($filter_tahun);
}

$where_sql = '';
if (count($where) > 0) {
    $where_sql = "WHERE " . implode(' AND ', $where);
}

$query = "SELECT p.*, m.nama_lengkap 
          FROM penilaian p 
          JOIN mahasiswa m ON p.id_mahasiswa = m.id_mahasiswa
          $where_sql
          ORDER BY p.id DESC";
$result = mysqli_query($koneksi, $query);

// Buat objek FPDF
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

// --- Kop Surat ---
$pdf->Image('gambar/logo.png',10,10,25); // logo

$pdf->SetFont('Arial','B',14);
$pdf->SetXY(40,10);
$pdf->Cell(0,7,'BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI PADANG',0,1,'L');

$pdf->SetFont('Arial','',10);
$pdf->SetX(40);
$pdf->Cell(0, 6, 'Jalan Gajah Mada, Gunung Pangilun, Nanggalo, Kota Padang, Sumatera Barat 25173 - Telp: (0751) 7055213', 0, 1, 'C');
$pdf->SetX(40);
$pdf->Cell(0,6,'Website: www.pom.go.id Email: bbpom-padang@pom.go.id',0,1,'L');

$pdf->Ln(10); // spasi setelah kop surat

$pdf->SetLineWidth(0.5);
$pdf->Line(10,40,200,40);
$pdf->Ln(5);

// Judul Laporan
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Laporan Penilaian PKL',0,1,'C');

// Informasi filter
$pdf->SetFont('Arial','',12);
$nama_bulan = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];

if ($filter_bulan == 'all') {
    $pdf->Cell(0,8, "Bulan: Semua", 0, 1);
} else {
    $pdf->Cell(0,8, "Bulan: ".$nama_bulan[intval($filter_bulan)], 0, 1);
}
$pdf->Cell(0,8, "Tahun: ".$filter_tahun, 0, 1);
$pdf->Ln(5);

// Header tabel
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(200,200,200);
$pdf->Cell(10,8,'No',1,0,'C',true);
$pdf->Cell(50,8,'Nama Mahasiswa',1,0,'C',true);
$pdf->Cell(30,8,'Tanggal',1,0,'C',true);
$pdf->Cell(40,8,'Supervisor',1,0,'C',true);
$pdf->Cell(20,8,'Total Skor',1,0,'C',true);
$pdf->Cell(30,8,'Nilai Supervisor',1,1,'C',true);

$pdf->SetFont('Arial','',10);

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10,8,$no++,1,0,'C');
    $pdf->Cell(50,8,substr($row['nama_lengkap'],0,25),1);
    $pdf->Cell(30,8,$row['tanggal_pelaksanaan'],1,0,'C');

    $supervisor = $row['nama_supervisor'] . "\n" . $row['jabatan_supervisor'];
    $x_before = $pdf->GetX();
    $y_before = $pdf->GetY();
    $pdf->MultiCell(40,4,$supervisor,1);
    $pdf->SetXY($x_before+40, $y_before);

    $pdf->Cell(20,8,$row['total_skor'],1,0,'C');
    $pdf->Cell(30,8,$row['nilai_supervisor'],1,1,'C');
}

// --- Tanda tangan ---
// Ambil posisi akhir dari isi tabel
$currentY = $pdf->GetY();

// Jika terlalu ke bawah, tambahkan halaman baru
if ($currentY > 230) {
    $pdf->AddPage();
    $pdf->SetY(50); // posisi awal tanda tangan
} else {
    $pdf->SetY($currentY + 15); // beri jarak 15mm dari tabel
}

$pdf->SetX(130);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,6, "Kepala Balai Besar", 0, 1, 'L');
$pdf->SetX(130);
$pdf->Cell(0,6, "Pengawas Obat dan Makanan", 0, 1, 'L');
$pdf->Ln(12);
$pdf->SetX(130);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6, "Dra. Hilda Murni, Apt., M.M.", 0, 1, 'L');

$pdf->Output();
