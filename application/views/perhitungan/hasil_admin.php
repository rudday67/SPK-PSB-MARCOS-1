<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
    <a href="<?= base_url('Laporan'); ?>" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i> Hasil Akhir Perankingan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr align="center">
                        <th>Nama Alternatif</th>
                        <th>Nilai Ki</th>
                        <th width="15%">Rank</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($hasil)): ?>
                        <?php $no = 1; foreach ($hasil as $keys): ?>
                        <tr align="center">
                            <td align="left"><?= $keys->nama ?></td>
                            <td><?= round($keys->nilai, 4) ?></td>
                            <td class="font-weight-bold text-primary"><?= $no; ?></td>
                        </tr>
                        <?php $no++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data untuk dihitung. Silakan input data penilaian terlebih dahulu.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer_admin'); ?><?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
    <a href="<?= base_url('Laporan'); ?>" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i> Hasil Akhir Perankingan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr align="center">
                        <th>Nama Alternatif</th>
                        <th>Nilai Ki</th>
                        <th width="15%">Rank</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($hasil)): ?>
                        <?php $no = 1; foreach ($hasil as $keys): ?>
                        <tr align="center">
                            <td align="left"><?= $keys->nama ?></td>
                            <td><?= round($keys->nilai, 4) ?></td>
                            <td class="font-weight-bold text-primary"><?= $no; ?></td>
                        </tr>
                        <?php $no++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data untuk dihitung. Silakan input data penilaian terlebih dahulu.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer_admin'); ?> 