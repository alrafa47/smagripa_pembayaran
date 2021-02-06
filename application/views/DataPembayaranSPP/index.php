<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Pembayaran SPP</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
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
    if ($this->session->flashdata('flash_dataPembayaranSPP')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_dataPembayaranSPP');   ?>
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

                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bayarSPP" data-nisn="<?= $row->nisn ?>">Bayar SPP</button>
                      <a href="<?= base_url() ?>DataPembayaranSPP/detailTransaksi/<?= $row->nisn ?>" class="btn btn-danger">Detail Transaksi</a>
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
<form action="<?= base_url() ?>DataPembayaranSPP/insertData" method="post" accept-charset="utf-8">
  <div class="modal fade " id="bayarSPP" tabindex="-1" aria-labelledby="bayarSPPLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bayarSPPLabel">Pembayaran SPP</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('DataPembayaran/insertData') ?>" method="post">
          <div class="modal-body">
            <table class="table tabel-bordered">
              <tr>
                <td>NISN</td>
                <td>
                  <div id="dataNISN"></div>
                  <input type="hidden" id="NIS" value="" name="dataNISN">
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
                  <input type="hidden" id="jenisSpp" value="" name="jenisspp">

                </td>
              </tr>
              <tr>
                <td>Nominal SPP</td>
                <td>
                  <div id="dataNominalSPP"></div>
                  <input type="hidden" id="nominalspp" value="" name="nominal">
                </td>
              </tr>
              <!-- <tr>
                <td>Kelas</td>
                <td>
                  <div class="form-group">
                    <div id="selectKelas"></div>
                  </div>
                </td>
              </tr> -->
            </table>
            <div id="dataDaftarTagihan"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.modal -->
  <!-- end modal detail data -->