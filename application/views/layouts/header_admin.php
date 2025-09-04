<?php
if($this->session->status !== ('Logged')) {
    redirect('login');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard | SPK MARCOS</title>
  <link href="<?= base_url('assets/')?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="<?= base_url('assets/')?>css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/css/sb-admin-2.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/')?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?= base_url('assets/')?>img/BM.png" type="image/x-icon">
</head>
<body id="page-top">

  <div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('Login/home'); ?>">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('assets/')?>img/BM.png" alt="Logo" style="height: 40px;">
            </div>
            <div class="sidebar-brand-text mx-3">SPK MARCOS</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item <?php if($page=='Dashboard'){echo 'active';}?>">
            <a class="nav-link" href="<?= base_url('Login/home'); ?>">
                <i class="fas fa-fw fa-home"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Master Data</div>
        <?php if($this->session->userdata('id_user_level') == '1'): ?>
        <li class="nav-item <?php if($page=='Kriteria'){echo 'active';}?>">
            <a class="nav-link" href="<?= base_url('Kriteria'); ?>">
                <i class="fas fa-fw fa-cube"></i>
                <span>Data Kriteria</span></a>
        </li>
        <li class="nav-item <?php if($page=='Prestasi'){echo 'active';}?>">
            <a class="nav-link" href="<?= base_url('Prestasi'); ?>">
                <i class="fas fa-fw fa-trophy"></i>
                <span>Data Prestasi</span></a>
        </li>
        <li class="nav-item <?php if($page=='Alternatif'){echo 'active';}?>">
            <a class="nav-link" href="<?= base_url('Alternatif'); ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Alternatif</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Proses Penilaian</div>
        <li class="nav-item <?php if($page=='Penilaian'){echo 'active';}?>">
            <a class="nav-link" href="<?= base_url('Penilaian/tambah'); ?>">
                <i class="fas fa-fw fa-edit"></i>
                <span>Input Penilaian</span></a>
        </li>
        
        <li class="nav-item <?php if($page=='Hasil'){echo 'active';}?>">
            <a class="nav-link" href="<?= base_url('Perhitungan/hasil'); ?>">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Data Hasil Akhir</span></a>
        </li>
        <?php endif; ?>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Master User</div>
        <?php if($this->session->userdata('id_user_level') == '1'): ?>
        <li class="nav-item <?php if($page=='User'){echo 'active';}?>">
            <a class="nav-link" href="<?= base_url('User'); ?>">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Data User</span></a>
        </li>
        <?php endif; ?>
        <li class="nav-item <?php if($page=='Profile'){echo 'active';}?>">
            <a class="nav-link" href="<?= base_url('Profile'); ?>">
                <i class="fas fa-fw fa-user"></i>
                <span>Data Profile</span></a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                    <h4 class="text-gray-800 font-weight-bold mb-0"><?= $page ?? 'Dashboard'; ?></h4>
                </div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-800 font-weight-bold">
                                <?= $this->session->username; ?>
                            </span>
                            <img src="<?= base_url('assets/')?>img/user.png" class="img-profile rounded-circle border border-primary">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= base_url('Profile'); ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="container-fluid">