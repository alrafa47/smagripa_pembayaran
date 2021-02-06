<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data DPP Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Data DPP Siswa</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_dppsiswa')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_dppsiswa');   ?>
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
              <h5 class="card-title">Tambah Data DPP Siswa</h5>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <?= validation_errors(); ?>
                  <form action="<?= base_url() ?>DataDPPSiswa/validation_form" method="post" accept-charset="utf-8">
                    <div class="card-body">
                      <!-- data Input Siswa -->
                      <h3>Data Siswa</h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">NISN</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="Nisn" value="<?php echo set_value('Nisn'); ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Nama Siswa</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="nm_siswa" value="<?php echo set_value('nm_siswa'); ?>">
                          </div>
                          <div class="form-group">

                            <label for="exampleInputPassword1">Jenis Kelamin</label>
                            <select class="form-control" name="jk_siswa">
                              <option>--Pilih Jenis kelamin--</option>
                              <option value="laki-laki" <?php echo  set_select('jk_siswa', 'laki-laki'); ?>>Laki-laki</option>
                              <option value="perempuan" <?php echo  set_select('jk_siswa', 'perempuan'); ?>>Perempuan</option>
                            </select>


                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Tempat Lahir</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="tmpt_lahir" value="<?php echo set_value('tmpt_lahir'); ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="exampleInputPassword1" name="tgl_lahir" value="<?php echo set_value('tgl_lahir'); ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Alamat</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="almat" value="<?php echo set_value('almat'); ?>">
                          </div>

                        </div>
                        <div class="col-md-6">


                          <div class="form-group">
                            <label for="exampleInputPassword1">No Telp</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="telp_siswa" value="<?php echo set_value('telp_siswa'); ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Tahun Masuk</label>
                            <select class="form-control" name="kd_ta">
                              <option>--Pilih Tahun Masuk--</option>
                              <?php

                              foreach ($tahunajaran as $row) { ?>
                                <option value="<?= $row->kode_ta ?>" <?php echo set_select('kd_ta', $row->kode_ta); ?>><?= $row->tahun_ajaran ?></option>
                              <?php } ?>
                            </select>

                          </div>

                          <!-- diambil dari tbl jurusan -->
                          <div class="form-group">
                            <label for="exampleInputPassword1">Jurusan</label>
                            <select class="form-control" name="jurusan" id="selectjurusan">
                              <option>--Pilih Jurusan--</option>
                              <?php
                              foreach ($jurusan as $jur) { ?>
                                <option value="<?= $jur->kode_jurusan ?>" <?php echo set_select('jurusan', $jur->kode_jurusan); ?>><?= $jur->nama_jurusan ?></option>
                              <?php } ?>
                            </select>

                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Kelas</label>
                            <select class="form-control" name="kode_kelas" id="selectkelas">
                              <option>--Pilih Kelas--</option>
                              <?php

                              foreach ($kelas as $row) { ?>
                                <option value="<?= $row->kode_kelas ?>" <?php echo set_select('kode_kelas', $row->kode_kelas); ?>><?= $row->kode_kelas ?></option>
                              <?php } ?>
                            </select>

                          </div>
                          <!-- diambil dari tbl jenis spp -->
                          <div class="form-group">
                            <label for="exampleInputPassword1">Jenis SPP</label>
                            <select class="form-control" name="jenis_spp">
                              <option>--Pilih Jenis SPP--</option>
                              <?php
                              foreach ($jenis_spp as $row) { ?>
                                <option value="<?= $row->kode_jenisspp  ?>" <?php echo set_select('jenis_spp', $row->kode_jenisspp); ?>><?= $row->kategori . "(" . $row->nominal_jenis . ")" ?></option>
                              <?php }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo set_value('password'); ?>">
                          </div>
                        </div>
                      </div>
                      <hr>
                      <!-- Data Input DPP -->
                      <h3>Data DPP</h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputPassword1">Nominal DPP</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="nmnl_dpp" value="<?php echo set_value('nmnl_dpp'); ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Jumlah Angsuran</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="jmlh_angsuran" value="<?php echo set_value('jmlh_angsuran'); ?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputPassword1">Status</label>
                            <select class="form-control" name="stts">
                              <option>--Pilih Status--</option>
                              <option value="0">Belum Lunas</option>
                              <option value="1">Lunas</option>
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
    <?php } ?>
    <!-- /.row -->
    <!-- list data -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- card-body -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NISN</th>
                  <th>Nama Siswa</th>
                  <th>Jenis Kelamin</th>
                  <th>No Telp</th>
                  <th>Jurusan</th>

                  <th>Action</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($dppsiswa1 as $row) { ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nisn ?></td>
                    <td><?= $row->nama_siswa ?></td>
                    <td><?= $row->jk ?></td>
                    <td><?= $row->no_telfon ?></td>
                    <td><?= $row->kode_jurusan ?></td>

                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailsiswa" data-nisn="<?= $row->nisn ?>">Detail Siswa</button>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#detailDPP" data-nisn="<?= $row->nisn ?>">Detail DPP</button>
                        <?php if ($this->session->userdata('level') == 'admin') { ?>
                          <a href="<?= base_url() ?>DataDPPSiswa/hapus/<?= $row->nisn ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                          <a href="<?= base_url() ?>DataDPPSiswa/ubah/<?= $row->nisn ?>" class="btn btn-warning">Update</a>
                        <?php } ?>
                      </div>
                    </td>

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
<!-- /.content-wrapper -->


<!-- modal detail siswa-->
<div class="modal fade" id="detailsiswa">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Data Siswa</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered no-margin">
          <thead>
            <tr>
              <th>NISN</th>
              <td id="nisn"></td>
            </tr>
            <tr>
              <th>Nama Siswa</th>
              <td id="nama_siswa"></td>
            </tr>
            <tr>
              <th>Password</th>
              <td id="password"></td>
            </tr>
            <tr>
              <th>Jenis Kelamin</th>
              <td id="jk"></td>
            </tr>
            <tr>
              <th>Tempat Lahir</th>
              <td id="tempat_lahir"></td>
            </tr>
            <tr>
              <th>Tanggal Lahir</th>
              <td id="tgl_lahir"></td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td id="alamat"></td>
            </tr>
            <tr>
              <th>No Telp</th>
              <td id="no_telfon"></td>
            </tr>
            <tr>
              <th>Tahun Ajaran</th>
              <td id="tahun_ajaran"></td>
            <tr>
              <th>Jurusan</th>
              <td id="jurusan"></td>
            </tr>
            <tr>
              <th>Kelas 1</th>
              <td id="kelas_1"></td>
            </tr>
            <tr>
              <th>Kelas 2</th>
              <td id="kelas_2"></td>
            </tr>
            <tr>
              <th>Kelas 3</th>
              <td id="kelas_3"></td>
            </tr>
            <tr>
              <th>Jenis SPP</th>
              <td id="jenis_spp"></td>
            </tr>
          </thead>
        </table>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- end modal detail siswa -->

<!-- modal detail dpp-->
<div class="modal fade" id="detailDPP">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Data DPP</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered no-margin">
          <thead>
            <tr>
              <th>NISN</th>
              <td id="nisn"></td>
            </tr>
            <tr>
              <th>Nominal DPP</th>
              <td id="nominal_dpp"></td>
            </tr>
            <tr>
              <th>Jumlah Angsuran</th>
              <td id="jumlah_angsuran"></td>
            </tr>
            <tr>
              <th>Nominal Angsuran</th>
              <td id="nominal_angsuran"></td>
            </tr>
            <tr>
              <th>Status</th>

              <td id="status"></td>
            </tr>

          </thead>
        </table>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>