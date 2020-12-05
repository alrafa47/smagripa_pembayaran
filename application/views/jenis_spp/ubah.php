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
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Jenis SPP</li>
            <li class="breadcrumb-item active">Ubah Jenis SPP/li>
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
                      <label for="exampleInputEmail1">Kode Jenis SPP</label>
                      <input type="text" class="form-control disabled" name="kode_jenisspp" value="<?= $ubah['kode_jenisspp'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nominal Jenis</label>
                      <input type="text" class="form-control" name="nominal_jenis" value="<?= $ubah['nominal_jenis'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Kategori</label>
                      <select class="form-control" name="kategori">
                        <?php
                        if ($ubah['kategori'] == 'tingkat 1') {
                          echo "<option value = 'tingkat 1' selected>Tingkat 1</option>
                            <option value ='tingkat 2'>Tingkat 2</option>
                            <option value ='tingkat 3'>Tingkat 3</option>";
                        } elseif ($ubah['kategori'] == 'tingkat 2') {
                          echo "<option value = 'tingkat 1'>Tingkat 1</option>
                            <option value ='tingkat 2' selected>Tingkat 2</option>
                            <option value ='tingkat 3'>Tingkat 3</option>";
                        } else {
                          echo "<option value = 'tingkat 1'>Tingkat 1</option>
                            <option value ='tingkat 2'>Tingkat 2</option>
                            <option value ='tingkat 3' selected>Tingkat 3</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tahun</label>
                      <input type="text" class="form-control disabled" name="tahun" value="<?= $ubah['tahun'] ?>">
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