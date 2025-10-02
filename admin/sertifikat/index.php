<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Sertifikat PKL</title>
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

  // Ambil data mahasiswa
  $query_mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
  ?>

  <div class="container mt-4">
<br> <br>
    <h3 class="mb-3 fw-bold">Data Sertifikat PKL</h3>

    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Sertifikat</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-sertifikat">
          Tambah Sertifikat
        </button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-sertifikat" class="table table-bordered table-striped">
            <thead class="text-center">
              <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Berakhir</th>
                <th>Nama Supervisor</th>
                <th>File Sertifikat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query = mysqli_query($koneksi, "SELECT s.*, m.nama_lengkap FROM sertifikat_pkl s JOIN mahasiswa m ON s.id_mahasiswa = m.id_mahasiswa ORDER BY s.id_sertifikat DESC");
              while ($row = mysqli_fetch_assoc($query)):
              ?>
              <tr class="text-center">
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($row['tanggal_mulai']) ?></td>
                <td><?= htmlspecialchars($row['tanggal_berakhir']) ?></td>
                <td><?= htmlspecialchars($row['nama_supervisor']) ?></td>
                <td>
                  <a href="/si-pkl/sertifikat/<?= htmlspecialchars($row['file_sertifikat']) ?>" target="_blank">Lihat</a>
                </td>
                <td>
                  <a href="sertifikat/cetak.php?id=<?= $row['id_sertifikat'] ?>" target="_blank" class="btn btn-info btn-sm">
                    <i class="fa fa-print"></i>
                  </a>
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-upload" onclick="setUploadId(<?= $row['id_sertifikat'] ?>)">
                    <i class="fa fa-upload"></i>
                  </button>
                  <a onclick="return confirm('Hapus data ini?')" href="sertifikat/hapus.php?id=<?= $row['id_sertifikat'] ?>" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<!-- Modal Tambah Sertifikat -->
<div class="modal fade" id="modal-sertifikat" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="sertifikat/proses_tambah.php" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Sertifikat PKL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama Mahasiswa</label>
            <select name="id_mahasiswa" id="select2-tambah" class="form-select" style="width: 100%;" required>
                <option></option>
              </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required />
          </div>

          <div class="col-md-3">
            <label class="form-label">Tanggal Berakhir</label>
            <input type="date" name="tanggal_berakhir" class="form-control" required />
          </div>

          <div class="col-md-6">
            <label class="form-label">Nama Supervisor</label>
            <input type="text" name="nama_supervisor" class="form-control" required />
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>


  <!-- Modal Upload File -->
  <div class="modal fade" id="modal-upload" tabindex="-1">
    <div class="modal-dialog">
      <form action="sertifikat/upload_file.php" method="POST" enctype="multipart/form-data" class="modal-content">
        <input type="hidden" name="id_sertifikat" id="upload-id-sertifikat" />
        <div class="modal-header">
          <h5 class="modal-title">Upload File Sertifikat</h5>
          <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
        </div>
        <div class="modal-body">
          <label class="form-label">File (PDF/DOC/DOCX)</label>
          <input type="file" name="file_sertifikat" class="form-control" accept=".pdf,.doc,.docx" required />
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Upload</button>
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>

<script>
$(document).ready(function () {
  // Inisialisasi DataTable
  $('#table-sertifikat').DataTable({
    "order": [],
    "columnDefs": [{ "orderable": false, "targets": 6 }],
    "language": {
      "search": "Cari:",
      "lengthMenu": "Tampilkan _MENU_ data per halaman",
      "zeroRecords": "Data tidak ditemukan",
      "info": "Menampilkan _PAGE_ dari _PAGES_",
      "infoEmpty": "Tidak ada data tersedia",
      "infoFiltered": "(disaring dari _MAX_ data)",
      "paginate": {
        "previous": "Sebelumnya",
        "next": "Berikutnya"
      }
    }
  });

  // Inisialisasi Select2
  $('#select2-tambah').select2({
    dropdownParent: $('#modal-sertifikat'),
    width: '100%',
    placeholder: '-- Pilih Mahasiswa --',
    allowClear: true,
    minimumInputLength: 1,
    ajax: {
      url: 'sertifikat/search_mahasiswa.php',
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
});

// Set ID saat klik upload
function setUploadId(id) {
  document.getElementById('upload-id-sertifikat').value = id;
}
</script>


<script>
  // Modal Tambah
$('#select2-tambah').select2({
  dropdownParent: $('#modal-sertifikat'),
  width: '100%',
  placeholder: '-- Pilih Mahasiswa --',
  allowClear: true,
  minimumInputLength: 1,
  ajax: {
    url: 'sertifikat/search_mahasiswa.php',
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
