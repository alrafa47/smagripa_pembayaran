<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data spp Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Data spp Siswa</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
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
        <div id="dataDaftarTagihan"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button form="formSPP" type="submit" class="btn btn-primary">Simpan Pembayaran</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
<!-- end modal detail data -->