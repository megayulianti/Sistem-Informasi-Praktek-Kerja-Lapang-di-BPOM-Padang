<?php
include '../koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT s.*, m.nama_lengkap FROM sertifikat_pkl s
                                JOIN mahasiswa m ON s.id_mahasiswa = m.id_mahasiswa
                                WHERE s.id_sertifikat = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sertifikat Penghargaan</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #eef3f9;
      font-family: 'Georgia', serif;
    }

    .certificate {
      width: 900px;
      height: 640px;
      margin: 50px auto;
      background: #fff;
      border: 3px solid #b0c4de;
      padding: 40px 30px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 0 25px rgba(0,0,0,0.1);
      box-sizing: border-box;
    }

    .decor-top-left,
    .decor-bottom-right {
      position: absolute;
      width: 250px;
      height: 250px;
      background: radial-gradient(circle at top left, #004aad, #007bff);
      border-radius: 50%;
      opacity: 0.8;
      z-index: 0;
    }

    .decor-top-left {
      top: -100px;
      left: -100px;
    }

    .decor-bottom-right {
      bottom: -100px;
      right: -100px;
    }

    .logo {
      position: absolute;
      top: 40px;
      right: 40px;
      width: 100px;
      z-index: 1;
    }

    .content {
      position: relative;
      z-index: 2;
      text-align: center;
    }

    .main-title {
      font-size: 32px;
      letter-spacing: 4px;
      margin-bottom: 0;
      font-weight: bold;
      color: #000;
    }

    .sub-title {
      font-size: 28px;
      letter-spacing: 2px;
      display: block;
    }

    .desc-top {
      margin-top: 15px;
      font-style: italic;
      color: #333;
      letter-spacing: 1px;
    }

    .recipient {
      font-size: 26px;
      font-weight: bold;
      margin: 15px 0;
      color: #111;
      text-transform: capitalize;
    }

    .description {
      font-size: 15px;
      color: #333;
      line-height: 1.8;
      margin-top: 10px;
    }

    .signatures {
      display: flex;
      justify-content: space-between;
      margin-top: 50px;
      padding: 0 50px;
    }

    .sign-box {
      text-align: center;
      width: 45%;
    }

    .signature-img {
      width: 100px;
      margin-bottom: 10px;
    }

    .underline {
      width: 300px;
      height: 2px;
      background-color: #000;
      margin: 10px auto 25px auto;
    }

    .background-logo {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 400px;
      opacity: 0.05;
      z-index: 0;
    }

    @media print {
      @page {
        size: A4 landscape;
        margin: 15mm;
      }

      body {
        margin: 0;
        padding: 0;
        background: none;
      }

      .certificate {
        width: 267mm;
        height: 180mm;
        padding: 20mm;
        border: 3px solid #b0c4de;
        box-shadow: none;
        box-sizing: border-box;
        page-break-after: always;
        overflow: visible;
      }

      .logo {
        width: 80px;
        top: 20px;
        right: 20px;
      }

      .main-title {
        font-size: 28pt;
      }

      .sub-title {
        font-size: 22pt;
      }

      .desc-top {
        font-size: 14pt;
      }

      .recipient {
        font-size: 24pt;
      }

      .description {
        font-size: 12pt;
        line-height: 1.6;
      }

      .signatures {
        padding: 0 30px;
      }

      .signature-img {
        width: 80px;
      }

      .background-logo {
        width: 350px;
        opacity: 0.05;
      }
    }
  </style>
</head>
<body onload="window.print()">
  <div class="certificate">
    <div class="decor-top-left"></div>
    <div class="decor-bottom-right"></div>
    <img src="gambar/logo.png" alt="Watermark Logo" class="background-logo" />
    <img src="gambar/logo.png" alt="Logo BPOM" class="logo" />

    <div class="content">
      <h1 class="main-title">
        SERTIFIKAT<br /><span class="sub-title">PENGHARGAAN</span>
      </h1>
      <p class="desc-top">PENGHARGAAN DIBERIKAN KEPADA</p>
      <br /><br />
      <h2 class="recipient"><?= htmlspecialchars($data['nama_lengkap']) ?></h2>
      <div class="underline"></div>

      <p class="description">
        Atas partisipasi sebagai mahasiswa magang keahlian dari Universitas Metamedia<br />
        periode Juni – Juli 2025 di Balai Besar Pengawas Obat dan Makanan<br />
        Jalan Gajah Mada, Gunung Pangilun, Nanggalo, Padang Utara, Kota Padang<br />
        yang dilaksanakan pada tanggal 19 Juni sampai 22 Juli 2025
      </p>

      <div class="signatures">
        <div class="sign-box">
          <img src="gambar/ttd2.png" alt="Signature 1" class="signature-img" />
          <p><strong>Rufus Stewart</strong><br />SUPERVISOR</p>
        </div>
        <div class="sign-box">
          <img src="gambar/ttd1.png" alt="Signature 2" class="signature-img" />
          <p><strong>Dra. Hilda Murni, Apt., M.M.</strong><br />KEPALA BALAI BESAR POM DI PADANG</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
