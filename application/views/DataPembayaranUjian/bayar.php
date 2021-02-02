<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pembayaran Ujian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Pembayaran Ujian</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- NOTIFIKASI -->
        <?php
        if ($this->session->flashdata('flash_ujian')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6>
                    <i class="icon fas fa-check"></i>
                    Data Berhasil
                    <strong>
                        <?= $this->session->flashdata('flash_ujian');   ?>
                    </strong>
                </h6>
            </div>
        <?php } ?>

        <!-- list data -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php $nisn = $this->uri->segment(3); ?>
                        <form class="form" action="<?= base_url('DataPembayaranUjian/tambahData/') . $nisn ?>" method="POST">
                            <div class="form-group">
                                <label for="exampleInputFile">Tahun Ajaran :: Kelas</label>
                                <select class="form-control" name="tahunAjaran" id="tahunAjaran">
                                    <option value="-">Pilih Tahun Ajaran</option>
                                    <?php
                                    $no = 1;
                                    foreach ($tahunAjaran as $valueTahunAJaran) :
                                        if ($siswa['kelas_' . $no] !== null) {
                                    ?>
                                            <option data-tahun="<?= $valueTahunAJaran->kode_ta ?>" value="<?= $valueTahunAJaran->kode_ta . '-' . $siswa['kelas_' . $no] ?>" data-kelas='<?= $siswa['kelas_' . $no] ?>'><?= $valueTahunAJaran->tahun_ajaran . '::' . $siswa['kelas_' . $no] ?></option>
                                    <?php
                                        }
                                        $no++;
                                    endforeach; ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Jenis Pembayaran</label>
                                        <select class="form-control" disabled id="jenis_pembayaran">
                                            <option value="-">Pilih Pembayaran</option>
                                            <div id="jenisPembayaran"></div>
                                        </select>
                                        <input type="hidden" name="id_pembayaran" id="id_pembayaran" readonly>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Nominal</label>
                                        <input type="number" class="form-control" name="nominal" id="nominal" readonly>
                                    </div>
                                </div>
                            </div>
                            <div id="dataPembayaran"></div>
                            <button class="mt-5 btn btn-primary float-right btn-lg" type="submit">Bayar</button>
                        </form>
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
<!-- /.content-wrapper -->