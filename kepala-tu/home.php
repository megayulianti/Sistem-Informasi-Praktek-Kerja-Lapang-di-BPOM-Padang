<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">
                  <a href="index.php" class="text-dark text-decoration-none">Dashboard</a>
                </h3>

               
              </div>

            </div>
            <div class="row">
           <div class="col-sm-6 col-md-3">
              <a href="?page=surat-balasan-pkl/index" class="text-decoration-none text-dark">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-icon">
                                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                      <i class="fas fa-solid fa-file"></i>
                                  </div>
                              </div>
                              <div class="col col-stats ms-3 ms-sm-0">
                                  <div class="numbers">
                                      <p class="card-category">Data Surat Balasan</p>
                                      <h4 class="card-title"><?= $surat_balasan_count ?> </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>

          <div class="col-sm-6 col-md-3">
              <a href="?page=Laporan-mahasiswa/index" class="text-decoration-none text-dark">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-icon">
                                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="fas fa-solid fa-envelope"></i>
                                  </div>
                              </div>
                              <div class="col col-stats ms-3 ms-sm-0">
                                  <div class="numbers">
                                      <p class="card-category">Laporan Data Mahasiswa</p>
                                      <h4 class="card-title"><?= $mahasiswa_count ?> </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>

           <div class="col-sm-6 col-md-3">
              <a href="?page=laporan-absensi/index" class="text-decoration-none text-dark">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-icon">
                                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                  <i class="fas fa-solid fa-book"></i>   
                                  </div>
                              </div>
                              <div class="col col-stats ms-3 ms-sm-0">
                                  <div class="numbers">
                                      <p class="card-category">Laporan Data Absensi</p>
                                      <h4 class="card-title"><?= $absensi_count ?> </h4>
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
                                          <i class="fas fa-user-check"></i> 
                                      </div>
                                  </div>
                                  <div class="col col-stats ms-3 ms-sm-0">
                                      <div class="numbers">
                                          <p class="card-category">Laporan Data Pendaftaran Magang</p>
                                          <h4 class="card-title"><?= $pendaftaran_magang_count ?></h4>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>


          <div class="col-sm-6 col-md-3">
              <a href="?page=laporan-surat-balasan/index" class="text-decoration-none text-dark">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-icon">
                                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                      <i class="fas fa-envelope"></i>
                                  </div>
                              </div>
                              <div class="col col-stats ms-3 ms-sm-0">
                                  <div class="numbers">
                                      <p class="card-category">Laporan Data Surat Balasan PKL</p>
                                      <h4 class="card-title"><?= $surat_balasan_count ?> </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>


          <div class="col-sm-6 col-md-3">
              <a href="?page=laporan-pemilihan-bagian/index" class="text-decoration-none text-dark">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-icon">
                                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                      <i class="fas fa-id-badge"></i>
                                  </div>
                              </div>
                              <div class="col col-stats ms-3 ms-sm-0">
                                  <div class="numbers">
                                      <p class="card-category">Laporan Data Pemilihan Bagian Tempat</p>
                                      <h4 class="card-title"><?= $pemilihan_bagian_tempat_count ?> </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>


          <div class="col-sm-6 col-md-3">
              <a href="?page=laporan-penilaian/index" class="text-decoration-none text-dark">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-icon">
                                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                      <i class="fas fa-chart-bar"></i>
                                  </div>
                              </div>
                              <div class="col col-stats ms-3 ms-sm-0">
                                  <div class="numbers">
                                      <p class="card-category">Laporan Data Blanko Penilaian</p>
                                      <h4 class="card-title"><?= $penilaian_count ?> </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>

          <div class="col-sm-6 col-md-3">
              <a href="?page=laporan-sertifikat/index" class="text-decoration-none text-dark">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-icon">
                                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                      <i class="fas fa-bookmark"></i>
                                  </div>
                              </div>
                              <div class="col col-stats ms-3 ms-sm-0">
                                  <div class="numbers">
                                      <p class="card-category">Laporan Data Sertifikat PKL</p>
                                      <h4 class="card-title"><?= $penilaian_count ?> </h4>
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

      