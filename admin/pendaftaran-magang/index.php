<!DOCTYPE html>
<html lang="en">
<head>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pendaftaran PKL</title>
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

// Query data mahasiswa untuk dropdown modal tambah
$query_mahasiswa = mysqli_query($koneksi, "SELECT id_mahasiswa AS id, nama_lengkap FROM mahasiswa ORDER BY nama_lengkap ASC");

// Query data pendaftaran magang untuk tabel utama
$query = mysqli_query($koneksi, "SELECT pm.*, m.nama_lengkap 
                                 FROM pendaftaran_magang pm
                                 JOIN mahasiswa m ON pm.id_mahasiswa = m.id_mahasiswa
                                 ORDER BY pm.id DESC");
?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Pendaftaran PKL</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="#"><i class="icon-home"></i></a>
        </li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Data Pendaftaran PKL</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data Pendaftaran PKL</h4>
            <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#modal-tambah">
              <i class="fa fa-plus"></i> Tambah Data
            </button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead class="text-center">
                  <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Tempat Magang</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Surat PKL</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  while ($data = mysqli_fetch_array($query)) {
                  ?>
                    <tr class="text-center">
                      <td><?= $no++ ?></td>
                      <td><?= htmlspecialchars($data['nama_lengkap']) ?></td>
                      <td><?= htmlspecialchars($data['tempat_magang']) ?></td>
                      <td><?= htmlspecialchars($data['tanggal_mulai']) ?></td>
                      <td><?= htmlspecialchars($data['tanggal_selesai']) ?></td>
                      <td>
                        <a href="/si-pkl/uploads/<?= htmlspecialchars($data['surat_pkl']); ?>" target="_blank">Lihat Surat</a>
                      </td>
                      <td><?= htmlspecialchars($data['status']) ?></td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="#" 
                              class="btn btn-success btn-sm me-2 btn-edit" 
                              data-bs-toggle="modal" 
                              data-bs-target="#modal-ubah" 
                              data-id="<?= htmlspecialchars($data['id']) ?>" 
                              data-idmahasiswa="<?= htmlspecialchars($data['id_mahasiswa']) ?>" 
                              data-nama="<?= htmlspecialchars($data['nama_lengkap']) ?>" 
                              data-tempat="<?= htmlspecialchars($data['tempat_magang']) ?>" 
                              data-mulai="<?= htmlspecialchars($data['tanggal_mulai']) ?>" 
                              data-selesai="<?= htmlspecialchars($data['tanggal_selesai']) ?>" 
                              data-status="<?= htmlspecialchars($data['status']) ?>">
                              <i class="fa fa-edit"></i>
                            </a>

                          <a href="pendaftaran-magang/hapus.php?id=<?= $data['id'] ?>" 
                              onclick="return confirm('Yakin ingin menghapus data ini?')" 
                              class="btn btn-danger btn-sm" title="Hapus">
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
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="pendaftaran-magang/proses_tambah.php" method="POST" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Pendaftaran Magang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
       <div class="mb-3">
          <label for="select2-tambah" class="form-label">Nama Mahasiswa</label>
           <select name="id_mahasiswa" id="select2-tambah" class="form-select" style="width: 100%;" required>
                <option></option> <!-- agar placeholder Select2 muncul -->
              </select>

        </div>



        <div class="mb-3">
          <label for="tempat_magang" class="form-label">Tempat Magang</label>
          <input type="text" name="tempat_magang" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
          <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
          <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="surat_pkl" class="form-label">Upload Surat PKL</label>
          <input type="file" name="surat_pkl" class="form-control" accept=\".pdf,.doc,.docx,.jpg,.jpeg,.png\" required>
        </div>

        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select name="status" class="form-select" required>
            <option value="" disabled selected>-- Pilih Status --</option>
            <option value="Pending">Pending</option>
            <option value="Disetujui">Disetujui</option>
            <option value="Ditolak">Ditolak</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>



<!-- Modal Ubah -->
<div class="modal fade" id="modal-ubah" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="pendaftaran-magang/proses_ubah.php" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Pendaftaran PKL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="ubah-id">

       <div class="mb-3">
          <label for="select2-ubah" class="form-label">Nama Mahasiswa</label>
          <select name="id_mahasiswa" id="select2-ubah" class="form-select" style="width: 100%;" required>
            <option></option>
          </select>
        </div>


        <div class="mb-3">
          <label>Tempat Magang</label>
          <input type="text" name="tempat_magang" id="ubah-tempat" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Tanggal Mulai</label>
          <input type="date" name="tanggal_mulai" id="ubah-mulai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Tanggal Selesai</label>
          <input type="date" name="tanggal_selesai" id="ubah-selesai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Upload Surat PKL</label>
          <input type="file" name="surat_pkl" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
        </div>
        <div class="mb-3">
          <label>Status</label>
          <select name="status" id="ubah-status" class="form-select" required>
            <option value="Pending">Pending</option>
            <option value="Disetujui">Disetujui</option>
            <option value="Ditolak">Ditolak</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>



<!-- JS: DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
  // DataTables
  $('#dataTable').DataTable({
    lengthMenu: [[10, 20, 30, 50], [10, 20, 30, 50]],
    pageLength: 10,
    language: {
      search: "Cari:",
      lengthMenu: "Tampilkan _MENU_ data per halaman",
      info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
      infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
      infoFiltered: "(disaring dari _MAX_ total data)",
      zeroRecords: "Data tidak ditemukan",
      paginate: {
        first: "Pertama",
        last: "Terakhir",
        next: "Selanjutnya",
        previous: "Sebelumnya"
      }
    },
    columnDefs: [
      { targets: 0, orderable: false },
      { targets: 7, orderable: false }
    ]
  });
});

</script>

<script>
  $(document).ready(function () {
  $('.btn-edit').on('click', function () {
    // Ambil data dari atribut
    const id = $(this).data('id');
    const idMahasiswa = $(this).data('idmahasiswa');
    const namaMahasiswa = $(this).data('nama');
    const tempat = $(this).data('tempat');
    const mulai = $(this).data('mulai');
    const selesai = $(this).data('selesai');
    const status = $(this).data('status');

    // Set data ke form modal
    $('#ubah-id').val(id);
    $('#ubah-tempat').val(tempat);
    $('#ubah-mulai').val(mulai);
    $('#ubah-selesai').val(selesai);
    $('#ubah-status').val(status);

    // Set Select2 untuk Mahasiswa
    const option = new Option(namaMahasiswa, idMahasiswa, true, true);
    $('#select2-ubah').append(option).trigger('change');
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
  minimumInputLength: 1, // mulai cari setelah 1 karakter diketik
  ajax: {
    url: 'pendaftaran-magang/search_mahasiswa.php',
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

// Modal Ubah
$('#select2-ubah').select2({
  dropdownParent: $('#modal-ubah'),
  width: '100%',
  placeholder: '-- Pilih Mahasiswa --',
  allowClear: true,
  minimumInputLength: 1,
  ajax: {
    url: 'pendaftaran-magang/search_mahasiswa.php',
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
