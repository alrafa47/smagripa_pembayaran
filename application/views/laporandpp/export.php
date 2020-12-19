<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data JenisSPP.xls");
?>
<table id="example1" class="table table-bordered table-striped">
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