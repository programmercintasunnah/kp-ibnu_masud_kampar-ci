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
                 <a class="" href="<?= base_url("userbiasa/kehadiran_hi") ?>">
                     <i class="fa fa-list"></i>
                     <span>Kehadiran Hari Ini</span>
                 </a>
             </li>
             <li class="sub-menu">
                 <a class="active" href="javascript:;">
                     <i class="fa fa-clipboard"></i>
                     <span>Rekap Data</span>
                 </a>
                 <ul class="sub">
                     <li class="active"><a href="<?= base_url("userbiasa/rekap_kehadiran") ?>">Rekap Kehadiran</a></li>
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
                         <?= $this->session->flashdata('message'); ?>
                         <ul class="nav nav-tabs nav-justified">
                             <li class="active">
                                 <a data-toggle="tab" href="#data_hi">Rekap Kehadiran</a>
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
                                                 Rekap Kehadiran
                                             </h2>
                                         </div>
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>
                                                     <th>No</th>
                                                     <th>Bulan</th>
                                                     <th>Jumlah Kehadiran</th>
                                                     <th>Jumlah Cuti</th>
                                                     <th>Jumlah Sakit</th>
                                                     <th>Jumlah Tanpa Keterangan</th>
                                                     <th>Jumlah Terlambat</th>
                                                     <th>Jumlah Menit Terlambat</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <tr class="gradeX">
                                                     <td>1</td>
                                                     <td>Januari</td>
                                                     <td><?= $jk1 ?></td>
                                                     <td><?= $jc1 ?></td>
                                                     <td><?= $js1 ?></td>
                                                     <td><?= $jtk1 ?></td>
                                                     <td><?= $jt1 ?></td>
                                                     <td>
                                                         <?php if ($jmt1['terlambat'] != null) : ?>
                                                             <?= $jmt1['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
                                                 <tr class="gradeX">
                                                     <td>2</td>
                                                     <td>Februari</td>
                                                     <td><?= $jk2 ?></td>
                                                     <td><?= $jc2 ?></td>
                                                     <td><?= $js2 ?></td>
                                                     <td><?= $jtk2 ?></td>
                                                     <td><?= $jt2 ?></td>
                                                     <td>
                                                         <?php if ($jmt2['terlambat'] != null) : ?>
                                                             <?= $jmt2['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
                                                 <tr class="gradeX">
                                                     <td>3</td>
                                                     <td>Maret</td>
                                                     <td><?= $jk3 ?></td>
                                                     <td><?= $jc3 ?></td>
                                                     <td><?= $js3 ?></td>
                                                     <td><?= $jtk3 ?></td>
                                                     <td><?= $jt3 ?></td>
                                                     <td>
                                                         <?php if ($jmt3['terlambat'] != null) : ?>
                                                             <?= $jmt3['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
                                                 <tr class="gradeX">
                                                     <td>4</td>
                                                     <td>April</td>
                                                     <td><?= $jk4 ?></td>
                                                     <td><?= $jc4 ?></td>
                                                     <td><?= $js4 ?></td>
                                                     <td><?= $jtk4 ?></td>
                                                     <td><?= $jt4 ?></td>
                                                     <td>
                                                         <?php if ($jmt4['terlambat'] != null) : ?>
                                                             <?= $jmt4['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
                                                 <tr class="gradeX">
                                                     <td>5</td>
                                                     <td>Mei</td>
                                                     <td><?= $jk5 ?></td>
                                                     <td><?= $jc5 ?></td>
                                                     <td><?= $js5 ?></td>
                                                     <td><?= $jtk5 ?></td>
                                                     <td><?= $jt5 ?></td>
                                                     <td>
                                                         <?php if ($jmt5['terlambat'] != null) : ?>
                                                             <?= $jmt5['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
                                                 <tr class="gradeX">
                                                     <td>6</td>
                                                     <td>Juni</td>
                                                     <td><?= $jk6 ?></td>
                                                     <td><?= $jc6 ?></td>
                                                     <td><?= $js6 ?></td>
                                                     <td><?= $jtk6 ?></td>
                                                     <td><?= $jt6 ?></td>
                                                     <td>
                                                         <?php if ($jmt6['terlambat'] != null) : ?>
                                                             <?= $jmt6['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
                                                 <tr class="gradeX">
                                                     <td>7</td>
                                                     <td>Juli</td>
                                                     <td><?= $jk7 ?></td>
                                                     <td><?= $jc7 ?></td>
                                                     <td><?= $js7 ?></td>
                                                     <td><?= $jtk7 ?></td>
                                                     <td><?= $jt7 ?></td>
                                                     <td>
                                                         <?php if ($jmt7['terlambat'] != null) : ?>
                                                             <?= $jmt7['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
                                                 <tr class="gradeX">
                                                     <td>8</td>
                                                     <td>Agustus</td>
                                                     <td><?= $jk8 ?></td>
                                                     <td><?= $jc8 ?></td>
                                                     <td><?= $js8 ?></td>
                                                     <td><?= $jtk8 ?></td>
                                                     <td><?= $jt8 ?></td>
                                                     <td>
                                                         <?php if ($jmt8['terlambat'] != null) : ?>
                                                             <?= $jmt8['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
                                                 <tr class="gradeX">
                                                     <td>9</td>
                                                     <td>September</td>
                                                     <td><?= $jk9 ?></td>
                                                     <td><?= $jc9 ?></td>
                                                     <td><?= $js9 ?></td>
                                                     <td><?= $jtk9 ?></td>
                                                     <td><?= $jt9 ?></td>
                                                     <td>
                                                         <?php if ($jmt9['terlambat'] != null) : ?>
                                                             <?= $jmt9['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
                                                 <tr class="gradeX">
                                                     <td>10</td>
                                                     <td>Oktober</td>
                                                     <td><?= $jk10 ?></td>
                                                     <td><?= $jc10 ?></td>
                                                     <td><?= $js10 ?></td>
                                                     <td><?= $jtk10 ?></td>
                                                     <td><?= $jt10 ?></td>
                                                     <td>
                                                         <?php if ($jmt10['terlambat'] != null) : ?>
                                                             <?= $jmt10['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
                                                 <tr class="gradeX">
                                                     <td>11</td>
                                                     <td>November</td>
                                                     <td><?= $jk11 ?></td>
                                                     <td><?= $jc11 ?></td>
                                                     <td><?= $js11 ?></td>
                                                     <td><?= $jtk11 ?></td>
                                                     <td><?= $jt11 ?></td>
                                                     <td>
                                                         <?php if ($jmt11['terlambat'] != null) : ?>
                                                             <?= $jmt11['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
                                                 <tr class="gradeX">
                                                     <td>12</td>
                                                     <td>Desember</td>
                                                     <td><?= $jk12 ?></td>
                                                     <td><?= $jc12 ?></td>
                                                     <td><?= $js12 ?></td>
                                                     <td><?= $jtk12 ?></td>
                                                     <td><?= $jt12 ?></td>
                                                     <td>
                                                         <?php if ($jmt12['terlambat'] != null) : ?>
                                                             <?= $jmt12['terlambat'] ?> Menit
                                                         <?php else : ?>
                                                             0 Menit
                                                         <?php endif ?>
                                                     </td>
                                                 </tr>
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
                                                     <th>Ket Absen</th>
                                                     <th>Tanggal</th>
                                                     <th>Jam Datang</th>
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
                                                         <td><?= $u->ket_absensi ?></td>
                                                         <td><?= $u->tanggal ?></td>
                                                         <td>
                                                             <?php if ($u->jam_datang == null) : ?>
                                                                 <span class="badge bg-warning">Tidak Hadir</span>
                                                             <?php else : ?>
                                                                 <?php if ($u->terlambat == 0) : ?>
                                                                     <?= $u->jam_datang ?>
                                                                     <p>
                                                                         <span class="badge bg-success">Tidak Terlambat</span>
                                                                     </p>
                                                                 <?php else : ?>
                                                                     <?= $u->jam_datang ?>
                                                                     <p>
                                                                         <span class="badge bg-important"> Terlambat <?= $u->terlambat ?> menit</span>
                                                                     </p>
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