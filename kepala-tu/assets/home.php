        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>

    <div class="row mb-3">
        <!-- Data Kategori Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Data Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kategori_count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-th fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data Berita Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Data Berita</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $berita_count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data Tim Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Data Tim</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $tim_count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data Kontak Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Data Kontak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kontak_count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-phone fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


      </div>

      </div>
      <!---Container Fluid-->
      


</body>

</html>