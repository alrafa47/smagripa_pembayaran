<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tagihan Siswa</h1>

                </div>
                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tagihan Siswa</li>
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

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card-body -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>NISN</th>
                            <td><?= $dataSiswa['nisn']; ?></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td><?= $dataSiswa['nama_siswa']; ?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>
                                <?php
                                for ($i = 3; $i >= 1; $i--) {
                                    if (!empty($dataSiswa['kelas_' . $i])) {
                                        echo $dataSiswa['kelas_' . $i]['kode_kelas'];
                                        break;
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <?php
                    $alphabet = ['10', '11', '12'];
                    ?>

                    <?php
                    for ($i = 1; $i <= 3; $i++) {
                        $total[$i] = 0;
                        if (!empty($dataSiswa['kelas_' . $i])) {
                    ?>
                            <h4>Kelas <?= $alphabet[$i - 1]; ?></h4>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <?php if ($i == 1 && !empty($dataSiswa['kelas_1'])) : ?>
                                        <tr>
                                            <th>DPP</th>
                                            <th><?= $dataSiswa['dpp']; ?></th>
                                        </tr>
                                    <?php
                                        $total[$i] += $dataSiswa['dpp'];
                                    endif;
                                    ?>
                                    <tr>
                                        <th>Kelas</th>
                                        <th><?= $dataSiswa['kelas_' . $i]['kode_kelas']; ?></th>
                                    </tr>
                                    <tr>
                                        <th>Biaya SPP</th>
                                        <th><?php $total[$i] += $dataSiswa['kelas_' . $i]['spp'];
                                            echo $dataSiswa['kelas_' . $i]['spp']; ?></th>
                                    </tr>
                                    <tr>
                                        <th>UTS ganjil</th>
                                        <th><?php $total[$i] += $dataSiswa['kelas_' . $i]['uts1'];
                                            echo $dataSiswa['kelas_' . $i]['uts1']; ?></th>
                                    </tr>
                                    <tr>
                                        <th>UAS ganjil</th>
                                        <td><?php $total[$i] += $dataSiswa['kelas_' . $i]['uas1'];
                                            echo $dataSiswa['kelas_' . $i]['uas1']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>UTS genap</th>
                                        <th><?php $total[$i] += $dataSiswa['kelas_' . $i]['uts2'];
                                            echo $dataSiswa['kelas_' . $i]['uts2']; ?></th>
                                    </tr>
                                    <tr>
                                        <th>UTS ganjil</th>
                                        <th><?php $total[$i] += $dataSiswa['kelas_' . $i]['uas2'];
                                            echo $dataSiswa['kelas_' . $i]['uas2']; ?></th>
                                    </tr>
                                    <?php if ($i == 3 && !empty($dataSiswa['kelas_3'])) : ?>
                                        <tr>
                                            <th>UNBK</th>
                                            <th><?php $total[$i] += $dataSiswa['unbk'];
                                                echo $dataSiswa['unbk']; ?></th>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th>Total Tanggungan Biaya Kelas <?= $alphabet[$i - 1]; ?></th>
                                        <th><?= $total[$i]; ?></th>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                    <?php
                        }
                    }
                    ?>
                    <table class="table table-bordered table-striped">
                        <?php
                        $totalKeseluruhan = 0;
                        for ($i = 1; $i <= 3; $i++) { ?>
                            <tr>
                                <td>Total Tanggungan Biaya Kelas <?= $alphabet[$i - 1] ?></td>
                                <td><?= $total[$i] ?></td>
                            </tr>
                        <?php
                            $totalKeseluruhan += $total[$i];
                        } ?>
                        <tr>
                            <td>Tanggungan Biaya</td>
                            <td><?= $totalKeseluruhan ?></td>
                        </tr>
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