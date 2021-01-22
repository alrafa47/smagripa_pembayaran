<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Pemasukan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Laporan Pemasukan</li>
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
                                <form action="<?= base_url('DataLaporanPemasukan') ?>" method="GET">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Tanggal Awal</label>
                                                <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal_awal">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Tanggal Akhir</label>
                                                <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal_akhir">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Total Pemasukan</label>
                                                <input type="text" class="form-control disable" id="exampleInputEmail1" name="total" readonly>
                                            </div>
                                        </div>
                                    </div>


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
                                <th>Tanggal</th>
                                <th>Jenis Pembayaran</th>
                                <th>Nominal</th>
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