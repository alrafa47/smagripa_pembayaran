<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Jenis SPP</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item">Jenis SPP</li>
            <li class="breadcrumb-item active">Ubah Jenis Pembayaran</li>
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
            <h5 class="card-title">Ubah Data</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kode Jenis Pembayaran</label>
                      <input type="text" class="form-control disabled" name="kode_jenispembayaran" value="<?= $ubah['kode_jenispembayaran'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama Pembayaran Ujian</label>
                      <select class="form-control" name="nama_pembayaran">
                        <?php
                        if ($ubah['nama_pembayaran'] == 'UTS') {
                          echo "<option value = 'UTS' selected>UTS</option>
                          <option value ='UAS'>UAS</option>
                          <option value ='UNBK'>UNBK</option>";
                        } elseif ($ubah['nama_pembayaran'] == 'UAS') {
                          echo "<option value = 'UTS' >UTS</option>
                          <option value ='UAS' selected >UAS</option>
                          <option value ='UNBK'>UNBK</option>";
                        } else {
                          echo "<option value = 'UTS' >UTS</option>
                          <option value ='UAS' >UAS</option>
                          <option value ='UNBK' selected>UNBK</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nominal Pembayaran</label>
                      <input type="text" class="form-control" name="nominal" value="<?= $ubah['nominal'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Tahun</label>
                      <select class="form-control" name="kd_ta">
                        <?php
                        foreach ($tahunajaran as $value) {
                          $selected = '';
                          if ($ubah1['kode_ta'] == $value->kode_ta) {
                            $selected = 'selected';
                          }
                        ?>
                          <option value="<?php echo $value->kode_ta ?>" <?php echo $selected ?>>
                            <?php echo $value->tahun_ajaran ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Jumlah Pembayaran/Tahun</label>
                      <input type="number" class="form-control" name="jumlah_pembayaran" value="<?= $ubah['jumlah_pembayaran'] ?>">
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
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper