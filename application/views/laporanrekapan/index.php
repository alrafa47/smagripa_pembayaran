<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Rekapan</h1>
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
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Jurusan</label>
                                                <select class="form-control" name="jurusan">
                                                    <option value='lihat_semua'>lihat Semua</option>
                                                    <?php
                                                    foreach ($jurusan as $valueJurusan) {
                                                        echo "<option value='$valueJurusan->kode_jurusan'>$valueJurusan->nama_jurusan</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Tahun ajaran Awal</label>
                                                <select class="form-control" name="tahun_awal">
                                                    <?php
                                                    foreach ($dataTahunAjaran as $valueTahunAjaran) {
                                                        echo "<option value='$valueTahunAjaran->kode_ta'>$valueTahunAjaran->tahun_ajaran</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Tahun Ajaran Akhir</label>
                                                <select class="form-control" name="tahun_akhir">
                                                    <?php
                                                    foreach ($dataTahunAjaran as $valueTahunAjaran) {
                                                        echo "<option value='$valueTahunAjaran->kode_ta'>$valueTahunAjaran->tahun_ajaran</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">NISN</th>
                                <th rowspan="2">Nama Siswa</th>
                                <th rowspan="2">DPP</th>
                                <th colspan="5">Kelas</th>
                                <th rowspan="2">UNBK</th>
                                <th rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th>SPP</th>
                                <th>UTS ganjil</th>
                                <th>UTS genap</th>
                                <th>UAS ganjil</th>
                                <th>UAS genap</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($dataSiswa as $row) { ?>

                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->nisn ?></td>
                                    <td><?= $row->nama_siswa ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="<?= base_url() ?>DataLaporanRekapSiswa/detail/<?= $row->nisn ?>" class="btn btn-warning">detail</a>
                                    </td>

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