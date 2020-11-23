<<<<<<< HEAD

Content Wrapper. Contains page content -->
=======
>>>>>>> second commit
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data DPP Siswa</h1>
<<<<<<< HEAD
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
    if ($this->session->flashdata('flash_dppsiswa')){ ?>
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="Nisn">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nama Siswa</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="nm_siswa">
                        </div>
                        <div class="form-group">
                          <label>Jenis Kelamin</label>
                          <div class="radio">
                            <label>
                              <input type="radio" class="form-group" value="laki-laki" placeholder="laki-laki" name="jk_siswa">Laki-laki
                            </label>
                            <label>
                              <input type="radio" class="form-group" value="perempuan" name="jk_siswa" placeholder="perempuan">
                              Perempuan
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Tempat Lahir</label>                  
                          <input type="text" class="form-control" id="exampleInputPassword1" name="tmpt_lahir">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Tanggal Lahir</label>
                          <input type="date" class="form-control" id="exampleInputPassword1" name="tgl_lahir">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Alamat</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="almat">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputPassword1">No Telp</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="telp_siswa">
                        </div>
                        <!-- diambil dari tbl jurusan -->
                        <div class="form-group">
                          <label for="exampleInputPassword1">jurusan</label>
                          <select class="form-control" name="jurusan">

                            <?php 
                            foreach ($jurusan as $jur) { ?>
                              <option value="<?= $jur->kode_jurusan?>"><?= $jur->nama_jurusan ?></option>
                            <?php } ?>
                          </select>

                        </div>             
                        <!-- diambil dari tbl jenis spp -->             
                        <div class="form-group">
                          <label for="exampleInputPassword1">Jenis SPP</label>
                          <select class="form-control" name="jenis_spp">
                            <?php 
                            foreach ($jenis_spp as $row) { ?>
                              <option value="<?= $row->kode_jenisspp  ?>"><?= $row->kategori."(".$row->nominal_jenis.")" ?></option>
                            <?php }
                            ?>
                          </select>
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
                          <input type="text" class="form-control" id="exampleInputPassword1" name="nmnl_dpp">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Jumlah Angsuran</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="jmlh_angsuran">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nominal Angsuran</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="nmnl_angsuran">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Status</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="stts">
                        </div>
                      </div>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save">
                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
              <div class="col-md-6">

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
                  <!-- <th>Nama Siswa</th> -->
                  <th>Nominal DPP</th>
                  <th>Jumlah Angsuran</th>
                  <th>Nominal Angsuran</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no=1;
                foreach ($dppsiswa as $row){ ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nisn ?></td>
                    <!-- <td><?= $row->nama_siswa ?></td> -->
                    <td><?= $row->nominal_dpp ?></td>
                    <td><?= $row->jumlah_angsuran ?></td>
                    <td><?= $row->nominal_angsuran ?></td>
                    <td><?= $row->status ?></td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" class="view_data" data-toggle="modal" id="myModal"  data-id="<?= $row->nisn ?>">Detail Data</button>
                        <a href="<?= base_url() ?>DataDPPSiswa/hapus/<?= $row->nisn ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                        <a href="<?= base_url() ?>DataDPPSiswa/ubah/<?= $row->nisn ?>" class="btn btn-warning">update</a>
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
=======
     </div>
     <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
                <select class="form-control" name="jk_siswa" >
                  <option >--Pilih Jenis kelamin--</option>
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

 </div>
 <div class="col-md-6">

     <div class="form-group">
      <label for="exampleInputPassword1">Alamat</label>
      <input type="text" class="form-control" id="exampleInputPassword1" name="almat" value="<?php echo set_value('almat'); ?>">
 </div>
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
 <select class="form-control" name="jurusan">
   <option>--Pilih Jurusan--</option>
   <?php
   foreach ($jurusan as $jur) { ?>
     <option value="<?= $jur->kode_jurusan ?>" <?php echo set_select('jurusan', $jur->kode_jurusan); ?>><?= $jur->nama_jurusan ?></option>
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
      <label for="exampleInputPassword1">Nominal Angsuran</label>
      <input type="text" class="form-control" id="exampleInputPassword1" name="nmnl_angsuran" value="<?php echo set_value('nmnl_angsuran'); ?>">
 </div>
 <div class="form-group">
      <label for="exampleInputPassword1">Status</label>
      <select class="form-control" name="stts">
          <option>--Pilih Status--</option>
          <option value="belum lunas">Belum Lunas</option>
          <option value="lunas">Lunas</option>
     </select>
</div>
</div>
</div>
<input type="submit" name="save" class="btn btn-primary" value="Save">
</div>
<!-- /.card-body -->
</form>
</div>
<div class="col-md-6">

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
             <!-- <th>Nama Siswa</th> -->
             <th>Nominal DPP</th>
             <th>Jumlah Angsuran</th>
             <th>Nominal Angsuran</th>
             <th>Status</th>
             <th>Action</th>
        </tr>
   </thead>
   <tbody>
      <?php
      $no = 1;
      foreach ($dppsiswa as $row) { ?>
        <tr>
          <td><?= $no ?></td>
          <td><?= $row->nisn ?></td>
          <td><?= $row->nominal_dpp ?></td>
          <td><?= $row->jumlah_angsuran ?></td>
          <td><?= $row->nominal_angsuran ?></td>
          <td><?= $row->status ?></td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-primary" class="view_data" data-toggle="modal" id="myModal" data-id="<?= $row->nisn ?>">Detail Data</button>
              <a href="<?= base_url() ?>DataDPPSiswa/hapus/<?= $row->nisn ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
              <a href="<?= base_url() ?>DataDPPSiswa/ubah/<?= $row->nisn ?>" class="btn btn-warning">update</a>
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
>>>>>>> second commit
</div>
<!-- /.content-wrapper -->


<!-- modal detail data-->
<div class="modal fade" id="phoneModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Data Siswa</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
<<<<<<< HEAD
        </button>
      </div>
      <div class="modal-body">
        <?php foreach ($detail_siswa as $row): ?>
          <p><?= $no ?></p>
          <p><?= $row->nisn ?></p>
          <p><?= $row->nama_siswa ?></p>
          <p><?= $row->nominal_dpp ?></p>
          <p><?= $row->jumlah_angsuran ?></p>
          <p><?= $row->nominal_angsuran ?></p>
          <p><?= $row->status ?></p>
        <?php endforeach ?>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
=======
     </button>
</div>
<div class="modal-body">
   <?php foreach ($detail_siswa as $row) : ?>
     <p><?= $no ?></p>
     <p><?= $row->nisn ?></p>
     <p><?= $row->nama_siswa ?></p>
     <p><?= $row->nominal_dpp ?></p>
     <p><?= $row->jumlah_angsuran ?></p>
     <p><?= $row->nominal_angsuran ?></p>
     <p><?= $row->status ?></p>
<?php endforeach ?>
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
>>>>>>> second commit
</div>
<!-- /.modal -->
<!-- end modal detail data -->