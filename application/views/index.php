<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="col-md-12">
        <center>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div>
                    <center>
                      <p></p>
                      <h1 style="font-family: 'Times New Roman', Times, serif;"><b>--SELAMAT DATANG <?= $this->session->userdata('username') ?>--</b></h1>
                      <h1 style="font-family: 'Times New Roman', Times, serif;"><b>di Sistem Informasi Pembayaran</b></h1>
                      <h2 style="font-family: 'Times New Roman', Times, serif;"><b>SMKS PGRI PAKISAJI</b></h2>
                      <p></p>
                    </center>

                  </div>

                </div>
              </div>
            </div>
          </div>
        </center>
      </div>
      <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas') { ?>
        <!-- Info boxes -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Pembayaran</h3>

                <p> DPP</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-graduate"></i>
              </div>
              <a href="<?= base_url('DataPembayaranDPP') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>Pembayaran</h3>

                <p> SPP</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-friends"></i>
              </div>
              <a href="<?= base_url('DataPembayaranSPP') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Pembayaran</h3>

                <p>UTS, UAS, UNBK</p>
              </div>
              <div class="icon">
                <i class="fas fa-list"></i>
              </div>
              <a href="<?= base_url('DataPembayaranUjian') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Laporan</h3>
                <p>Rekapan</p>
              </div>
              <div class="icon">
                <i class="fas fa-list-alt"></i>
              </div>
              <a href="<?= base_url('DataLaporanRekapan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      <?php } ?>


    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->