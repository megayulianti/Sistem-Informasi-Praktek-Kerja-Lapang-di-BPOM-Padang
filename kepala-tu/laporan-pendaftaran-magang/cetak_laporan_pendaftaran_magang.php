<?php
require('../fpdf/fpdf.php');
include '../koneksi.php';

// Ambil filter dari form POST
$filter_bulan = isset($_POST['bln']) ? $_POST['bln'] : 'all';
$filter_tahun = isset($_POST['thn']) ? $_POST['thn'] : date('Y');

$where = "1=1";
if ($filter_bulan != 'all' && $filter_bulan != '') {
    $where .= " AND MONTH(pm.tanggal_mulai) = " . intval($filter_bulan);
}
if ($filter_tahun != '') {
    $where .= " AND YEAR(pm.tanggal_mulai) = " . intval($filter_tahun);
}

$query = mysqli_query($koneksi, "SELECT pm.*, m.nama_lengkap 
                                 FROM pendaftaran_magang pm
                                 JOIN mahasiswa m ON pm.id_mahasiswa = m.id_mahasiswa
                                 WHERE $where
                                 ORDER BY pm.id DESC");

// Membuat objek FPDF
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

// --- KOP SURAT ---
// Tambahkan logo
$logo_path = 'gambar/logo.png'; // sesuaikan path gambar logo
if(file_exists($logo_path)){
    $pdf->Image($logo_path,10,10,30); // x=10, y=10, width=30mm (height proporsional)
}

// Posisi teks kop surat (kanan logo)
$pdf->SetXY(45, 10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,7,'BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI PADANG',0,1);

$pdf->SetFont('Arial','',10);
$pdf->SetX(45);
$pdf->MultiCell(0,5,"Jalan Gajah Mada, Gunung Pangilun, Nanggalo, Gn. Pangilun, Kec. Padang Utara, Kota Padang, Sumatera Barat 25173, Telp. (0751) 7055213");

$pdf->SetX(45);
$pdf->MultiCell(0,5,"Website: www.pom.go.id    Email: bbpom-padang@pom.go.id");

// Garis bawah kop surat
$pdf->SetLineWidth(0.5);
$pdf->Line(10, 40, 200, 40); // garis horisontal dari kiri 10 ke kanan 200 pada posisi y=40

$pdf->Ln(12); // beri jarak setelah kop surat

// Judul laporan
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Laporan Data Verifikasi Pendaftaran',0,1,'C');

// Tampilkan filter bulan dan tahun
$bulan_arr = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];

$filter_bulan_nama = ($filter_bulan != 'all') ? $bulan_arr[intval($filter_bulan)] : "Semua Bulan";

$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,"Filter: Bulan $filter_bulan_nama, Tahun $filter_tahun",0,1,'C');

$pdf->Ln(5);

// Header tabel
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'No',1,0,'C');
$pdf->Cell(50,8,'Nama Lengkap',1,0,'C');
$pdf->Cell(50,8,'Tempat Magang',1,0,'C');
$pdf->Cell(25,8,'Tgl Mulai',1,0,'C');
$pdf->Cell(25,8,'Tgl Selesai',1,0,'C');
$pdf->Cell(25,8,'Status',1,1,'C');

// Isi tabel
$pdf->SetFont('Arial','',10);
$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
    $pdf->Cell(10,7,$no++,1,0,'C');
    $pdf->Cell(50,7,$row['nama_lengkap'],1,0);
    $pdf->Cell(50,7,$row['tempat_magang'],1,0);
    $pdf->Cell(25,7,$row['tanggal_mulai'],1,0,'C');
    $pdf->Cell(25,7,$row['tanggal_selesai'],1,0,'C');
    $pdf->Cell(25,7,$row['status'],1,1,'C');
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

$pdf->Output('I', 'laporan_pendaftaran_magang.pdf');
exit;
