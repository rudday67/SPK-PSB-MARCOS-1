<!-- <?php 
$this->load->view('layouts/header_admin'); 

// 1. Matriks Keputusan (X)
$matriks_x = [];
foreach($alternatifs as $alternatif) {
    foreach($kriterias as $kriteria) {
        $nilai = $this->Penilaian_model->get_nilai($alternatif->id_alternatif, $kriteria->id_kriteria);
        $matriks_x[$kriteria->id_kriteria][$alternatif->id_alternatif] = $nilai;
    }
}

// Lanjutkan perhitungan hanya jika ada data
if (!empty($alternatifs) && !empty($kriterias)):

// 2. Matriks Ideal (AI) dan Anti-Ideal (AAI)
$ideal = []; 
$anti_ideal = [];
foreach ($kriterias as $kri) {
    $col_values = !empty($matriks_x[$kri->id_kriteria]) ? array_values($matriks_x[$kri->id_kriteria]) : [0];
    if ($kri->jenis == 'Benefit') {
        $ideal[$kri->id_kriteria] = max($col_values);
        $anti_ideal[$kri->id_kriteria] = min($col_values);
    } else { // Cost
        $ideal[$kri->id_kriteria] = min($col_values);
        $anti_ideal[$kri->id_kriteria] = max($col_values);
    }
}

// 3. Normalisasi
$matriks_normalisasi = [];
foreach ($kriterias as $kri) {
    foreach ($alternatifs as $alt) {
        $pembagi_ideal = $ideal[$kri->id_kriteria];
        $nilai_x = $matriks_x[$kri->id_kriteria][$alt->id_alternatif];
        
        $normalisasi = 0;
        if ($kri->jenis == 'Benefit') {
            $normalisasi = ($pembagi_ideal == 0) ? 0 : $nilai_x / $pembagi_ideal;
        } else { // Cost
            $normalisasi = ($nilai_x == 0) ? 0 : $pembagi_ideal / $nilai_x;
        }
        $matriks_normalisasi[$kri->id_kriteria][$alt->id_alternatif] = $normalisasi;
    }
}

// 4. Pembobotan
$matriks_terbobot = [];
foreach ($kriterias as $kri) {
    foreach ($alternatifs as $alt) {
        $terbobot = $matriks_normalisasi[$kri->id_kriteria][$alt->id_alternatif] * $kri->bobot;
        $matriks_terbobot[$kri->id_kriteria][$alt->id_alternatif] = $terbobot;
    }
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i> Matriks Keputusan (X)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr align="center">
                        <th>Nama Alternatif</th>
                        <?php foreach ($kriterias as $kriteria): ?>
                            <th><?= $kriteria->kode_kriteria ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alternatifs as $alternatif): ?>
                    <tr align="center">
                        <td align="left"><?= $alternatif->nama; ?></td>
                        <?php foreach ($kriterias as $kriteria): ?>
                            <td><?= $matriks_x[$kriteria->id_kriteria][$alternatif->id_alternatif] ?? 0; ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i> Matriks Normalisasi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr align="center">
                        <th>Nama Alternatif</th>
                        <?php foreach ($kriterias as $kriteria): ?>
                            <th><?= $kriteria->kode_kriteria ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alternatifs as $alternatif): ?>
                    <tr align="center">
                        <td align="left"><?= $alternatif->nama; ?></td>
                        <?php foreach ($kriterias as $kriteria): ?>
                            <td><?= round($matriks_normalisasi[$kriteria->id_kriteria][$alternatif->id_alternatif], 4); ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php endif; ?>
<?php $this->load->view('layouts/footer_admin'); ?> -->