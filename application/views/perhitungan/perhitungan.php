<?php 
$this->load->view('layouts/header_admin'); 
$this->Perhitungan_model->hapus_hasil();
//Matrix Keputusan (X)
$matriks_x = array();
foreach($alternatifs as $alternatif):
	foreach($kriterias as $kriteria):
		
		$id_alternatif = $alternatif->id_alternatif;
		$id_kriteria = $kriteria->id_kriteria;
		
		$data_pencocokan = $this->Perhitungan_model->data_nilai($id_alternatif,$id_kriteria);
		$nilai = $data_pencocokan['nilai'];
		if ($nilai !== null) {
			$matriks_x[$id_kriteria][$id_alternatif] = $nilai;
		} else {
			$matriks_x[$id_kriteria][$id_alternatif] = 0;
		}
	endforeach;
endforeach;

//Matriks Normalisasi
$matriks_n = array();
$matriks_nb = array();
$total_nb = array();

foreach($alternatifs as $alternatif):
	$id_alternatif = $alternatif->id_alternatif;
	$t_nb = 0;
	foreach($kriterias as $kriteria):
		
		$id_kriteria = $kriteria->id_kriteria;
		$x = $matriks_x[$id_kriteria][$id_alternatif];
		$bobot = $kriteria->bobot;
		$type_kriteria = $kriteria->jenis;
		if($type_kriteria == 'Benefit'):
			$m = max($matriks_x[$id_kriteria]);
			$n = @($x/$m);
		elseif($type_kriteria == 'Cost'):
			$m = min($matriks_x[$id_kriteria]);
			$n = @($m/$x);
		endif;
		$nb = $n*$bobot;
		$t_nb += $nb;
		$matriks_n[$id_kriteria][$id_alternatif] = $n;
		$matriks_nb[$id_kriteria][$id_alternatif] = $nb;
	endforeach;

	$total_nb[$id_alternatif] = $t_nb;
endforeach;

$t_min = 0;
$t_max = 0;
foreach ($kriterias as $kriteria):
	$id_kriteria = $kriteria->id_kriteria;
	$min = min($matriks_nb[$id_kriteria]);
	$max = max($matriks_nb[$id_kriteria]);
	$t_min += $min;
	$t_max += $max;
endforeach;

$nilai_k_min = array();
$nilai_k_max = array();
foreach($alternatifs as $alternatif):
	$id_alternatif = $alternatif->id_alternatif;
	$t_nb = $total_nb[$id_alternatif];
	$k_min = @($t_nb/$t_min);
	$k_max = @($t_nb/$t_max);
	$nilai_k_min[$id_alternatif] = $k_min;
	$nilai_k_max[$id_alternatif] = $k_max;
endforeach;

$nilai_fk_min = array();
$nilai_fk_max = array();
$nilai_ki = array();
foreach($alternatifs as $alternatif):
	$id_alternatif = $alternatif->id_alternatif;
	
	$k_min = $nilai_k_min[$id_alternatif];
	$k_max = $nilai_k_max[$id_alternatif];
	$fk_max = $k_max/($k_min + $k_max);
	$fk_min = $k_min/($k_min + $k_max);

	$ki = ($k_max + $k_min) / (1 + ((1 - $fk_max) / $fk_max) + ((1 - $fk_min) / $fk_min));

	$nilai_fk_min[$id_alternatif] = $fk_min;
	$nilai_fk_max[$id_alternatif] = $fk_max;
	$nilai_ki[$id_alternatif] = $ki;
