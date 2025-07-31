<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-cube text-primary mr-2"></i>Edit Kriteria
        </h1>
        <p class="text-muted mt-2">Ubah data kriteria penilaian</p>
    </div>
    <a href="<?= base_url('Kriteria'); ?>" class="btn btn-secondary btn-icon-split">
        <span class="icon text-white">
            <i class="fas fa-arrow-left"></i>
        </span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-edit mr-2"></i>Form Edit Kriteria
        </h6>
    </div>
    
    <?php echo form_open('Kriteria/update/'.$kriteria->id_kriteria); ?>
    <div class="card-body">
        <?php echo form_hidden('id_kriteria', $kriteria->id_kriteria) ?>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="font-weight-bold text-gray-700">Kode Kriteria</label>
                <input type="text" name="kode_kriteria" value="<?= $kriteria->kode_kriteria ?>" 
                       class="form-control border-primary" required autocomplete="off">
                <small class="form-text text-muted">Kode unik untuk kriteria</small>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="font-weight-bold text-gray-700">Nama Kriteria</label>
                <input type="text" name="keterangan" value="<?= $kriteria->keterangan ?>" 
                       class="form-control border-primary" required autocomplete="off">
                <small class="form-text text-muted">Nama lengkap kriteria</small>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="font-weight-bold text-gray-700">Bobot Kriteria</label>
                <div class="input-group">
                    <input type="number" name="bobot" step="0.01" value="<?= $kriteria->bobot ?>" 
                           class="form-control border-primary" required>
                    <div class="input-group-append">
                        <span class="input-group-text bg-light">%</span>
                    </div>
                </div>
                <small class="form-text text-muted">Bobot dalam persentase</small>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="font-weight-bold text-gray-700">Jenis Kriteria</label>
                <select name="jenis" class="form-control border-primary" required>
                    <option value="Benefit" <?= ($kriteria->jenis == "Benefit") ? 'selected' : '' ?>>Benefit</option>
                    <option value="Cost" <?= ($kriteria->jenis == "Cost") ? 'selected' : '' ?>>Cost</option>
                </select>
                <small class="form-text text-muted">
                    <span class="badge badge-success-light text-success">Benefit</span> = Lebih besar lebih baik | 
                    <span class="badge badge-warning-light text-warning">Cost</span> = Lebih kecil lebih baik
                </small>
            </div>
        </div>
    </div>
    
    <div class="card-footer bg-white d-flex justify-content-between border-top">
        <button type="reset" class="btn btn-outline-secondary">
            <i class="fas fa-redo mr-2"></i>Reset
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-2"></i>Simpan Perubahan
        </button>
    </div>
    <?php echo form_close() ?>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>