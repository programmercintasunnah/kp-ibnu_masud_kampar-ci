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
             <h6 class="centered">Pegawai</h6>
             <li class="mt">
                 <a class="active" href="<?= base_url("userbiasa") ?>">
                     <i class="fa fa-dashboard"></i>
                     <span>Dashboard</span>
                 </a>
             </li>
             <li class="">
                 <a class="" href="<?= base_url("userbiasa/profile") ?>">
                     <i class="fa fa-user"></i>
                     <span>Profile</span>
                 </a>
             </li>
             <li class="">
                 <a class="" href="<?= base_url("userbiasa/jadwaldp") ?>">
                     <i class="fa fa-table"></i>
                     <span>Jadwal Datang & Pulang</span>
                 </a>
             </li>
             <li class="">
                 <a class="" href="<?= base_url("userbiasa/kehadiran_hi") ?>">
                     <i class="fa fa-list"></i>
                     <span>Kehadiran Hari Ini</span>
                 </a>
             </li>
             <li class="sub-menu">
                 <a href="javascript:;">
                     <i class="fa fa-clipboard"></i>
                     <span>Rekap Data</span>
                 </a>
                 <ul class="sub">
                     <li><a href="<?= base_url("userbiasa/rekap_kehadiran") ?>">Rekap Kehadiran</a></li>
                     <li><a href="<?= base_url("userbiasa/rekap_jurnal") ?>">Rekap Jurnal</a></li>
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
                     <h1 class="gen-case">
                         <?php if (date('l') == 'Sunday') : ?>
                             <div class="alert alert-warning" role="alert">
                                 <i class="fa fa-calendar"></i> Hari Ini Hari Ahad(Libur)</div>
                         <?php else : ?>
                             <?php if ($ahi['ket_absen'] == 1) : ?>
                                 <div class="alert alert-success" role="alert">
                                     <i class="fa fa-check-square"></i> Hari Ini Anda Hadir
                                     <div>
                                         <?php if ($ahi['terlambat'] > 0) : ?>
                                             <span class="badge bg-important">
                                                 <i class="fa fa-clock-o"></i> Jam Datang : <?= $ahi['jam_datang'] ?> (Terlambat <?= $ahi['terlambat'] ?> Menit)
                                             </span>
                                         <?php else : ?>
                                             <span class="badge bg-success">
                                                 <i class="fa fa-clock-o"></i> Jam Datang : <?= $ahi['jam_datang'] ?> (Tidak Terlambat)
                                             </span>
                                         <?php endif ?>
                                         <?php if ($ahi['tanggal'] == date('Y-m-d') && $ahi['jam_pulang'] <= date('H:i:s')) : ?>
                                             <span class="badge bg-default">
                                                 <i class="fa fa-clock-o"></i> Jam Pulang : <?= $ahi['jam_pulang'] ?> (Sudah Pulang)
                                             </span>
                                         <?php endif ?>
                                     </div>
                                 </div>
                             <?php elseif ($ahi['ket_absen'] == 2) : ?>
                                 <div class="alert alert-success" role="alert">
                                     <i class="fa fa-info-circle"></i> Hari Ini Anda Tidak Hadir Karena Cuti</div>
                             <?php elseif ($ahi['ket_absen'] == 3) : ?>
                                 <div class="alert alert-success" role="alert">
                                     <i class="fa fa-plus-square"></i> Hari Ini Anda Tidak Hadir Karena Sakit</div>
                             <?php elseif ($ahi['ket_absen'] == 4) : ?>
                                 <div class="alert alert-danger" role="alert">
                                     <i class="fa fa-exclamation-triangle"></i> Hari Ini Anda Tidak Hadir Tanpa Keterangan</div>
                             <?php elseif ($ahi['ket_absen'] == 0) : ?>
                                 <div class="alert alert-danger" role="alert">
                                     <i class="fa fa-exclamation-triangle"></i> Hari Ini Anda Belum Absen</div>
                             <?php endif ?>
                         <?php endif ?>
                     </h1>
                     <div class="col-md-12 detailed">
                         <div class="row centered mb">
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-check-square"></i></h1>
                                 <h3><?= $jml_kehadiran ?></h3>
                                 <h5>JUMLAH HARI KEHADIRAN</h5>
                                 <p>(dalam bulan ini)</p>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-plus-square"></i></h1>
                                 <h3><?= $jml_sakit ?></h3>
                                 <h5>JUMLAH HARI SAKIT</h5>
                                 <p>(dalam bulan ini)</p>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-info-circle"></i></h1>
                                 <h3><?= $jml_cuti ?></h3>
                                 <h5>JUMLAH HARI CUTI</h5>
                                 <p>(dalam bulan ini)</p>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-times-circle"></i></h1>
                                 <h3><?= $jml_tanpaket ?></h3>
                                 <h5>JUMLAH HARI TANPA KETERANGAN</h5>
                                 <p>(dalam bulan ini)</p>
                             </div>
                             <!-- --- -->
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-ban"></i></h1>
                                 <h3><?= $jml_terlambat ?></h3>
                                 <h5>JUMLAH TERLAMBAT</h5>
                                 <p>(dalam bulan ini)</p>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-clock-o"></i></h1>
                                 <h3>
                                     <?php if ($jml_menitterlambat['terlambat'] == null) : ?>
                                         0 Menit
                                     <?php else : ?>
                                         <?= $jml_menitterlambat['terlambat'] ?> Menit
                                     <?php endif ?>
                                 </h3>
                                 <h5>JUMLAH MENIT TERLAMBAT</h5>
                                 <p>(dalam bulan ini)</p>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-file-text"></i></h1>
                                 <h3><?= $jml_jurnal ?></h3>
                                 <h5>JUMLAH JURNAL</h5>
                                 <p>(dalam bulan ini)</p>
                             </div>
                             <div class="col-sm-3">
                                 <h1><i class="fa fa-clock-o"></i></h1>
                                 <h3>
                                     <?php if ($jml_menitkeluar['lama_keluar'] == null) : ?>
                                         0 Menit
                                     <?php else : ?>
                                         <?= $jml_menitkeluar['lama_keluar'] ?> Menit
                                     <?php endif ?>
                                 </h3>
                                 <h5>JUMLAH MENIT KELUAR</h5>
                                 <p>(dalam bulan ini)</p>
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