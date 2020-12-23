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
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
                                    <select class="form-control" name="kode_ta">
                                        <option>Pilih tahun</option>
                                        <?php

                                        foreach ($tahunajaran as $row) { ?>
                                            <option value="<?= $row->kode_ta ?>" <?php echo set_select('kd_ta', $row->kode_ta); ?>><?= $row->tahun_ajaran ?></option>
                                        <?php } ?>
                                        ?>

                                    </select>
                                    <div><button type="submit" class="btn btn-danger">Lihat</button></div>

                                </form>
                            </div>
                            <a href="<?= base_url('DataLaporanSPP/export/') . $this->input->get('ta') ?>" class="btn btn-warning">Export</a>
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
                                <th>Nominal Bayar</th>
                                <th colspan="12">Bulan</th>
                            </tr>
                            <tr>
                                <td colspan="4">+</td>
                                <?php
                                $bulan = array('juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'januari', 'februari', 'maret', 'april', 'mei', 'juni');
                                foreach ($bulan as $bln) :
                                ?>
                                    <td>
                                        <label><?= $bln ?></label>
                                    <?php
                                endforeach
                                    ?>
                                    </td>
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
                            foreach ($dataspp as $row) {
                                // $data = dataBayar($dataBayar, $row->nisn);
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->nisn ?></td>
                                    <td><?= $row->nama_siswa ?></td>
                                    <td><?= $row->nominal_jenis  ?></td>
                                    <td> </td>


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