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
            <th rowspan="2">Total Kekurangan</th>
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
    <tbody>
        <?php
        $no = 1;
        $totalKeseluruhan = 0;
        $dpp = 0;
        for ($i = 1; $i <= 3; $i++) {
            $spp[$i] = 0;
            $uts1[$i] = 0;
            $uas1[$i] = 0;
            $uts2[$i] = 0;
            $uas2[$i] = 0;
        }
        $unbk = 0;
        foreach ($dataSiswa as $row) {
            $total = 0;
        ?>

            <tr>
                <td><?= $no ?></td>
                <td><?= $row->nisn ?></td>
                <td><?= $row->nama_siswa ?></td>
                <td><?= $row->dpp;
                    $total += $row->dpp;
                    $dpp += $row->dpp; ?></td>
                <?php for ($i = 1; $i <= 3; $i++) {
                    $kelas = 'kelas_' . $i ?>
                    <?php if (!empty($row->$kelas['kode_kelas'])) { ?>
                        <td><?= $row->$kelas['kode_kelas'] ?></td>
                        <td><?php echo $row->$kelas['spp'];
                            $total += $row->$kelas['spp'];
                            $spp[$i] += $row->$kelas['spp'];
                            ?></td>
                        <td><?php echo $row->$kelas['uts1'];
                            $total += $row->$kelas['uts1'];
                            $uts1[$i] += $row->$kelas['uts1'];
                            ?></td>
                        <td><?php echo $row->$kelas['uas1'];
                            $total += $row->$kelas['uas1'];
                            $uas1[$i] += $row->$kelas['uas1'];
                            ?></td>
                        <td><?php echo $row->$kelas['uts2'];
                            $total += $row->$kelas['uts2'];
                            $uts2[$i] += $row->$kelas['uts2'];
                            ?></td>
                        <td><?php echo $row->$kelas['uas2'];
                            $total += $row->$kelas['uas2'];
                            $uas2[$i] += $row->$kelas['uas2'];
                            ?></td>
                    <?php } else { ?>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    <?php } ?>
                <?php } ?>
                <td><?php if (empty($row->unbk)) {
                        echo '-';
                    } else {
                        echo $row->unbk;
                        $total += $row->unbk;
                        $unbk += $row->unbk;
                    }
                    ?>
                </td>
                <td>
                    <?= $total ?>
                </td>

            </tr>
        <?php
            $no++;
            $totalKeseluruhan += $total;
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Total</td>
            <td><?= $dpp ?></td>
            <?php for ($i = 1; $i <= 3; $i++) { ?>
                <td>Total</td>
                <td><?= $spp[$i] ?></td>
                <td><?= $uts1[$i] ?></td>
                <td><?= $uas1[$i] ?></td>
                <td><?= $uts2[$i] ?></td>
                <td><?= $uas2[$i] ?></td>
            <?php } ?>

            <td><?= $unbk ?></td>
            <td><?= $totalKeseluruhan ?></td>
        </tr>
    </tfoot>
</table>