<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Jenis SPP</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Jenis SPP</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_jenis_spp')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_jenis_spp');   ?>
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
              <h5 class="card-title">Tambah Data Jenis SPP</h5>
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
                  <form action="<?= base_url() ?>DataJenisSpp/validation_form" method="post" accept-charset="utf-8">
                    <div class="card-body">
                      <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Kode Jenis SPP</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="kode_jenisspp">
                    </div> -->


                      <div class="form-group">
                        <label for="exampleInputPassword1">Tingkat</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="kategori">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nominal Jenis</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="nominal_jenis">
                      </div>
                      <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Tahun</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="tahun">
                    </div> -->

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
                  <th>Kode Jenis SPP</th>
                  <th>Nominal Jenis</th>
                  <th>Tingkat</th>
                  <?php if ($this->session->userdata('level') == 'admin') { ?>
                    <th>Action</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($jenis_spp as $row) { ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->kode_jenisspp ?></td>
                    <td><?= $row->nominal_jenis ?></td>
                    <td><?= $row->kategori ?></td>
                    <?php if ($this->session->userdata('level') == 'admin') { ?>
                      <td>
                        <div class="btn-group">
                          <a href="<?= base_url() ?>DataJenisSpp/hapus/<?= $row->kode_jenisspp ?>" class="btn btn-danger" onclick="return confirm('Apakah Anada Akan Menghapus Data Ini ?')">Hapus</a>
                          <a href="<?= base_url() ?>DataJenisSpp/ubah/<?= $row->kode_jenisspp ?>" class="btn btn-warning">update</a>
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