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
                 <a class="active" href="<?= base_url("admin") ?>">
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
 <section id="main-content">
     <section class="wrapper site-min-height">
         <!-- page start-->
         <div class="chat-room mt">
             <aside class="mid-side">
                 <div class="chat-room-head">
                     <h3><i class="fa fa-dashboard"></i> Dashboard</h3>
                     <div class="pull-right position">
                         <h5>
                             <b><span id="tgljs"></span>
                                 Pukul : <span id="jam"></span>:
                                 <span id="menit"></span>:
                                 <span id="detik"></span></b>
                         </h5>
                     </div>
                 </div>

                 <?= $this->session->flashdata('message'); ?>
                 <div class="room-desk">


                     <div class="col-md-12 detailed">
                         <div class="row centered mb">
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-users"></i></h1>
                                 <h3><?= $jml_ju_hi ?></h3>
                                 <h5>JUMLAH SEMUA PEGAWAI</h5>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-laptop"></i></h1>
                                 <h3><?= $jml_juo_hi ?></h3>
                                 <h5>JUMLAH PEGAWAI ONLINE</h5>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-clipboard"></i></h1>
                                 <h3><?= $jml_jsj_hi ?></h3>
                                 <h5>JUMLAH SEMUA JURNAL</h5>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-bell-o"></i></h1>
                                 <h3><?= $sp ?></h3>
                                 <h5>JUMLAH SEMUA PENGUMUMAN</h5>
                             </div>
                             <!-- --- -->
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-list"></i></h1>
                                 <h3><?= $jml_h_hi ?></h3>
                                 <h5>KEHADIRAN PEGAWAI HARI INI</h5>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-times-circle"></i></h1>
                                 <h3><?= $jml_th_hi ?></h3>
                                 <h5>PEGAWAI TIDAK HADIR HARI INI</h5>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-clipboard"></i></h1>
                                 <h3><?= $jml_jurnal_hi ?></h3>
                                 <h5>JURNAL HARI INI</h5>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-bell-o"></i></h1>
                                 <h3><?= $phi ?></h3>
                                 <h5>PENGUMUMAN HARI INI</h5>
                             </div>
                         </div><br>
                         <!-- /row -->
                     </div>
                 </div>

             </aside>
         </div>
         <!-- page end-->
     </section>
     <!-- /wrapper -->
 </section>
 <!-- /MAIN CONTENT -->
 <!--main content end-->
 <script src="<?= base_url("assets/") ?>js/waktu.js"></script>