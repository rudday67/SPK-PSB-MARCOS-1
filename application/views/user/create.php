<?php $this->load->view('layouts/header_admin'); ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800"><i class="fas fa-user-plus mr-2"></i>Tambah Data User</h1>
        <a href="<?= base_url('User'); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-<?= $this->session->flashdata('message_type') ?> alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Card -->
    <div class="card shadow border-left-primary">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-edit mr-1"></i>Form Tambah User</h6>
        </div>
        
        <?= form_open('User/store', ['class' => 'needs-validation', 'novalidate' => '']) ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="font-weight-bold text-gray-700">E-Mail</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
                            <div class="invalid-feedback">
                                Harap masukkan email yang valid
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="username" class="font-weight-bold text-gray-700">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
                            <div class="invalid-feedback">
                                Harap masukkan username
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="password" class="font-weight-bold text-gray-700">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
                            <div class="invalid-feedback">
                                Harap masukkan password
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="font-weight-bold text-gray-700">Nama Lengkap</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
                            <div class="invalid-feedback">
                                Harap masukkan nama lengkap
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="privilege" class="font-weight-bold text-gray-700">Level</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                            </div>
                            <select class="form-control selectpicker" id="privilege" name="privilege" required data-live-search="true">
                                <option value="">-- Pilih Level --</option>
                                <?php foreach ($user_level as $k): ?>
                                <option value="<?= $k->id_user_level ?>"><?= $k->user_level ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Harap pilih level user
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 text-right">
                <button type="reset" class="btn btn-outline-secondary mr-2">
                    <i class="fas fa-redo mr-1"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan User
                </button>
            </div>
        <?= form_close() ?>
    </div>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>

<!-- Add Bootstrap Select CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Initialize select picker
        $('.selectpicker').selectpicker();
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>