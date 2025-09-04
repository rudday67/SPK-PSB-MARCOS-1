<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Data Penilaian</h1>
    <a href="<?= base_url('Penilaian/tambah'); ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data Penilaian </a>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i> Daftar Alternatif Telah Dinilai</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Alternatif</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($list as $data): ?>
                    <tr align="center">
                        <td><?= $no++ ?></td>
                        <td align="left"><?= $data->nama ?></td>
                        <td>
                            <a href="<?= base_url('Penilaian/edit/'.$data->id_alternatif); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>