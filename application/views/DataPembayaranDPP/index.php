<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Pembayaran DPP</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Pembayaran DPP</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_dataPembayaranDPP')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_dataPembayaranDPP');   ?>
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
              <div class="col-md-12">
                <form action="<?= base_url() ?>DataPembayaranDPP/insertData" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8">

                        <div class="form-group">
                          <label>NISN</label>
                          <select class="form-control select2bs4" name="nisnSiswa" id="SiswaBelumLunas" style="width: 100%;">
                            <option selected>Pilih Siswa</option>
                            <?php foreach ($siswaBelumLunas as $dataBelumLunas) : ?>
                              <option value="<?= $dataBelumLunas->nisn ?>"><?= '(' . $dataBelumLunas->nisn . ')' . $dataBelumLunas->nama_siswa ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Jurusan</label>
                          <input type="text" id="jurusan_kelas" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                          <label>Kelas</label>
                          <input type="text" id="kelas" class="form-control" name="kelas" readonly>
                        </div>
                        <div class="form-group">
                          <label>Jumlah Angsuran</label>
                          <input type="text" class="form-control" id="jumlahAngsuran" readonly>
                        </div>
                        <div class="form-group">
                          <label>Nominal</label>
                          <input type="text" class="form-control" id="nominal" readonly>
                        </div>
                        <div class="form-group">
                          <label>Nominal Angsuran</label>
                          <input type="text" class="form-control" name="nominalAngsuran" id="nominalAngsuran" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row col-12">
                      <div id="DetailPembaryaran">
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" id="btnSaveAngsuran" name="save" class="btn btn-primary" value="Save" disabled>
                    </div>
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
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NISN</th>
                  <th>Nama Siswa</th>
                  <th>Jurusan</th>
                  <th>Total DPP</th>
                  <th>Jumlah Anguran</th>
                  <th>Nominal Angsuran</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($dataDPP as $row) { ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nisn ?></td>
                    <td><?= $row->nama_siswa ?></td>
                    <td><?= $row->nama_jurusan ?></td>
                    <td><?= $row->nominal_dpp ?></td>
                    <td><?= $row->jumlah_angsuran ?></td>
                    <td><?= $row->nominal_angsuran ?></td>
                    <td><?= ($row->status == 0) ? 'Belum Lunas' : 'Lunas'; ?></td>
                    <td>
                      <a href="<?= base_url() ?>DataPembayaranDPP/detailTransaksi/<?= $row->nisn ?>" class="btn btn-primary">Detail Transaksi</a>
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