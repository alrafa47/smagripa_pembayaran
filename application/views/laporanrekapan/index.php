<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rekap Tagihan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Rekapan Pembayaran</li>
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
                                <form action="<?= base_url('DataLaporanRekapan') ?>" method="GET">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Tahun Ajaran</label>
                                                <select class="form-control" name="ta">
                                                    <option value="lihat_semua">Pilih tahun</option>
                                                    <?php
                                                    foreach ($tahunajaran as $row) { ?>
                                                        <option value="<?= $row->kode_ta ?>" <?php echo set_select('kd_ta', $row->kode_ta); ?>><?= $row->tahun_ajaran ?></option>
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
                                                    foreach ($kelas as $row) { ?>
                                                        <option value="<?= $row->kode_kelas ?>"><?= $row->kelas . ' ' . $row->nama_jurusan . ' ' . $row->nama_kelas ?></option>
                                                    <?php } ?>
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div><button type="submit" class="btn btn-danger">Lihat</button></div>
                                </form>
                            </div>
                            <a href="<?= base_url('DataLaporanRekapan/export/') . $this->input->get('ta') . '/' . $this->input->get('kelas')  ?>" class="btn btn-warning">Export</a>
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
                                    <th rowspan="2">DPP</th>
                                    <th colspan="6">Kelas X</th>
                                    <th colspan="6">Kelas XI</th>
                                    <th colspan="6">Kelas XII</th>
                                    <th rowspan="2">UNBK</th>
                                    <th rowspan="2">Action</th>
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
                                <?php
                                $no = 1;
                                // print_r($dataSiswa);
                                foreach ($dataSiswa as $row) { ?>

                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row->nisn ?></td>
                                        <td><?= $row->nama_siswa ?></td>
                                        <td><?= $row->dpp ?></td>
                                        <?php for ($i = 1; $i <= 3; $i++) {
                                            $kelas = 'kelas_' . $i ?>
                                            <td><?= $row->$kelas['kode_kelas'] ?></td>
                                            <td><?= $row->$kelas['spp'] ?></td>
                                            <td><?= $row->$kelas['uts1'] ?></td>
                                            <td><?= $row->$kelas['uas1'] ?></td>
                                            <td><?= $row->$kelas['uts2'] ?></td>
                                            <td><?= $row->$kelas['uas2'] ?></td>
                                        <?php } ?>
                                        <td><?= $row->unbk ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>DataLaporanRekapan/detail/<?= $row->nisn ?>" class="btn btn-warning">detail</a>
                                            <a href="<?= base_url() ?>DataLaporanRekapan/exportsiswa/<?= $row->nisn ?>" class="btn btn-primary">export</a>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
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