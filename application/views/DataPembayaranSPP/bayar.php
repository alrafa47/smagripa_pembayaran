 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1>Bayar SPP</h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="Welcome">Dashboard</a></li>
             <li class="breadcrumb-item active">Bayar SPP</li>
           </ol>
         </div>
       </div>
     </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
     <!-- NOTIFIKASI -->
     <?php
      if ($this->session->flashdata('flash_guru')) { ?>
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
             <!-- <h5 class="card-title">Bayar SPP</h5> -->
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
                 <form action="<?= base_url() ?>DataPembayaranSPP/validation_form" method="post" accept-charset="utf-8">
                   <div class="card-body">
                     <div class="row">
                       <div class="col-md-6">
                         <div class="form-group">
                           <label>Tanggal</label>
                           <input type="date" name="tgl_spp" class="form-control" value="">
                         </div>
                       </div>
                     </div>
                     <div class="row">
                       <div class="col-md-6">
                         <div class="form-group">
                           <label>NISN</label>
                           <select class="form-control select2bs4" style="width: 100%;">
                             <option>Pilih NISN</option>
                             <?php foreach ($siswa as $sw) : ?>
                               <option value="<?= $sw->nisn ?>"><?= $sw->nisn . "(" . $sw->nama_siswa . ")" ?></option>
                             <?php endforeach ?>
                           </select>
                         </div>
                         <div class="form-group">
                           <label>Kelas</label>
                           <select class="form-control">
                             <?php foreach ($kelas as $kls) : ?>
                               <option value="<?= $kls->kode_kelas ?>">
                                 <?= $kls->kode_kelas ?>
                               </option>
                             <?php endforeach ?>
                           </select>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                           <label>Tahun Ajaran</label>
                           <select class="form-control">
                             <option>option 1</option>
                             <option>option 2</option>
                             <option>option 3</option>
                             <option>option 4</option>
                             <option>option 5</option>
                           </select>
                         </div>
                         <div class="form-group">
                           <label>Jenis SPP</label>
                           <select class="form-control">
                             <?php foreach ($JenisSpp as $jns) : ?>
                               <option value="<?= $jns->kode_jenisspp ?>">
                                 <?= $jns->kategori . " (Rp. " . $jns->nominal_jenis . ")" ?>
                               </option>
                             <?php endforeach ?>
                           </select>
                         </div>
                       </div>
                     </div>
                     <div class="col-md-12">
                       <div class="form-group">
                         <label>Bulan Pembayaran</label>
                         <div class="row">
                           <?php
                            $tahun = 1;
                            $bulan = array();
                            switch ($tahun) {
                              case 1:
                                $bulan = array('januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember');
                                break;
                            }
                            $no = 1;
                            foreach ($bulan as $bln) :
                            ?>
                             <div class="col-md-4">
                               <div class="custom-control custom-checkbox">
                                 <input class="custom-control-input" type="checkbox" id="customCheckbox<?= $no ?>" value="<?= $bln ?>" name="bulan[]">
                                 <label for="customCheckbox<?= $no ?>" class="custom-control-label"><?= $bln ?></label>
                               </div>
                             </div>
                           <?php
                              $no++;
                            endforeach
                            ?>
                         </div>
                       </div>
                       <div class="form-group">
                         <label>Nominal</label>
                         <input type="number" class="form-control" name="nominal">
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
     <!-- /.row -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper