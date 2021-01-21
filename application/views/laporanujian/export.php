<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=Data LaporanUjian.xls");
function dataPembayaranUTS_UAS($dataPembayaran, $nis, $jenisPembayaran, $keterangan)
{
    foreach ($dataPembayaran as $valuedataPembayaran) {
        if ($valuedataPembayaran->nisn ==  $nis && $valuedataPembayaran->kode_jenispembayaran == $jenisPembayaran && $valuedataPembayaran->keterangan == $keterangan) {
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
    <h3>LAPORAN KEUANGAN Ujian </h3>
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
        foreach ($this->Jenis_Pembayaran_Model->getAllData() as $value) {
            $dataJenisPembayaran[$value->kode_jenispembayaran] = $value->nominal;
        }
        foreach ($dataSiswa as $row) { ?>

            <tr>
                <td><?= $no ?></td>
                <td><?= $row->nisn ?></td>
                <td><?= $row->nama_siswa ?></td>
                <td><?= (dataPembayaranUTS_UAS($dataPembayaran, $row->nisn, 'uts', 1) == 'lunas') ? 'lunas' : $dataJenisPembayaran['uts'] ?></td>
                <td><?= (dataPembayaranUTS_UAS($dataPembayaran, $row->nisn, 'uts', 2) == 'lunas') ? 'lunas' : $dataJenisPembayaran['uts'] ?></td>
                <td><?= (dataPembayaranUTS_UAS($dataPembayaran, $row->nisn, 'uas', 1) == 'lunas') ? 'lunas' : $dataJenisPembayaran['uas'] ?></td>
                <td><?= (dataPembayaranUTS_UAS($dataPembayaran, $row->nisn, 'uas', 2) == 'lunas') ? 'lunas' : $dataJenisPembayaran['uas'] ?></td>
                <?php if ($explode_kelas[0] == 'XII') :
                    $sisaAngsuranPembayaranUnbk = dataPembayaranUNBK($dataPembayaran, $row->nisn, 'unbk');
                ?>

                    <td><?= ($sisaAngsuranPembayaranUnbk == 0) ? 'lunas' : $dataJenisPembayaran['unbk'] / 12 * $sisaAngsuranPembayaranUnbk ?></td>
                <?php endif; ?>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table>