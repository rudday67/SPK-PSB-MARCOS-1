<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Edit Data Prestasi</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Form Edit Prestasi</h6>
    </div>
    
    <form action="<?= base_url('Prestasi/update') ?>" method="post">
        <input type="hidden" name="id_prestasi" value="<?= $prestasi->id_prestasi ?>">
        
        <div class="card-body">
            <div class="form-group">
                <label>Siswa</label>
                <input type="text" class="form-control" value="<?= $prestasi->nama ?>" readonly>
                <input type="hidden" name="id_alternatif" value="<?= $prestasi->id_alternatif ?>">
            </div>
            <div class="form-group">
                <label>Nama Prestasi</label>
                <input type="text" name="nama_prestasi" class="form-control" value="<?= $prestasi->nama_prestasi ?>" required>
            </div>
            <div class="form-group">
                <label>Tingkat</label>
                <select name="tingkat" id="tingkat" class="form-control" required>
                    <option value="Kecamatan" <?= ($prestasi->tingkat == 'Kecamatan') ? 'selected' : '' ?>>Kecamatan</option>
                    <option value="Kabupaten" <?= ($prestasi->tingkat == 'Kabupaten') ? 'selected' : '' ?>>Kabupaten</option>
                    <option value="Provinsi" <?= ($prestasi->tingkat == 'Provinsi') ? 'selected' : '' ?>>Provinsi</option>
                    <option value="Nasional" <?= ($prestasi->tingkat == 'Nasional') ? 'selected' : '' ?>>Nasional</option>
                    <option value="Internasional" <?= ($prestasi->tingkat == 'Internasional') ? 'selected' : '' ?>>Internasional</option>
                </select>
            </div>
            <div class="form-group">
                <label>Juara</label>
                <select name="juara" id="juara" class="form-control" required>
                    <option value="1" <?= ($prestasi->juara == '1') ? 'selected' : '' ?>>Juara 1</option>
                    <option value="2" <?= ($prestasi->juara == '2') ? 'selected' : '' ?>>Juara 2</option>
                    <option value="3" <?= ($prestasi->juara == '3') ? 'selected' : '' ?>>Juara 3</option>
                    <option value="Harapan 1" <?= ($prestasi->juara == 'Harapan 1') ? 'selected' : '' ?>>Harapan 1</option>
                    <option value="Harapan 2" <?= ($prestasi->juara == 'Harapan 2') ? 'selected' : '' ?>>Harapan 2</option>
                    <option value="Harapan 3" <?= ($prestasi->juara == 'Harapan 3') ? 'selected' : '' ?>>Harapan 3</option>
                    <option value="Finalis" <?= ($prestasi->juara == 'Finalis') ? 'selected' : '' ?>>Finalis</option>
                    <option value="Peserta" <?= ($prestasi->juara == 'Peserta') ? 'selected' : '' ?>>Peserta</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nilai Poin (Otomatis)</label>
                <input type="number" name="nilai_poin" id="nilai_poin" class="form-control" value="<?= $prestasi->nilai_poin ?>" readonly required>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
            <a href="<?= base_url('Prestasi'); ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data Poin
    const poinSkala = {
        'Kecamatan':    { '1': 8, '2': 7, '3': 6, 'Harapan 1': 5, 'Harapan 2': 4, 'Harapan 3': 3, 'Finalis': 2, 'Peserta': 1 },
        'Kabupaten':    { '1': 12, '2': 10, '3': 8, 'Harapan 1': 7, 'Harapan 2': 6, 'Harapan 3': 5, 'Finalis': 4, 'Peserta': 3 },
        'Provinsi':     { '1': 30, '2': 25, '3': 20, 'Harapan 1': 15, 'Harapan 2': 12, 'Harapan 3': 10, 'Finalis': 8, 'Peserta': 5 },
        'Nasional':     { '1': 40, '2': 35, '3': 30, 'Harapan 1': 25, 'Harapan 2': 20, 'Harapan 3': 15, 'Finalis': 10, 'Peserta': 8 },
        'Internasional':{ '1': 50, '2': 45, '3': 40, 'Harapan 1': 35, 'Harapan 2': 30, 'Harapan 3': 25, 'Finalis': 20, 'Peserta': 15 }
    };

    const tingkatSelect = document.getElementById('tingkat');
    const juaraSelect = document.getElementById('juara');
    const nilaiPoinInput = document.getElementById('nilai_poin');

    function updatePoin() {
        const tingkat = tingkatSelect.value;
        const juara = juaraSelect.value;
        
        if (tingkat && juara && poinSkala[tingkat] && poinSkala[tingkat][juara]) {
            nilaiPoinInput.value = poinSkala[tingkat][juara];
        } else {
            nilaiPoinInput.value = '';
        }
    }

    tingkatSelect.addEventListener('change', updatePoin);
    juaraSelect.addEventListener('change', updatePoin);
});
</script>


<?php $this->load->view('layouts/footer_admin'); ?>