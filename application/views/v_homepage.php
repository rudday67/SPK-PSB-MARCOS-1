<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Publik</h1>
</div>

<div class="card shadow mb-4 border-left-primary">
    <div class="card-body">
        <h4 class="mb-2">Selamat Datang di Sistem Pendukung Keputusan!</h4>
        <p class="mb-0">Selamat datang di Sistem Pendukung Keputusan (SPK) Penentuan Siswa Berprestasi. Silakan lihat hasil peringkat siswa melalui menu di bawah ini. Untuk mengelola data, silakan login sebagai Admin.</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="<?= base_url('Homepage'); ?>" class="card bg-primary text-white shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Menu Utama</div>
                        <div class="h5 mb-0 font-weight-bold">Dashboard</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-home fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <a href="<?= base_url('Perhitungan/hasil_publik'); ?>" class="card bg-success text-white shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Lihat Hasil</div>
                        <div class="h5 mb-0 font-weight-bold">Data Hasil Akhir</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- <div class="col-lg-4 col-md-6 mb-4">
        <a href="<?= base_url('Profile'); ?>" class="card bg-info text-white shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Informasi</div>
                        <div class="h5 mb-0 font-weight-bold">Data Profile</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </a>
    </div> -->
</div>