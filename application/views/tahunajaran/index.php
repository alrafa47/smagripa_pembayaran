<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Tahun Ajaran</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Tahun Ajaran</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_tahunajaran')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_tahunajaran');   ?>
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
              <h5 class="card-title">Tambah Data Tahun Ajaran</h5>
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
                  <form action="<?= base_url() ?>DataTahunAjaran/validation_form" method="post" accept-charset="utf-8">
                    <div class="card-body">

                      <div class="form-group">
                        <label for="exampleInputPassword1">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="thn_ajaran">
                      </div>
                      <!-- <div class="form-group">
                      <label for="exampleInputPassword1">Semester</label>
                      <select class="form-control" name="smt">
                        <option>--Pilih Semester--</option>
                        <option value="ganjil">Ganjil</option>
                        <option value="genap">Genap</option>
                      </select>
                    </div> -->
                      <div class="form-group">
                        <label for="exampleInputPassword1">Status</label>
                        <select class="form-control" name="stts">
                          <option>--Pilih Status--</option>
                          <option value="aktif">Aktif</option>
                          <option value="tidak aktif">Tidak Aktif</option>
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
    <?php } ?>
    <!-- /.row -->
    <!-- list data -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- card-body -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped responsive">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Tahun Ajaran</th>
                    <th>Tahun Ajaran</th>
                    <th>Status</th>

                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($tahunajaran as $row) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $row->kode_ta ?></td>
                      <td><?= $row->tahun_ajaran ?></td>
                      <td><?= $row->status ?></td>


                      <td>
                        <div class="btn-group">
                          <?php if ($this->session->userdata('level') == 'admin') { ?>
                            <!-- <a href="<?= base_url() ?>DataTahunAjaran/hapus/<?= $row->kode_ta ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a> -->

                            <button data-ref="<?= base_url('DataTahunAjaran/hapus') ?>" data-id="<?= $row->kode_ta ?>" class="btn btn-danger hapus">Hapus</button>
                            <a href="<?= base_url() ?>DataTahunAjaran/ubah/<?= $row->kode_ta ?>" class="btn btn-warning">update</a>
                          <?php } ?>
                          <a href="<?= base_url() ?>DataTahunAjaran/konfigurasiUjian/<?= $row->kode_ta ?>" class="btn btn-primary">config Ujian</a>
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