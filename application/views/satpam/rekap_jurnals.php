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
                 <a class="" href="<?= base_url("satpam") ?>">
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
                 <a class="active" href="javascript:;">
                     <i class="fa fa-clipboard"></i>
                     <span>Rekap Data Saya</span>
                 </a>
                 <ul class="sub">
                     <li><a href="<?= base_url("satpam/rekap_kehadirans") ?>">Rekap Kehadiran</a></li>
                     <li class="active"><a href="<?= base_url("satpam/rekap_jurnals") ?>">Rekap Jurnal</a></li>
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
                                 <a data-toggle="tab" href="#data_hi">Rekap Jurnal Bulan Ini</a>
                             </li>
                             <li>
                                 <a data-toggle="tab" href="#seluruh_data">Seluruh Data Jurnal</a>
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
                                                 Rekap Jurnal Bulan Ini
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
                                         <div class="col-md-4">
                                             <a href="<?= base_url("satpam/pdf_rekapjurnalku") ?>" class="btn btn-danger"><i class="fa fa-file-text"></i> Export PDF</a>
                                             <br><br>
                                         </div>
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>

                                                     <th>No</th>
                                                     <th>Tanggal</th>
                                                     <th>Kegiatan Keluar</th>
                                                     <th>Mulai Pukul</th>
                                                     <th>Sampai Pukul</th>
                                                     <th>Lama Keluar</th>
                                                     <th>Keterangan</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1; ?>
                                                 <?php foreach ($jurnalku as $u) : ?>
                                                     <tr class="gradeX">
                                                         <td><?= $no++ ?></td>
                                                         <td><?= $u->tanggal_jurnal ?></td>
                                                         <td><?= ucwords($u->kegiatan_keluar) ?></td>
                                                         <td><?= ucwords($u->mulai_pukul) ?></td>
                                                         <td><?= ucwords($u->sampai_pukul) ?></td>

                                                         <td>
                                                             <?php if ($u->acc_jurnal == 1) : ?>
                                                                 <?= ucwords($u->lama_keluar) ?> Menit
                                                             <?php else : ?>
                                                                 <span class="badge">
                                                                     <?php
                                                                        $mulai_pukul = $u->mulai_pukul;
                                                                        $time = new DateTime($mulai_pukul);
                                                                        $now = new DateTime();

                                                                        echo $time->diff($now)->format('%h jam %i menit');
                                                                        ?>
                                                                 </span>
                                                             <?php endif ?>
                                                         </td>
                                                         <td>
                                                             <?php if ($u->acc_jurnal == 0) : ?>
                                                                 <span class="badge bg-warning">Belum di acc</span>
                                                             <?php elseif ($u->acc_jurnal == 1) : ?>
                                                                 <span class="badge bg-success">Selesai</span>
                                                             <?php elseif ($u->acc_jurnal == 2) : ?>
                                                                 <span class="badge bg-primary">Belum kembali</span>
                                                             <?php endif ?>
                                                         </td>
                                                     </tr>
                                                 <?php endforeach ?>
                                                 <?php if ($total_lamakeluar['lama_keluar'] != null) : ?>
                                                     <tr class="gradeX">
                                                         <td>
                                                             <h5 class="bbold">Total Menit</h5>
                                                         </td>
                                                         <td>
                                                             <h5 class="bbold">
                                                                 <?= $total_lamakeluar['lama_keluar'] ?> Menit
                                                             </h5>
                                                         </td>
                                                         <td></td>
                                                         <td></td>
                                                         <td></td>
                                                         <td></td>
                                                         <td></td>
                                                     </tr>
                                                 <?php endif ?>
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
                                             <h2 style="font-weight: bold" class="mb">Seluruh Data Jurnal</h2>
                                         </div>
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>

                                                     <th>No</th>
                                                     <th>Tanggal</th>
                                                     <th>Kegiatan Keluar</th>
                                                     <th>Mulai Pukul</th>
                                                     <th>Sampai Pukul</th>
                                                     <th>Lama Keluar</th>
                                                     <th>Keterangan</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1; ?>
                                                 <?php foreach ($seluruh_jurnalku as $u) : ?>
                                                     <tr class="gradeX">
                                                         <td><?= $no++ ?></td>
                                                         <td><?= $u->tanggal_jurnal ?></td>
                                                         <td><?= ucwords($u->kegiatan_keluar) ?></td>
                                                         <td><?= ucwords($u->mulai_pukul) ?></td>
                                                         <td><?= ucwords($u->sampai_pukul) ?></td>

                                                         <td>
                                                             <?php if ($u->acc_jurnal == 1) : ?>
                                                                 <?= ucwords($u->lama_keluar) ?> Menit
                                                             <?php else : ?>
                                                                 <span class="badge">
                                                                     <?php
                                                                        $mulai_pukul = $u->mulai_pukul;
                                                                        $time = new DateTime($mulai_pukul);
                                                                        $now = new DateTime();

                                                                        echo $time->diff($now)->format('%h jam %i menit');
                                                                        ?>
                                                                 </span>
                                                             <?php endif ?>
                                                         </td>
                                                         <td>
                                                             <?php if ($u->acc_jurnal == 0) : ?>
                                                                 <span class="badge bg-warning">Belum di acc</span>
                                                             <?php elseif ($u->acc_jurnal == 1) : ?>
                                                                 <span class="badge bg-success">Selesai</span>
                                                             <?php elseif ($u->acc_jurnal == 2) : ?>
                                                                 <span class="badge bg-primary">Belum kembali</span>
                                                             <?php endif ?>
                                                         </td>
                                                     </tr>
                                                 <?php endforeach ?>
                                                 <?php if ($total_lamakeluarsemua['lama_keluar'] != null) : ?>
                                                     <tr class="gradeX">
                                                         <td>
                                                             <h5 class="bbold">Total Menit</h5>
                                                         </td>
                                                         <td>
                                                             <h5 class="bbold">
                                                                 <?= $total_lamakeluarsemua['lama_keluar'] ?> Menit
                                                             </h5>
                                                         </td>
                                                         <td></td>
                                                         <td></td>
                                                         <td></td>
                                                         <td></td>
                                                         <td></td>
                                                     </tr>
                                                 <?php endif ?>
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