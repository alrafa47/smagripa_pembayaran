<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=LaporanDPP <? $jurusan $tahun_awal - $tahun_akhir?>.xls");
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
    <h3>LAPORAN KEUANGAN DPP
        <br>Tahun Ajaran<?php echo "\n" .  $tahun_awal . " \n-\n " . $tahun_akhir ?>
        <br>Jurusan<?php echo "\n" . $jurusan ?>
    </h3>

</center>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Jumlah DPP</th>
            <th>Nominal Angsuran</th>
            <th>Jumlah Angsuran</th>
            <th>Terbayar</th>
            <th>Belum Terbayar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        function dataAngsuran($dataAngsuran, $nisn)
        {
            $jumlahTotalTerbayar = 0;
            foreach ($dataAngsuran as $valueAngsuran) {
                if ($valueAngsuran->nisn == $nisn) {
                    $jumlahTotalTerbayar += $valueAngsuran->nominal_bayar;
                }
            }
            return $jumlahTotalTerbayar;
        }
        foreach ($dataSiswa as $row) {
            $data = dataAngsuran($dataAngsuran, $row->nisn);
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row->nisn ?></td>
                <td><?= $row->nama_siswa ?></td>
                <td><?= $row->nominal_dpp ?></td>
                <td><?= $row->nominal_angsuran ?></td>
                <td><?= $row->jumlah_angsuran ?></td>
                <td><?= $data ?></td>
                <td><?= $row->nominal_dpp - $data ?></td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table>