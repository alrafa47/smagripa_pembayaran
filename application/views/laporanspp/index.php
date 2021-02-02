<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan SPP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data SPP</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.row -->
    <!-- list data -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card-body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <form action="<?= base_url('DataLaporanSPP') ?>" method="GET">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Tahun Ajaran</label>
                                                <select class="form-control" name="ta">
                                                    <option value="lihat_semua">Pilih Tahun</option>
                                                    <?php
                                                    foreach ($tahunajaran as $row) {
                                                        $selected = '';
                                                        if ($this->input->get('ta') == $row->kode_ta) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                        <option value="<?= $row->kode_ta ?>" <?php echo set_select('kd_ta', $row->kode_ta); ?> <?= $selected ?>><?= $row->tahun_ajaran ?></option>
                                                    <?php } ?>
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Kelas</label>
                                                <select class="form-control" name="kelas">
                                                    <option value="lihat_semua">Pilih Kelas</option>
                                                    <?php
                                                    foreach ($kelas as $row) {
                                                        $selected = '';
                                                        if ($this->input->get('kelas') == $row->kode_kelas) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                        <option value="<?= $row->kode_kelas ?>" <?= $selected ?>><?= $row->kelas . ' ' . $row->nama_jurusan . ' ' . $row->nama_kelas ?></option>
                                                    <?php } ?>
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div><button type="submit" class="btn btn-danger">Lihat</button></div>
                                </form>
                            </div>
                            <a href="<?= base_url('DataLaporanSPP/export/') . $this->input->get('ta') . '/' . $this->input->get('kelas') ?>" class="btn btn-warning">Export</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card-body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped responsive">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">NISN</th>
                                    <th rowspan="2">Nama Siswa</th>
                                    <th rowspan="2">Nominal Bayar</th>
                                    <th colspan="12">Bulan</th>
                                    <th rowspan="2">Kekurangan Pembayaran</th>
                                </tr>
                                <tr>
                                    <?php foreach ($bulan as $bln) : ?>
                                        <td>
                                            <label><?= $bln ?></label>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                function dataBayar($dataBayar, $nisn)
                                {
                                    $jumlahTotalTerbayar = 0;
                                    foreach ($dataBayar as $valueBayar) {
                                        if ($valueBayar->nisn == $nisn) {
                                            $jumlahTotalTerbayar += $valueBayar->nominal_bayar;
                                        }
                                    }
                                    return $jumlahTotalTerbayar;
                                }

                                function dataBayarPerBulan($dataPembayaran, $nisn, $bulan, $ta)
                                {
                                    foreach ($dataPembayaran as $valueBayar) {
                                        if ($valueBayar->nisn == $nisn && $bulan == $valueBayar->bulan && $ta == $valueBayar->ta_bayar) {
                                            return 'lunas';
                                        }
                                    }
                                    return '-';
                                }

                                $nisn = '';
                                $totalKeseluruhan = 0;
                                foreach ($dataSiswa as $row) {
                                    $total = 0;
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row->nisn ?></td>
                                        <td><?= $row->nama_siswa ?></td>
                                        <td><?= $row->nominal_jenis  ?></td>
                                        <?php foreach ($bulan as $keyBulan => $bln) : ?>
                                            <td>
                                                <label>
                                                    <?php
                                                    $dataBayar = dataBayarPerBulan($dataPembayaran, $row->nisn, $keyBulan, $this->input->get('ta'));
                                                    if ($dataBayar == '-') {
                                                        echo $row->nominal_jenis;
                                                        $total += $row->nominal_jenis;
                                                    } else {
                                                        echo $dataBayar;
                                                    }

                                                    ?>
                                                </label>
                                            </td>
                                        <?php endforeach; ?>
                                        <td><?= $total ?></td>
                                    </tr>
                                <?php
                                    $no++;
                                    $totalKeseluruhan += $total;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="16">Total</td>
                                    <td><?= $totalKeseluruhan ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper