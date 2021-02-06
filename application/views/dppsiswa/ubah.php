<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item">Data Siswa</li>
            <li class="breadcrumb-item active">Ubah Data Siswa</li>
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
              <div class="col-md-12">
                <?= validation_errors(); ?>
                <form action="" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <h3>Update Data Siswa</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">NISN</label>
                          <input type="text" class="form-control " name="Nisn" value="<?= $ubah['nisn'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nama Siswa</label>
                          <input type="text" class="form-control" name="nm_siswa" value="<?= $ubah1['nama_siswa'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Jenis Kelamin</label>
                          <select class="form-control" name="jk_siswa">
                            <?php
                            if ($ubah1['jk'] == 'laki-laki') {
                              echo "<option value = 'laki-laki' selected>Laki-laki</option>
                          <option value ='perempuan'>Perempuan</option>";
                            } else {
                              echo "<option value = 'laki-laki'>Laki-laki</option>
                          <option value ='perempuan' selected>Perempuan</option>";
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Tempat Lahir</label>
                          <input type="text" class="form-control" name="tmpt_lahir" value="<?= $ubah1['tempat_lahir'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Tanggal Lahir</label>
                          <input type="date" class="form-control" name="tgl_lahir" value="<?= $ubah1['tgl_lahir'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Alamat</label>
                          <input type="text" class="form-control" name="almat" value="<?= $ubah1['alamat'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">No Telp</label>
                          <input type="text" class="form-control" name="telp_siswa" value="<?= $ubah1['no_telfon'] ?>">
                        </div>
                      </div>
                      <div class="col-md-6">


                        <div class="form-group">
                          <label for="exampleInputPassword1">Tahun Masuk</label>
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
                          <label for="exampleInputPassword1">Nama Jurusan</label>
                          <select class="form-control" name="jurusan">
                            <?php
                            foreach ($jurusan as $value) {
                              $selected = '';
                              if ($ubah1['kode_jurusan'] == $value->kode_jurusan) {
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
                          <label for="exampleInputPassword1">Kelas 1</label>
                          <select class="form-control" name="kelas_1">
                            <option value="">pilih kelas</option>
                            <?php
                            foreach ($kelas as $value) {
                              $selected = '';
                              if ($ubah1['kelas_1'] == $value->kode_kelas) {
                                $selected = 'selected';
                              }
                            ?>
                              <option value="<?php echo $value->kode_kelas ?>" <?php echo $selected ?>><?php echo $value->kode_kelas ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Kelas 2</label>
                          <select class="form-control" name="kelas_2">
                            <option value="">pilih kelas</option>
                            <?php
                            foreach ($kelas as $value) {
                              $selected = '';
                              if ($ubah1['kelas_2'] == $value->kode_kelas) {
                                $selected = 'selected';
                              }
                            ?>
                              <option value="<?php echo $value->kode_kelas ?>" <?php echo $selected ?>><?php echo $value->kode_kelas ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Kelas 3</label>
                          <select class="form-control" name="kelas_3">
                            <option value="">pilih kelas</option>
                            <?php
                            foreach ($kelas as $value) {
                              $selected = '';
                              if ($ubah1['kelas_3'] == $value->kode_kelas) {
                                $selected = 'selected';
                              }
                            ?>
                              <option value="<?php echo $value->kode_kelas ?>" <?php echo $selected ?>><?php echo $value->kode_kelas ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Jenis SPP</label>
                          <select class="form-control" name="jenis_spp">
                            <?php
                            foreach ($jenis_spp as $value) {
                              $selected = '';
                              if ($ubah1['kode_jenisspp'] == $value->kode_jenisspp) {
                                $selected = 'selected';
                              }
                            ?>
                              <option value="<?php echo $value->kode_jenisspp ?>" <?php echo $selected ?>><?php echo $value->kategori . "(" . $value->nominal_jenis . ")" ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="text" class="form-control" name="password" value="<?= $ubah1['password'] ?>">
                        </div>
                      </div>
                    </div>
                    <hr>
                    <!-- Data Input DPP -->
                    <h3> Update Data DPP</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nominal DPP</label>
                          <input type="text" class="form-control" name="nmnl_dpp" value="<?= $ubah['nominal_dpp'] ?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Jumlah Angsuran</label>
                          <input type="text" class="form-control" name="jmlh_angsuran" value="<?= $ubah['jumlah_angsuran'] ?>">
                        </div>
                      </div>
                      <div class="col-md-6">

                        <div class="form-group">
                          <label for="exampleInputPassword1">Status</label>
                          <select class="form-control" name="stts">
                            <?php
                            if ($ubah['status'] == '0') {
                              echo "<option value = '0' selected>Belum Lunas</option>
                          <option value ='1'>Lunas</option>";
                            } else {
                              echo "<option value = '0'>Belum Lunas</option>
                          <option value ='1' selected>Lunas</option>";
                            }
                            ?>
                          </select>
                        </div>

                      </div>
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