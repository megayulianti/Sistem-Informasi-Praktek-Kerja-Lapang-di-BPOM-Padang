<?php
include 'koneksi.php';
session_start();

// Array bulan
$bulan = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April",
    5 => "May", 6 => "June", 7 => "July", 8 => "August",
    9 => "September", 10 => "October", 11 => "November", 12 => "December"
];

// Tangkap filter dari form POST, kalau tidak ada pakai default
$filter_bulan = isset($_POST['bln']) ? $_POST['bln'] : 'all';
$filter_tahun = isset($_POST['thn']) ? $_POST['thn'] : date('Y');

// Buat kondisi WHERE sesuai filter
$where_clause = "";
if ($filter_bulan != 'all') {
    $bulan_padded = str_pad($filter_bulan, 2, '0', STR_PAD_LEFT);
    $where_clause = "WHERE MONTH(sm.tanggal_masuk_surat) = '$bulan_padded' AND YEAR(sm.tanggal_masuk_surat) = '$filter_tahun'";
} else {
    $where_clause = "WHERE YEAR(sm.tanggal_masuk_surat) = '$filter_tahun'";
}

// Ambil data surat dengan filter
$query = mysqli_query($koneksi, "SELECT sm.*, m.nama_lengkap 
    FROM surat_balasan sm
    JOIN mahasiswa m ON sm.id_mahasiswa = m.id_mahasiswa
    $where_clause
    ORDER BY sm.id_surat_balasan DESC");
?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Data Surat Balasan PKL</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <!-- Form Filter Bulan & Tahun -->
    <form action="" method="post" class="mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <label>Bulan</label>
                <select class="form-control" name="bln">
                    <option value="all" <?= ($filter_bulan == 'all') ? 'selected' : '' ?>>ALL</option>
                    <?php
                    foreach ($bulan as $key => $value) {
                        $selected = ($filter_bulan == $key) ? 'selected' : '';
                        echo "<option value=\"$key\" $selected>$value</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label>Tahun</label>
                <select name="thn" class="form-control">
                    <?php
                    $now = date('Y');
                    for ($a = 2020; $a <= $now; $a++) {
                        $selected = ($filter_tahun == $a) ? 'selected' : '';
                        echo "<option value='$a' $selected>$a</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary" name="tampilkan">Tampilkan Data</button>
            </div>
        </div>
    </form>

    <!-- Form Cetak PDF -->
    <form action="laporan-surat-balasan/cetak_laporan_surat-balasan.php" method="get" target="_blank" class="mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <select class="form-control" name="bln">
                    <option value="all" <?= ($filter_bulan == 'all') ? 'selected' : '' ?>>ALL</option>
                    <?php
                    foreach ($bulan as $key => $value) {
                        $selected = ($filter_bulan == $key) ? 'selected' : '';
                        echo "<option value=\"$key\" $selected>$value</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="thn" class="form-control">
                    <?php
                    for ($a = 2020; $a <= $now; $a++) {
                        $selected = ($filter_tahun == $a) ? 'selected' : '';
                        echo "<option value='$a' $selected>$a</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-danger">Cetak PDF</button>
            </div>
        </div>
    </form>
                        <div class="table-responsive mt-3">
                            <table id="suratTable" class="display table table-bordered table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Lampiran</th>
                                        <th>Perihal</th>
                                        <th>Kepala Kampus</th>
                                        <th>Tujuan Kampus</th>
                                        <th>Tgl Masuk Surat</th>
                                        <th>Tgl Mulai</th>
                                        <th>Tgl Berakhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr class="text-center">
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($data['nomor_surat']) ?></td>
                                            <td><?= htmlspecialchars($data['lampiran']) ?></td>
                                            <td><?= htmlspecialchars($data['perihal']) ?></td>
                                            <td><?= htmlspecialchars($data['kepala_kampus']) ?></td>
                                            <td><?= htmlspecialchars($data['tujuan_kampus']) ?></td>
                                            <td><?= htmlspecialchars($data['tanggal_masuk_surat']) ?></td>
                                            <td><?= htmlspecialchars($data['tanggal_mulai']) ?></td>
                                            <td><?= htmlspecialchars($data['tanggal_berakhir']) ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan jQuery dan DataTables (jika belum ada) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#suratTable').DataTable({
            "lengthMenu": [
                [10, 20, 30, 40, 50, 100],
                [10, 20, 30, 40, 50, 100]
            ],
            "order": [], // disable initial order
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Data kosong",
                "infoFiltered": "(filter dari _MAX_ total data)"
            }
        });
    });
</script>
