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
                     <li class="active"><a href="<?= base_url("admin/data_jurnal") ?>">Data Jurnal</a></li>
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
                                 <a data-toggle="tab" href="#data_jhi">Jurnal Hari Ini</a>
                             </li>
                             <li>
                                 <a data-toggle="tab" href="#seluruh_data">Seluruh Data Jurnal</a>
                             </li>
                         </ul>
                     </div>
                     <!-- /panel-heading -->
                     <div class="panel-body">
                         <div class="tab-content">
                             <div id="data_jhi" class="tab-pane active">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="col-md-9">
                                             <h2 style="font-weight: bold" class="mb">
                                                 Jurnal Hari Ini
                                             </h2>
                                         </div>

                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>

                                                     <th>No</th>
                                                     <th>Foto</th>
                                                     <th>Nama</th>
                                                     <th>Kegiatan Keluar</th>
                                                     <th>Mulai Pukul</th>
                                                     <th>Sampai Pukul</th>
                                                     <th>Lama Keluar</th>
                                                     <th>Keterangan</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1; ?>
                                                 <?php foreach ($jurnal_acc as $u) : ?>
                                                     <tr class="gradeX">
                                                         <td><?= $no++ ?></td>
                                                         <td>
                                                             <img src="<?= base_url("assets/img/profile/") ?><?= $u->foto ?>" alt="" width="50" class="img-circle">
                                                         </td>
                                                         <td><?= strtoupper($u->nama_pegawai) ?></td>
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
                                                                 <a data-ij_id="<?= $u->id_jurnal ?>" data-ij_mulaipukul="<?= $u->mulai_pukul ?>" data-ij_fk="<?= $u->fk_user_jurnal ?>" data-ij_nama="<?= $u->nama_pegawai ?>" data-ij_ket="<?= $u->kegiatan_keluar ?>" data-ij_foto="<?= $u->foto ?>" data-ij_acc="<?= $u->acc_jurnal ?>" data-toggle="modal" data-target="#modalJurnalSelesai" class="btn btn-warning btn-round tombol_acckembali"><i class="fa fa-pencil"></i> ACC TELAH KEMBALI</a>
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
                                             <h2 style="font-weight: bold" class="mb">Seluruh Data Jurnal</h2>
                                         </div>
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>

                                                     <th>No</th>
                                                     <th>Foto</th>
                                                     <th>Nama</th>
                                                     <th>Kegiatan Keluar</th>
                                                     <th>Tanggal</th>
                                                     <th>Mulai Pukul</th>
                                                     <th>Sampai Pukul</th>
                                                     <th>Lama Keluar</th>
                                                     <th>Keterangan</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1; ?>
                                                 <?php foreach ($seluruh_jurnal as $u) : ?>
                                                     <tr class="gradeX">
                                                         <td><?= $no++ ?></td>
                                                         <td>
                                                             <img src="<?= base_url("assets/img/profile/") ?><?= $u->foto ?>" alt="" width="50" class="img-circle">
                                                         </td>
                                                         <td><?= strtoupper($u->nama_pegawai) ?></td>
                                                         <td><?= ucwords($u->kegiatan_keluar) ?></td>
                                                         <td><?= $u->tanggal_jurnal ?></td>
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