<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Mahasiswa</title>
 <!-- jQuery (harus pertama sebelum Select2 dan Bootstrap JS) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Select2 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Bootstrap CSS & Bundle JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php
include 'koneksi.php';
session_start();

// Query data mahasiswa for dropdown
$query_mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
?>

<!-- Notifikasi -->
<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
        . htmlspecialchars($_SESSION['success']) .
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
        . htmlspecialchars($_SESSION['error']) .
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    unset($_SESSION['error']);
}
?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Surat Balasan PKl</h3>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data Surat Balasan</h4>
            <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#modal-tambah">
              Tambah Data
            </button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTable" class="display table table-bordered table-striped table-hover" style="width:100%">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Kepala Kampus</th>
                    <th>Tujuan Kampus</th>
                    <th>Tgl Masuk Surat</th>
                    <th>Tgl Mulai</th>
                    <th>Tgl Berakhir</th>
                    <th>Status</th>
                    <th>Surat PKL</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $query = mysqli_query($koneksi, "SELECT sm.*, m.nama_lengkap 
                          FROM surat_balasan sm
                          JOIN mahasiswa m ON sm.id_mahasiswa = m.id_mahasiswa
                          ORDER BY sm.id_surat_balasan DESC");
                  while ($data = mysqli_fetch_array($query)) {
                  ?>
                    <tr class="text-center">
                      <td><?= $no++ ?></td>
                      <td><?= htmlspecialchars($data['nomor_surat']) ?></td>
                      <td><?= htmlspecialchars($data['kepala_kampus']) ?></td>
                      <td><?= htmlspecialchars($data['tujuan_kampus']) ?></td>
                      <td><?= htmlspecialchars($data['tanggal_masuk_surat']) ?></td>
                      <td><?= htmlspecialchars($data['tanggal_mulai']) ?></td>
                      <td><?= htmlspecialchars($data['tanggal_berakhir']) ?></td>
                      <td><?= htmlspecialchars($data['status']) ?></td>
                       <td>
                        <a href="/si-pkl/surat-balasan/<?= htmlspecialchars($data['file_surat']); ?>" target="_blank">Lihat Surat</a>
                      </td>
                    <td>
                      <div class="d-flex justify-content-center gap-2">
                        <a href="surat-balasan-pkl/cetak.php?id=<?= $data['id_surat_balasan'] ?>" class="btn btn-info btn-sm" target="_blank" title="Cetak">
                          <i class="fa fa-print"></i>
                        </a>
                        <button type="button" class="btn btn-warning btn-sm btn-upload-surat"
                                data-id="<?= $data['id_surat_balasan'] ?>" data-bs-toggle="modal" data-bs-target="#modal-upload" title="Upload Surat">
                          <i class="fa fa-upload"></i>
                        </button>
                        <a href="surat-balasan-pkl/hapus.php?id=<?= $data['id_surat_balasan'] ?>" onclick="return confirm('Yakin ingin dihapus?')" class="btn btn-danger btn-sm" title="Hapus">
                          <i class="fa fa-trash"></i>
                        </a>
                      </div>
                    </td>

                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="surat-balasan-pkl/proses_tambah.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Surat Balasan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="id_mahasiswa" class="form-label">Nama Mahasiswa</label>
             <select name="id_mahasiswa" id="select2-tambah" class="form-select" style="width: 100%;" required>
                <option></option>
              </select>

            </div>

            <div class="col-md-4 mb-3">
              <label>Nomor Surat</label>
              <input type="text" class="form-control" name="nomor_surat" required />
            </div>
            <div class="col-md-4 mb-3">
              <label>Lampiran</label>
              <input type="text" class="form-control" name="lampiran" required />
            </div>
            <div class="col-md-4 mb-3">
              <label>Perihal</label>
              <input type="text" class="form-control" name="perihal" required />
            </div>
            <div class="col-md-6 mb-3">
              <label>Kepala Kampus</label>
              <input type="text" class="form-control" name="kepala_kampus" required />
            </div>
            <div class="col-md-6 mb-3">
              <label>Tujuan Kampus</label>
              <input type="text" class="form-control" name="tujuan_kampus" required />
            </div>
            <div class="col-md-4 mb-3">
              <label>Tanggal Masuk Surat</label>
              <input type="date" class="form-control" name="tanggal_masuk_surat" required />
            </div>
            <div class="col-md-4 mb-3">
              <label>Tanggal Mulai</label>
              <input type="date" class="form-control" name="tanggal_mulai" required />
            </div>
            <div class="col-md-4 mb-3">
              <label>Tanggal Berakhir</label>
              <input type="date" class="form-control" name="tanggal_berakhir" required />
            </div>
          </div>

          <hr />
          <h6>Mahasiswa 1</h6>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama_1" required />
            </div>
            <div class="col-md-4 mb-3">
              <label>NIM</label>
              <input type="text" class="form-control" name="nim_1" required />
            </div>
            <div class="col-md-4 mb-3">
              <label>Jurusan</label>
              <input type="text" class="form-control" name="jurusan_1" required />
            </div>
          </div>

          <?php for ($i = 2; $i <= 5; $i++) { ?>
            <h6>Mahasiswa <?= $i ?></h6>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama_<?= $i ?>" />
              </div>
              <div class="col-md-4 mb-3">
                <label>NIM</label>
                <input type="text" class="form-control" name="nim_<?= $i ?>" />
              </div>
              <div class="col-md-4 mb-3">
                <label>Jurusan</label>
                <input type="text" class="form-control" name="jurusan_<?= $i ?>" />
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </form>
  </div>
</div>



<!-- Modal Upload Surat -->
<div class="modal fade" id="modal-upload" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="surat-balasan-pkl/upload_surat.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_surat_balasan" id="upload-id-surat">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload File Surat Balasan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="file_surat" class="form-label">File Surat (PDF/DOC/DOCX)</label>
            <input type="file" name="file_surat" class="form-control" accept=".pdf,.doc,.docx" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  // Modal Tambah
$('#select2-tambah').select2({
  dropdownParent: $('#modal-tambah'),
  width: '100%',
  placeholder: '-- Pilih Mahasiswa --',
  allowClear: true,
  minimumInputLength: 1,
  ajax: {
    url: 'surat-balasan-pkl/search_mahasiswa.php',
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return { term: params.term };
    },
    processResults: function (data) {
      return { results: data };
    },
    cache: true
  }
});

  // Initialize DataTable
  $(document).ready(function() {
    $('#dataTable').DataTable({
      "lengthMenu": [10, 20, 30, 40, 50, 100],
      "language": {
        "search": "Cari:",
        "lengthMenu": "Tampilkan _MENU_ data per halaman",
        "zeroRecords": "Data tidak ditemukan",
        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
        "infoEmpty": "Tidak ada data tersedia",
        "infoFiltered": "(disaring dari _MAX_ total data)",
        "paginate": {
          "first": "Pertama",
          "last": "Terakhir",
          "next": "Berikutnya",
          "previous": "Sebelumnya"
        }
      }
    });
     // Tombol upload surat - isi id ke input hidden
    $('.btn-upload-surat').on('click', function () {
      var id = $(this).data('id');
      $('#upload-id-surat').val(id);
    });
  });
</script>

<script>
  // Modal Tambah
$('#select2-tambah').select2({
  dropdownParent: $('#modal-tambah'),
  width: '100%',
  placeholder: '-- Pilih Mahasiswa --',
  allowClear: true,
  minimumInputLength: 1,
  ajax: {
    url: 'surat-balasan-pkl/search_mahasiswa.php',
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return { term: params.term };
    },
    processResults: function (data) {
      return { results: data };
    },
    cache: true
  }
});


</script>
</body>
</html>