endforeach;
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800"><i class="fas fa-calculator mr-2"></i>Data Perhitungan</h1>
    </div>

    <!-- Matriks Keputusan (X) -->
    <div class="card shadow mb-4 ">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-1"></i>Matriks Keputusan (X)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr align="center">
                            <th width="5%">No</th>
                            <th>Nama Alternatif</th>
                            <?php foreach ($kriterias as $kriteria): ?>
                                <th><?= $kriteria->kode_kriteria ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatifs as $alternatif): ?>
                        <tr align="center">
                            <td><?= $no; ?></td>
                            <td align="left"><?= $alternatif->nama ?></td>
                            <?php
                            foreach ($kriterias as $kriteria):
                                $id_alternatif = $alternatif->id_alternatif;
                                $id_kriteria = $kriteria->id_kriteria;
                                echo '<td>';
                                echo $matriks_x[$id_kriteria][$id_alternatif];
                                echo '</td>';
                            endforeach
                            ?>
                        </tr>
                        <?php $no++; endforeach ?>
                        <tr align="center" class="bg-light font-weight-bold">
                            <td colspan="2">MIN</td>
                            <?php
                            foreach ($kriterias as $kriteria):
                                $id_kriteria = $kriteria->id_kriteria;
                                $type_kriteria = $kriteria->jenis;
                                if($type_kriteria == 'Benefit'):
                                    echo '<td>';
                                    echo min($matriks_x[$id_kriteria]);
                                    echo '</td>';
                                elseif($type_kriteria == 'Cost'):
                                    echo '<td>';
                                    echo max($matriks_x[$id_kriteria]);
                                    echo '</td>';
                                endif;
                            endforeach;
                            ?>
                        </tr>
                        <tr align="center" class="bg-light font-weight-bold">
                            <td colspan="2">MAX</td>
                            <?php
                            foreach ($kriterias as $kriteria):
                                $id_kriteria = $kriteria->id_kriteria;
                                $type_kriteria = $kriteria->jenis;
                                if($type_kriteria == 'Benefit'):
                                    echo '<td>';
                                    echo max($matriks_x[$id_kriteria]);
                                    echo '</td>';
                                elseif($type_kriteria == 'Cost'):
                                    echo '<td>';
                                    echo min($matriks_x[$id_kriteria]);
                                    echo '</td>';
                                endif;
                            endforeach;
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Matriks Normalisasi (N) -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-1"></i>Matriks Normalisasi (N)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr align="center">
                            <th width="5%">No</th>
                            <th>Nama Alternatif</th>
                            <?php foreach ($kriterias as $kriteria): ?>
                                <th><?= $kriteria->kode_kriteria ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatifs as $alternatif): ?>
                        <tr align="center">
                            <td><?= $no; ?></td>
                            <td align="left"><?= $alternatif->nama ?></td>
                            <?php
                            foreach ($kriterias as $kriteria):
                                $id_alternatif = $alternatif->id_alternatif;
                                $id_kriteria = $kriteria->id_kriteria;
                                echo '<td>';
                                echo $matriks_n[$id_kriteria][$id_alternatif];
                                echo '</td>';
                            endforeach
                            ?>
                        </tr>
                        <?php $no++; endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bobot Kriteria -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-weight mr-1"></i>Bobot Kriteria</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr align="center">
                            <?php foreach ($kriterias as $kriteria): ?>
                            <th>(<?= $kriteria->kode_kriteria ?>) <?= $kriteria->keterangan ?><br/>(<?= $kriteria->jenis ?>)</th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <?php foreach ($kriterias as $kriteria): ?>
                            <td><?= $kriteria->bobot ?></td>
                            <?php endforeach ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Matriks Normalisasi Terbobot -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-1"></i>Matriks Normalisasi Terbobot</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr align="center">
                            <th width="5%">No</th>
                            <th>Nama Alternatif</th>
                            <?php foreach ($kriterias as $kriteria): ?>
                                <th><?= $kriteria->kode_kriteria ?></th>
                            <?php endforeach ?>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatifs as $alternatif):
                            $id_alternatif = $alternatif->id_alternatif;
                        ?>
                        <tr align="center">
                            <td><?= $no; ?></td>
                            <td align="left"><?= $alternatif->nama ?></td>
                            <?php
                            foreach ($kriterias as $kriteria):
                                $id_kriteria = $kriteria->id_kriteria;
                                echo '<td>';
                                echo $matriks_nb[$id_kriteria][$id_alternatif];
                                echo '</td>';
                            endforeach;
                            ?>
                            <td class="font-weight-bold"><?= $total_nb[$id_alternatif] ?></td>
                        </tr>
                        <?php $no++; endforeach ?>
                        <tr align="center" class="bg-light font-weight-bold">
                            <td colspan="2">MIN</td>
                            <?php
                            foreach ($kriterias as $kriteria):
                                $id_kriteria = $kriteria->id_kriteria;
                                echo '<td>';
                                echo min($matriks_nb[$id_kriteria]);
                                echo '</td>';
                            endforeach;
                            ?>
                            <td><?= $t_min ?></td>
                        </tr>
                        <tr align="center" class="bg-light font-weight-bold">
                            <td colspan="2">MAX</td>
                            <?php
                            foreach ($kriterias as $kriteria):
                                $id_kriteria = $kriteria->id_kriteria;
                                echo '<td>';
                                echo max($matriks_nb[$id_kriteria]);
                                echo '</td>';
                            endforeach;
                            ?>
                            <td><?= $t_max ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Perhitungan tingkat utilitas alternatif Ki -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-calculator mr-1"></i>Perhitungan Tingkat Utilitas Alternatif Ki</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr align="center">
                            <th width="5%">No</th>
                            <th>Nama Alternatif</th>
                            <th width="25%">K+</th>
                            <th width="25%">K-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatifs as $alternatif):
                            $id_alternatif = $alternatif->id_alternatif;
                        ?>
                        <tr align="center">
                            <td><?= $no; ?></td>
                            <td align="left"><?= $alternatif->nama ?></td>
                            <td><?= $nilai_k_max[$id_alternatif] ?></td>
                            <td><?= $nilai_k_min[$id_alternatif] ?></td>
                        </tr>
                        <?php $no++; endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Penentuan fungsi utilitas alternatif f(Ki) -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-line mr-1"></i>Penentuan Fungsi Utilitas Alternatif f(Ki)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr align="center">
                            <th width="5%">No</th>
                            <th>Nama Alternatif</th>
                            <th width="20%">f(K+)</th>
                            <th width="20%">f(K-)</th>
                            <th width="20%">Ki</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatifs as $alternatif):
                            $id_alternatif = $alternatif->id_alternatif;
                        ?>
                        <tr align="center">
                            <td><?= $no; ?></td>
                            <td align="left"><?= $alternatif->nama ?></td>
                            <td><?= $nilai_fk_max[$id_alternatif] ?></td>
                            <td><?= $nilai_fk_min[$id_alternatif] ?></td>
                            <td class="font-weight-bold text-primary"><?= $nilai_ki[$id_alternatif] ?></td>
                        </tr>
                        <?php
                        $no++;
                        $hasil_akhir = [
                            'id_alternatif' => $id_alternatif,
                            'nilai' => $nilai_ki[$id_alternatif]
                        ];
                        $this->Perhitungan_model->insert_hasil($hasil_akhir);
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>