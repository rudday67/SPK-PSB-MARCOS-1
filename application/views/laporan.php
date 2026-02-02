<!DOCTYPE html>
<html>
<head>
    <title>Sistem Pendukung Keputusan Metode MARCOS</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
        padding: 8px; /* Tambahan agar lebih rapi saat dicetak */
    }
    h4 {
        text-align: center;
        text-transform: uppercase;
    }
</style>
<body>

<h4>Laporan Hasil Akhir Perankingan</h4>

<table border="1" width="100%">
    <thead>
        <tr align="center">
            <th width="5%">No</th>
            <th>Nama Alternatif</th>
            <th>Nilai Ki</th>
            <th width="15%">Rank SPK</th> <th width="15%">Rank Akhir</th> </tr>
    </thead>
    <tbody>
        <?php
            $no = 1;
            foreach ($hasil as $keys): ?>
        <tr align="center">
            <td><?= $no; ?></td>
            <td align="left"><?= $keys->nama ?></td>
            <td><?= round($keys->nilai, 4) ?></td> <td><?= $no; ?></td> 
            
            <td style="font-weight: bold;">
                <?= (!empty($keys->rank_pimpinan)) ? $keys->rank_pimpinan : $no; ?>
            </td>
        </tr>
        <?php
            $no++;
            endforeach ?>
    </tbody>
</table>

<script>
    window.print();
</script>
</body>
</html>