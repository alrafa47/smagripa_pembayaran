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
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Pembayaran Ujian</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- NOTIFIKASI -->
        <?php
        if ($this->session->flashdata('flash_siswa')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6>
                    <i class="icon fas fa-check"></i>
                    Data Berhasil
                    <strong>
                        <?= $this->session->flashdata('flash_siswa');   ?>
                    </strong>
                </h6>
            </div>
        <?php } ?>

        <!-- list data -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php $nisn = $this->uri->segment(3) ?>
                    <form action="<?= base_url('DataPembayaranUjian/tambahData/') . $nisn ?>">
                        <!-- card-body -->
                        <?php foreach ($tahunAjaran as  $valueTahunAjaran) : ?>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td colspan="3"><?= $valueTahunAjaran->tahun_ajaran ?></td>
                                    </tr>
                                    <tr>
                                        <td>+</td>
                                        <td>UTS</td>
                                        <td>UAS</td>
                                    </tr>
                                    <tr>
                                        <td>Semester 1</td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox" value="<?= $valueTahunAjaran->kode_ta - 1 ?>" name="uts[]">
                                                <label for="customCheckbox" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox" value="<?= $valueTahunAjaran->kode_ta - 1 ?>" name="uas[]">
                                                <label for="customCheckbox" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Semester 2</td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox" value="<?= $valueTahunAjaran->kode_ta - 2 ?>" name="uts[]">
                                                <label for="customCheckbox" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox" value="<?= $valueTahunAjaran->kode_ta - 2 ?>" name="uas[]">
                                                <label for="customCheckbox" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <?php endforeach; ?>
                        <!-- /.card-body -->
                        <!-- card-body -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td colspan="6">UNBK</td>
                                </tr>
                                <tr>
                                    <?php
                                    $bulan1 = array('juli', 'agustus', 'september', 'oktober', 'november', 'desember');
                                    foreach ($bulan1 as $bln) :
                                    ?>
                                        <td>
                                            <div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox" value="<?= $bln ?>" name="unbk[]">
                                                    <label for="customCheckbox" class="custom-control-label"><?= $bln ?></label>
                                                </div>
                                            </div>
                                        <?php
                                    endforeach
                                        ?>
                                        </td>
                                </tr>
                                <tr>
                                    <?php
                                    $bulan = array('januari', 'februari', 'maret', 'april', 'mei', 'juni');
                                    foreach ($bulan as $bln) :
                                    ?>
                                        <td>
                                            <div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="customCheckbox" value="<?= $bln ?>" name="unbk[]">
                                                    <label for="customCheckbox" class="custom-control-label"><?= $bln ?></label>
                                                </div>
                                            </div>
                                        <?php
                                    endforeach
                                        ?>
                                        </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </form>
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