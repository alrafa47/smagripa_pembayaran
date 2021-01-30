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
                                                    foreach ($tahunajaran as $row) {
                                                        $selected = '';
                                                        if ($this->input->get('ta') == $row->kode_ta) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                        <option value="<?= $row->kode_ta ?>" <?= $selected ?>><?= $row->tahun_ajaran ?></option>
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
                                                    foreach ($kelas as $row) {
                                                        $selected = '';
                                                        if ($this->input->get('kelas') == $row->kode_kelas) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                        <option value="<?= $row->kode_kelas ?>" <?= $selected ?>><?= $row->kelas . ' ' . $row->nama_jurusan . ' ' . $row->nama_kelas ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <?php if ($this->input->get('kelas') !== null) : ?>
                                                <div class="form-group">
                                                    <label>Kelas Mendatang</label>
                                                    <select class="form-control" id="kelasmendatang">
                                                        <option value=" lihat_semua">Pilih kelas</option>
                                                        <?php
                                                        foreach ($kelas as $row) {
                                                            $explodeKelas = explode('_', $this->input->get('kelas'));
                                                            $explodeKelas2 = explode('_', $row->kode_kelas);
                                                            if ($explodeKelas[1] == $explodeKelas2[1]) {
                                                        ?>
                                                                <option value="<?= $row->kode_kelas ?>"><?= $row->kelas . ' ' . $row->nama_jurusan . ' ' . $row->nama_kelas ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <option value="lulus">Lulus</option>
                                                    </select>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <input type="submit" value="Cari Kelas" class="btn btn-primary">
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
                    <form action="<?= base_url('DataNaikKelas/naikTingkat/' . $this->input->get('ta') . '/' . $this->input->get('kelas')) ?>" method="post" id="naikkelas">

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
                                    <th>Kelulusan</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($datasiswa as $row) { ?>
                                    <tr>
                                        <input type="hidden" name="id[]" value="<?= $row->nisn ?>">
                                        <td><?= $no ?></td>
                                        <td><?= $row->nisn ?></td>
                                        <td><?= $row->nama_siswa ?></td>
                                        <td><?= $row->kode_jurusan ?></td>
                                        <td>
                                            <?php
                                            if ($row->kelas_1 != null || $row->kelas_1 != '') {
                                                echo $row->kelas_1;
                                            } else {
                                            ?>

                                                <select class="form-control opt-X" name="kelas_1[]">
                                                    <option value="">Pilih kelas</option>
                                                    <?php
                                                    foreach ($kelas as $valueKelas) {
                                                        $expKelas = explode('_', $valueKelas->kode_kelas);
                                                        if ($row->kode_jurusan == $expKelas[1] && 'X' == $expKelas[0]) {
                                                    ?>
                                                            <option data-kelas="<?= $valueKelas->kode_kelas ?>" value="<?= $row->nisn . '+' . $valueKelas->kode_kelas ?>"><?= $valueKelas->kelas . ' ' . $valueKelas->nama_jurusan . ' ' . $valueKelas->nama_kelas ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            <?php
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row->kelas_2 != null || $row->kelas_2 != '') {
                                                echo $row->kelas_2;
                                            } else {
                                            ?>
                                                <select class="form-control opt-XI" name="kelas_2[]">
                                                    <option value="">Pilih kelas</option>
                                                    <?php
                                                    foreach ($kelas as $valueKelas) {
                                                        $expKelas = explode('_', $valueKelas->kode_kelas);
                                                        if ($row->kode_jurusan == $expKelas[1] && 'XI' == $expKelas[0]) {
                                                    ?>
                                                            <option data-kelas="<?= $valueKelas->kode_kelas ?>" value="<?= $row->nisn . '+' . $valueKelas->kode_kelas ?>"><?= $valueKelas->kelas . ' ' . $valueKelas->nama_jurusan . ' ' . $valueKelas->nama_kelas ?></option>

                                                    <?php }
                                                    } ?>
                                                </select>
                                            <?php
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row->kelas_3 != null || $row->kelas_3 != '') {
                                                echo $row->kelas_3;
                                            } else {
                                            ?>
                                                <select class="form-control opt-XII" name="kelas_3[]">
                                                    <option value="">Pilih kelas</option>
                                                    <?php
                                                    foreach ($kelas as $valueKelas) {
                                                        $expKelas = explode('_', $valueKelas->kode_kelas);
                                                        if ($row->kode_jurusan == $expKelas[1] && 'XII' == $expKelas[0]) {
                                                    ?>
                                                            <option data-kelas="<?= $valueKelas->kode_kelas ?>" value="<?= $row->nisn . '+' . $valueKelas->kode_kelas ?>"><?= $valueKelas->kelas . ' ' . $valueKelas->nama_jurusan . ' ' . $valueKelas->nama_kelas ?></option>

                                                    <?php }
                                                    } ?>
                                                </select>
                                            <?php
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($row->tahun_keluar != null || $row->tahun_keluar != '') {
                                                foreach ($tahunajaran as $valueTahunAjaran) {
                                                    if ($row->tahun_keluar == $valueTahunAjaran->kode_ta) {
                                                        echo $valueTahunAjaran->tahun_ajaran;
                                                    }
                                                }
                                            } else {
                                                if (($row->kelas_3 != null || $row->kelas_3 != '') && ($row->kelas_2 != null || $row->kelas_2 != '') && ($row->kelas_1 != null || $row->kelas_1 != '')) {
                                            ?>
                                                    <input type="checkbox" name="kelulusan[]" value="<?= $row->nisn ?>">
                                            <?php
                                                }
                                            } ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <input form="naikkelas" type="submit" value="Simpan" class="btn btn-primary float-right">

                </div>
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