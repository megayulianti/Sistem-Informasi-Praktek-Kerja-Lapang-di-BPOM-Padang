<?php
include 'koneksi.php';
session_start();

// Ambil data mahasiswa dari DB
$query_mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Penilaian PKL</title>

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

<?php if (isset($_SESSION['success'])): ?>
  <script>alert("<?= $_SESSION['success'] ?>");</script>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
  <script>alert("<?= $_SESSION['error'] ?>");</script>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="container mt-4">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Form Penilaian PKL</h3>
    </div>

    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Input Penilaian</h4>
        <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#modal-penilaian">
          Tambah Penilaian
        </button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="text-center">
              <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Supervisor</th>
                <th>Total Skor</th>
                <th>Nilai Supervisor</th>
                <th>File Nilai</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query = mysqli_query($koneksi, "SELECT p.*, m.nama_lengkap FROM penilaian p JOIN mahasiswa m ON p.id_mahasiswa = m.id_mahasiswa ORDER BY p.id DESC");
              while ($row = mysqli_fetch_assoc($query)) : ?>
              <tr class="text-center">
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($row['tanggal_pelaksanaan']) ?></td>
                <td><?= htmlspecialchars($row['nama_supervisor']) ?><br><small><?= htmlspecialchars($row['jabatan_supervisor']) ?></small></td>
                <td><?= $row['total_skor'] ?></td>
                <td><?= $row['nilai_supervisor'] ?></td>
                <td>
                  <?php if (!empty($row['file_surat_nilai'])): ?>
                    <a href="/si-pkl/surat-nilai/<?= htmlspecialchars($row['file_surat_nilai']) ?>" target="_blank">Lihat Surat</a>
                  <?php else: ?>
                    <span class="text-muted">Belum diupload</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="penilaian/cetak.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm" target="_blank">
                    <i class="fa fa-print"></i>
                  </a>
                  <button type="button" class="btn btn-warning btn-sm btn-upload-surat" data-id="<?= $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#modal-upload">
                    <i class="fa fa-upload"></i>
                  </button>
                  <a onclick="return confirm('Yakin ingin hapus?')" href="penilaian/hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">
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
</div>

<!-- Modal Tambah Penilaian -->
<div class="modal fade" id="modal-penilaian" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <form action="penilaian/proses_tambah.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Penilaian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Nama Mahasiswa</label>
             <select name="id_mahasiswa" id="select2-tambah" class="form-select" style="width: 100%;" required>
                <option></option>
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <label>Tanggal Pelaksanaan</label>
              <input type="date" name="tanggal_pelaksanaan" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
              <label>Nama Supervisor</label>
              <input type="text" name="nama_supervisor" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Jabatan Supervisor</label>
              <input type="text" name="jabatan_supervisor" class="form-control" required>
            </div>
          </div>

          <h6>Penilaian Aspek</h6>
          <?php
          $aspek = [
            "Kedisiplinan", "Kejujuran", "Kemampuan bersosialisasi", "Komunikasi (lisan & tulisan)",
            "Kemampuan manajerial", "Kerjasama dalam tim", "Aplikasi ilmu komputer", "Ilmu penunjang",
            "Kualitas hasil kerja", "Motivasi mempelajari hal baru"
          ];
          foreach ($aspek as $i => $nama): ?>
            <div class="mb-2">
              <label><?= ($i + 1) . ". $nama" ?></label>
              <select name="nilai[]" class="form-select" required>
                <option value="">-- Pilih Nilai --</option>
                <option value="50">Kurang (&lt;55)</option>
                <option value="60">Cukup (56-65)</option>
                <option value="75">Baik (66-80)</option>
                <option value="90">Baik Sekali (81-100)</option>
              </select>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Upload Surat Nilai -->
<div class="modal fade" id="modal-upload" tabindex="-1">
  <div class="modal-dialog">
    <form action="penilaian/upload_surat.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" id="upload-id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload Surat Nilai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Pilih File (PDF)</label>
            <input type="file" name="file_surat" class="form-control" accept=".pdf" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>



<script>
   // Inisialisasi Select2
  $('#select2-tambah').select2({
    dropdownParent: $('#modal-penilaian'),
    width: '100%',
    placeholder: '-- Pilih Mahasiswa --',
    allowClear: true,
    minimumInputLength: 1,
    ajax: {
      url: 'penilaian/search_mahasiswa.php',
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

  $(document).ready(function () {
    $('.table').DataTable({
      "lengthMenu": [[10, 20, 30, 50, 100], [10, 20, 30, 50, 100]],
      "pagingType": "simple_numbers",
      "language": {
        "search": "Cari:",
        "lengthMenu": "Tampilkan _MENU_ data per halaman",
        "zeroRecords": "Data tidak ditemukan",
        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
        "infoEmpty": "Data kosong",
        "infoFiltered": "(disaring dari _MAX_ total data)",
        "paginate": {
          "previous": "Sebelumnya",
          "next": "Selanjutnya"
        }
      }
    });

    // Set ID ke modal upload
    $('.btn-upload-surat').on('click', function () {
      var id = $(this).data('id');
      $('#upload-id').val(id);
    });
  });
</script>
<script>
  // Modal Tambah
$('#select2-tambah').select2({
  dropdownParent: $('#modal-penilaian'),
  width: '100%',
  placeholder: '-- Pilih Mahasiswa --',
  allowClear: true,
  minimumInputLength: 1,
  ajax: {
    url: 'penilaian/search_mahasiswa.php',
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
