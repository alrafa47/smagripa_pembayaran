<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Konfigurasi Ujian Tahun Ajaran <?= $tahunAjaran['tahun_ajaran'] ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
                        <li class="breadcrumb-item">Data Tahun Ajaran</li>
                        <li class="breadcrumb-item active">Konfigurasi Ujian Tahun Ajaran</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- tambah data -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Konfigurasi Ujian Tahun Ajaran <?= $tahunAjaran['tahun_ajaran'] ?></h5>
                        <?php if ($this->session->userdata('level') == 'admin') { ?>
                            <button id="ganti_konfigurasi" class="btn btn-s btn-primary float-right">Ganti Konfigurasi</button>
                        <?php } ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <?= validation_errors(); ?>
                                <form action="<?= base_url('DataTahunAjaran/insertKonfigUjian') ?>" method="post" accept-charset="utf-8">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tahun Ajaran</label>
                                            <input type="text" class="form-control disabled" value="<?= $tahunAjaran['tahun_ajaran'] ?>" readonly>
                                            <input type="hidden" class="form-control disabled" name="kd_ta" value="<?= $tahunAjaran['kode_ta'] ?>" readonly>
                                        </div>
                                        <?php
                                        foreach ($ujian as $valueUjian) :
                                        ?>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1"><?= $valueUjian ?></label>
                                                <select id="<?= $valueUjian ?>" name="<?= $valueUjian ?>" class="form-control" <?= $disabled ?>>
                                                    <?php foreach ($jenisPembayaran as $valueJenisPembayaran) :
                                                        $selected = '';
                                                        if ($valueUjian == $valueJenisPembayaran->nama_pembayaran) {
                                                            if ($valueJenisPembayaran->kode_jenispembayaran == $tagihan->$valueUjian) {
                                                                $selected = 'selected';
                                                            }
                                                            echo "<option value='$valueJenisPembayaran->kode_jenispembayaran' $selected >Rp. $valueJenisPembayaran->nominal</option>";
                                                        }
                                                    endforeach; ?>
                                                </select>
                                            </div>
                                        <?php endforeach; ?>
                                        <div>
                                            <input id="btn_save" type="submit" name="save" class="btn btn-primary" value="Save" <?= $disabled ?>>
                                        </div>
                                        <!-- /.card-body -->
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
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