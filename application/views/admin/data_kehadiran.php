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
                 <a class="active" href="javascript:;">
                     <i class="fa fa-clipboard"></i>
                     <span>Kehadiran & Jurnal</span>
                 </a>
                 <ul class="sub">
                     <li class="active"><a href="<?= base_url("admin/data_kehadiran") ?>">Data Kehadiran</a></li>
                     <li><a href="<?= base_url("admin/data_jurnal") ?>">Data Jurnal</a></li>
                     <li><a href="<?= base_url("admin/rekap_data") ?>">Rekap Data</a></li>
                 </ul>
             </li>
             <li class="sub-menu">
                 <a class="" href="javascript:;">
                     <i class="fa fa-th-list"></i>
                     <span>Data Master</span>
                 </a>
                 <ul class="sub">
                     <li class=""><a href="<?= base_url("admin/data_users") ?>">Data Users & Jabatan</a></li>
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
     <section class="wrapper site-min-height">

         <aside>
             <!-- /col-lg-12 -->
             <div class="col-lg-12 mt">
                 <div class="row content-panel">
                     <div class="panel-heading">
                         <?= $this->session->flashdata('message'); ?>
                         <ul class="nav nav-tabs nav-justified">
                             <li class="active">
                                 <a data-toggle="tab" href="#data_hi">Kehadiran Hari Ini</a>
                             </li>
                             <li>
                                 <a data-toggle="tab" href="#seluruh_data">Seluruh Data Kehadiran</a>
                             </li>
                         </ul>
                     </div>
                     <!-- /panel-heading -->
                     <div class="panel-body">

                         <div class="tab-content">
                             <div id="data_hi" class="tab-pane active">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="col-md-9">
                                             <h2 style="font-weight: bold" class="mb">
                                                 Kehadiran Hari Ini
                                             </h2>
                                             <div class="tab-content">
                                                 <a href="<?= base_url("admin/kartuqrcode") ?>" class="btn btn-info btn-round"><i class="fa fa-credit-card"></i> Kartu QR Code</a>
                                             </div><br>
                                             <div class="tab-content mb">
                                                 <a href="<?= base_url("admin/scann_qrcode") ?>" class="btn btn-warning btn-round"><i class="fa fa-camera"></i> Scann QR Code</a>
                                             </div>
                                         </div>
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>

                                                     <th>No</th>
                                                     <th>Foto</th>
                                                     <th>Nama</th>
                                                     <th>Ket Absen</th>
                                                     <th>Jam Datang</th>
                                                     <th>Status</th>
                                                     <th>Ket Datang</th>
                                                     <th>Jam Pulang</th>
                                                     <th>Ket Pulang</th>
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
                                                         <td><?= $u->ket_absensi ?></td>
                                                         <td>
                                                             <?php if ($u->ket_ahi != 0) : ?>
                                                                 <?= $u->jam_datang_ahi ?>
                                                             <?php endif ?>
                                                         </td>
                                                         <td>
                                                             <?php if ($u->ket_ahi != 0) : ?>
                                                                 <?php if ($u->jam_datang_ahi == null) : ?>
                                                                     <span class="badge bg-warning">Tidak Hadir</span>
                                                                 <?php else : ?>
                                                                     <?php if ($u->terlambat_ahi == 0) : ?>
                                                                         <span class="badge bg-success">Tidak Terlambat</span>
                                                                     <?php else : ?>
                                                                         <span class="badge bg-important"> Terlambat <?= $u->terlambat_ahi ?> menit</span>
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
                                                             <?php if ($u->tanggal_ahi == date('Y-m-d') && $u->jam_pulang_ahi <= date('H:i:s') && $u->jam_pulang_ahi != null) : ?>
                                                                 <?= $u->jam_pulang_ahi ?>
                                                                 <p><span class="badge bg-default">Sudah Pulang</span></p>
                                                             <?php elseif ($u->ket_ahi != 1) : ?>
                                                             <?php elseif ($u->tanggal_ahi == date('Y-m-d')) : ?>
                                                                 <?= $u->jam_pulang_ahi ?>
                                                                 <p><span class="badge bg-success">Masih di Pondok</span></p>
                                                             <?php elseif ($u->tanggal_ahi != date('Y-m-d')) : ?>
                                                                 <?= $u->jam_pulang_ahi ?>
                                                             <?php endif ?>
                                                         </td>
                                                         <td>
                                                             <?php if ($u->ket_ahi != 0) : ?>
                                                                 <?= $u->ket_pulang_ahi ?>
                                                             <?php endif ?>
                                                         </td>
                                                     </tr>

                                                 <?php endforeach ?>
                                             </tbody>
                                         </table>

                                     </div>
                                 </div>
                                 <!-- /data_users -->
                             </div>
                             <!-- /tab-pane -->
                             <div id="seluruh_data" class="tab-pane">
                                 <div class="row">
                                     <div class="col-md-12">


                                         <div class="col-md-10">
                                             <h2 style="font-weight: bold" class="mb">Seluruh Data Kehadiran</h2>
                                         </div>
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>

                                                     <th>No</th>
                                                     <th>Foto</th>
                                                     <th>Nama</th>
                                                     <th>Ket Absen</th>
                                                     <th>Tanggal</th>
                                                     <th>Jam Datang</th>
                                                     <th>Status</th>
                                                     <th>Ket Datang</th>
                                                     <th>Jam Pulang</th>
                                                     <th>Ket Pulang</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1; ?>
                                                 <?php foreach ($seluruh_kehadiran as $u) : ?>
                                                     <tr class="gradeX">
                                                         <td><?= $no++ ?></td>
                                                         <td>
                                                             <img src="<?= base_url("assets/img/profile/") ?><?= $u->foto ?>" alt="" width="50" class="img-circle">
                                                         </td>
                                                         <td><?= strtoupper($u->nama_pegawai) ?></td>
                                                         <td><?= $u->ket_absensi ?></td>
                                                         <td><?= $u->tanggal ?></td>
                                                         <td><?= $u->jam_datang ?></td>
                                                         <td>
                                                             <?php if ($u->jam_datang == null) : ?>
                                                                 <span class="badge bg-warning">Tidak Hadir</span>
                                                             <?php else : ?>
                                                                 <?php if ($u->terlambat == 0) : ?>
                                                                     <span class="badge bg-success">Tidak Terlambat</span>
                                                                 <?php else : ?>
                                                                     <span class="badge bg-important"> Terlambat <?= $u->terlambat ?> menit</span>
                                                                 <?php endif ?>
                                                             <?php endif ?>
                                                         </td>
                                                         <td><?= $u->ket_jd ?></td>
                                                         <td><?= $u->jam_pulang ?></td>
                                                         <td><?= $u->ket_jp ?></td>
                                                     </tr>
                                                 <?php endforeach ?>
                                             </tbody>
                                         </table>

                                     </div>
                                 </div>
                                 <!-- /row -->
                             </div>
                             <!-- /tab-pane -->
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