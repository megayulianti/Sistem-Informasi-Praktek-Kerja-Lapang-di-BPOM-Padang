<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Tampilan Fitur</h6>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
              </div>
            </div>
            <div class="row">
               <div class="col-sm-6 col-md-3">
                  <a href="?page=mahasiswa/index" class="text-decoration-none">
                      <div class="card card-stats card-round">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-icon">
                                      <div class="icon-big text-center icon-primary bubble-shadow-small">
                                          <i class="fas fa-address-book"></i> 
                                      </div>
                                  </div>
                                  <div class="col col-stats ms-3 ms-sm-0">
                                      <div class="numbers">
                                          <p class="card-category">Data Mahasiswa</p>
                                          <h4 class="card-title"><?= $mahasiswa_count ?></h4>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>

               <div class="col-sm-6 col-md-3">
                  <a href="?page=pendaftaran-magang/index" class="text-decoration-none">
                      <div class="card card-stats card-round">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-icon">
                                      <div class="icon-big text-center icon-primary bubble-shadow-small">
                                          <i class="fas fa-clipboard "></i> 
                                      </div>
                                  </div>
                                  <div class="col col-stats ms-3 ms-sm-0">
                                      <div class="numbers">
                                          <p class="card-category">Data Pendaftaran magang </p>
                                           <h4 class="card-title"><?= $pendaftaran_magang_count?></h4>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>

               <div class="col-sm-6 col-md-3">
                  <a href="?page=surat-balasan-pkl/index" class="text-decoration-none">
                      <div class="card card-stats card-round">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-icon">
                                      <div class="icon-big text-center icon-primary bubble-shadow-small">
                                          <i class="fas fa-envelope"></i> 
                                      </div>
                                  </div>
                                  <div class="col col-stats ms-3 ms-sm-0">
                                      <div class="numbers">
                                          <p class="card-category">Data Surat Balasan PKL</p>
                                           <h4 class="card-title"><?= $surat_balasan_pkl_count?></h4>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>

               <div class="col-sm-6 col-md-3">
                  <a href="?page=pemilihan-bagian-tempat/index" class="text-decoration-none">
                      <div class="card card-stats card-round">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-icon">
                                      <div class="icon-big text-center icon-primary bubble-shadow-small">
                                          <i class="fas fa-id-badge"></i> 
                                      </div>
                                  </div>
                                  <div class="col col-stats ms-3 ms-sm-0">
                                      <div class="numbers">
                                          <p class="card-category">Data Pemilihan Bagian Tempat</p>
                                           <h4 class="card-title"><?= $pemilihan_bagian_tempat_count?></h4>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>

                <div class="col-sm-6 col-md-3">
                  <a href="?page=absensi/index" class="text-decoration-none">
                      <div class="card card-stats card-round">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-icon">
                                      <div class="icon-big text-center icon-primary bubble-shadow-small">
                                          <i class="fas fa-user-check"></i> 
                                      </div>
                                  </div>
                                  <div class="col col-stats ms-3 ms-sm-0">
                                      <div class="numbers">
                                          <p class="card-category">Data Absensi</p>
                                           <h4 class="card-title"><?= $absensi_count?></h4>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>




               <div class="col-sm-6 col-md-3">
                  <a href="?page=sertifikat/index" class="text-decoration-none">
                      <div class="card card-stats card-round">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-icon">
                                      <div class="icon-big text-center icon-primary bubble-shadow-small">
                                          <i class="fas fa-copy"></i> 
                                      </div>
                                  </div>
                                  <div class="col col-stats ms-3 ms-sm-0">
                                      <div class="numbers">
                                          <p class="card-category">Data Sertifikat PKL</p>
                                           <h4 class="card-title"><?= $sertifikat_pkl_count?></h4>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>


              <div class="col-sm-6 col-md-3">
                  <a href="?page=laporan-pendaftaran-magang/index" class="text-decoration-none">
                      <div class="card card-stats card-round">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-icon">
                                      <div class="icon-big text-center icon-primary bubble-shadow-small">
                                          <i class="fas fa-file-pdf"></i> 
                                      </div>
                                  </div>
                                  <div class="col col-stats ms-3 ms-sm-0">
                                      <div class="numbers">
                                          <p class="card-category">Data Laporan Pendaftaran Magang</p>
                                           <h4 class="card-title"><?= $laporan_pendaftaran_magang_count?></h4>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>
             
              
             
            


            </div>

          </div>
        </div>

      