<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data Kelas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item">Data Kelas</li>
            <li class="breadcrumb-item active">Ubah Data Kelas</li>
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
                      <label for="exampleInputEmail1">Kode Kelas</label>
                      <input type="text" class="form-control disabled" name="kd_kelas" value="<?= $ubah['kode_kelas'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Kelas</label>
                      <select class="form-control" name="kelas">
                        <?php
                        if ($ubah['kelas'] == 'X') {
                          echo "<option value = 'X' selected>X</option>
                          <option value ='XI'>XI</option>
                          <option value ='XII'>XII</option>";
                        } elseif ($ubah['kelas'] == 'XI') {
                          echo "<option value = 'X'>X</option>
                          <option value ='XI' selected> XI </option>
                          <option value ='XII'> XII </option>";
                        } else {
                          echo "<option value = 'X'>X</option>
                          <option value ='XI'>XI</option>
                          <option value ='XII' selected> XII </option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama Jurusan</label>
                      <select class="form-control" name="kd_jur">
                        <?php
                        foreach ($jurusan as $value) {
                          $selected = '';
                          if ($ubah['kode_jurusan'] == $value->kode_jurusan) {
                            $selected = 'selected';
                          }
                        ?>
                          <option value="<?php echo $value->kode_jurusan ?>" <?php echo $selected ?>><?php echo $value->nama_jurusan ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama Kelas</label>
                      <select class="form-control" name="nm_kelas">
                        <?php
                        foreach (range('A', 'D') as $value) {
                          $selected = '';
                          if ($ubah['nama_kelas'] == $value) {
                            $selected = 'selected';
                          }
                        ?>
                          <option value="<?php echo $value ?>" <?php echo $selected ?>><?php echo $value ?></option>
                        <?php
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