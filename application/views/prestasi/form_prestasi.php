<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel"><i class="fa fa-plus"></i> Tambah Data Prestasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?= base_url('Prestasi/store') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Siswa</label>
                        <select name="id_alternatif" class="form-control" required>
                            <option value="">--Pilih Siswa--</option>
                            <?php foreach($alternatif as $alt): ?>
                                <option value="<?= $alt->id_alternatif ?>"><?= $alt->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Prestasi</label>
                        <input type="text" name="nama_prestasi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tingkat</label>
                        <select name="tingkat" id="tingkat" class="form-control" required>
                            <option value="">--Pilih Tingkat--</option>
                            <option value="Kecamatan">Kecamatan</option>
                            <option value="Kabupaten">Kabupaten</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Juara</label>
                        <select name="juara" id="juara" class="form-control" required>
                            <option value="">--Pilih Juara--</option>
                            <option value="1">Juara 1</option>
                            <option value="2">Juara 2</option>
                            <option value="3">Juara 3</option>
                            <option value="Harapan 1">Harapan 1</option>
                            <option value="Harapan 2">Harapan 2</option>
                            <option value="Harapan 3">Harapan 3</option>
                            <option value="Finalis">Finalis</option>
                            <option value="Peserta">Peserta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nilai Poin (Otomatis)</label>
                        <input type="number" name="nilai_poin" id="nilai_poin" class="form-control" readonly required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Data Poin dari Gambar Anda
    const poinSkala = {
        'Kecamatan':    { '1': 8, '2': 7, '3': 6, 'Harapan 1': 5, 'Harapan 2': 4, 'Harapan 3': 3, 'Finalis': 2, 'Peserta': 1 },
        'Kabupaten':    { '1': 12, '2': 10, '3': 8, 'Harapan 1': 7, 'Harapan 2': 6, 'Harapan 3': 5, 'Finalis': 4, 'Peserta': 3 },
        'Provinsi':     { '1': 30, '2': 25, '3': 20, 'Harapan 1': 15, 'Harapan 2': 12, 'Harapan 3': 10, 'Finalis': 8, 'Peserta': 5 },
        'Nasional':     { '1': 40, '2': 35, '3': 30, 'Harapan 1': 25, 'Harapan 2': 20, 'Harapan 3': 15, 'Finalis': 10, 'Peserta': 8 },
        'Internasional':{ '1': 50, '2': 45, '3': 40, 'Harapan 1': 35, 'Harapan 2': 30, 'Harapan 3': 25, 'Finalis': 20, 'Peserta': 15 }
    };

    // 2. Ambil elemen-elemen form
    const tingkatSelect = document.getElementById('tingkat');
    const juaraSelect = document.getElementById('juara');
    const nilaiPoinInput = document.getElementById('nilai_poin');

    // 3. Fungsi untuk update poin
    function updatePoin() {
        const tingkat = tingkatSelect.value;
        const juara = juaraSelect.value;
        
        // Cek jika tingkat dan juara sudah dipilih
        if (tingkat && juara && poinSkala[tingkat] && poinSkala[tingkat][juara]) {
            nilaiPoinInput.value = poinSkala[tingkat][juara];
        } else {
            nilaiPoinInput.value = ''; // Kosongkan jika salah satu belum dipilih
        }
    }

    // 4. Tambahkan event listener ke kedua dropdown
    tingkatSelect.addEventListener('change', updatePoin);
    juaraSelect.addEventListener('change', updatePoin);
});
</script>