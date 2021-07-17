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
             <h6 class="centered">Satpam</h6>
             <li class="mt">
                 <a class="active" href="<?= base_url("satpam") ?>">
                     <i class="fa fa-dashboard"></i>
                     <span>Dashboard</span>
                 </a>
             </li>
             <li class="">
                 <a class="" href="<?= base_url("satpam/profile") ?>">
                     <i class="fa fa-user"></i>
                     <span>Profile</span>
                 </a>
             </li>
             <li class="">
                 <a class="" href="<?= base_url("satpam/data_jadwal") ?>">
                     <i class="fa fa-table"></i>
                     <span>Jadwal Datang & Pulang</span>
                 </a>
             </li>
             <li class="sub-menu">
                 <a href="javascript:;">
                     <i class="fa fa-clipboard"></i>
                     <span>Kehadiran & Jurnal</span>
                 </a>
                 <ul class="sub">
                     <li><a href="<?= base_url("satpam/absen_qrcode") ?>">Absen QRCODE</a></li>
                     <li><a href="<?= base_url("satpam/data_kehadiran") ?>">Data Kehadiran</a></li>
                     <li>
                         <a href="<?= base_url("satpam/data_jurnal") ?>">Data Jurnal
                             <?php if ($jmlbelumacc != 0) : ?>
                                 <span class="badge bg-success">
                                     <?= $jmlbelumacc ?>
                                 </span>
                             <?php endif ?>
                         </a>
                     </li>
                     <li><a href="<?= base_url("satpam/data_kepulangan") ?>">Data Kepulangan</a></li>
                     <li><a href="<?= base_url("satpam/seluruh_data") ?>">Seluruh Data</a></li>
                 </ul>
             </li>
             <li class="sub-menu">
                 <a href="javascript:;">
                     <i class="fa fa-clipboard"></i>
                     <span>Rekap Data Saya</span>
                 </a>
                 <ul class="sub">
                     <li><a href="<?= base_url("satpam/rekap_kehadirans") ?>">Rekap Kehadiran</a></li>
                     <li><a href="<?= base_url("satpam/rekap_jurnals") ?>">Rekap Jurnal</a></li>
                 </ul>
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
                     <!-- /col-md-6 -->
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
                     <a href="" class="btn btn-theme"><i class="fa fa-bell-o"></i> PENGUMUMAN</a>
                     <?php foreach ($pengumuman as $p) : ?>
                         <div class="room-box">
                             <h5 class="text-primary"><a href="">
                                     Kepada :
                                     <?php if ($p->kepada == 1) : ?>
                                         Seluruh pegawai
                                     <?php elseif ($p->kepada == 2) : ?>
                                         Seluruh satpam
                                     <?php endif ?>
                                 </a></h5>
                             <p><?= ucwords($p->isi) ?></p>
                             <p>
                                 <span class="text-muted">
                                     <span class="text-muted"> Tanggal buat :</span> <?= $p->tanggal ?> <?= $p->pukul ?>
                                     <?php if ($p->ket_edit == 1) : ?>
                                         <span class="text-danger" style="font-style: oblique">Telah diedit</span>
                                     <?php endif ?>
                             </p>
                         </div>
                     <?php endforeach ?>
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