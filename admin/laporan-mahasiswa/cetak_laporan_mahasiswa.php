<?php
require('../fpdf/fpdf.php');
include '../koneksi.php';
session_start();

class PDF extends FPDF {
    // Header
    function Header() {
        $this->Image('gambar/logo.png',10,6,30);
        $this->SetFont('Arial','B',12);
        $this->Cell(40);
        $this->Cell(0,5,'BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI PADANG',0,1,'L');

        $this->SetFont('Arial','',10);
        $this->SetX(50);
        $this->MultiCell(0,5,'Jalan Gajah Mada, Gunung Pangilun, Nanggalo, Gn. Pangilun, Kec. Padang Utara, Kota Padang, Sumatera Barat 25173, Telp. (0751) 7055213');
        $this->SetX(50);
        $this->MultiCell(0,5,'Website: www.pom.go.id Email: bbpom-padang@pom.go.id');

        $this->Ln(3);
        $this->SetLineWidth(0.5);
        $this->Line(10,35,200,35);
        $this->Ln(10);
    }

    // Footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'C');
    }
}

// Buat PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Laporan Data Mahasiswa',0,1,'C');
$pdf->Ln(5);

// Header tabel
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,10,'No',1,0,'C');
$pdf->Cell(50,10,'Nama Lengkap',1,0,'C');
$pdf->Cell(60,10,'Gmail',1,0,'C');
$pdf->Cell(30,10,'Jenis Kelamin',1,0,'C');
$pdf->Cell(40,10,'No HP',1,1,'C');

// Data tabel
$pdf->SetFont('Arial','',12);
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
    $pdf->Cell(10,10,$no++,1,0,'C');
    $pdf->Cell(50,10,$row['nama_lengkap'],1,0);
    $pdf->Cell(60,10,$row['gmail'],1,0);
    $pdf->Cell(30,10,$row['jenis_kelamin'],1,0,'C');
    $pdf->Cell(40,10,$row['no_hp'],1,1);
}

// Tambahkan tanda tangan
$pdf->Ln(15);

// Format tanggal otomatis
setlocale(LC_TIME, 'id_ID');
$tanggal = date('d') . ' ' . date('F') . ' ' . date('Y'); // Anda bisa format sesuai kebutuhan

$pdf->SetFont('Arial','',12);
$pdf->Cell(130); // Geser ke kanan
$pdf->Cell(0,7,"Padang, $tanggal",0,1,'L');
$pdf->Cell(100);
$pdf->Cell(0,7,"Kepala Balai Besar Pengawas Obat dan Makanan,",0,1,'L');
$pdf->Ln(20); // Jarak untuk tanda tangan

$pdf->Cell(130);
$pdf->Cell(0,7,"________________________",0,1,'L');
$pdf->Cell(130);
$pdf->Cell(0,7,"Dra. Hilda Murni, Apt., M.M.",0,1,'L'); // Ganti sesuai nama


// Output ke browser
$pdf->Output('I', 'laporan_mahasiswa.pdf');
?>
