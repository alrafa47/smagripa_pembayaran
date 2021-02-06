<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?= base_url() ?>assets/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Sistem Pembayaran</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url() ?>assets/dist/img/user1.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $this->session->userdata('username') ?> </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="<?= base_url() ?>Welcome" class="nav-link active">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard</i>
            </p>
          </a>
        </li>
        <?php if ($this->session->userdata('level') == 'admin') { ?>
          <li class="nav-item">
            <a href="<?= base_url() ?>DataUser" class="nav-link">
              <i class="fas fa-user-friends"></i>
              <p>
                Data User
              </p>
            </a>
          </li>
        <?php } ?>
        <!-- Data Jurusan  -->
        <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'petugas') { ?>
          <li class="nav-item">
            <a href="<?= base_url() ?>DataJurusan" class="nav-link">
              <i class="fas fa-shield-alt"></i>
              <p>
                Data Jurusan
              </p>
            </a>
          </li>
          <!-- Data Kelas -->
          <li class="nav-item">
            <a href="<?= base_url() ?>DataKelas" class="nav-link">
              <i class="fas fa-school"></i>
              <p>
                Data Kelas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url() ?>DataJenisSPP" class="nav-link">
              <i class="fas fa-list"></i>
              <p>
                Data Jenis SPP
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url() ?>DataJenisPembayaran" class="nav-link">
              <i class="fas fa-tags"></i>
              <p>
                Data Jenis Pembayaran Ujian
              </p>
            </a>
          </li>

          <!-- Data Tahun Ajaran -->
          <li class="nav-item">
            <a href="<?= base_url() ?>DataTahunAjaran" class="nav-link">
              <i class="fas fa-calendar-alt"></i>
              <p>
                Data Tahun Ajaran
              </p>
            </a>
          </li>
          <!-- Jenis SPP -->

          <!-- Data DPPSiswa-->
          <li class="nav-item">
            <a href="<?= base_url() ?>DataDPPSiswa" class="nav-link">
              <i class="fas fa-user-graduate"></i>
              <p>
                Data Siswa
              </p>
            </a>
          </li>
          <?php if ($this->session->userdata('level') == 'admin') { ?>
            <li class="nav-item">
              <a href="<?= base_url() ?>DataNaikKelas" class="nav-link">
                <i class="fas fa-university"></i>
                <p>
                  Kenaikan Kelas
                </p>
              </a>
            </li>
          <?php } ?>



          <!-- data pembayaran -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-dollar-sign"></i>
              <p> Transaksi Pembayaran <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url() ?>DataPembayaranDPP" class="nav-link">
                  <i class="fas fa-hand-holding-usd"></i>
                  <p>
                    Pembayaran DPP
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url() ?>DataPembayaranSPP" class="nav-link">
                  <i class="fas fa-hand-holding-usd"></i>
                  Pembayaran SPP
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url() ?>DataPembayaranUjian" class="nav-link">
                  <i class="fas fa-hand-holding-usd"></i>
                  <p>Pembayaran Ujian</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- data laporan -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-list-alt"></i>
              <p> Laporan Pembayaran <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url() ?>DataLaporan" class="nav-link">
                  <i class="fas fa-list-alt"></i>
                  Laporan DPP
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url() ?>DataLaporanSPP" class="nav-link">
                  <i class="fas fa-list-alt"></i>
                  <p>
                    Laporan SPP
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('DataLaporanUjian') ?>" class="nav-link">
                  <i class="fas fa-list-alt"></i>
                  <p>Laporan Ujian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url() ?>DataLaporanRekapan" class="nav-link">
                  <i class="fas fa-list-alt"></i>
                  <p>Rekapan Pembayaran</p>
                </a>
              </li>

            </ul>
          <li class="nav-item">
            <a href="<?= base_url() ?>DataLaporanPemasukan" class="nav-link">
              <i class="fas fa-hand-holding-usd"></i>
              <p>
                Data Laporan Pemasukan
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('level') == 'siswa') { ?>
          <li class="nav-item">
            <a href="<?= base_url() ?>DataLaporanRekapan/detail/<?= $this->session->userdata('id_user') ?>" class="nav-link">
              <i class="fas fa-hand-holding-usd"></i>
              <p>
                Tagihan Pembayaran
              </p>
            </a>
          </li>
        <?php } ?>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>