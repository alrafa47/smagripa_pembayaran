<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=LaporanUjian <?= $kelass $ta ?>.xls");
function dataPembayaranUTS_UAS($dataPembayaran, $nis, $jenisPembayaran, $keterangan)
{
    foreach ($dataPembayaran as $valuedataPembayaran) {
        if ($valuedataPembayaran->nisn ==  $nis && $valuedataPembayaran->nama_pembayaran == $jenisPembayaran && $valuedataPembayaran->keterangan == $keterangan) {
            return "lunas";
        }
    }
}

function dataPembayaranUNBK($dataPembayaran, $nis, $jenisPembayaran)
{
    $no = 0;
    foreach ($dataPembayaran as $valuedataPembayaran) {
        if ($valuedataPembayaran->nisn ==  $nis && $valuedataPembayaran->kode_jenispembayaran == $jenisPembayaran) {
            $no++;
        }
    }
    return 12 - $no;
}

function getNominal($jenisPembayaran, $kode_ta)
{
    $index  = array_search($kode_ta, array_column($jenisPembayaran, 'kode_jenispembayaran'));
    if (!$index) {
        return 'error';
    }
    return $jenisPembayaran[$index]->nominal;
}
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
    <h3>LAPORAN KEUANGAN UTS, UAS, UNBK
        <br>Tahun Ajaran<?php echo "\n" .  $ta ?>
        <br>Kelas<?php echo "\n" . $kelass ?>
    </h3>
</center>
<table border="1">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">NISN</th>
            <th rowspan="2">Nama Siswa</th>
            <th colspan="2">UTS</th>
            <th colspan="2">UAS</th>
            <?php
            $explode_kelas = explode('_', $this->uri->segment(4));
            if ($explode_kelas[0] == 'XII') : ?>
                <th rowspan="2">UNBK</th>
            <?php endif; ?>
            <th rowspan="2">Total</th>


        </tr>
        <tr>
            <th>UTS ganjil</th>
            <th>UTS genap</th>
            <th>UAS ganjil</th>
            <th>UAS genap</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $totalKeseluruhan = 0;
        foreach ($dataSiswa as $row) {
            $total = 0;
        ?>

            <tr>
                <td><?= $no ?></td>
                <td><?= $row->nisn ?></td>
                <td><?= $row->nama_siswa ?></td>
                <td>
                    <?php
                    if (dataPembayaranUTS_UAS($dataPembayaran, $row->nisn, 'UTS', 1) == 'lunas') {
                        echo 'lunas';
                    } else {
                        echo $nominal_ujian = getNominal($jenisPembayaran, $konfigTagihanUjian->UTS);
                        $total += $nominal_ujian;
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (dataPembayaranUTS_UAS($dataPembayaran, $row->nisn, 'UTS', 2) == 'lunas') {
                        echo 'lunas';
                    } else {
                        echo $nominal_ujian = getNominal($jenisPembayaran, $konfigTagihanUjian->UTS);
                        $total += $nominal_ujian;
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (dataPembayaranUTS_UAS($dataPembayaran, $row->nisn, 'UAS', 1) == 'lunas') {
                        echo 'lunas';
                    } else {
                        echo $nominal_ujian = getNominal($jenisPembayaran, $konfigTagihanUjian->UAS);
                        $total += $nominal_ujian;
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (dataPembayaranUTS_UAS($dataPembayaran, $row->nisn, 'UAS', 2) == 'lunas') {
                        echo 'lunas';
                    } else {
                        echo $nominal_ujian = getNominal($jenisPembayaran, $konfigTagihanUjian->UAS);
                        $total += $nominal_ujian;
                    }
                    ?>
                </td>
                <?php if ($explode_kelas[0] == 'XII') :
                    $sisaAngsuranPembayaranUnbk = dataPembayaranUNBK($dataPembayaran, $row->nisn, 'unbk');
                ?>

                    <td><?= ($sisaAngsuranPembayaranUnbk == 0) ? 'lunas' : $dataJenisPembayaran['unbk'] / 12 * $sisaAngsuranPembayaranUnbk ?></td>
                <?php endif; ?>
                <td><?= $total ?></td>
            </tr>
        <?php
            $totalKeseluruhan += $total;
            $no++;
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="<?= ($explode_kelas[0] == 'XII') ? 8 : 7; ?>">Total</td>
            <td><?= $totalKeseluruhan ?></td>
        </tr>
    </tfoot>
</table>