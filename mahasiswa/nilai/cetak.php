<?php
include '../koneksi.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "SELECT p.*, m.nama_lengkap, m.nim FROM penilaian p JOIN mahasiswa m ON p.id_mahasiswa = m.id_mahasiswa WHERE p.id = $id");

if (mysqli_num_rows($query) === 0) {
    die("Data tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cetak Penilaian</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
    }
    h2, h3, p {
      margin: 5px 0;
    }
    .kop-surat {
      display: flex;
      align-items: center;
      border-bottom: 2px solid #000;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }
    .kop-surat img {
      width: 70px;
      height: auto;
      margin-right: 15px;
    }
    .kop-surat .text {
      flex: 1;
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #000;
      padding: 6px;
      text-align: center;
    }
    .no-border {
      border: none;
      text-align: left;
    }
   .ttd {
  margin-top: 10px;
}

  </style>
</head>
<body onload="window.print()">

  <div class="kop-surat">
    <img src="gambar/logo.png"  alt="">
    <div class="text" style="text-align: center;">
      <h2 style="font-size: 18px;">BALAI BESAR PENGAWASAN OBAT DAN MAKANAN DI PADANG</h2>
      <h3 style="font-size: 14px;">BALAI BESAR POM DI PADANG</h3>
      <p>Jalan Gajah Mada, Gunung Pangilun, Nanggalo, Gn. Pangilun, Kec. Padang Utara, Kota Padang, Sumatera Barat 25173 - Telp: (0751) 7055213</p>
    </div>
  </div>

<h3 style="text-align: center; font-size: 16px;">
  FORMULIR PENILAIAN SUPERVISOR INSTANSI PRAKTEK KERJA LAPANGAN (PKL)
</h3>

  <table>
    <tr><td class="no-border">Nama Mahasiswa</td><td class="no-border">: <?= htmlspecialchars($data['nama_lengkap']) ?></td></tr>
    <tr><td class="no-border">NIM</td><td class="no-border">: <?= htmlspecialchars($data['nim']) ?></td></tr>
    <tr><td class="no-border">Tanggal Pelaksanaan PKL</td><td class="no-border">: <?= $data['tanggal_pelaksanaan'] ?></td></tr>
    <tr><td class="no-border">Nama Supervisor</td><td class="no-border">: <?= htmlspecialchars($data['nama_supervisor']) ?></td></tr>
    <tr><td class="no-border">Jabatan Supervisor</td><td class="no-border">: <?= htmlspecialchars($data['jabatan_supervisor']) ?></td></tr>
  </table>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Aspek yang Dinilai</th>
        <th>Nilai</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $aspek_lines = explode("\n", trim($data['aspek']));
      foreach ($aspek_lines as $i => $line):
        $parts = explode(":", $line);
      ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars(trim($parts[0])) ?></td>
          <td><?= isset($parts[1]) ? htmlspecialchars(trim($parts[1])) : "" ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="2"><strong>Total Skor</strong></td>
        <td><?= $data['total_skor'] ?></td>
      </tr>
      <tr>
        <td colspan="2"><strong>Nilai Supervisor</strong></td>
        <td><?= $data['nilai_supervisor'] ?></td>
      </tr>
    </tbody>
  </table>

  <div class="ttd">
  <table style="width: 100%; border: none; margin-top: 40px;">
    <tr>
      <td style="border: none; width: 65%;"></td>
      <td style="border: none; text-align: center;">
        <p>Padang, <?= date('d-m-Y', strtotime($data['tanggal'])) ?></p>
        <p><strong>Yang Menilai,</strong></p>
        <br><br><br><br> <!-- Ruang tanda tangan -->
        <p><strong><?= htmlspecialchars($data['nama_supervisor']) ?></strong><br>NIP</p>
      </td>
    </tr>
  </table>
</div>



</body>
</html>
