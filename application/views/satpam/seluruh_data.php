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
                     <li><a href="<?= base_url("satpam/data_kepulangan") ?>">Data Kepulangan</a></li>
                     <li class="active"><a href="<?= base_url("satpam/seluruh_data") ?>">Seluruh Data</a></li>
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
                                 <a data-toggle="tab" href="#seluruh_k">Seluruh Data Kehadiran</a>
                             </li>
                             <li>
                                 <a data-toggle="tab" href="#seluruh_j">Seluruh Data Jurnal</a>
                             </li>
                         </ul>
                     </div>
                     <!-- /panel-heading -->
                     <div class="panel-body">
                         <div class="tab-content">
                             <div id="seluruh_k" class="tab-pane active">
                                 <div class="row">
                                     <!-- Modal aadad-->
                                     <div class="modal fade" id="modalEditKehadiran" tabindex="-1" role="dialog" aria-labelledby="modalTKelas" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                     <h4 class="modal-title" id="myModalLabel">Edit Kehadiran</h4>
                                                 </div>
                                                 <!-- <div class="modal-body"> -->
                                                 <div class="">
                                                     <form action="<?= base_url('satpam/edit_kehadiran_modal') ?>" method="post">

                                                         <!-- /col-md-4 -->
                                                         <div class="col-md-4 centered">
                                                             <div class="profile-pic">
                                                                 <p>
                                                                     <img class="img-circle" id="ek_foto">
                                                                 </p>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-8 profile-text mt">
                                                             <div class="form-group">
                                                                 <label for="ek_nama">Nama</label>
                                                                 <input type="hidden" name="ek_id" id="ek_id">
                                                                 <input type="hidden" name="ek_fk" id="ek_fk">
                                                                 <input type="text" readonly name="ek_nama" id="ek_nama" class="form-control round-form">
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="ek_absen">Absensi</label>

                                                                 <select class="form-control round-form" name="ek_absen" id="ek_absen">
                                                                     <option value=0>~ Pilih ~</option>
                                                                     <?php foreach ($ket_absensi as $k) : ?>
                                                                         <option value="<?= $k->id_absensi ?>"><?= $k->ket_absensi ?></option>
                                                                     <?php endforeach ?>
                                                                 </select>
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="ek_jamd">Jam Datang</label>
                                                                 <div class="input-group bootstrap-timepicker">
                                                                     <input name="ek_jamd" id="ek_jamd" type="text" class="form-control timepicker-24" autocomplete="off">
                                                                     <span class="input-group-btn">
                                                                         <button class="btn btn-theme01" type="button"><i class="fa fa-clock-o"></i></button>
                                                                     </span>
                                                                 </div>
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="ek_ketd">Keterangan Datang</label>
                                                                 <textarea name="ek_ketd" id="ek_ketd" class="form-control" cols="30" rows="5" placeholder="Keterangan (tidak wajib di isi)"></textarea>
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
                                     <div class="col-md-12">
                                         <div class="col-md-9">
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
                                                     <th>Ket Datang</th>
                                                     <th>Jam Pulang</th>
                                                     <th>Ket Pulang</th>
                                                     <th>Aksi</th>
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
                                                         <td><?= $u->jam_datang ?>
                                                             <?php if ($u->jam_datang == null) : ?>
                                                                 <span class="badge bg-warning">Tidak Hadir</span>
                                                             <?php else : ?>
                                                                 <?php if ($u->terlambat > 0) : ?>
                                                                     <p><span class="badge bg-important">Terlambat <?= $u->terlambat ?> menit</span></p>
                                                                 <?php else : ?>
                                                                     <p><span class="badge bg-success">Tidak Terlambat</span></p>
                                                                 <?php endif ?>
                                                             <?php endif ?>

                                                         </td>
                                                         <td><?= $u->ket_jd ?></td>
                                                         <td>

                                                             <?php if ($u->tanggal == date('Y-m-d') && $u->jam_pulang <= date('H:i:s') && $u->jam_pulang != null) : ?>
                                                                 <?= $u->jam_pulang ?>
                                                                 <p><span class="badge bg-default">Sudah Pulang</span></p>
                                                             <?php elseif ($u->ket_absen != 1) : ?>
                                                             <?php elseif ($u->tanggal == date('Y-m-d')) : ?>
                                                                 <?= $u->jam_pulang ?>
                                                                 <p><span class="badge bg-success">Masih di Pondok</span></p>
                                                             <?php elseif ($u->tanggal != date('Y-m-d')) : ?>
                                                                 <?= $u->jam_pulang ?>
                                                             <?php endif ?>
                                                         </td>
                                                         <td><?= $u->ket_jp ?></td>
                                                         <td>
                                                             <?php if ($u->tanggal == date('Y-m-d')) : ?>
                                                                 <a data-k_foto="<?= $u->foto ?>" data-k_nama="<?= $u->nama_pegawai ?>" data-k_id="<?= $u->id_kehadiran ?>" data-k_fk="<?= $u->fk_user_kehadiran ?>" data-k_absen="<?= $u->ket_absen ?>" data-k_jamd="<?= $u->jam_datang ?>" data-k_ketd="<?= $u->ket_jd ?>" data-k_jamp="<?= $u->jam_pulang ?>" data-k_ketp="<?= $u->ket_jp ?>" href="" class="btn btn-xs btn-primary tombol_editkehadiran" data-toggle="modal" data-target="#modalEditKehadiran"><i class="fa fa-edit"></i></a>
                                                                 <a href="<?= base_url("satpam/hapus_kehadiran_sd") ?>/<?= $u->id_kehadiran ?>a<?= $u->fk_user_kehadiran ?>" class="btn btn-xs btn-danger tombol-hapus"><i class="fa fa-trash"></i></a>
                                                             <?php else : ?>
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
                             <div id="seluruh_j" class="tab-pane">
                                 <div class="row">
                                     <!-- Modal aadad-->
                                     <div class="modal fade" id="modalEditJurnal" tabindex="-1" role="dialog" aria-labelledby="modalTKelas" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                     <h4 class="modal-title" id="myModalLabel">Edit Jurnal</h4>
                                                 </div>
                                                 <!-- <div class="modal-body"> -->
                                                 <div class="">
                                                     <form action="<?= base_url('satpam/edit_jurnal_modal') ?>" method="post">

                                                         <!-- /col-md-4 -->
                                                         <div class="col-md-4 centered">
                                                             <div class="profile-pic">
                                                                 <p>
                                                                     <img class="img-circle" id="ej_foto">
                                                                 </p>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-8 profile-text mt">
                                                             <div class="form-group">
                                                                 <label for="ej_nama">Nama</label>
                                                                 <input type="hidden" name="ej_id" id="ej_id">
                                                                 <input type="hidden" name="ej_fk" id="ej_fk">
                                                                 <input type="text" readonly name="ej_nama" id="ej_nama" class="form-control round-form">
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="ej_mulaip">Mulai Pukul</label>
                                                                 <div class="input-group bootstrap-timepicker">
                                                                     <input name="ej_mulaip" id="ej_mulaip" type="text" class="form-control timepicker-24" autocomplete="off">
                                                                     <span class="input-group-btn">
                                                                         <button class="btn btn-theme01" type="button"><i class="fa fa-clock-o"></i></button>
                                                                     </span>
                                                                 </div>
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="ej_sampaip">Sampai Pukul</label>
                                                                 <div class="input-group bootstrap-timepicker">
                                                                     <input name="ej_sampaip" id="ej_sampaip" type="text" class="form-control timepicker-24" autocomplete="off">
                                                                     <span class="input-group-btn">
                                                                         <button class="btn btn-theme01" type="button"><i class="fa fa-clock-o"></i></button>
                                                                     </span>
                                                                 </div>
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="ej_ket">Kegiatan Keluar</label>
                                                                 <textarea name="ej_ket" id="ej_ket" class="form-control" cols="30" rows="5" placeholder="Keterangan (wajib di isi)"></textarea>
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
                                     <!-- Modal aadad-->
                                     <div class="modal fade" id="modalEditJurnal1" tabindex="-1" role="dialog" aria-labelledby="modalTKelas" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                     <h4 class="modal-title" id="myModalLabel">Edit Jurnal</h4>
                                                 </div>
                                                 <!-- <div class="modal-body"> -->
                                                 <div class="">
                                                     <form action="<?= base_url('satpam/edit_jurnal_modal1') ?>" method="post">

                                                         <!-- /col-md-4 -->
                                                         <div class="col-md-4 centered">
                                                             <div class="profile-pic">
                                                                 <p>
                                                                     <img class="img-circle" id="ej_foto1">
                                                                 </p>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-8 profile-text mt">
                                                             <div class="form-group">
                                                                 <label for="ej_nama1">Nama</label>
                                                                 <input type="hidden" name="ej_id1" id="ej_id1">
                                                                 <input type="hidden" name="ej_fk1" id="ej_fk1">
                                                                 <input type="text" readonly name="ej_nama1" id="ej_nama1" class="form-control round-form">
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="ej_mulaip1">Mulai Pukul</label>
                                                                 <div class="input-group bootstrap-timepicker">
                                                                     <input name="ej_mulaip1" id="ej_mulaip1" type="text" class="form-control timepicker-24" autocomplete="off">
                                                                     <span class="input-group-btn">
                                                                         <button class="btn btn-theme01" type="button"><i class="fa fa-clock-o"></i></button>
                                                                     </span>
                                                                 </div>
                                                             </div>
                                                             <div class="form-group">
                                                                 <label for="ej_ket1">Kegiatan Keluar</label>
                                                                 <textarea name="ej_ket1" id="ej_ket1" class="form-control" cols="30" rows="5" placeholder="Keterangan (wajib di isi)"></textarea>
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
                                                     <th>Aksi</th>
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
                                                         <td>
                                                             <?php if ($u->tanggal_jurnal == date('Y-m-d')) : ?>
                                                                 <?php if ($u->acc_jurnal == 1) : ?>
                                                                     <a data-e_id="<?= $u->id_jurnal ?>" data-e_fk="<?= $u->fk_user_jurnal ?>" data-e_ket="<?= $u->kegiatan_keluar ?>" data-e_foto="<?= $u->foto ?>" data-e_nama="<?= $u->nama_pegawai ?>" data-e_mulaip="<?= $u->mulai_pukul ?>" data-e_sampaip="<?= $u->sampai_pukul ?>" class="btn btn-xs btn-primary tombol_editjurnal" data-toggle="modal" data-target="#modalEditJurnal"><i class="fa fa-edit"></i></a>
                                                                     <a href="<?= base_url("satpam/hapus_jurnal") ?>/<?= $u->id_jurnal ?>" class="btn btn-xs btn-danger tombol-hapus"><i class="fa fa-trash"></i></a>
                                                                 <?php else : ?>
                                                                     <a data-e_id="<?= $u->id_jurnal ?>" data-e_fk="<?= $u->fk_user_jurnal ?>" data-e_ket="<?= $u->kegiatan_keluar ?>" data-e_foto="<?= $u->foto ?>" data-e_nama="<?= $u->nama_pegawai ?>" data-e_mulaip="<?= $u->mulai_pukul ?>" class="btn btn-xs btn-primary tombol_editjurnal1" data-toggle="modal" data-target="#modalEditJurnal1"><i class="fa fa-edit"></i></a>
                                                                     <a href="<?= base_url("satpam/hapus_edit_jurnal") ?>/<?= $u->id_jurnal ?>a<?= $u->fk_user_jurnal ?>" class="btn btn-xs btn-danger tombol-hapus"><i class="fa fa-trash"></i></a>
                                                                 <?php endif ?>
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