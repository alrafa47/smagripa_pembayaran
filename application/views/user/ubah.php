Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item">Data User</li>
            <li class="breadcrumb-item active">Ubah Data User</li>
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
                <form action="<?= base_url('DataUser/ubah/') . $ubah['id_user'] ?>" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control disable" id="username" name="username" value="<?= $ubah['username'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="pass">Password</label>
                      <input type="text" class="form-control" id="pass" name="pass" value="<?= $ubah['password'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="level">Admin</label>
                      <select class="form-control" name="level">
                        <?php
                        if ($ubah['level'] == 'admin') {
                          echo "<option value = 'admin' selected>Admin</option>
                          <option value ='petugas'>petugas</option>
                          <option value ='siswa'>Siswa</option>";
                        } elseif ($ubah['level'] == 'petugas') {
                          echo "<option value = 'admin' >Admin</option>
                          <option value ='petugas' selected>petugas</option>
                          <option value ='siswa'>Siswa</option>";
                        } else {
                          echo "<option value = 'admin' >Admin</option>
                          <option value ='petugas'>petugas</option>
                          <option value ='siswa'selected>Siswa</option>";
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
<!-- /.content-wrapper