<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-fw fa-chart-area mr-2"></i>Data Hasil Akhir
    </h1>
    
    <div class="d-flex align-items-center">
        <?php if ($this->session->userdata('id_user_level') == '3'): ?>
            <?php if ($belum_verif > 0): ?>
                <a href="<?= base_url('Perhitungan/verifikasi_semua'); ?>" 
                   class="btn btn-sm btn-success shadow-sm mr-2" 
                   onclick="return confirm('Verifikasi seluruh data?')">
                    <i class="fas fa-check-double fa-sm text-white-50 mr-1"></i> Verifikasi Semua
                </a>
            <?php else: ?>
                <a href="<?= base_url('Perhitungan/batal_verifikasi_semua'); ?>" 
                   class="btn btn-sm btn-danger shadow-sm mr-2" 
                   onclick="return confirm('Batalkan seluruh verifikasi?')">
                    <i class="fas fa-undo fa-sm text-white-50 mr-1"></i> Batal Semua
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <a href="<?= base_url('Laporan'); ?>" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-print fa-sm text-white-50 mr-1"></i> Cetak Data
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-table mr-2"></i> Hasil Akhir Perankingan
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tabelPeringkat" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr align="center">
                        <th>Nama Alternatif</th>
                        <th>Nilai Ki</th>
                        <th width="15%">Rank</th>
                        <th>Verifikasi</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($hasil)): ?>
                        <?php $no = 1; foreach ($hasil as $keys): ?>
                        <tr align="center">
                            <td align="left"><?= $keys->nama ?></td>
                            <td><?= round($keys->nilai, 4) ?></td>
                            <td class="font-weight-bold text-primary"><?= $no; ?></td>
                            <td style="vertical-align: middle;">
                                <?php if ($keys->status_verifikasi == 1): ?>
                                    <div class="badge badge-success px-3 py-2 shadow-sm" style="font-size: 0.85rem;">
                                        <i class="fa fa-check-circle mr-1"></i> Terverifikasi
                                    </div>
                                    
                                    <?php if ($this->session->userdata('id_user_level') == '3'): ?>
                                        <div class="mt-2">
                                            <a href="<?= base_url('Perhitungan/batal_verifikasi/'.$keys->id_alternatif) ?>" 
                                               class="btn btn-sm btn-link text-danger p-0 font-weight-bold" 
                                               onclick="return confirm('Batalkan verifikasi untuk siswa ini?')">
                                               <i class="fa fa-undo fa-xs"></i> Batal Verifikasi
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                <?php else: ?>
                                    <?php if ($this->session->userdata('id_user_level') == '3'): ?>
                                        <a href="<?= base_url('Perhitungan/verifikasi/'.$keys->id_alternatif) ?>" 
                                           class="btn btn-sm btn-outline-success shadow-sm px-3">
                                            <i class="fa fa-stamp mr-1"></i> Verifikasi
                                        </a>
                                    <?php else: ?>
                                        <span class="badge badge-secondary px-3 py-2">
                                            <i class="fa fa-clock mr-1"></i> Menunggu
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $no++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data untuk dihitung.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>

<script>
$(document).ready(function() {
    // Pastikan ID di sini SAMA dengan ID di tag <table> (tabelPeringkat)
    $('#tabelPeringkat').DataTable({
        "order": [[ 2, "asc" ]] 
    });
});
</script>