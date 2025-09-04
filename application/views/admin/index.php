<?php $this->load->view('layouts/header_admin'); ?>

<div class="container-fluid">

	<?php if($this->session->userdata('id_user_level') == '1'): ?>
	
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
		<div class="col-lg-4 col-md-6 mb-4">
			<a href="<?= base_url('Kriteria'); ?>" class="menu-card bg-primary-soft">
				<i class="fas fa-cube fa-3x text-primary mb-3"></i>
				<h5 class="text-dark fw-bold">Data Kriteria</h5>
				<p class="small text-muted mb-0">Kelola kriteria penilaian</p>
			</a>
		</div>

		<div class="col-lg-4 col-md-6 mb-4">
			<a href="<?= base_url('prestasi'); ?>" class="menu-card bg-success-soft">
				<i class="fas fa-cubes fa-3x text-success mb-3"></i>
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
				<h5 class="text-dark fw-bold">Data Penilaian</h5>
				<p class="small text-muted mb-0">Kelola penilaian siswa</p>
			</a>
		</div>

		<div class="col-lg-4 col-md-6 mb-4">
			<a href="<?= base_url('Perhitungan'); ?>" class="menu-card bg-secondary-soft">
				<i class="fas fa-calculator fa-3x text-secondary mb-3"></i>
				<h5 class="text-dark fw-bold">Data Perhitungan</h5>
				<p class="small text-muted mb-0">Proses perhitungan MARCOS</p>
			</a>
		</div>

		<div class="col-lg-4 col-md-6 mb-4">
			<a href="<?= base_url('Perhitungan/hasil'); ?>" class="menu-card bg-danger-soft">
				<i class="fas fa-chart-bar fa-3x text-danger mb-3"></i>
				<h5 class="text-dark fw-bold">Data Hasil Akhir</h5>
				<p class="small text-muted mb-0">Hasil perankingan siswa</p>
			</a>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if($this->session->userdata('id_user_level') == '2'): ?>
	<div class="row">
		<div class="col-lg-4 col-md-6 mb-4">
			<a href="<?= base_url('Login/home'); ?>" class="menu-card bg-primary-soft">
				<i class="fas fa-home fa-3x text-primary mb-3"></i>
				<h5 class="text-dark fw-bold">Dashboard</h5>
				<p class="small text-muted mb-0">Halaman utama sistem</p>
			</a>
		</div>
		<div class="col-lg-4 col-md-6 mb-4">
			<a href="<?= base_url('Perhitungan/hasil'); ?>" class="menu-card bg-success-soft">
				<i class="fas fa-chart-bar fa-3x text-success mb-3"></i>
				<h5 class="text-dark fw-bold">Data Hasil Akhir</h5>
				<p class="small text-muted mb-0">Hasil perankingan siswa</p>
			</a>
		</div>
		<div class="col-lg-4 col-md-6 mb-4">
			<a href="<?= base_url('Profile'); ?>" class="menu-card bg-info-soft">
				<i class="fas fa-user fa-3x text-info mb-3"></i>
				<h5 class="text-dark fw-bold">Data Profile </h5>
				<p class="small text-muted mb-0">Kelola profil Anda</p>
			</a>
		</div>
	</div>
	<?php endif; ?>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>