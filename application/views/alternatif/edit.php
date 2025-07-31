<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-users text-primary mr-2"></i>Edit Data Alternatif
        </h1>
        <p class="text-muted mt-2">Ubah informasi alternatif</p>
    </div>
    <a href="<?= base_url('Alternatif'); ?>" class="btn btn-secondary btn-icon-split">
        <span class="icon text-white">
            <i class="fas fa-arrow-left"></i>
        </span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-edit mr-2"></i>Formulir Edit Data Alternatif
        </h6>
    </div>
    <div class="card-body">
        <?php echo form_open('Alternatif/update/'.$alternatif->id_alternatif); ?>
        <div class="row">
            <?php echo form_hidden('id_alternatif', $alternatif->id_alternatif) ?>
            <div class="form-group col-md-12">
                <label class="font-weight-bold text-gray-700">Nama Alternatif</label>
                <input autocomplete="off" type="text" name="nama" value="<?php echo $alternatif->nama ?>" required class="form-control border-primary"/>
            </div>
        </div>
    </div>
    <div class="card-footer bg-light text-right border-top">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
        <button type="reset" class="btn btn-outline-secondary"><i class="fas fa-redo mr-2"></i>Reset</button>
    </div>
    <?php echo form_close() ?>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>