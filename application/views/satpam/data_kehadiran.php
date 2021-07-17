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
                     <li class="active"><a href="<?= base_url("satpam/data_kehadiran") ?>">Data Kehadiran</a></li>
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
                         <h1 style="font-weight: bold" class="mb"><i class="fa fa-clipboard"></i> Data Kehadiran Hari Ini</h1>
                         <?= $this->session->flashdata('message'); ?>
                         <ul class="nav nav-tabs nav-justified">
                             <li class="active">
                                 <a data-toggle="tab" href="#belum_hadir">Belum Hadir</a>
                             </li>
                             <li>
                                 <a data-toggle="tab" href="#hadir">Telah Hadir</a>
                             </li>
                             <li>
                                 <a data-toggle="tab" href="#tidak_hadir">Tidak Hadir</a>
                             </li>
                         </ul>
                     </div>
                     <!-- /panel-heading -->
                     <div class="panel-body">
                         <div class="tab-content">
                             <div id="belum_hadir" class="tab-pane active">
                                 <!-- Modal -->
                                 <div class="modal fade" id="modalIsiKehadiran" tabindex="-1" role="dialog" aria-labelledby="modalTKelas" aria-hidden="true">
                                     <div class="modal-dialog">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                 <h4 class="modal-title" id="myModalLabel">Isi Kehadiran Hari Ini</h4>
                                             </div>
                                             <!-- <div class="modal-body"> -->
                                             <div class="">
                                                 <form action="<?= base_url('satpam/isi_kehadiran_modal') ?>" method="post">

                                                     <!-- /col-md-4 -->
                                                     <div class="col-md-4 centered">
                                                         <div class="profile-pic">
                                                             <p>
                                                                 <img class="img-circle" id="ik_foto">
                                                             </p>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-8 profile-text mt">
                                                         <div class="form-group">
                                                             <label for="ik_nama">Nama</label>
                                                             <input type="hidden" name="ik_id" id="ik_id">
                                                             <input type="text" readonly name="ik_nama" id="ik_nama" class="form-control round-form">
                                                         </div>
                                                         <div class="form-group">
                                                             <label for="ik_absensi">Absensi</label>

                                                             <select class="form-control round-form" name="ik_absensi" id="ik_absensi">
                                                                 <option value=0>~ Pilih ~</option>
                                                                 <?php foreach ($ket_absensi as $k) : ?>
                                                                     <option value="<?= $k->id_absensi ?>"><?= $k->ket_absensi ?></option>
                                                                 <?php endforeach ?>
                                                             </select>
                                                         </div>
                                                         <div class="form-group">
                                                             <label for="jd">Jam Datang</label>
                                                             <div class="input-group bootstrap-timepicker">
                                                                 <input name="jd" id="jd" type="text" class="form-control timepicker-24" autocomplete="off" value="<?= date('H:i:s') ?>">
                                                                 <span class="input-group-btn">
                                                                     <button class="btn btn-theme01" type="button"><i class="fa fa-clock-o"></i></button>
                                                                 </span>
                                                             </div>
                                                         </div>
                                                         <div class="form-group">
                                                             <label for="ik_ket">Keterangan Absensi</label>
                                                             <textarea name="ik_ket" id="ik_ket" class="form-control" cols="30" rows="5" placeholder="Keterangan (opsional)"></textarea>
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
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="col-md-9">
                                             <h6>
                                                 <!-- <a href="<?= base_url("satpam/mulai_absen") ?>" class="btn btn-round btn-primary mb"><i class="fa fa-undo"></i> Mulai Absen</a> -->
                                             </h6>
                                         </div>
                                         <div class="col-md-3">
                                             <h4 class=""><b>
                                                     <span id="tgljs"></span>
                                                     <p> Pukul : <span id="jam"></span>:
                                                         <span id="menit"></span>:
                                                         <span id="detik"></span>
                                                     </p>
                                                 </b>
                                             </h4>
                                         </div>
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>
                                                     <th>No</th>
                                                     <th>Foto</th>
                                                     <th>Nama</th>
                                                     <th>Jabatan</th>
                                                     <th>Alamat</th>
                                                     <th>Online</th>
                                                     <th>Aksi</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1; ?>
                                                 <?php foreach ($users_ahi as $u) : ?>
                                                     <tr class="gradeX">
                                                         <td><?= $no++ ?></td>
                                                         <td>
                                                             <img src="<?= base_url("assets/img/profile/") ?><?= $u->foto ?>" alt="" width="50" class="img-circle">
                                                         </td>
                                                         <td><?= strtoupper($u->nama_pegawai) ?></td>
                                                         <td><?= strtoupper($u->nama_jabatan) ?></td>
                                                         <td><?= ucwords($u->alamat) ?></td>
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
                                                         <td>
                                                             <a data-ik_id="<?= $u->fk_user_ahi ?>" data-ik_nama="<?= $u->nama_pegawai ?>" data-ik_foto="<?= $u->foto ?>" href="" data-toggle="modal" data-target="#modalIsiKehadiran" class="btn btn-warning btn-round tombol_isikehadiran"><i class="fa fa-pencil"></i> ISI KEHADIRAN</a>
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
                             <div id="hadir" class="tab-pane">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>
                                                     <th>No</th>
                                                     <th>Foto</th>
                                                     <th>Nama</th>
                                                     <th>Jabatan</th>
                                                     <th>Jam Datang</th>
                                                     <th>Terlambat</th>
                                                     <th>Keterangan</th>
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
                                                         <td><?= strtoupper($u->nama_jabatan) ?></td>
                                                         <td><?= $u->jam_datang_ahi ?></td>
                                                         <td>
                                                             <?php if ($u->terlambat_ahi > 0) : ?>
                                                                 <span class="badge bg-important"><?= $u->terlambat_ahi ?> Menit</span>
                                                             <?php else : ?>
                                                                 <span class="badge bg-success">Tidak Terlambat</span>
                                                             <?php endif ?>
                                                         </td>
                                                         <td><?= $u->ket_datang_ahi ?></td>
                                                     </tr>
                                                 <?php endforeach ?>
                                             </tbody>
                                         </table>
                                     </div>
                                 </div>
                                 <!-- /row -->
                             </div>
                             <!-- /tab-pane -->
                             <!-- /tab-pane -->
                             <div id="tidak_hadir" class="tab-pane">
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
                                                     <th>Keterangan</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1; ?>
                                                 <?php foreach ($users_ahi_thadir as $u) : ?>
                                                     <tr class="gradeX">
                                                         <td><?= $no++ ?></td>
                                                         <td>
                                                             <img src="<?= base_url("assets/img/profile/") ?><?= $u->foto ?>" alt="" width="50" class="img-circle">
                                                         </td>
                                                         <td><?= strtoupper($u->nama_pegawai) ?></td>
                                                         <td><?= strtoupper($u->nama_jabatan) ?></td>
                                                         <td><?= $u->ket_absensi ?></td>
                                                         <td><?= $u->ket_datang_ahi ?></td>
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
 <script src="<?= base_url("assets/") ?>js/waktu.js"></script>