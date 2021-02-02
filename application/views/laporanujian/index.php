<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Ujian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Pembayaran Ujian</li>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <form action="<?= base_url('DataLaporanUjian') ?>" method="GET">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Tahun Ajaran</label>
                                                <select class="form-control" name="ta">
                                                    <option value="lihat_semua">Pilih tahun</option>
                                                    <?php
                                                    foreach ($tahunajaran as $row) {
                                                        $selected = '';
                                                        if ($this->input->get('ta') == $row->kode_ta) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                        <option value="<?= $row->kode_ta ?>" <?php echo set_select('kd_ta', $row->kode_ta); ?><?= $selected ?>><?= $row->tahun_ajaran ?></option>
                                                    <?php } ?>
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Kelas</label>
                                                <select class="form-control" name="kelas">
                                                    <option value="lihat_semua">Pilih kelas</option>
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
                            <a href="<?= base_url('DataLaporanUjian/export/') . $this->input->get('ta') . '/' . $this->input->get('kelas') ?>" class="btn btn-warning">Export</a>
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
                        <?php
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
                                if ($valuedataPembayaran->nisn ==  $nis && $valuedataPembayaran->nama_pembayaran == $jenisPembayaran) {
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
                        <table id="example1" class="table table-bordered table-striped responsive">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">NISN</th>
                                    <th rowspan="2">Nama Siswa</th>
                                    <th colspan="2">UTS</th>
                                    <th colspan="2">UAS</th>
                                    <?php
                                    $explode_kelas = explode('_', $this->input->get('kelas'));
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
                                        <?php
                                        if ($explode_kelas[0] == 'XII') :
                                            $sisaAngsuranPembayaranUnbk = dataPembayaranUNBK($dataPembayaran, $row->nisn, 'UNBK');
                                        ?>

                                            <td><?php
                                                if ($sisaAngsuranPembayaranUnbk == 0) {
                                                    echo 'lunas';
                                                } else {
                                                    echo $nominal_ujian = getNominal($jenisPembayaran, $konfigTagihanUjian->UNBK) / 12 * $sisaAngsuranPembayaranUnbk;
                                                    $total += $nominal_ujian;
                                                }
                                                ?></td>
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