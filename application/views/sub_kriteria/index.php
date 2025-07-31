<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-cubes text-primary mr-2"></i>Data Sub Kriteria
        </h1>
        <p class="text-muted mt-2">Kelola sub kriteria penilaian</p>
    </div>
</div>

<?= $this->session->flashdata('message'); ?>

<?php if ($kriteria == NULL): ?>
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-table mr-2"></i>Daftar Data Sub Kriteria
        </h6>
    </div>
    <div class="card-body">
        <div class="alert alert-primary-light border-primary text-primary">
            <i class="fas fa-info-circle mr-2"></i>Data sub kriteria belum tersedia
        </div>
    </div>
</div>
<?php endif; ?>

<?php foreach ($kriteria as $key): ?>
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-list-alt mr-2"></i><?= $key->keterangan." (".$key->kode_kriteria.")" ?>
        </h6>
        <button data-toggle="modal" data-target="#tambah<?= $key->id_kriteria ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-2"></i>Tambah Sub Kriteria
        </button>
    </div>

    <div class="modal fade" id="tambah<?= $key->id_kriteria ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle mr-2"></i>Tambah <?= $key->keterangan ?>
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('Sub_kriteria/store') ?>
                <div class="modal-body">
                    <?= form_hidden('id_kriteria', $key->id_kriteria) ?>
                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">Nama Sub Kriteria</label>
                        <input type="text" name="deskripsi" class="form-control border-primary" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">Nilai</label>
                        <input type="text" name="nilai" class="form-control border-primary" required autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <?php
            $sub_kriteria1 = $this->Sub_Kriteria_model->data_sub_kriteria($key->id_kriteria);
            if (!empty($sub_kriteria1)):
        ?>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" >
                <thead class="bg-light">
                    <tr>
                        <th width="5%" class="text-center py-3">No</th>
                        <th class="py-3">Nama Sub Kriteria</th>
                        <th class="text-center py-3">Nilai</th>
                        <th width="15%" class="text-center py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($sub_kriteria1 as $subkey): ?>
                    <tr class="border-bottom">
                        <td class="text-center align-middle"><?= $no ?></td>
                        <td class="align-middle"><?= $subkey['deskripsi'] ?></td>
                        <td class="text-center align-middle">
                            <?= $subkey['nilai'] ?>
                        </td>
                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-center">
                                <a data-toggle="modal" href="#editsk<?= $subkey['id_sub_kriteria'] ?>"
                                    class="btn btn-sm btn-circle btn-outline-primary mr-2"
                                    data-toggle="tooltip"
                                    title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?= base_url('Sub_kriteria/destroy/'.$subkey['id_sub_kriteria']) ?>"
                                    class="btn btn-sm btn-circle btn-outline-danger"
                                    onclick="return confirm('Hapus sub kriteria ini?')"
                                    data-toggle="tooltip"
                                    title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="editsk<?= $subkey['id_sub_kriteria'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">
                                        <i class="fas fa-edit mr-2"></i>Edit <?= $subkey['deskripsi'] ?>
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?= form_open('Sub_kriteria/update/'.$subkey['id_sub_kriteria']) ?>
                                <?= form_hidden('id_sub_kriteria', $subkey['id_sub_kriteria']) ?>
                                <div class="modal-body">
                                    <?= form_hidden('id_kriteria', $key->id_kriteria) ?>
                                    <div class="form-group">
                                        <label class="font-weight-bold text-gray-700">Nama Sub Kriteria</label>
                                        <input type="text" name="deskripsi" value="<?= $subkey['deskripsi'] ?>"
                                            class="form-control border-primary" required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold text-gray-700">Nilai</label>
                                        <input type="text" name="nilai" value="<?= $subkey['nilai'] ?>"
                                            class="form-control border-primary" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                                        <i class="fas fa-times mr-2"></i>Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-2"></i>Update
                                    </button>
                                </div>
                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="alert alert-primary-light border-primary text-primary m-3">
            <i class="fas fa-info-circle mr-2"></i>Belum ada sub kriteria untuk <?= $key->keterangan ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?>

<?php $this->load->view('layouts/footer_admin'); ?>