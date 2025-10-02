<?php
include('../../koneksi.php');
session_start();

// Amankan input ID
$id = intval($_GET['id']); // Mencegah SQL Injection

// Ambil data dari database
$query = mysqli_query($koneksi, "SELECT * FROM surat_balasan WHERE id_surat_balasan = $id");

// Cek apakah data ditemukan
if (!$query || mysqli_num_rows($query) == 0) {
  die("Data tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);

// Fungsi format tanggal Indonesia
function formatTanggalIndonesia($tanggal) {
  $bulan = [
    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
    '04' => 'April', '05' => 'Mei', '06' => 'Juni',
    '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
    '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
  ];

  $parts = explode('-', $tanggal);
  return $parts[2] . ' ' . $bulan[$parts[1]] . ' ' . $parts[0];
}

// Format tanggal
$tanggal_hari_ini = formatTanggalIndonesia(date('Y-m-d'));
$tanggal_masuk = formatTanggalIndonesia($data['tanggal_masuk_surat']);
$tanggal_mulai = formatTanggalIndonesia($data['tanggal_mulai']);
$tanggal_berakhir = formatTanggalIndonesia($data['tanggal_berakhir']);
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Permohonan Kerja Praktik</title>
  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
      padding: 50px;
      line-height: 1.6;
      position: relative;
    }

    .header {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      border-bottom: 3px solid black;
      padding-bottom: 10px;
    }

    .logo-container {
      flex: 0 0 80px;
      padding-right: 15px;
    }

    .logo {
      width: 70px;
      height: auto;
    }

    .kop {
      flex: 1;
      text-align: center;
    }

    .kop h2 {
      margin: 0;
      font-size: 20px;
      color: green;
    }

    .kop p {
      margin: 0;
      font-size: 14px;
    }

    .tanggal-kanan {
      text-align: right;
      margin-top: -15px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .nomor-surat {
      margin-bottom: 20px;
    }

    .isi-surat {
      text-align: justify;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      margin-bottom: 20px;
    }

    table, th, td {
      border: 1px solid black;
      padding: 8px;
      font-size: 14px;
      text-align: left;
    }

    .ttd {
      width: 100%;
      margin-top: 30px;
      text-align: right;
    }

    .ttd p {
      margin: 2px 0;
    }

    .note-kiri-bawah {
      position: fixed;
      bottom: 30px;
      left: 0px;
      font-size: 12px;
      font-style: italic;
    }

    /* Print styles */
    @media print {
      @page {
        size: A4 portrait;
        margin: 20mm;
      }

      body {
        font-size: 12pt;
        padding: 0;
        margin: 0;
      }

      .header {
        margin-bottom: 5px;
        padding-bottom: 5px;
        border-bottom-width: 2px;
      }

      .tanggal-kanan {
        margin-top: -10px;
        margin-bottom: 10px;
        font-size: 11pt;
      }

      table, th, td {
        font-size: 11pt;
        padding: 6px;
      }

      .ttd {
        margin-top: 20px;
      }

     
    }
  </style>
</head>
<body onload="window.print()">

  <!-- Header berisi logo dan kop -->
  <div class="header">
    <div class="logo-container">
      <img src="gambar/logo.png" alt="Logo" class="logo">
    </div>
    <div class="kop">
      <h2>BALAI BESAR PENGAWAS OBAT DAN MAKANAN DI PADANG</h2>
      <p>Jalan Gajah Mada, Gunung Pangilun, Nanggalo, Gn. Pangilun, Kec. Padang Utara, Kota Padang, Sumatera Barat 25173, Telp. (0751) 7055213</p>
      <p>Website: www.pom.go.id Email: bbpom-padang@pom.go.id</p>
    </div>
  </div>

  <div class="tanggal-kanan">
    <p><strong>Padang,</strong> <?= htmlspecialchars($tanggal_hari_ini) ?></p>
  </div>

  <div class="nomor-surat">
    <p>Nomor: <?= htmlspecialchars($data['nomor_surat']) ?></p>
    <p>Perihal: <?= htmlspecialchars($data['perihal']) ?></p>
  </div>

  <div class="isi-surat">
    <p>Kepada Yth.</p>
    <p><?= htmlspecialchars($data['kepala_kampus']) ?></p>
    <p><?= htmlspecialchars($data['tujuan_kampus']) ?></p>

    <p>Dengan hormat,</p>
    <p>Menindaklanjuti surat saudara Nomor: <?= htmlspecialchars($data['nomor_surat']) ?> tanggal <?= htmlspecialchars($tanggal_masuk) ?> perihal Permohonan Praktik Kerja Lapangan (PKL), bersama ini kami sampaikan sebagai berikut:</p>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>NIM</th>
          <th>Program Studi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td><?= htmlspecialchars($data['nama_1']) ?></td>
          <td><?= htmlspecialchars($data['nim_1']) ?></td>
          <td><?= htmlspecialchars($data['jurusan_1']) ?></td>
        </tr>
        <?php for ($i = 2; $i <= 5; $i++): ?>
          <?php if (!empty($data["nama_$i"]) || !empty($data["nim_$i"]) || !empty($data["jurusan_$i"])): ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= htmlspecialchars($data["nama_$i"]) ?></td>
            <td><?= htmlspecialchars($data["nim_$i"]) ?></td>
            <td><?= htmlspecialchars($data["jurusan_$i"]) ?></td>
          </tr>
          <?php endif; ?>
        <?php endfor; ?>
      </tbody>
    </table>

    <p>Telah diterima untuk melaksanakan Praktik Kerja Lapangan pada tanggal <?= htmlspecialchars($tanggal_mulai) ?> s.d <?= htmlspecialchars($tanggal_berakhir) ?> di Balai Besar Pengawas Obat dan Makanan di Padang. Kami harapkan peserta PKL dapat menaati seluruh peraturan yang berlaku.</p>

    <p>Demikian kami sampaikan, atas perhatian dan kerja samanya diucapkan terima kasih.</p>
  </div>

  <div class="ttd">
    <p>Kepala TU</p>
    <p>Pengawas Obat dan Makanan</p>
    <br><br><br>
    <p><strong>drh. Elita R. Marbun, M.Kes</strong></p>
  </div>

  
</body>
</html>
