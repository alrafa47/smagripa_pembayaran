<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data LaporanDPP.xls");
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
    <h3>LAPORAN PEMASUKAN </h3>


</center>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Jenis Pembayaran</th>
            <th>Keterangan</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($datasiswa as $row) { ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row->nisn ?></td>
                <td><?= $row->nama_siswa ?></td>
                <td><?= $row->kelas ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table>