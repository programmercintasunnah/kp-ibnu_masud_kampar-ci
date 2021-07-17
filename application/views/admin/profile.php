 <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
 <!--sidebar start-->
 <aside>
     <div id="sidebar" class="nav-collapse ">
         <!-- sidebar menu start-->
         <ul class="sidebar-menu" id="nav-accordion">
             <p class="centered"><a href=""><img src="<?= base_url("assets/") ?>img/profile/<?= $foto ?>" class="img-circle" width="80"></a></p>
             <h5 class="centered"><i class="fa fa-circle text-success"></i> <?= ucwords($nama_pegawai) ?></h5>
             <h6 class="centered">Admin</h6>
             <li class="mt">
                 <a class="" href="<?= base_url("admin") ?>">
                     <i class="fa fa-dashboard"></i>
                     <span>Dashboard</span>
                 </a>
             </li>
             <li class="">
                 <a class="active" href="<?= base_url("admin/profile") ?>">
                     <i class="fa fa-user"></i>
                     <span>Profile</span>
                 </a>
             </li>
             <li class="sub-menu">
                 <a href="javascript:;">
                     <i class="fa fa-clipboard"></i>
                     <span>Kehadiran & Jurnal</span>
                 </a>
                 <ul class="sub">
                     <li><a href="<?= base_url("admin/data_kehadiran") ?>">Data Kehadiran</a></li>
                     <li><a href="<?= base_url("admin/data_jurnal") ?>">Data Jurnal</a></li>
                     <li><a href="<?= base_url("admin/rekap_data") ?>">Rekap Data</a></li>
                 </ul>
             </li>
             <li class="sub-menu">
                 <a href="javascript:;">
                     <i class="fa fa-th-list"></i>
                     <span>Data Master</span>
                 </a>
                 <ul class="sub">
                     <li><a href="<?= base_url("admin/data_users") ?>">Data Users & Jabatan</a></li>
                     <li><a href="<?= base_url("admin/data_info") ?>">Data Informasi</a></li>
                     <li><a href="<?= base_url("admin/data_jadwal") ?>">Data Jadwal</a></li>
                 </ul>
             </li>
             <li class="sub-menu">
                 <a href="javascript:;">
                     <i class="fa fa-clipboard"></i>
                     <span>Rekap Data Saya</span>
                 </a>
                 <ul class="sub">
                     <li><a href="<?= base_url("admin/rekap_kehadirans") ?>">Rekap Kehadiran</a></li>
                     <li><a href="<?= base_url("admin/rekap_jurnals") ?>">Rekap Jurnal</a></li>
                 </ul>
             </li>
             <li class="">
                 <a class="" href="<?= base_url("admin/pengaturan") ?>">
                     <i class="fa fa-cogs"></i>
                     <span>Pengaturan</span>
                 </a>
             </li>
         </ul>
         <!-- sidebar menu end-->
     </div>
 </aside>
 <!--sidebar end-->

 <!-- Modal aadad-->
 <div class="modal fade" id="editPassword" tabindex="-1" role="dialog" aria-labelledby="modalTKelas" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel1">Edit Password</h4>
             </div>
             <!-- <div class="modal-body"> -->
             <div class="">
                 <form action="<?= base_url('admin/edit_passwordku') ?>" method="post">
                     <div class="col-md-12 profile-text mt">
                         <div class="form-group">
                             <label for="password">Password</label>
                             <input type="password" placeholder="password" name="ep_password" id="ep_password" class="form-control round-form">
                         </div>
                         <div class="form-group">
                             <label for="ulangipassword">Ulangi Password</label>
                             <input type="password" placeholder="ulangi password" name="ep_ulangipassword" id="ep_ulangipassword" class="form-control round-form">
                         </div>
                     </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Simpan</button>
             </div>
             </form>
             <!-- </div> -->
         </div>
     </div>
 </div>
 <section id="main-content">
     <section class="wrapper site-min-height">
         <div class="row">
             <div class="col-lg-12">
                 <div class="col-lg-4">
                     <div class="custom-box">
                         <div class="servicetitle">
                         </div>
                         <div class="profile-pic">
                             <p><img src="<?= base_url("assets/img/") ?>profile/<?= $profile['foto'] ?>" class="img-circle"></p>
                         </div>
                         <h3 class="bbold"><?= ucwords($profile['nama_pegawai']) ?></h3>
                         <ul class="pricing">
                             <li>
                                 <h6 class="text-primary bbold">Username : </h6><?= ucwords($profile['username']) ?>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Password : </h6>******
                                 <a href="" class="btn-xs btn-primary" data-target="#editPassword" data-toggle="modal"><i class="fa fa-pencil"> Edit</i></a>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Level : </h6><?= ucwords($profile['level']) ?>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Jabatan : </h6><?= ucwords($profile['nama_jabatan']) ?>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Tempat, Tanggal Lahir : </h6><?= ucwords($profile['t_lahir']) ?>, <?= $profile['tgl_lahir'] ?>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Pendidikan Terakhir : </h6><?= ucwords($profile['pendidikan_terakhir']) ?>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Tamatan : </h6><?= ucwords($profile['tamatan']) ?>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Keahlian :

                                 </h6> <?php if ($profile['keahlian'] == null) : ?>
                                     -
                                 <?php else : ?>
                                     <?= ucwords($profile['keahlian']) ?>
                                 <?php endif ?>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">No HP :

                                 </h6> <?php if ($profile['nohp'] == null) : ?>
                                     -
                                 <?php else : ?>
                                     <?= ucwords($profile['nohp']) ?>
                                 <?php endif ?>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Asal : </h6><?= ucwords($profile['asal']) ?>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Alamat : </h6><?= ucwords($profile['alamat']) ?>
                             </li>
                         </ul>
                     </div>
                     <!-- end custombox -->
                 </div>
                 <!-- end col-4 -->

                 <div class="col-lg-8">
                     <div class="custom-box">
                         <div class="servicetitle">
                             <h1><i class="fa fa-edit"> Edit Profile</i></h1>
                             <?= $this->session->flashdata('message'); ?>
                             <br>
                         </div>

                         <!-- <form role="form" method="post" action="<?= base_url("admin/edit_profileku") ?>" class="form-horizontal"> -->
                         <?= form_open_multipart("admin/edit_profileku") ?>
                         <div class="form-group">
                             <label class="col-lg-3 control-label"> Foto</label>
                             <div class="col-md-9">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                     <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                         <img src="<?= base_url("assets/") ?>img/profile/<?= $foto ?>">
                                     </div>
                                     <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                     <div>
                                         <span class="btn btn-theme02 btn-file">
                                             <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih foto</span>
                                             <span class="fileupload-exists"><i class="fa fa-undo"></i> Ganti</span>
                                             <input type="file" class="default" id="fotoku" name="fotoku" />
                                         </span>
                                         <a href="" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Hapus</a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Nama</label>
                             <div class="col-lg-9">
                                 <input autocomplete="off" type="text" value="<?= $profile['nama_pegawai'] ?>" id="nama" name="nama" class="form-control round-form">
                                 <?= form_error('nama', '<small class="text-danger pl-1">', '</small><br>'); ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Username</label>
                             <div class="col-lg-9">
                                 <input autocomplete="off" type="text" value="<?= $profile['username'] ?>" id="username" name="username" class="form-control round-form">
                                 <?= form_error('username', '<small class="text-danger pl-1">', '</small><br>'); ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Tempat Lahir</label>
                             <div class="col-lg-9">
                                 <input autocomplete="off" type="text" value="<?= $profile['t_lahir'] ?>" name="t_lahir" id="t_lahir" class="form-control round-form">
                                 <?= form_error('t_lahir', '<small class="text-danger pl-1">', '</small><br>'); ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Tanggal Lahir</label>
                             <div class="col-lg-9">
                                 <input autocomplete="off" type="date" value="<?= $profile['tgl_lahir'] ?>" name="tgl_lahir" id="tgl_lahir" class="form-control round-form">
                                 <?= form_error('tgl_lahir', '<small class="text-danger pl-1">', '</small><br>'); ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Pendidikan Terakhir</label>
                             <div class="col-lg-9">
                                 <select class="form-control round-form round-form" name="pend_terakhir" id="pend_terakhir">
                                     <option value="">~Pilih~</option>
                                     <?php if ($profile['pendidikan_terakhir'] == "SD Sederajat") : ?>
                                         <option selected value="SD Sederajat">SD Sederajat</option>
                                         <option value="SMP Sederajat">SMP Sederajat</option>
                                         <option value="SMA Sederajat">SMA Sederajat</option>
                                         <option value="D1">D1</option>
                                         <option value="D2">D2</option>
                                         <option value="D3">D3</option>
                                         <option value="S1">S1</option>
                                         <option value="S2">S2</option>
                                         <option value="S3">S3</option>
                                     <?php elseif ($profile['pendidikan_terakhir'] == "SMP Sederajat") : ?>
                                         <option value="SD Sederajat">SD Sederajat</option>
                                         <option selected value="SMP Sederajat">SMP Sederajat</option>
                                         <option value="SMA Sederajat">SMA Sederajat</option>
                                         <option value="D1">D1</option>
                                         <option value="D2">D2</option>
                                         <option value="D3">D3</option>
                                         <option value="S1">S1</option>
                                         <option value="S2">S2</option>
                                         <option value="S3">S3</option>
                                     <?php elseif ($profile['pendidikan_terakhir'] == "SMA Sederajat") : ?>
                                         <option value="SD Sederajat">SD Sederajat</option>
                                         <option value="SMP Sederajat">SMP Sederajat</option>
                                         <option selected value="SMA Sederajat">SMA Sederajat</option>
                                         <option value="D1">D1</option>
                                         <option value="D2">D2</option>
                                         <option value="D3">D3</option>
                                         <option value="S1">S1</option>
                                         <option value="S2">S2</option>
                                         <option value="S3">S3</option>
                                     <?php elseif ($profile['pendidikan_terakhir'] == "D1") : ?>
                                         <option value="SD Sederajat">SD Sederajat</option>
                                         <option value="SMP Sederajat">SMP Sederajat</option>
                                         <option value="SMA Sederajat">SMA Sederajat</option>
                                         <option selected value="D1">D1</option>
                                         <option value="D2">D2</option>
                                         <option value="D3">D3</option>
                                         <option value="S1">S1</option>
                                         <option value="S2">S2</option>
                                         <option value="S3">S3</option>
                                     <?php elseif ($profile['pendidikan_terakhir'] == "D2") : ?>
                                         <option value="SD Sederajat">SD Sederajat</option>
                                         <option value="SMP Sederajat">SMP Sederajat</option>
                                         <option value="SMA Sederajat">SMA Sederajat</option>
                                         <option value="D1">D1</option>
                                         <option selected value="D2">D2</option>
                                         <option value="D3">D3</option>
                                         <option value="S1">S1</option>
                                         <option value="S2">S2</option>
                                         <option value="S3">S3</option>
                                     <?php elseif ($profile['pendidikan_terakhir'] == "D3") : ?>
                                         <option value="SD Sederajat">SD Sederajat</option>
                                         <option value="SMP Sederajat">SMP Sederajat</option>
                                         <option value="SMA Sederajat">SMA Sederajat</option>
                                         <option value="D1">D1</option>
                                         <option value="D2">D2</option>
                                         <option selected value="D3">D3</option>
                                         <option value="S1">S1</option>
                                         <option value="S2">S2</option>
                                         <option value="S3">S3</option>
                                     <?php elseif ($profile['pendidikan_terakhir'] == "S1") : ?>
                                         <option value="SD Sederajat">SD Sederajat</option>
                                         <option value="SMP Sederajat">SMP Sederajat</option>
                                         <option value="SMA Sederajat">SMA Sederajat</option>
                                         <option value="D1">D1</option>
                                         <option value="D2">D2</option>
                                         <option value="D3">D3</option>
                                         <option selected value="S1">S1</option>
                                         <option value="S2">S2</option>
                                         <option value="S3">S3</option>
                                     <?php elseif ($profile['pendidikan_terakhir'] == "S2") : ?>
                                         <option value="SD Sederajat">SD Sederajat</option>
                                         <option value="SMP Sederajat">SMP Sederajat</option>
                                         <option value="SMA Sederajat">SMA Sederajat</option>
                                         <option value="D1">D1</option>
                                         <option value="D2">D2</option>
                                         <option value="D3">D3</option>
                                         <option value="S1">S1</option>
                                         <option selected value="S2">S2</option>
                                         <option value="S3">S3</option>
                                     <?php elseif ($profile['pendidikan_terakhir'] == "S3") : ?>
                                         <option value="SD Sederajat">SD Sederajat</option>
                                         <option value="SMP Sederajat">SMP Sederajat</option>
                                         <option value="SMA Sederajat">SMA Sederajat</option>
                                         <option value="D1">D1</option>
                                         <option value="D2">D2</option>
                                         <option value="D3">D3</option>
                                         <option value="S1">S1</option>
                                         <option value="S2">S2</option>
                                         <option selected value="S3">S3</option>
                                     <?php endif ?>
                                 </select>
                                 <?= form_error('pend_terakhir', '<small class="text-danger pl-1">', '</small><br>'); ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Tamatan</label>
                             <div class="col-lg-9">
                                 <input autocomplete="off" type="text" value="<?= $profile['tamatan'] ?>" name="tamatan" id="tamatan" class="form-control round-form">
                                 <?= form_error('tamatan', '<small class="text-danger pl-1">', '</small><br>'); ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Keahlian</label>
                             <div class="col-lg-9">
                                 <input autocomplete="off" type="text" value="<?= $profile['keahlian'] ?>" placeholder="Keahlian" name="keahlian" id="keahlian" class="form-control round-form">
                                 <?= form_error('keahlian', '<small class="text-danger pl-1">', '</small><br>'); ?>
                             </div>
                         </div>
                         <div class="form-group" id="nohpku">
                             <label class="col-lg-3 control-label">No HP</label>
                             <div class="col-lg-9">
                                 <input type="tel" value="<?= $profile['nohp'] ?>" pattern="^\d{12}$" name="nohp" id="nohp" class="form-control round-form" autocomplete="off" maxlength="12" value="<?= set_value('nohp') ?>" placeholder="Nomor Handphone">
                                 <?= form_error('nohp', '<small class="text-danger pl-1">', '</small><br>'); ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Asal</label>
                             <div class="col-lg-9">
                                 <textarea rows="5" cols="20" class="form-control" id="asal" name="asal"><?= $profile['asal'] ?></textarea>
                                 <?= form_error('asal', '<small class="text-danger pl-1">', '</small><br>'); ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-lg-3 control-label">Alamat</label>
                             <div class="col-lg-9">
                                 <textarea rows="5" cols="20" class="form-control" id="alamat" name="alamat"><?= $profile['alamat'] ?></textarea>
                                 <?= form_error('alamat', '<small class="text-danger pl-1">', '</small><br>'); ?>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button class="btn btn-primary" name="edit" id="edit" type="submit"><i class="fa fa-save"></i> SIMPAN DATA</button>
                         </div>
                         <?= form_close() ?>
                     </div>
                 </div>
             </div>
             <!-- end col-4 -->
         </div>
         <!--  /col-lg-12 -->
         </div>
         <!--  /row -->
     </section>
     <!-- /wrapper -->
 </section>
 <!-- /MAIN CONTENT -->
 <!--main content end-->