<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> <?= isset($edit_data) ? 'Edit' : 'Input'; ?> Penilaian Alternatif</h1>
</div>

<form action="<?= $url_action; ?>" method="post">

<?php if(isset($edit_data)): ?>
    <input type="hidden" name="id_alternatif" value="<?= $edit_data->id_alternatif ?>">
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-check mr-2"></i> Alternatif (Siswa)</h6>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="id_alternatif">Nama Siswa</label>
            <?php if(isset($edit_data)): ?>
                <input type="text" class="form-control" value="<?= $edit_data->nama ?>" readonly>
            <?php else: ?>
                <select name="id_alternatif" id="id_alternatif" class="form-control" required>
                    <option value="">--Pilih Siswa--</option>
                    <?php foreach ($alternatif_prestasi as $item): ?>
                        <option value="<?= $item['id_alternatif'] ?>" data-prestasi="<?= $item['nilai_prestasi'] ?>"><?= $item['nama'] ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-pencil-alt mr-2"></i> Input Nilai Kriteria</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nilai Raport (K1)</label>
                    <input type="number" name="nilai_raport" class="form-control" value="<?= $penilaian_map[1] ?? '' ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nilai IPC (K2)</label>
                    <input type="number" name="nilai_ipc" class="form-control" value="<?= $penilaian_map[2] ?? '' ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Prestasi (K3)</label>
                    <input type="text" id="prestasi" class="form-control" value="<?= $penilaian_map[3] ?? '' ?>" readonly style="background-color: #e9ecef;">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Absensi (K4)</label>
                    <input type="number" name="absensi" class="form-control" value="<?= $penilaian_map[4] ?? '' ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ekstrakurikuler (K5)</label>
                    <select name="ekstrakurikuler" class="form-control" required>
                        <option value="">--Pilih Nilai--</option>
                        <option value="50" <?= (isset($penilaian_map[5]) && $penilaian_map[5] == 50) ? 'selected' : '' ?>>Sangat Baik</option>
                        <option value="40" <?= (isset($penilaian_map[5]) && $penilaian_map[5] == 40) ? 'selected' : '' ?>>Baik</option>
                        <option value="30" <?= (isset($penilaian_map[5]) && $penilaian_map[5] == 30) ? 'selected' : '' ?>>Cukup</option>
                        <option value="20" <?= (isset($penilaian_map[5]) && $penilaian_map[5] == 20) ? 'selected' : '' ?>>Sangat Kurang</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Penilaian</button>
            <a href="<?= base_url('Penilaian'); ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const siswaDropdown = document.getElementById('id_alternatif');
    const prestasiInput = document.getElementById('prestasi');
    if(siswaDropdown) {
        siswaDropdown.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const nilaiPrestasi = selectedOption.getAttribute('data-prestasi');
            if (this.value) {
                prestasiInput.value = nilaiPrestasi;
            } else {
                prestasiInput.value = '';
            }
        });
    }
});
</script>

<?php $this->load->view('layouts/footer_admin'); ?>