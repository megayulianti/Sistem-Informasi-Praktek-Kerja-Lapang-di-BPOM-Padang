<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Pilih Mahasiswa</title>

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

// Ambil data mahasiswa untuk dropdown
$query_mahasiswa = mysqli_query($koneksi, "SELECT id_mahasiswa AS id, nama_lengkap FROM mahasiswa ORDER BY nama_lengkap ASC");

// Ambil data dari pemilihan_bagian_tempat
$query = mysqli_query($koneksi, "SELECT pbt.*, m.nama_lengkap 
                                 FROM pemilihan_bagian_tempat pbt
                                 JOIN mahasiswa m ON pbt.id_mahasiswa = m.id_mahasiswa
                                 ORDER BY pbt.id_bagian DESC");
?>

<!-- Tambahkan ini di head atau sebelum </body> -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Pengumuman</h3>
    </div>

    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Daftar Pengumuman</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah">
          <i class="fa fa-plus"></i> Tambah Data
        </button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTable" class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Nama PKL</th>
                <th>Bidang Bagian</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                  <td><?= htmlspecialchars($row['nama_pkl']) ?></td>
                  <td><?= htmlspecialchars($row['bidang_bagian']) ?></td>
                  <td>
                    <a href="#" 
                        class="btn btn-success btn-sm me-2 btn-edit" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modal-ubah" 
                        data-id="<?= htmlspecialchars($row['id_bagian']) ?>" 
                        data-idmahasiswa="<?= htmlspecialchars($row['id_mahasiswa']) ?>" 
                        data-nama="<?= htmlspecialchars($row['nama_lengkap']) ?>" 
                        data-bidang="<?= htmlspecialchars($row['bidang_bagian']) ?>" >
                        <i class="fa fa-edit"></i>
                      </a>


                    <a href="pemilihan-bagian-tempat/hapus.php?id_bagian=<?= $row['id_bagian'] ?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-sm btn-danger">
                      <i class="fa fa-trash"></i>
                    </a>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah" tabindex="-1">
  <div class="modal-dialog">
    <form action="pemilihan-bagian-tempat/proses_tambah.php" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Pemilihan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Mahasiswa</label>
           <select name="id_mahasiswa" id="select2-tambah" class="form-select" style="width: 100%;" required>
                <option></option>
              </select>
        </div>

        <div class="mb-3">
          <label>Nama PKL</label>
          <input type="text" name="nama_pkl" class="form-control" required>
        </div>

       <div class="mb-3">
          <label>Bidang Bagian</label>
          <select name="bidang_bagian" class="form-control" required>
            <option value="" disabled selected>-- Pilih Bidang Bagian --</option>
            <option value="bidang pengujian">Bidang Pengujian</option>
            <option value="bidang pemeriksaan">Bidang Pemeriksaan</option>
            <option value="bidang penindakan">Bidang Penindakan</option>
            <option value="bidang infonkom">Bidang Infonkom</option>
            <option value="bidang tata usaha">Bidang Tata Usaha</option>
          </select>
        </div>

      </div>

      <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Ubah -->
<div class="modal fade" id="modal-ubah" tabindex="-1">
  <div class="modal-dialog">
    <form action="pemilihan-bagian-tempat/proses_ubah.php" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Data Pemilihan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
       <input type="hidden" name="id_bagian" id="ubah-id">

        <div class="mb-3">
          <label for="ubah-idmahasiswa" class="form-label">Nama Mahasiswa</label>
           <select name="id_mahasiswa" id="select2-ubah" class="form-select" style="width: 100%;" required>
            <option></option>
          </select>
        </div>

        <div class="mb-3">
          <label for="ubah-namapkl" class="form-label">Nama PKL</label>
          <input type="text" name="nama_pkl" id="ubah-namapkl" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="ubah-bidangbagian" class="form-label">Bidang Bagian</label>
          <select name="bidang_bagian" id="ubah-bidangbagian" class="form-select" required>
            <option value="" disabled selected>-- Pilih Bidang Bagian --</option>
            <option value="bidang pengujian">Bidang Pengujian</option>
            <option value="bidang pemeriksaan">Bidang Pemeriksaan</option>
            <option value="bidang penindakan">Bidang Penindakan</option>
            <option value="bidang infonkom">Bidang Infonkom</option>
            <option value="bidang tata usaha">Bidang Tata Usaha</option>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>





<script>
  // Inisialisasi DataTables dengan opsi lengthMenu sesuai permintaan
  $(document).ready(function() {
    $('#dataTable').DataTable({
      "lengthMenu": [ [10, 20, 30, 40, 50, 100], [10, 20, 30, 40, 50, 100] ],
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
      },
      "pagingType": "simple_numbers",
      "order": [], // Supaya default tidak diurutkan otomatis kolom mana pun
      "columnDefs": [
        { "orderable": false, "targets": 4 } // Kolom aksi tidak bisa diurutkan
      ]
    });
  });

</script>
<script>
 $(document).ready(function () {
  $('.btn-edit').on('click', function () {
    // Ambil data dari atribut
    const id = $(this).data('id'); // Perbaikan
    const idMahasiswa = $(this).data('idmahasiswa');
    const namaMahasiswa = $(this).data('nama');
    const bidang = $(this).data('bidang');

    // Set data ke form modal
    $('#ubah-id').val(id);
    $('#ubah-bidangbagian').val(bidang);
    
    // Set Select2 untuk Mahasiswa (pastikan Select2 sudah aktif)
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
    url: 'pemilihan-bagian-tempat/search_mahasiswa.php',
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
    url: 'pemilihan-bagian-tempat/search_mahasiswa.php',
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