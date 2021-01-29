<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=LaporanRekapan <?$kelass $ta.xls");
?>
<style type="text/css">
    body {
        font-family: sans-serif;
    }

    table {
        margin: 20px auto;
        border-collapse: collapse;
    }

    table th,
    table td {
        border: 1px solid #3c3c3c;
        padding: 3px 8px;

    }

    a {
        background: blue;
        color: #fff;
        padding: 8px 10px;
        text-decoration: none;
        border-radius: 2px;
    }
</style>
<center>
    <h3>REKAP TAGIHAN SISWA
        <br>Tahun Ajaran<?php echo "\n" .  $ta ?>
        <br>Kelas<?php echo "\n" . $kelass ?>
        </h5>
</center>
<table border="1">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">NISN</th>
            <th rowspan="2">Nama Siswa</th>
            <th rowspan="2">DPP</th>
            <th colspan="6">Kelas X</th>
            <th colspan="6">Kelas XI</th>
            <th colspan="6">Kelas XII</th>
            <th rowspan="2">UNBK</th>
        </tr>
        <tr>
            <!-- X -->
            <th>Kelas</th>
            <th>SPP</th>
            <th>UTS I</th>
            <th>UAS I</th>
            <th>UTS II</th>
            <th>UAS II</th>
            <!-- XI -->
            <th>Kelas</th>
            <th>SPP</th>
            <th>UTS I</th>
            <th>UAS I</th>
            <th>UTS II</th>
            <th>UAS II</th>
            <!-- XII -->
            <th>Kelas</th>
            <th>SPP</th>
            <th>UTS I</th>
            <th>UAS I</th>
            <th>UTS II</th>
            <th>UAS II</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        // print_r($dataSiswa);
        foreach ($dataSiswa as $row) { ?>

            <tr>
                <td><?= $no ?></td>
                <td><?= $row->nisn ?></td>
                <td><?= $row->nama_siswa ?></td>
                <td><?= $row->dpp ?></td>
                <?php for ($i = 1; $i <= 3; $i++) {
                    $kelas = 'kelas_' . $i ?>
                    <?php if (!empty($row->$kelas['kode_kelas'])) { ?>
                        <td><?= $row->$kelas['kode_kelas'] ?></td>
                        <td><?= $row->$kelas['spp'] ?></td>
                        <td><?= $row->$kelas['uts1'] ?></td>
                        <td><?= $row->$kelas['uas1'] ?></td>
                        <td><?= $row->$kelas['uts2'] ?></td>
                        <td><?= $row->$kelas['uas2'] ?></td>
                    <?php } else { ?>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    <?php } ?>
                <?php } ?>
                <td><?= (empty($row->unbk)) ? '-' : $row->unbk; ?></td>

            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table>