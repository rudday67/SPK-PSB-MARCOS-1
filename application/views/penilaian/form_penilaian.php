<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> <?= (isset($edit_data)) ? 'Edit' : 'Input' ?> Data Penilaian</h1>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Form Penilaian</h6>
    </div>
    
    <form action="<?= $url_action ?>" method="post">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="font-weight-bold">Pilih Alternatif (Siswa)</label>
                    
                    <?php if(isset($edit_data)): ?>
                        <input type="text" class="form-control" value="<?= $edit_data->nama ?>" readonly/>
                        <input type="hidden" name="id_alternatif" value="<?= $edit_data->id_alternatif ?>" />
                    <?php else: ?>
                        <select name="id_alternatif" id="id_alternatif_dropdown" class="form-control" required>
                            <option value="">--Pilih Siswa--</option>
                            <?php foreach($alternatifs as $alt): ?>
                                <option value="<?= $alt->id_alternatif ?>" data-poin-prestasi="<?= $alt->poin_prestasi ?>"><?= $alt->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
                
                <h6 class="col-md-12 font-weight-bold text-primary mt-3">Input Nilai Kriteria</h6>
                
                <?php foreach($kriterias as $kriteria): ?>
                    <div class="form-group col-md-6">
                        <label><?= $kriteria->keterangan ?> (<?= $kriteria->kode_kriteria ?>)</label>
                        
                        <?php 
                            $nilai = $penilaian_map[$kriteria->id_kriteria] ?? '';
                            if ($kriteria->kode_kriteria == 'K5') : 
                        ?>
                            <select name="<?= $kriteria->kode_kriteria ?>" class="form-control" required>
                                <option value="">--Pilih Nilai--</option>
                                <option value="4" <?= ($nilai == 4) ? 'selected' : '' ?>>Sangat Baik</option>
                                <option value="3" <?= ($nilai == 3) ? 'selected' : '' ?>>Baik</option>
                                <option value="2" <?= ($nilai == 2) ? 'selected' : '' ?>>Cukup</option>
                                <option value="1" <?= ($nilai == 1) ? 'selected' : '' ?>>Sangat Kurang</option>
                            </select>
                        
                        <?php else: 
                            $is_readonly = ($kriteria->kode_kriteria == 'K3');
                        ?>
                            <input type="<?= ($is_readonly) ? 'text' : 'number' ?>" 
                                   name="<?= $kriteria->kode_kriteria ?>" 
                                   id="<?= $kriteria->kode_kriteria ?>"
                                   value="<?= $nilai ?>" 
                                   class="form-control" 
                                   step="any" 
                                   <?= ($is_readonly) ? 'readonly style="background-color: #e9ecef;"' : 'required' ?> />
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            <a href="<?= base_url('Penilaian'); ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const siswaDropdown = document.getElementById('id_alternatif_dropdown');
    // Asumsi input prestasi memiliki id="K3"
    const prestasiInput = document.getElementById('K3'); 

    if(siswaDropdown && prestasiInput) {
        siswaDropdown.addEventListener('change', function() {
            // Jika "--Pilih Siswa--" dipilih, kosongkan field prestasi
            if (!this.value) {
                prestasiInput.value = '';
                return;
            }
            
            // Ambil pilihan yang sedang aktif
            const selectedOption = this.options[this.selectedIndex];
            // Baca nilai dari atribut 'data-poin-prestasi'
            const poin = selectedOption.getAttribute('data-poin-prestasi');
            // Masukkan nilai poin ke dalam input prestasi
            prestasiInput.value = poin;
        });
    }
});
</script>

<?php $this->load->view('layouts/footer_admin'); ?>