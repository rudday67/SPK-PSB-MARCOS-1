<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-cube text-primary mr-2"></i>Data Kriteria
        </h1>
        <p class="text-muted mt-2">Kelola data kriteria penilaian</p>
    </div>
    <a href="<?= base_url('Kriteria/create'); ?>" class="btn btn-primary btn-sm">
        <i class="fas fa-plus mr-2"></i>Tambah Data
    </a>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
    <div class="card-header bg-white py-3 border-bottom">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-table mr-2"></i>Daftar Data Kriteria
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr align="center">
                        <th width="5%" class="py-3">No</th>
                        <th class="py-3">Kode Kriteria</th>
                        <th class="py-3">Nama Kriteria</th>
                        <th class="py-3">Bobot</th>
                        <th class="py-3">Jenis</th>
                        <th width="15%" class="text-center py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        foreach ($list as $data => $value) {
                    ?>
                    <tr align="center" class="border-bottom">
                        <td class="align-middle"><?= $no ?></td>
                        <td class="align-middle"><?php echo $value->kode_kriteria ?></td>
                        <td class="align-middle"><?php echo $value->keterangan ?></td>
                        <td class="align-middle"><?php echo $value->bobot ?></td>
                        <td class="align-middle"><?php echo $value->jenis ?></td>
                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-center">
                                <a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="<?=base_url('Kriteria/edit/'.$value->id_kriteria)?>" class="btn btn-sm btn-circle btn-outline-primary mr-2"><i class="fas fa-pencil-alt"></i></a>
                                <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="<?=base_url('Kriteria/destroy/'.$value->id_kriteria)?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-sm btn-circle btn-outline-danger"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>