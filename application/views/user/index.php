<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-users-cog mr-2"></i> Data User</h1>
    <a href="<?= base_url('User/create'); ?>" class="btn btn-primary">
        <i class="fas fa-plus mr-1"></i> Tambah User
    </a>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
    <!-- Card Header -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-1"></i> Daftar Data User</h6>
    </div>

    <div class="card-body bg-gray-50">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nama</th>
                        <th>E-mail</th>
                        <th>Username</th>
                        <th class="text-center">Level</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($list as $data => $value) { ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td><?= htmlspecialchars($value->nama) ?></td>
                        <td><?= htmlspecialchars($value->email) ?></td>
                        <td><?= htmlspecialchars($value->username) ?></td>
                        <td class="text-center">
                            <?php
                            foreach ($user_level as $k) {
                                if($k->id_user_level == $value->id_user_level) {
                                    echo '<span class="badge badge-primary">'.htmlspecialchars($k->user_level).'</span>';
                                }
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a data-toggle="tooltip" data-placement="top" title="Detail" href="<?= base_url('User/show/'.$value->id_user) ?>" class="btn btn-sm btn-circle btn-outline-info"><i class="fas fa-eye"></i>
                                </a>
                                <a data-toggle="tooltip" data-placement="top" title="Edit" href="<?= base_url('User/edit/'.$value->id_user) ?>" class="btn btn-sm btn-circle btn-outline-primary"><i class="fas fa-pencil-alt"></i>
                                </a>
                                <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?= base_url('User/destroy/'.$value->id_user) ?>" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')" class="btn btn-sm btn-circle btn-outline-danger"><i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer_admin'); ?> 