<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pembayaran Ujian <?= $nama_siswa ?></h1>
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
        if ($this->session->flashdata('flash_dataPembayaranUjian')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6>
                    <i class="icon fas fa-check"></i>
                    Data Berhasil
                    <strong>
                        <?= $this->session->flashdata('flash_dataPembayaranUjian');   ?>
                    </strong>
                </h6>
            </div>
        <?php } ?>
        <?php
        function DataPembayaranUjian($pembayaranUjian, $ta, $semester, $jenisUjian)
        {
            foreach ($pembayaranUjian as $value) {
                if ($value->tahunBayar == $ta && $value->keterangan == $semester && $value->nama_pembayaran == $jenisUjian) {
                    return ['nominal' => $value->nominal, 'tanggal' => $value->tanggal, 'no_transaksi' => $value->no_transaksi];
                }
            }
            return ['nominal' => '-', 'tanggal' => '-', 'no_transaksi' => '-'];
        }

        function DataPembayaranUjianUNBK($pembayaranUjian, $bulan)
        {
            foreach ($pembayaranUjian as $value) {
                if ($value->keterangan == $bulan && $value->nama_pembayaran == 'UNBK') {
                    return ['nominal' => $value->nominal, 'tanggal' => $value->tanggal, 'no_transaksi' => $value->no_transaksi];
                }
            }
            return ['nominal' => '-', 'tanggal' => '-', 'no_transaksi' => '-'];
        }
        $kls = 1;
        foreach ($tahunAjaran as $valueTahunAjaran) :
            if ($dataSiswa['kelas_' . $kls] !== null) {
        ?>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h5 class="card-title">Angsuran Ujian Tahun ajaran <?= $valueTahunAjaran->tahun_ajaran  ?></h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php
                                $semester = ['1' => 'Ganjil', '2' => 'Genap'];
                                $ujian = ['1' => 'UTS', '2' => 'UAS'];
                                foreach ($semester as $keySemester => $valueSemester) { ?>
                                    <h3>Semester <?= $valueSemester ?></h3>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Ujian</th>
                                                <th>nominal Pembayaran</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ujian as $valueujian) {
                                                $data = DataPembayaranUjian($pembayaranUjian, $valueTahunAjaran->kode_ta, $keySemester, $valueujian);
                                            ?>
                                                <tr>
                                                    <td><?= strtoupper($valueujian) ?></td>
                                                    <td><?= $data['nominal'] ?></td>
                                                    <td><?= $data['tanggal'] ?></td>
                                                    <td>
                                                        <?php if ($data['no_transaksi'] != '-') { ?>
                                                            <a href="<?= base_url() ?>DataPembayaranUjian/hapusDetailTransaksi/<?= $data['no_transaksi'] ?>/<?= $nisn ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus Transaksi</a>
                                                        <?php } else {
                                                            echo '-';
                                                        } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                <?php } ?>

                            </div>
                            <!-- ./card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
        <?php
            }
            $kls++;

        endforeach; ?>
        <!-- /.row -->
        <?php if ($dataSiswa['kelas_3'] !== null) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card collapsed-card">
                        <div class="card-header">
                            <h5 class="card-title">Pembayaran UNBK</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Angsuran Ke-</th>
                                        <th>nominal Pembayaran</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 1; $i <= 12; $i++) {
                                        $data = DataPembayaranUjianUNBK($pembayaranUjian, $i);
                                    ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $data['nominal'] ?></td>
                                            <td><?= $data['tanggal'] ?></td>
                                            <td>
                                                <?php if ($data['no_transaksi'] != '-') { ?>
                                                    <a href="<?= base_url() ?>DataPembayaranUjian/hapusDetailTransaksi/<?= $data['no_transaksi'] ?>/<?= $nisn ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus Transaksi</a>
                                                <?php } else {
                                                    echo '-';
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <!-- ./card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        <?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->