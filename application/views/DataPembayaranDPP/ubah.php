<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data DPP Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Data DPP Siswa</li>
            <li class="breadcrumb-item active">Ubah Data DPP Siswa</li>
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
          <?= validation_errors(); ?>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <form action="<?= base_url('DataPembayaranDPP/ubahData') ?>" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">NISN</label>
                      <input type="text" class="form-control disabled" name="Nisn" value="<?= $dataDPP->nisn ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Siswa</label>
                      <input type="text" class="form-control disabled" value="<?= $dataDPP->nama_siswa ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nominal DPP</label>
                      <input type="text" class="form-control" name="nmnl_dpp" value="<?= $dataDPP->nominal_dpp ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Jumlah Angsuran</label>
                      <input type="text" class="form-control" name="jmlh_angsuran" value="<?= $dataDPP->jumlah_angsuran ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nominal Angsuran</label>
                      <input type="text" class="form-control" name="nmnl_angsuran" value="<?= $dataDPP->nominal_angsuran ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Status</label>
                      <select class="form-control" name="stts">
                        <?php
                        if ($dataDPP->status == 0) {
                          echo "<option value='0' selected>Belum Lunas</option>";
                          echo "<option value='1'> Lunas</option>";
                        } else {
                          echo "<option value='0' >Belum Lunas</option>";
                          echo "<option value='1' selected> Lunas</option>";
                        }
                        ?>
                      </select>
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