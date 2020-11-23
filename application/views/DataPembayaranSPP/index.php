<<<<<<< HEAD
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
=======
<div class="content-wrapper">
>>>>>>> second commit
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
<<<<<<< HEAD
          <h1>Data Guru</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Guru</li>
=======
          <h1>Data spp Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Data spp Siswa</li>
>>>>>>> second commit
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
<<<<<<< HEAD
    <?php 
    if ($this->session->flashdata('flash_guru')){ ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i> 
          Data Berhasil 
          <strong>
            <?= $this->session->flashdata('flash_guru');   ?>
          </strong> 
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Tambah Data</h5>
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
                <form action="<?= base_url() ?>DataGuru/validation_form" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label >Kode Guru</label>
                      <input type="text" class="form-control" name="id_gur">
                    </div>
                    <div class="form-group">
                      <label >Nama Guru</label>
                      <input type="text" class="form-control" name="nama_gur">
                    </div>
                    <div class="form-group">
                      <label >Status</label>
                      <label class="radio-inline">
                        <input type="radio" name="optradio">Honorer</label>
                        <label class="radio-inline">
                          <input type="radio" name="optradio">Tetap</label>
                        </div>

                        <div class="form-group">
                          <label>Pendidikan Terkahir</label>
                          <select class="form-control" name="pendidikan_gur">
                            <option value="SMK">SMK/SMA Sederajad</option>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="S4">S4</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label >Nomor Telepon</label>
                          <input type="number" class="form-control" name="no_telp_gur">
                        </div>

                        <div class="form-group">
                          <label >Email</label>
                          <input type="email" class="form-control" name="email_gur">
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




        <!-- list data -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- card-body -->
              <div class="card-body">

                <nav>
                  <div class="nav nav-tabs" id="nav-tab">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab">Daftar Transaksi</a>
                    <a class="nav-item nav-link" id="nav-profil-tab" data-toggle="tab" href="#nav-profil" role="tab">Profil</a>
                    <a class="nav-item nav-link" id="nav-kontak-tab" data-toggle="tab" href="#nav-kontak" role="tab">Kontak</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                    <h4>Home</h4>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Guru</th>
                          <th>Status</th>
                          <th>Pendidikan terakhir</th>
                          <th>No.Telp</th>
                          <th>Email</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        foreach ($siswa as $row){ ?>
                          <tr>
                            <td><?= $no ?></td>
                            <td><?= $row->nama_guru?></td>
                            <td><?= $row->status ?></td>
                            <td><?= $row->pendidikan_terakhir ?></td>
                            <td><?= $row->no_telp ?></td>
                            <td><?= $row->email ?></td>
                            <td>
                              <a href="<?= base_url() ?>DataGuru/hapus/<?= $row->id_guru ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                            </td>
                          </tr>
                          <?php 
                          $no++;
                        } 
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="nav-profil" role="tabpanel">
                    <h4>Profil</h4>
                    <p>hai, Saya Diki.</p>
                  </div>
                  <div class="tab-pane fade" id="nav-kontak" role="tabpanel">
                    <h4>Kontak</h4>
                    <p>Email : malasngoding@gmail.com</p>
                  </div>
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
=======
    <?php
    if ($this->session->flashdata('flash_sppsiswa')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_sppsiswa');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
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
                  <th>Nama</th>
                  <th>Jurusan</th>
                  <th>Jenis</th>
                  <th>Nominal spp</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($dataSiswa as $row) { ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nisn ?></td>
                    <td><?= $row->nama_siswa ?></td>
                    <td><?= $row->kode_jurusan ?></td>
                    <td><?= $row->kategori ?></td>
                    <td><?= $row->nominal_jenis ?></td>
                    <td>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bayarSPP" data-nisn="<?= $row->nisn ?>">Bayar SPP</button>
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


<!-- modal detail data-->
<!-- Modal -->
<div class="modal fade " id="bayarSPP" tabindex="-1" aria-labelledby="bayarSPPLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bayarSPPLabel">Pembayaran SPP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table tabel-bordered">
          <tr>
            <td>NISN</td>
            <td>
              <div id="dataNISN"></div>
            </td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>
              <div id="dataNama"></div>
            </td>
          </tr>
          <tr>
            <td>Jurusan</td>
            <td>
              <div id="dataJurusan"></div>
            </td>
          </tr>
          <tr>
            <td>Jenis SPP</td>
            <td>
              <div id="dataJenisSPP"></div>
            </td>
          </tr>
          <tr>
            <td>Nominal SPP</td>
            <td>
              <div id="dataNominalSPP"></div>
            </td>
          </tr>
        </table>
        <form method="POST" action="<?= base_url() ?>DataPembayaranSPP/bayarSPP">
          <div id="dataDaftarTagihan"></div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
<!-- end modal detail data -->
>>>>>>> second commit
