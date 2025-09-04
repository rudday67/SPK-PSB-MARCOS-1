<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-trophy"></i> Data Prestasi</h1>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i> Daftar Data Prestasi</h6>
        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambahModal">
            <i class="fa fa-plus"></i> Tambah Data
        </button>
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
                    <tr align="center">
                        <td><?= $no++ ?></td>
                        <td align="left"><?= $data->nama_alternatif ?></td>
                        <td align="left"><?= $data->nama_prestasi ?></td>
                        <td><?= $data->tingkat ?></td>
                        <td><?= $data->juara ?></td>
                        <td><?= $data->nilai_poin ?></td>
                        <td>
                            <?php // Tombol Edit dan Hapus akan kita fungsikan nanti ?>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahModalLabel">Tambah Data Prestasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Prestasi/store'); ?>" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label for="id_alternatif">Nama Siswa</label>
                <select name="id_alternatif" id="id_alternatif" class="form-control" required>
                    <option value="">--Pilih Siswa--</option>
                    <?php foreach ($alternatif as $siswa): ?>
                        <option value="<?= $siswa->id_alternatif ?>"><?= $siswa->nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_prestasi">Nama Prestasi</label>
                <input type="text" name="nama_prestasi" id="nama_prestasi" class="form-control" placeholder="Contoh: Lomba Cerdas Cermat" required>
            </div>
            <div class="form-group">
                <label for="tingkat">Tingkat</label>
                <select name="tingkat" id="tingkat" class="form-control" required>
                    <option value="">--Pilih Tingkat--</option>
                    <option value="Kabupaten">Kabupaten</option>
                    <option value="Provinsi">Provinsi</option>
                    <option value="Internasional">Internasional</option>
                </select>
            </div>
            <div class="form-group">
                <label for="juara">Juara</label>
                <select name="juara" id="juara" class="form-control" required>
                    <option value="">--Pilih Juara--</option>
                    <option value="1">Juara 1</option>
                    <option value="2">Juara 2</option>
                    <option value="3">Juara 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nilai_poin">Nilai Poin</label>
                <input type="number" step="0.1" name="nilai_poin" id="nilai_poin" class="form-control" placeholder="Masukkan nilai poin..." required>
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

<?php $this->load->view('layouts/footer_admin'); ?>