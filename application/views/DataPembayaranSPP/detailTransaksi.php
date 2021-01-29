<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pembayaran SPP <?= $nama_siswa ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Pembayaran SPP</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        if ($this->session->flashdata('flash_dataPembayaranSPP')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6>
                    <i class="icon fas fa-check"></i>
                    Data Berhasil
                    <strong>
                        <?= $this->session->flashdata('flash_dataPembayaranSPP');   ?>
                    </strong>
                </h6>
            </div>
        <?php } ?>
        <?php
        function DataPembayaranSpp($pembayaranSPP, $ta, $bln)
        {
            foreach ($pembayaranSPP as $value) {
                if ($value->kode_ta == $ta && $value->bulan == $bln) {
                    return ['nominal' => $value->nominal, 'tanggal' => $value->tanggal, 'no_transaksi' => $value->no_transaksi];
                }
            }
            return ['nominal' => '-', 'tanggal' => '-', 'no_transaksi' => '-'];
        }
        $no = 1;
        foreach ($tahunAjaran as $keyTahunAjaran => $valueTahunAjaran) :
            if ($dataSiswa['kelas_' . $no] !== null) {
        ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h5 class="card-title">Angsuran SPP Tahun ajaran <?= $valueTahunAjaran->tahun_ajaran ?></h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <h3>Semester Ganjil</h3>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>nominal Pembayaran</th>
                                            <th>Tanggal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ganjil as $angkaBulan => $namaBulan) :
                                            $dataPembayaran = DataPembayaranSpp($pembayaran, $valueTahunAjaran->kode_ta, $angkaBulan);
                                        ?>
                                            <tr>
                                                <td><?= $namaBulan ?></td>
                                                <td><?= $dataPembayaran['nominal'] ?></td>
                                                <td><?= $dataPembayaran['tanggal'] ?></td>
                                                <td>
                                                    <?php if ($dataPembayaran['no_transaksi'] != '-') { ?>
                                                        <a href="<?= base_url() ?>DataPembayaranSPP/hapusDetailTransaksi/<?= $dataPembayaran['no_transaksi'] ?>/<?= $nisn ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus Transaksi</a>
                                                    <?php } else {
                                                        echo '-';
                                                    } ?>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <h3 class="mt-3">Semester Genap</h3>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>nominal Pembayaran</th>
                                            <th>Tanggal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($genap as $angkaBulan => $namaBulan) :
                                            $dataPembayaran = DataPembayaranSpp($pembayaran, $valueTahunAjaran->kode_ta, $angkaBulan);
                                        ?>
                                            <tr>
                                                <th><?= $namaBulan ?></th>
                                                <th><?= $dataPembayaran['nominal'] ?></th>
                                                <th><?= $dataPembayaran['tanggal'] ?></th>
                                                <td>
                                                    <?php if ($dataPembayaran['no_transaksi'] != '-') { ?>
                                                        <a href="<?= base_url() ?>DataPembayaranSPP/hapusDetailTransaksi/<?= $dataPembayaran['no_transaksi'] ?>/<?= $nisn ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus Transaksi</a>
                                                    <?php } else {
                                                        echo '-';
                                                    } ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- ./card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
        <?php
            }
            $no++;
        endforeach; ?>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->