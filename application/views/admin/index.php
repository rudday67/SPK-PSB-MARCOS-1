<?php $this->load->view('layouts/header_admin'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4 border-0 bg-gradient-primary text-white">
        <div class="card-body py-4 px-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-3">Selamat Datang, <?= $this->session->username; ?>!</h2>
                    <p class="mb-0">Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di sidebar. Sistem ini membantu dalam penentuan siswa berprestasi menggunakan metode MARCOS.</p>
                </div>
                <div class="col-md-4 text-right d-none d-md-block">
                    <i class="fas fa-user-shield fa-5x" style="opacity: 0.25;"></i>
                </div>
            </div>
        </div>
    </div>

    <h3 class="h4 my-4 text-gray-800">Akses Cepat</h3>

    <div class="row">
        <?php $user_level = $this->session->userdata('id_user_level'); ?>

        <?php if (in_array($user_level, ['1', '3'])): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="<?= base_url('Kriteria'); ?>" class="menu-card bg-primary-soft">
                    <i class="fas fa-cube fa-3x text-primary mb-3"></i>
                    <h5 class="text-dark fw-bold">Data Kriteria</h5>
                    <p class="small text-muted mb-0">Kelola kriteria penilaian</p>
                </a>
            </div>
        <?php endif; ?>

        <?php if (in_array($user_level, ['1', '4'])): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="<?= base_url('Prestasi'); ?>" class="menu-card bg-success-soft">
                    <i class="fas fa-trophy fa-3x text-success mb-3"></i>
                    <h5 class="text-dark fw-bold">Data Prestasi</h5>
                    <p class="small text-muted mb-0">Kelola Data Prestasi</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="<?= base_url('Alternatif'); ?>" class="menu-card bg-info-soft">
                    <i class="fas fa-users fa-3x text-info mb-3"></i>
                    <h5 class="text-dark fw-bold">Data Alternatif</h5>
                    <p class="small text-muted mb-0">Kelola data siswa</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="<?= base_url('Penilaian'); ?>" class="menu-card bg-warning-soft">
                    <i class="fas fa-edit fa-3x text-warning mb-3"></i>
                    <h5 class="text-dark fw-bold">Input Penilaian</h5>
                    <p class="small text-muted mb-0">Kelola penilaian siswa</p>
                </a>
            </div>
        <?php endif; ?>

        <div class="col-lg-4 col-md-6 mb-4">
            <a href="<?= base_url('Perhitungan/hasil'); ?>" class="menu-card bg-danger-soft">
                <i class="fas fa-chart-bar fa-3x text-danger mb-3"></i>
                <h5 class="text-dark fw-bold">Data Hasil Akhir</h5>
                <p class="small text-muted mb-0">Hasil perankingan siswa</p>
            </a>
        </div>
        
        <?php if ($user_level == '1'): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="<?= base_url('User'); ?>" class="menu-card bg-secondary-soft">
                    <i class="fas fa-users-cog fa-3x text-secondary mb-3"></i>
                    <h5 class="text-dark fw-bold">Data User</h5>
                    <p class="small text-muted mb-0">Kelola data user</p>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>



<?php $this->load->view('layouts/footer_admin'); ?>