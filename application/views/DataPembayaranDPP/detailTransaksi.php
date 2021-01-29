<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Pembayaran DPP <?= $nama_siswa ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Pembayaran DPP </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_dataPembayaranDPP')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_dataPembayaranDPP');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Detail Angsuran DPP</h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Angsuran Ke-</th>
                  <th>nominal Pembayaran</th>
                  <th>Tanggal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (empty($detailAngsuran)) {
                  echo "<tr><td colspan='5' style='text-align: center;'> belum ada pembayaran DPP</td></tr>";
                } else {
                  for ($i = 1; $i <= $jumlahAngsuran; $i++) {
                    if (in_array($i, array_column($detailAngsuran, 'angsuran'))) {
                      $key = array_search($i, array_column($detailAngsuran, 'angsuran'));
                ?>
                      <tr>
                        <td><?= $detailAngsuran[$key]->angsuran ?></td>
                        <td><?= $detailAngsuran[$key]->nominal_bayar ?></td>
                        <td><?= $detailAngsuran[$key]->tanggal ?></td>
                        <td>
                          <a href="<?= base_url() ?>DataPembayaranDPP/hapusDetailTransaksi/<?= $detailAngsuran[$key]->nisn ?>/<?= $detailAngsuran[$key]->no_transaksi ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus Transaksi</a>
                        </td>
                      </tr>
                <?php
                    } else {
                      echo "<tr><td colspan='5' style='text-align: center;'>belum ada pembayaran pada angsuran ke $i</td></tr>";
                    }
                  }
                }
                ?>
              </tbody>
            </table>
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
<!-- /.content-wrapper -->