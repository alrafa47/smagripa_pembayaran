<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Jenis Pembayaran Ujian</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Jenis Pembayaran Ujian</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_jenis_pembayaran')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_jenis_pembayaran');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->
    <?php if ($this->session->userdata('level') == 'admin') { ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Tambah Data Jenis Pembayaran</h5>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <?= validation_errors(); ?>
                  <form action="<?= base_url() ?>DataJenisPembayaran/validation_form" method="post" accept-charset="utf-8">
                    <div class="card-body">
                      <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Kode Jenis Pembayaran</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="kode_jenispembayaran">
                    </div> -->
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nama Pembayaran Ujian</label>
                        <select class="form-control" name="nama_pembayaran">
                          <option>--Pilih Pembayaran--</option>
                          <option value="UTS">UTS</option>
                          <option value="UAS">UAS</option>
                          <option value="UNBK">UNBK</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nominal Pembayaran</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="nominal">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Tahun Berlaku </label>
                        <select class="form-control" name="kd_ta">
                          <option>--Pilih Tahun--</option>
                          <?php

                          foreach ($tahunajaran as $row) { ?>
                            <option value="<?= $row->kode_ta ?>" <?php echo set_select('kd_ta', $row->kode_ta); ?>><?= $row->tahun_ajaran ?></option>
                          <?php } ?>
                        </select>

                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Jumlah Pembayaran/Tahun </label>
                        <input type="number" class="form-control" id="exampleInputPassword1" name="jumlah_pembayaran">
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save">
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
    <?php } ?>
    <!-- /.row -->
    <!-- list data -->
    <?= validation_errors(); ?>
    <form action="<?= base_url() ?>DataPembayaranSPP/validation_form" method="post" accept-charset="utf-8">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- card-body -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Jenis Pembayaran</th>
                    <th>Nama Pembayaran</th>
                    <th>Nominal Jenis</th>
                    <th>Tahun</th>
                    <th>Jumlah Pembayaran Pertahun</th>
                    <?php if ($this->session->userdata('level') == 'admin') { ?>
                      <th>Action</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($jenis_pembayaran as $row) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $row->kode_jenispembayaran ?></td>
                      <td><?= $row->nama_pembayaran ?></td>
                      <td><?= $row->nominal ?></td>
                      <td><?= $row->tahun_ajaran ?></td>
                      <td><?= $row->jumlah_pembayaran ?></td>
                      <?php if ($this->session->userdata('level') == 'admin') { ?>
                        <td>
                          <div class="btn-group">
                            <a href="<?= base_url() ?>DataJenisPembayaran/hapus/<?= $row->kode_jenispembayaran ?>" class="btn btn-danger" onclick="return confirm('Apakah Anada Akan Menghapus Data Ini ?')">Hapus</a>
                            <a href="<?= base_url() ?>DataJenisPembayaran/ubah/<?= $row->kode_jenispembayaran ?>" class="btn btn-warning">update</a>
                          </div>
                        </td>
                      <?php } ?>
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