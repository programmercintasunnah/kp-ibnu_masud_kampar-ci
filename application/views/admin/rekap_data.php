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
                     <li class=""><a href="<?= base_url("admin/data_kehadiran") ?>">Data Kehadiran</a></li>
                     <li><a href="<?= base_url("admin/data_jurnal") ?>">Data Jurnal</a></li>
                     <li class="active"><a href="<?= base_url("admin/rekap_data") ?>">Rekap Data</a></li>
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
                                 <a data-toggle="tab" href="#rekap_k">Rekap Data Kehadiran</a>
                             </li>
                             <li>
                                 <a data-toggle="tab" href="#rekap_j">Rekap Seluruh Data Kehadiran</a>
                             </li>
                         </ul>
                     </div>
                     <!-- /panel-heading -->
                     <div class="panel-body">
                         <div class="tab-content">
                             <div id="rekap_k" class="tab-pane active">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="col-md-10">
                                             <h2 style="font-weight: bold" class="mb">Rekap Data Kehadiran Bulan Ini
                                                 <?php if (date('m') == 1) : ?>
                                                     (Januari)
                                                 <?php elseif (date('m') == 2) : ?>
                                                     (Februari)
                                                 <?php elseif (date('m') == 3) : ?>
                                                     (Maret)
                                                 <?php elseif (date('m') == 4) : ?>
                                                     (April)
                                                 <?php elseif (date('m') == 5) : ?>
                                                     (Mei)
                                                 <?php elseif (date('m') == 6) : ?>
                                                     (Juni)
                                                 <?php elseif (date('m') == 7) : ?>
                                                     (Juli)
                                                 <?php elseif (date('m') == 8) : ?>
                                                     (Agustus)
                                                 <?php elseif (date('m') == 9) : ?>
                                                     (September)
                                                 <?php elseif (date('m') == 10) : ?>
                                                     (Oktober)
                                                 <?php elseif (date('m') == 11) : ?>
                                                     (November)
                                                 <?php elseif (date('m') == 12) : ?>
                                                     (Desember)
                                                 <?php endif ?>
                                             </h2>
                                         </div>
                                         <div class="col-md-3 mb">
                                             <a href="<?= base_url("admin/pdf_rekap_data") ?>" class="btn btn-danger"><i class="fa fa-file-text"></i> Export PDF</a>
                                         </div>
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>

                                                     <th>No</th>
                                                     <th>Foto</th>
                                                     <th>Nama</th>
                                                     <th>Jabatan</th>
                                                     <th>Jumlah Kehadiran</th>
                                                     <th>Jumlah Cuti</th>
                                                     <th>Jumlah Sakit</th>
                                                     <th>Jumlah Tanpa Keterangan</th>
                                                     <th>Jumlah Terlambat</th>
                                                     <th>Jumlah Menit Terlambat</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1; ?>
                                                 <?php foreach ($rekapdata_kehadiran as $u) : ?>
                                                     <tr class="gradeX">
                                                         <td><?= $no++ ?></td>
                                                         <td>
                                                             <img src="<?= base_url("assets/img/profile/") ?><?= $u->foto ?>" alt="" width="50" class="img-circle">
                                                         </td>
                                                         <td><?= strtoupper($u->nama_pegawai) ?></td>
                                                         <td><?= strtoupper($u->nama_jabatan) ?></td>
                                                         <td><?= $u->hadir ?></td>
                                                         <td><?= $u->cuti ?></td>
                                                         <td><?= $u->sakit ?></td>
                                                         <td><?= $u->tanpaket ?></td>
                                                         <td><?= $u->jumlah_terlambat ?></td>
                                                         <td><?= $u->jumlah_mterlambat ?> Menit</td>
                                                     </tr>
                                                 <?php endforeach ?>
                                             </tbody>
                                         </table>

                                     </div>
                                 </div>
                                 <!-- /data_users -->
                             </div>
                             <!-- /tab-pane -->
                             <div id="rekap_j" class="tab-pane">
                                 <div class="row">
                                     <div class="col-md-12">


                                         <div class="col-md-10">
                                             <h2 style="font-weight: bold" class="mb">Rekap Seluruh Data Kehadiran</h2>
                                         </div>
                                         <!-- <div class="col-md-3 mb">
                                             <a href="<?= base_url("admin/pdf_rekap_data") ?>" class="btn btn-danger"><i class="fa fa-file-text"></i> Export PDF</a>
                                         </div> -->
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>

                                                     <th>No</th>
                                                     <th>Foto</th>
                                                     <th>Nama</th>
                                                     <th>Jabatan</th>
                                                     <th>Jumlah Kehadiran</th>
                                                     <th>Jumlah Cuti</th>
                                                     <th>Jumlah Sakit</th>
                                                     <th>Jumlah Tanpa Keterangan</th>
                                                     <th>Jumlah Terlambat</th>
                                                     <th>Jumlah Menit Terlambat</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1; ?>
                                                 <?php foreach ($rekapdata_kehadirans as $u) : ?>
                                                     <tr class="gradeX">
                                                         <td><?= $no++ ?></td>
                                                         <td>
                                                             <img src="<?= base_url("assets/img/profile/") ?><?= $u->foto ?>" alt="" width="50" class="img-circle">
                                                         </td>
                                                         <td><?= strtoupper($u->nama_pegawai) ?></td>
                                                         <td><?= strtoupper($u->nama_jabatan) ?></td>
                                                         <td><?= $u->hadir ?></td>
                                                         <td><?= $u->cuti ?></td>
                                                         <td><?= $u->sakit ?></td>
                                                         <td><?= $u->tanpaket ?></td>
                                                         <td><?= $u->jumlah_terlambat ?></td>
                                                         <td><?= $u->jumlah_mterlambat ?> Menit</td>
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