<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistem Pendukung Keputusan Penentuan Siswa Berprestasi SMK Negeri Bali Mandara" />
    <meta name="author" content="" />
    <title>Login | SPK MARCOS - SMK Negeri Bali Mandara</title>

    <!-- Custom fonts -->
    <link href="<?= base_url('assets/')?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    
    <!-- Custom styles -->
    <link href="<?= base_url('assets/')?>css/sb-admin-2.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="<?= base_url('assets/')?>img/BM.png" type="image/x-icon">
    
    <style>
        :root {
            --primary-color: #2C5FB7;
            --secondary-color: #F9A826;
            --accent-color: #4FD1C5;
            --dark-color: #2D3748;
            --light-color: #F7FAFC;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--dark-color) !important;
        }
        
        .login-container {
            box-shadow: 0 15px 35px rgba(50,50,93,.1), 0 5px 15px rgba(0,0,0,.07);
            border-radius: 20px;
            overflow: hidden;
            background: white;
        }
        
        .welcome-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #4F81C7 100%);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .welcome-section h1 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }
        
        .welcome-section h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
        }
        
        .login-card {
            padding: 3rem;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .login-icon {
            background: linear-gradient(135deg, var(--primary-color) 0%, #4F81C7 100%);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 20px rgba(47, 95, 183, 0.3);
        }
        
        .login-icon i {
            font-size: 2rem;
            color: white;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px 20px;
            border: 2px solid #EDF2F7;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(47, 95, 183, 0.2);
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, #4F81C7 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(47, 95, 183, 0.2);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(47, 95, 183, 0.3);
        }
        
        .footer-text {
            color: #718096;
            font-size: 0.85rem;
        }
        
        .school-logo {
            height: 40px;
            margin-right: 15px;
        }
        
        @media (max-width: 991.98px) {
            .welcome-section {
                padding: 2rem;
            }
            .login-card {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('') ?>">
            <img src="<?= base_url('assets/img/BM.png') ?>" alt="Logo SMK" class="school-logo">
            <span class="d-none d-md-inline">SPK Penentuan Siswa Berprestasi</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="login-container">
                <div class="row no-gutters">
                    <div class="col-lg-6 d-none d-lg-flex">
                        <div class="welcome-section">
                            <h1>SMK Negeri Bali Mandara</h1>
                            <p>
                            Selamat datang di Sistem Pendukung Keputusan (SPK) Penentuan Siswa Berprestasi.
                            Sistem ini dikembangkan untuk mendukung proses penilaian dan pemilihan siswa berprestasi secara lebih efisien, objektif, dan terstruktur, sejalan dengan semangat peningkatan mutu pendidikan di SMK Negeri Bali Mandara.
                            </p>
                            <p class="mb-0">
                            Dengan metode MARCOS, sistem ini membantu menganalisis berbagai kriteria penting seperti nilai akademik, prestasi, keaktifan, serta kedisiplinan siswa untuk mendapatkan hasil yang adil dan dapat dipertanggungjawabkan.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login-card">
                            <div class="login-header">
                                <div class="login-icon">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <h3 class="font-weight-bold">Masuk ke Sistem</h3>
                                <p class="text-muted">Gunakan akun Anda untuk mengakses sistem</p>
                            </div>

                            <?php $error = $this->session->flashdata('message'); if($error) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $error; ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?> 

                            <form class="user" action="<?= site_url('Login/login'); ?>" method="post">
                                <div class="form-group mb-4">
                                    <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off" />
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off" />
                                </div>
                                <button type="submit" name="submit" class="btn btn-login btn-block text-white">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                                </button>
                            </form>

                            <div class="text-center mt-4 pt-3">
                                <p class="footer-text mb-0">
                                    &copy; <?= date('Y'); ?> SMK Negeri Bali Mandara
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap & Plugin JS -->
<script src="<?= base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/')?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/')?>js/sb-admin-2.min.js"></script>
</body>
</html>