<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Naik Kelas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Naik Kelas</li>
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
                                <form action="<?= base_url('DataNaikKelas') ?>" method="GET">
                                    <div class="row">
                                        <div class="col-3">
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
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Kelas Sekarang</label>
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
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Kelas Mendatang</label>
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
                                    <input type="submit" value="Cari Kelas">
                                </form>
                            </div>
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
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Jurusan</th>
                                <th>X</th>
                                <th>XI</th>
                                <th>XII</th>
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
                                    <td><?= $row->kode_jurusan ?></td>
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