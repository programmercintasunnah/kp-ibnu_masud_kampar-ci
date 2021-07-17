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
                 <a class="" href="<?= base_url("admin/profile") ?>">
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
                 <a class="active" href="javascript:;">
                     <i class="fa fa-th-list"></i>
                     <span>Data Master</span>
                 </a>
                 <ul class="sub">
                     <li class="active"><a href="<?= base_url("admin/data_users") ?>">Data Users & Jabatan</a></li>
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

 <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <section id="main-content">
     <section class="wrapper">
         <!-- page start-->
         <div class="row mt">
             <div class="col-sm-12">
                 <div class="form-panel">
                     <div class="">
                         <a href="<?= base_url("admin/data_users") ?>" class="btn btn-theme btn-round"><i class="fa fa-angle-double-left"></i> Kembali</a>
                         <a href="<?= base_url("admin/data_users") ?>" class="close">&times;</a>
                         <h1 class="col-lg-offset-1">TAMBAH USER</h1>
                     </div>
                     <div class="panel-body">
                         <div class="row">
                             <form action="<?= base_url('admin/add_user') ?>" method="post">
                                 <div class="col-lg-5 col-lg-offset-1" id="nohpku">
                                     <input type="hidden" name="id" id="id">
                                     <label for="nama" class="">Nama</label>
                                     <input type="text" name="nama" id="nama" maxlength="22" autocomplete="off" class="form-control round-form" autofocus value="<?= set_value('nama') ?>" placeholder="Nama pegawai">
                                     <?= form_error('nama', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     <label for="tl" class="mt">Tempat Lahir</label>
                                     <input type="text" name="tl" id="tl" autocomplete="off" class="form-control round-form" value="<?= set_value('tl') ?>" placeholder="Tempat lahir">
                                     <?= form_error('tl', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     <label for="tgl" class="mt">Tanggal Lahir</label>
                                     <input type="date" name="tgl" id="tgl" class="form-control round-form" value="<?= set_value('tgl') ?>">
                                     <?= form_error('tgl', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     <label for="jabatan" class="mt">Jabatan</label>
                                     <select class="form-control round-form" name="jabatan" id="jabatan">
                                         <option value="">~Pilih~</option>
                                         <?php foreach ($jabatan as $j) : ?>
                                             <option value="<?= $j->id_jabatan ?>"><?= $j->nama_jabatan ?></option>
                                         <?php endforeach ?>
                                     </select>
                                     <?= form_error('jabatan', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     <label for="nohp" class="mt">Nomor HP</label>
                                     <input type="tel" pattern="^\d{12}$" name="nohp" id="nohp" class="form-control round-form" autocomplete="off" maxlength="12" value="<?= set_value('nohp') ?>" placeholder="Nomor Handphone">
                                     <?= form_error('nohp', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     <label for="username" class="mt">Username</label>
                                     <input type="text" name="username" id="username" maxlength="15" autocomplete="off" class="form-control round-form" value="<?= set_value('username') ?>" placeholder="Username">
                                     <?= form_error('username', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     <label for="password1" class="mt">Password</label>
                                     <div class="form-inline" role="form">
                                         <input type="password" name="password1" id="password1" class="form-control round-form" style="width:205px" placeholder="Password">
                                         <?= form_error('password1', '<small class="text-danger pl-1">', '</small><div class="mt"></div>'); ?>
                                         <input type="password" name="password2" id="password2" class="form-control round-form" style="width:205px" placeholder="Ulangi password">
                                         <?= form_error('password2', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     </div>
                                 </div>
                                 <div class="col-md-5">
                                     <label for="level_user" class="">Level User</label>
                                     <select class="form-control round-form" name="level_user" id="level_user">
                                         <option value="">~Pilih~</option>
                                         <option value=1>Admin</option>
                                         <option value=2>Satpam</option>
                                         <option value=3>User Biasa</option>
                                     </select><?= form_error('level_user', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     <label for="pend_terakhir" class="mt">Pendidikan Terakhir</label>
                                     <select class="form-control round-form" name="pend_terakhir" id="pend_terakhir">
                                         <option value="">~Pilih~</option>
                                         <option value="SD Sederajat">SD Sederajat</option>
                                         <option value="SMP Sederajat">SMP Sederajat</option>
                                         <option value="SMA Sederajat">SMA Sederajat</option>
                                         <option value="D1">D1</option>
                                         <option value="D2">D2</option>
                                         <option value="D3">D3</option>
                                         <option value="S1">S1</option>
                                         <option value="S2">S2</option>
                                         <option value="S3">S3</option>
                                     </select><?= form_error('pend_terakhir', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     <label for="tamatan" class="mt">Tamatan</label>
                                     <input type="text" name="tamatan" id="tamatan" autocomplete="off" class="form-control round-form" value="<?= set_value('tamatan') ?>" placeholder="Tamatan">
                                     <?= form_error('tamatan', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     <label for="keahlian" class="mt">Keahlian</label>
                                     <input type="text" name="keahlian" id="keahlian" autocomplete="off" class="form-control round-form" value="<?= set_value('keahlian') ?>" placeholder="Keahlian">
                                     <?= form_error('keahlian', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     <label for="asal" class="mt">Asal</label>
                                     <input type="text" name="asal" id="asal" autocomplete="off" class="form-control round-form" value="<?= set_value('asal') ?>" placeholder="Asal">
                                     <?= form_error('asal', '<small class="text-danger pl-1">', '</small><br>'); ?>
                                     <label for="alamat" class="mt">Alamat Lengkap</label>
                                     <textarea rows="3" name="alamat" id="alamat" class=" form-control round-form" placeholder="  Alamat lengkap... "><?= set_value('alamat') ?></textarea>
                                     <?= form_error('alamat', '<small class="text-danger pl-1">', '</small>'); ?>
                                     <Button type="submit" class="btn btn-round mt btn-primary" style="margin-left: 290px; margin-top: 50px"><i class="fa fa-save"></i> SIMPAN DATA</Button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- /wrapper -->
 </section>
 <!-- /MAIN CONTENT -->
 <!--main content end-->