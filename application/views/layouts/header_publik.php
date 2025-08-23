<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SPK MARCOS - SMK Negeri Bali Mandara</title>

    <link href="<?= base_url('assets/')?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/')?>css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url('assets/')?>img/BM.png" type="image/x-icon">
</head>
<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <div class="container">
                        <a class="navbar-brand d-flex align-items-center" href="<?= base_url('') ?>">
                            <img src="<?= base_url('assets/img/BM.png') ?>" alt="Logo SMK" style="height: 40px; margin-right: 15px;">
                            <span class="d-none d-md-inline font-weight-bold text-primary">SPK Siswa Berprestasi</span>
                        </a>
                        
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('Laporan') ?>">
                                    <i class="fas fa-print fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Laporan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('Perhitungan/hasil_publik') ?>">
                                <i class="fas fa-chart-bar fa-sm fa-fw mr-2 text-gray-400"></i>
                                Hasil Peringkat
                               </a>
                            </li>
                            
                            <div class="topbar-divider d-none d-sm-block"></div>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('Login') ?>">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600">Login Admin</span>
                                    <img src="<?= base_url('assets/')?>img/user.png" class="img-profile rounded-circle border" style="width: 32px; height: 32px;">
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">