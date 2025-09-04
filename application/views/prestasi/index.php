<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-trophy"></i> Data Prestasi</h1>
    
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">
        <i class="fa fa-plus"></i> Tambah Data
    </button>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i> Daftar Data Prestasi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Nama Siswa</th>
                        <th>Nama Prestasi</th>
                        <th>Tingkat</th>
                        <th>Juara</th>
                        <th>Poin</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($list as $data): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $data->nama ?></td>
                        <td><?= $data->nama_prestasi ?></td>
                        <td class="text-center"><?= $data->tingkat ?></td>
                        <td class="text-center"><?= $data->juara ?></td>
                        <td class="text-center"><?= $data->nilai_poin ?></td>
                        <td class="text-center">
                            
                            <a href="<?= base_url('Prestasi/edit/' . $data->id_prestasi) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            
                            <a href="<?= base_url('Prestasi/destroy/' . $data->id_prestasi) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                <i class="fa fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('prestasi/form_prestasi'); ?>
<?php $this->load->view('layouts/footer_admin'); ?>