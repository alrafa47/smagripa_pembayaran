Content Wrapper. Contains page content -->
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
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
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
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">NISN</label>
                      <input type="text" class="form-control disabled" name="Nisn" value="<?= $ubah['nisn'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nominal DPP</label>
                      <input type="text" class="form-control" name="nmnl_dpp" value="<?= $ubah['nominal_dpp'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Jumlah Angsuran</label>
                      <input type="text" class="form-control" name="jmlh_angsuran" value="<?= $ubah['jumlah_angsuran'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nominal Angsuran</label>
                      <input type="text" class="form-control" name="nmnl_angsuran" value="<?= $ubah['nominal_angsuran'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Status</label>
                      <input type="text" class="form-control" name="stts" value="<?= $ubah['status'] ?>">
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