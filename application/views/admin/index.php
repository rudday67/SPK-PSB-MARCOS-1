<?php $this->load->view('layouts/header_admin'); ?>

<div class="container-fluid">
  <?php if($this->session->userdata('id_user_level') == '1'): ?>
  <!-- Welcome Card -->
  <div class="card shadow mb-4 border-0 bg-gradient-primary text-white">
    <div class="card-body py-4 px-5">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h2 class="mb-3">Selamat Datang, <?= $this->session->username; ?>!</h2>
          <p class="mb-0">Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di sidebar. Sistem ini membantu dalam penentuan siswa berprestasi menggunakan metode MARCOS.</p>
        </div>
        <div class="col-md-4 text-right d-none d-md-block">
          <i class="fas fa-user-shield fa-5x opacity-25"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Menu Cards -->
  <div class="row">
    <!-- Data Kriteria Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 font-weight-bold text-primary mb-1">Data Kriteria</div>
              <div class="text-muted small">Kelola kriteria penilaian</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-cube fa-2x text-gray-300"></i>
            </div>
          </div>
          <div class="mt-3">
            <a href="<?= base_url('Kriteria'); ?>" class="btn btn-sm btn-primary">Kelola <i class="fas fa-arrow-right ml-1"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Data Sub Kriteria Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 font-weight-bold text-success mb-1">Data Sub Kriteria</div>
              <div class="text-muted small">Kelola sub kriteria penilaian</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-cubes fa-2x text-gray-300"></i>
            </div>
          </div>
          <div class="mt-3">
            <a href="<?= base_url('Sub_kriteria'); ?>" class="btn btn-sm btn-success">Kelola <i class="fas fa-arrow-right ml-1"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Data Alternatif Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 font-weight-bold text-info mb-1">Data Alternatif</div>
              <div class="text-muted small">Kelola data siswa</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
          <div class="mt-3">
            <a href="<?= base_url('Alternatif'); ?>" class="btn btn-sm btn-info">Kelola <i class="fas fa-arrow-right ml-1"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Data Penilaian Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 font-weight-bold text-warning mb-1">Data Penilaian</div>
              <div class="text-muted small">Kelola penilaian siswa</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-edit fa-2x text-gray-300"></i>
            </div>
          </div>
          <div class="mt-3">
            <a href="<?= base_url('Penilaian'); ?>" class="btn btn-sm btn-warning">Kelola <i class="fas fa-arrow-right ml-1"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Data Perhitungan Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-secondary shadow h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 font-weight-bold text-secondary mb-1">Data Perhitungan</div>
              <div class="text-muted small">Proses perhitungan MARCOS</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calculator fa-2x text-gray-300"></i>
            </div>
          </div>
          <div class="mt-3">
            <a href="<?= base_url('Perhitungan'); ?>" class="btn btn-sm btn-secondary">Lihat <i class="fas fa-arrow-right ml-1"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Data Hasil Akhir Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 font-weight-bold text-danger mb-1">Data Hasil Akhir</div>
              <div class="text-muted small">Hasil perankingan siswa</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
            </div>
          </div>
          <div class="mt-3">
            <a href="<?= base_url('Perhitungan/hasil'); ?>" class="btn btn-sm btn-danger">Lihat <i class="fas fa-arrow-right ml-1"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if($this->session->userdata('id_user_level') == '2'): ?>
  <!-- Welcome Card for User Level 2 -->
  <div class="card shadow mb-4 border-0 bg-gradient-info text-white">
    <div class="card-body py-4 px-5">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h2 class="mb-3">Selamat Datang, <?= $this->session->username; ?>!</h2>
          <p class="mb-0">Anda bisa mengakses fitur yang tersedia sesuai dengan wewenang Anda.</p>
        </div>
        <div class="col-md-4 text-right d-none d-md-block">
          <i class="fas fa-user fa-5x opacity-25"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Menu Cards for User Level 2 -->
  <div class="row">
    <!-- Dashboard Card -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 font-weight-bold text-primary mb-1">Dashboard</div>
              <div class="text-muted small">Halaman utama sistem</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-home fa-2x text-gray-300"></i>
            </div>
          </div>
          <div class="mt-3">
            <a href="<?= base_url('Login/home'); ?>" class="btn btn-sm btn-primary">Buka <i class="fas fa-arrow-right ml-1"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Data Hasil Akhir Card -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 font-weight-bold text-success mb-1">Data Hasil Akhir</div>
              <div class="text-muted small">Hasil perankingan siswa</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
            </div>
          </div>
          <div class="mt-3">
            <a href="<?= base_url('Perhitungan/hasil'); ?>" class="btn btn-sm btn-success">Lihat <i class="fas fa-arrow-right ml-1"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Data Profile Card -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="h5 font-weight-bold text-info mb-1">Data Profile</div>
              <div class="text-muted small">Kelola profil Anda</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
          <div class="mt-3">
            <a href="<?= base_url('Profile'); ?>" class="btn btn-sm btn-info">Kelola <i class="fas fa-arrow-right ml-1"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>