<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-circle"></i> Data Profil</h1>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4 border-left-primary">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-edit mr-1"></i> Edit Profil</h6>
    </div>
    
    <?php echo form_open('Profile/update/'.$profile->id_user); ?>
        <div class="card-body bg-gray-50">
            <div class="row">
                <?php echo form_hidden('id_user', $profile->id_user) ?>
                
                <div class="form-group col-md-6">
                    <label class="font-weight-bold text-gray-700">Alamat Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input autocomplete="off" type="email" name="email" value="<?php echo $profile->email ?>" required class="form-control border-left-0">
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="font-weight-bold text-gray-700">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white"><i class="fas fa-user"></i></span>
                        </div>
                        <input autocomplete="off" type="text" name="username" value="<?php echo $profile->username ?>" required class="form-control border-left-0">
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="font-weight-bold text-gray-700">Password Baru</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white"><i class="fas fa-lock"></i></span>
                        </div>
                        <input autocomplete="off" type="password" name="password" required class="form-control border-left-0" placeholder="Masukkan password baru">
                    </div>
                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="font-weight-bold text-gray-700">Nama Lengkap</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input autocomplete="off" type="text" name="nama" value="<?php echo $profile->nama ?>" required class="form-control border-left-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 text-right">
            <button type="reset" class="btn btn-outline-secondary mr-2">
                <i class="fas fa-undo mr-1"></i> Reset
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Simpan Perubahan
            </button>
        </div>
    <?php echo form_close() ?>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>