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
                 <a class="active" href="<?= base_url("userbiasa/jadwaldp") ?>">
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
                         <h1 style="font-weight: bold" class="mb"><i class="fa fa-clipboard"></i> Data Jadwal Jam Datang & Pulang</h1>
                         <?= $this->session->flashdata('message'); ?>
                     </div>
                     <!-- /panel-heading -->
                     <div class="panel-body">
                         <div class="tab-content">

                         </div>
                         <div class="row">
                             <div class="col-md-12">
                                 <table class="table display" id="" width="100%">
                                     <thead>
                                         <tr>

                                             <th>No</th>
                                             <th>Hari</th>
                                             <th>Jam Datang</th>
                                             <th>Jam Pulang</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php $no = 1; ?>
                                         <?php foreach ($data_jam as $j) : ?>
                                             <tr class="gradeX">
                                                 <td><?= $no++ ?></td>
                                                 <td><?= strtoupper($j->hari) ?></td>
                                                 <td><?= $j->jam_datang ?></td>
                                                 <td><?= $j->jam_pulang ?></td>
                                             </tr>
                                         <?php endforeach ?>
                                     </tbody>
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