<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan DPP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
                                    <select class="form-control" name="ta">
                                        <option value="lihat_semua">Pilih tahun</option>
                                        <?php
                                        foreach ($tahunajaran as $row) { ?>
                                            <option value="<?= $row->kode_ta ?>" <?php echo set_select('kd_ta', $row->kode_ta); ?>><?= $row->tahun_ajaran ?></option>
                                        <?php } ?>
                                        ?>

                                    </select>
                                    <select class="form-control" name="kelas">
                                        <option value="lihat_semua">Pilih kelas</option>
                                        <?php
                                        foreach ($kelas as $row) { ?>
                                            <option value="<?= $row->kode_kelas ?>"><?= $row->kelas . ' ' . $row->nama_jurusan . ' ' . $row->nama_kelas ?></option>
                                        <?php } ?>
                                        ?>

                                    </select>
                                    <div><button type="submit" class="btn btn-danger">Lihat</button></div>

                                </form>
                            </div>
                            <a href="<?= base_url('DataLaporan/export/') . $this->input->get('jurusan') . '/' . $this->input->get('tahun_awal') . '/' . $this->input->get('tahun_akhir') ?>" class="btn btn-warning">Export</a>
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
                    <?php
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
                    <table id="example1" class="table table-bordered table-striped">
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
                                    <td><?= (dataPembayaranUTS_UAS($dataPembayaran, $row->nisn, 'uas', 1) == 'lunas') ? 'lunas' : $dataJenisPembayaran['uas'] ?></td>
                                    <td><?= (dataPembayaranUTS_UAS($dataPembayaran, $row->nisn, 'uts', 2) == 'lunas') ? 'lunas' : $dataJenisPembayaran['uts'] ?></td>
                                    <td><?= (dataPembayaranUTS_UAS($dataPembayaran, $row->nisn, 'uas', 2) == 'lunas') ? 'lunas' : $dataJenisPembayaran['uas'] ?></td>
                                    <?php if ($explode_kelas[0] == 'XII') :
                                        $sisaAngsuranPembayaranUnbk = dataPembayaranUNBK($dataPembayaran, $row->nisn, 'unbk');
                                    ?>

                                        <td><?= ($sisaAngsuranPembayaranUnbk == 0) ? 'lunas' : $dataJenisPembayaran['unbk'] * $sisaAngsuranPembayaranUnbk ?></td>
                                    <?php endif; ?>

                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
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