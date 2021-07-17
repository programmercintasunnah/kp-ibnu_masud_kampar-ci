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
                 <a class="" href="<?= base_url("userbiasa") ?>">
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
                 <a class="active" href="<?= base_url("userbiasa/kehadiran_hi") ?>">
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

 <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <section id="main-content">
     <section class="wrapper site-min-height">

         <aside>
             <!-- /col-lg-12 -->
             <div class="col-lg-12 mt">
                 <div class="row content-panel">
                     <div class="panel-heading">
                         <h1 style="font-weight: bold" class=""><i class="fa fa-clipboard"></i> Kedatangan Semua Pegawai Hari Ini</h1>
                         <?= $this->session->flashdata('message'); ?>
                     </div>
                     <!-- /panel-heading -->
                     <div class="panel-body">
                         <div class="tab-content">
                             <a href="<?= base_url("userbiasa/kartuqrcode") ?>" class="btn btn-info btn-round"><i class="fa fa-credit-card"></i> Kartu QR Code</a>
                         </div><br>
                         <div class="tab-content mb">
                             <a href="<?= base_url("userbiasa/scann_qrcode") ?>" class="btn btn-warning btn-round"><i class="fa fa-camera"></i> Scann QR Code</a>
                         </div>
                         <div class="row">
                             <div class="col-md-12">

                                 <table class="table display" id="" width="100%">
                                     <thead>
                                         <tr>

                                             <th>No</th>
                                             <th>Foto</th>
                                             <th>Nama</th>
                                             <th>Jabatan</th>
                                             <th>Ket Absen</th>
                                             <th>Jam Datang</th>
                                             <th>Ket Datang</th>
                                             <th>Online</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php $no = 1; ?>
                                         <?php foreach ($kehadiran_hi as $u) : ?>

                                             <tr class="gradeX">
                                                 <td><?= $no++ ?></td>
                                                 <td>
                                                     <img src="<?= base_url("assets/img/profile/") ?><?= $u->foto ?>" alt="" width="50" class="img-circle">
                                                 </td>
                                                 <td><?= strtoupper($u->nama_pegawai) ?></td>
                                                 <td><?= strtoupper($u->nama_jabatan) ?></td>
                                                 <td><?= $u->ket_absensi ?></td>
                                                 <td>
                                                     <?php if ($u->ket_ahi != 0) : ?>
                                                         <?php if ($u->jam_datang_ahi == null) : ?>
                                                             <p>
                                                                 <span class="badge bg-warning">Tidak Hadir</span>
                                                             </p>
                                                         <?php else : ?>
                                                             <?php if ($u->terlambat_ahi == 0) : ?>
                                                                 <?= $u->jam_datang_ahi ?>
                                                                 <p>
                                                                     <span class="badge bg-success">Tidak Terlambat</span>
                                                                 </p>
                                                             <?php else : ?>
                                                                 <?= $u->jam_datang_ahi ?>
                                                                 <p>
                                                                     <span class="badge bg-important"> Terlambat <?= $u->terlambat_ahi ?> menit</span>
                                                                 </p>
                                                             <?php endif ?>
                                                         <?php endif ?>
                                                     <?php endif ?>
                                                 </td>
                                                 <td>
                                                     <?php if ($u->ket_ahi != 0) : ?>
                                                         <?= $u->ket_datang_ahi ?>
                                                     <?php endif ?>
                                                 </td>
                                                 <td>
                                                     <?php if ($u->status_login == 1) : ?>
                                                         <span class="badge bg-success">Online</span>
                                                     <?php else : ?>
                                                         <span class="badge">
                                                             <?php
                                                                $last_login = $u->last_login;
                                                                $date = new DateTime($last_login);
                                                                $now = new DateTime();

                                                                if ($date->diff($now)->format("%y") >= 1) {
                                                                    echo $date->diff($now)->format("%y Tahun yang lalu");
                                                                } else if ($date->diff($now)->format("%m") >= 1) {
                                                                    echo $date->diff($now)->format("%m Bulan yang lalu");
                                                                } else if ($date->diff($now)->format("%d") >= 1) {
                                                                    echo $date->diff($now)->format("%d Hari yang lalu");
                                                                } else if ($date->diff($now)->format("%h") >= 1) {
                                                                    echo $date->diff($now)->format("%h Jam yang lalu");
                                                                } else if ($date->diff($now)->format("%i") >= 1) {
                                                                    echo $date->diff($now)->format("%i Menit yang lalu");
                                                                } else if ($date->diff($now)->format("%s") >= 0) {
                                                                    echo $date->diff($now)->format("%s Detik yang lalu");
                                                                }
                                                                ?>
                                                         </span>
                                                     <?php endif ?>
                                                 </td>
                                                 </td>
                                             </tr>

                                         <?php endforeach ?> </tbody>
                                 </table>
                             </div>
                         </div>
                         <!-- /row -->
                     </div>
                 </div>
                 <!-- /tab-content -->
             </div>
             <!-- /panel-body -->
             </div>
             <!-- /col-lg-12 -->
         </aside>
     </section>
     <!-- /wrapper -->
 </section>
 <!-- /MAIN CONTENT -->
 <!--main content end-->