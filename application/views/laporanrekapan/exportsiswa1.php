<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=tagihan.xls");
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
    <h3>RINCIAN KEKURANGAN ADMINISTRASI KEUANGAN</h3><br>
    <h3>TAHUN PELAJARAN</h3>
</center>
<table border="1">
    <thead>
        <tr>
            <td>NISN</td>
            <td><?= $dataSiswa['nisn']; ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><?= $dataSiswa['nama_siswa']; ?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>
                <?php
                for ($i = 3; $i >= 1; $i--) {
                    if (!empty($dataSiswa['kelas_' . $i])) {
                        echo $dataSiswa['kelas_' . $i]['kode_kelas'];
                        break;
                    }
                }
                ?>
            </td>
        </tr>
</table>
<br>
<?php
$alphabet = ['10', '11', '12'];
?>

<?php
for ($i = 1; $i <= 3; $i++) {
    $total[$i] = 0;
    if (!empty($dataSiswa['kelas_' . $i])) {
?>
        <h4>Kelas <?= $alphabet[$i - 1]; ?></h4>
        <table border="1">
            <tbody>
                <?php if ($i == 1 && !empty($dataSiswa['kelas_1'])) : ?>
                    <tr>
                        <td>DPP</td>
                        <td><?= $dataSiswa['dpp']; ?></td>
                    </tr>
                <?php
                    $total[$i] += $dataSiswa['dpp'];
                endif;
                ?>
                <tr>
                    <td>Kelas</td>
                    <td><?= $dataSiswa['kelas_' . $i]['kode_kelas']; ?></td>
                </tr>
                <tr>
                    <td>Biaya SPP</td>
                    <td><?php $total[$i] += $dataSiswa['kelas_' . $i]['spp'];
                        echo $dataSiswa['kelas_' . $i]['spp']; ?></td>
                </tr>
                <tr>
                    <td>UTS ganjil</td>
                    <td><?php $total[$i] += $dataSiswa['kelas_' . $i]['uts1'];
                        echo $dataSiswa['kelas_' . $i]['uts1']; ?></td>
                </tr>
                <tr>
                    <td>UAS ganjil</td>
                    <td><?php $total[$i] += $dataSiswa['kelas_' . $i]['uas1'];
                        echo $dataSiswa['kelas_' . $i]['uas1']; ?></td>
                </tr>
                <tr>
                    <td>UTS genap</td>
                    <td><?php $total[$i] += $dataSiswa['kelas_' . $i]['uts2'];
                        echo $dataSiswa['kelas_' . $i]['uts2']; ?></td>
                </tr>
                <tr>
                    <td>UTS ganjil</td>
                    <td><?php $total[$i] += $dataSiswa['kelas_' . $i]['uas2'];
                        echo $dataSiswa['kelas_' . $i]['uas2']; ?></td>
                </tr>
                <?php if ($i == 3 && !empty($dataSiswa['kelas_3'])) : ?>
                    <tr>
                        <td>UNBK</td>
                        <td><?php $total[$i] += $dataSiswa['unbk'];
                            echo $dataSiswa['unbk']; ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td>Total Tanggungan Biaya Kelas <?= $alphabet[$i - 1]; ?></td>
                    <td><?= $total[$i]; ?></td>
                </tr>
            </tbody>
        </table>
        <br>
<?php
    }
}
?>
<table border="1">
    <?php
    $totalKeseluruhan = 0;
    for ($i = 1; $i <= 3; $i++) { ?>
        <tr>
            <td>Total Tanggungan Biaya Kelas <?= $alphabet[$i - 1] ?></td>
            <td><?= $total[$i] ?></td>
        </tr>
    <?php
        $totalKeseluruhan += $total[$i];
    } ?>
    <tr>
        <td>Tanggungan Biaya</td>
        <td><?= $totalKeseluruhan ?></td>
    </tr>
</table>