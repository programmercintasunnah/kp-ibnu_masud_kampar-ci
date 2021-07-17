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
                     <li class=""><a href="<?= base_url("satpam/data_kehadiran") ?>">Data Kehadiran</a></li>
                     <li class="active">
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
                         <h1 style="font-weight: bold" class="mb"><i class="fa fa-clipboard"></i> Data Jurnal Hari Ini</h1>
                         <?= $this->session->flashdata('message'); ?>
                         <ul class="nav nav-tabs nav-justified">
                             <li class="active">
                                 <a data-toggle="tab" href="#isi_jurnal">Isi Jurnal Hari Ini</a>
                             </li>
                             <li>
                                 <a data-toggle="tab" href="#jurnal_acc">Data Jurnal Hari Ini</a>
                             </li>
                         </ul>
                     </div>
                     <!-- /panel-heading -->
                     <div class="panel-body">
                         <div class="tab-content">
                             <div id="isi_jurnal" class="tab-pane active">
                                 <!-- Modal -->
                                 <div class="modal fade" id="modalIsiJurnal" tabindex="-1" role="dialog" aria-labelledby="modalTKelas" aria-hidden="true">
                                     <div class="modal-dialog">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                 <h4 class="modal-title" id="myModalLabel">Isi Jurnal Hari Ini</h4>
                                             </div>
                                             <!-- <div class="modal-body"> -->
                                             <div class="">
                                                 <form action="<?= base_url('satpam/mulai_jurnal_modal') ?>" method="post">

                                                     <!-- /col-md-4 -->
                                                     <div class="col-md-4 centered">
                                                         <div class="profile-pic">
                                                             <p>
                                                                 <img class="img-circle" id="ij_foto">
                                                             </p>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-8 profile-text mt">
                                                         <div class="form-group">
                                                             <label for="ij_nama">Nama</label>
                                                             <input type="hidden" name="ij_id" id="ij_id">
                                                             <input type="hidden" name="ij_acc" id="ij_acc">
                                                             <input type="text" readonly name="ij_nama" id="ij_nama" class="form-control round-form">
                                                         </div>
                                                         <div class="form-group">
                                                             <label for="ij_ket">Kegiatan Keluar</label>
                                                             <textarea name="ij_ket" id="ij_ket" class="form-control" cols="30" rows="5" placeholder="Keterangan (wajib di isi)"></textarea>
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
                                             <h4 class="gen-case">
                                                 <p class="mt">
                                                     <?php if ($setting['status'] == 1) : ?>
                                                         *Sistem Kejujuran Isi Jurnal <span class="badge bg-success">Aktif</span>
                                                     <?php else : ?>
                                                         *Sistem Kejujuran Isi Jurnal <span class="badge bg-default">Tidak Aktif</span>
                                                     <?php endif ?>
                                                 </p>
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
                                                 <?php foreach ($jurnal_hariini as $u) : ?>
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

                                                             <?php if ($u->acc_jurnal_jhi == 0) : ?>
                                                                 <a data-ij_id="<?= $u->fk_user_jhi ?>" data-ij_nama="<?= $u->nama_pegawai ?>" data-ij_ket="<?= $u->kegiatan_keluar_jhi ?>" data-ij_foto="<?= $u->foto ?>" data-ij_acc="<?= $u->acc_jurnal_jhi ?>" href="" data-toggle="modal" data-target="#modalIsiJurnal" class="btn btn-theme btn-round tombol_isijurnal"><i class="fa fa-pencil"></i> ISI JURNAL</a>
                                                             <?php elseif ($u->acc_jurnal_jhi == 1) : ?>
                                                                 <a data-ij_id="<?= $u->fk_user_jhi ?>" data-ij_nama="<?= $u->nama_pegawai ?>" data-ij_ket="<?= $u->kegiatan_keluar_jhi ?>" data-ij_foto="<?= $u->foto ?>" data-ij_acc="<?= $u->acc_jurnal_jhi ?>" href="" data-toggle="modal" data-target="#modalIsiJurnal" class="btn btn-success btn-round tombol_isijurnal"><i class="fa fa-pencil"></i> ISI JURNAL LAGI</a>
                                                             <?php elseif ($u->acc_jurnal_jhi == 2) : ?>
                                                                 <span class="badge bg-primary">Belum kembali ke pondok</span>
                                                             <?php else : ?>
                                                                 <a data-ij_id="<?= $u->fk_user_jhi ?>" data-ij_nama="<?= $u->nama_pegawai ?>" data-ij_ket="<?= $u->kegiatan_keluar_jhi ?>" data-ij_foto="<?= $u->foto ?>" data-ij_acc="<?= $u->acc_jurnal_jhi ?>" href="" data-toggle="modal" data-target="#modalIsiJurnal" class="btn btn-warning btn-round tombol_accjurnal"><i class="fa fa-pencil"></i> ACC JURNAL</a>
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
                             <div id="jurnal_acc" class="tab-pane">
                                 <!-- Modal aadad-->
                                 <div class="modal fade" id="modalJurnalSelesai" tabindex="-1" role="dialog" aria-labelledby="modalTKelas" aria-hidden="true">
                                     <div class="modal-dialog">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                 <h4 class="modal-title" id="myModalLabel1">Acc Telah Kembali</h4>
                                             </div>
                                             <!-- <div class="modal-body"> -->
                                             <div class="">
                                                 <form action="<?= base_url('satpam/selesai_jurnal_modal') ?>" method="post">

                                                     <!-- /col-md-4 -->
                                                     <div class="col-md-4 centered">
                                                         <div class="profile-pic">
                                                             <p>
                                                                 <img class="img-circle" id="ij_foto1">
                                                             </p>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-8 profile-text mt">
                                                         <div class="form-group">
                                                             <label for="ij_nama1">Nama</label>
                                                             <input type="hidden" name="ij_id1" id="ij_id1">
                                                             <!-- <input type="time" name="ij_mulai_pukul1" id="ij_mulai_pukul1"> -->
                                                             <input type="hidden" name="ij_fk1" id="ij_fk1">
                                                             <input type="hidden" name="ij_acc1" id="ij_acc1">
                                                             <input type="text" readonly name="ij_nama1" id="ij_nama1" class="form-control round-form">
                                                         </div>
                                                         <div class="form-group">
                                                             <label for="ij_ket1">Kegiatan Keluar</label>
                                                             <textarea name="ij_ket1" id="ij_ket1" class="form-control" cols="30" rows="5" placeholder="Keterangan (wajib di isi)"></textarea>
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