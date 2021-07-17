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
                 <a class="active" href="javascript:;">
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
                     <li class="active"><a href="<?= base_url("satpam/data_kepulangan") ?>">Data Kepulangan</a></li>
                     <li class=""><a href="<?= base_url("satpam/seluruh_data") ?>">Seluruh Data</a></li>
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


 <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <!-- Modal -->
 <div class="modal fade" id="modalPulangCepat" tabindex="-1" role="dialog" aria-labelledby="modalTKelas" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Izin Pulang Lebih Awal</h4>
             </div>
             <!-- <div class="modal-body"> -->
             <div class="">
                 <form action="<?= base_url('satpam/pulang_cepat_modal') ?>" method="post">

                     <!-- /col-md-4 -->
                     <div class="col-md-4 centered">
                         <div class="profile-pic">
                             <p>
                                 <img class="img-circle" id="p_foto">
                             </p>
                         </div>
                     </div>
                     <div class="col-md-8 profile-text mt">
                         <div class="form-group">
                             <label for="p_nama">Nama</label>
                             <input type="hidden" name="p_id" id="p_id">
                             <input type="hidden" name="p_idk" id="p_idk">
                             <input type="text" readonly name="p_nama" id="p_nama" class="form-control round-form">
                         </div>
                         <div class="form-group">
                             <label for="p_jamp">Jam Pulang</label>
                             <div class="input-group bootstrap-timepicker">
                                 <input name="p_jamp" id="p_jamp" type="text" value="<?= date('H:i:s') ?>" class="form-control timepicker-24" autocomplete="off">
                                 <span class="input-group-btn">
                                     <button class="btn btn-theme01" type="button"><i class="fa fa-clock-o"></i></button>
                                 </span>
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="p_ket">Alasan / Keterangan Pulang Lebih Awal</label>
                             <textarea name="p_ket" id="p_ket" class="form-control" cols="30" rows="5" placeholder="Keterangan (wajib di isi)"></textarea>
                         </div>
                     </div>
             </div>
             <!-- </div> -->
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Simpan</button>
             </div>
             </form>
         </div>
     </div>
 </div>
 <section id="main-content">
     <section class="wrapper site-min-height">

         <aside>
             <!-- /col-lg-12 -->
             <div class="col-lg-12 mt">
                 <div class="row content-panel">
                     <div class="panel-heading">
                         <h1 style="font-weight: bold" class="mb"><i class="fa fa-clipboard"></i> Data Kepulangan Hari Ini</h1>
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
                                             <th>Foto</th>
                                             <th>Nama</th>
                                             <th>Jam Datang</th>
                                             <th>Ket Datang</th>
                                             <th>Jam Pulang</th>
                                             <th>Ket Pulang</th>
                                             <th>Keterangan</th>
                                             <th>Aksi</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php $no = 1; ?>
                                         <?php foreach ($users_ahi_hadir as $u) : ?>
                                             <tr class="gradeX">
                                                 <td><?= $no++ ?></td>
                                                 <td>
                                                     <img src="<?= base_url("assets/img/profile/") ?><?= $u->foto ?>" alt="" width="50" class="img-circle">
                                                 </td>
                                                 <td><?= strtoupper($u->nama_pegawai) ?></td>
                                                 <td><?= $u->jam_datang_ahi ?></td>
                                                 <td><?= $u->ket_datang_ahi ?></td>
                                                 <td>
                                                     <?= $u->jam_pulang_ahi ?>
                                                 </td>
                                                 <td><?= $u->ket_pulang_ahi ?></td>
                                                 <td>
                                                     <?php if ($u->tanggal_ahi == date('Y-m-d') && $u->jam_pulang_ahi <= date('H:i:s')) : ?>
                                                         <span class="badge bg-default">Sudah Pulang</span>
                                                     <?php else : ?>
                                                         <span class="badge bg-success">Masih di pondok</span>
                                                     <?php endif ?>
                                                 </td>
                                                 <td>
                                                     <?php if ($u->tanggal_ahi == date('Y-m-d') && $u->jam_pulang_ahi >= date('H:i:d')) : ?>
                                                         <a data-id_p="<?= $u->fk_user_ahi ?>" data-fk_kehadiran_p="<?= $u->fk_kehadiran ?>" data-foto_p="<?= $u->foto ?>" data-nama_p="<?= $u->nama_pegawai ?>" href="" class="btn btn-warning btn-round tombol_pulangcepat" data-toggle="modal" data-target="#modalPulangCepat"><i class="fa fa-home"></i> Pulang</a>
                                                     <?php elseif ($u->tanggal_ahi == date('Y-m-d')) : ?>
                                                     <?php endif ?>
                                                 </td>
                                             </tr>
                                         <?php endforeach ?>
                                     </tbody>
                                 </table>

                             </div>

                         </div>
                     </div>
                     <!-- /tab-pane -->
                 </div>
                 <!-- /tab-content -->
         </aside>
     </section>
     <!-- /wrapper -->
 </section>
 <!-- /MAIN CONTENT -->
 <!--main content end-->