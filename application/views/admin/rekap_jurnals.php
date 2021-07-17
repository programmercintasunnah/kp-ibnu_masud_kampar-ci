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
                 <a href="javascript:;">
                     <i class="fa fa-clipboard"></i>
                     <span>Kehadiran & Jurnal</span>
                 </a>
                 <ul class="sub">
                     <li><a href="<?= base_url("admin/data_kehadiran") ?>">Data Kehadiran</a></li>
                     <li><a href="<?= base_url("admin/data_jurnal") ?>">Data Jurnal</a></li>
                     <li><a href="<?= base_url("admin/rekap_data") ?>">Rekap Data</a></li>
                 </ul>
             </li>
             <li class="sub-menu">
                 <a href="javascript:;">
                     <i class="fa fa-th-list"></i>
                     <span>Data Master</span>
                 </a>
                 <ul class="sub">
                     <li><a href="<?= base_url("admin/data_users") ?>">Data Users & Jabatan</a></li>
                     <li><a href="<?= base_url("admin/data_info") ?>">Data Informasi</a></li>
                     <li><a href="<?= base_url("admin/data_jadwal") ?>">Data Jadwal</a></li>
                 </ul>
             </li>
             <li class="sub-menu">
                 <a class="active" href="javascript:;">
                     <i class="fa fa-clipboard"></i>
                     <span>Rekap Data Saya</span>
                 </a>
                 <ul class="sub">
                     <li><a href="<?= base_url("admin/rekap_kehadirans") ?>">Rekap Kehadiran</a></li>
                     <li class="active"><a href="<?= base_url("admin/rekap_jurnals") ?>">Rekap Jurnal</a></li>
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
                                             <h2 style="font-weight: bold" class="">
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
                                         </div>
                                         </h2>
                                         <div class="col-md-10">
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
                                                             <form action="<?= base_url('admin/mulai_jurnal_modal') ?>" method="post">

                                                                 <!-- /col-md-4 -->
                                                                 <div class="col-md-4 centered">
                                                                     <div class="profile-pic">
                                                                         <p>
                                                                             <img class="img-circle" id="ij_foto" src="<?= base_url('assets/img/profile') ?>/<?= $profile['foto'] ?>">
                                                                         </p>
                                                                     </div>
                                                                 </div>
                                                                 <div class="col-md-8 profile-text mt">
                                                                     <div class="form-group">
                                                                         <label for="ij_nama">Nama</label>
                                                                         <input type="text" value="<?= ucwords($profile['nama_pegawai']) ?>" readonly name="ij_nama" id="ij_nama" class="form-control round-form">
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
                                             <h4 class="gen-case">
                                                 <a class="btn btn-theme btn-round" data-toggle="modal" data-target="#modalIsiJurnal">
                                                     <i class="fa fa-pencil"></i> Isi Jurnal
                                                 </a>
                                                 <p class="mt">
                                                     <?php if ($setting['status'] == 1) : ?>
                                                         *Sistem Kejujuran Isi Jurnal <span class="badge bg-success">Aktif</span>
                                                     <?php else : ?>
                                                         *Sistem Kejujuran Isi Jurnal <span class="badge bg-default">Tidak Aktif</span>
                                                     <?php endif ?>
                                                 </p>
                                             </h4>

                                         </div>
                                         <div class="col-md-2">
                                             <br><br>
                                             <a href="<?= base_url("admin/pdf_rekapjurnalku") ?>" class="btn btn-danger"><i class="fa fa-file-text"></i> Export PDF</a>
                                         </div>
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
                                                         <form action="<?= base_url('admin/selesai_jurnal_modal') ?>" method="post">

                                                             <!-- /col-md-4 -->
                                                             <div class="col-md-4 centered">
                                                                 <div class="profile-pic">
                                                                     <p>
                                                                         <img class="img-circle" id="ij_foto1" src="<?= base_url('assets/img/profile') ?>/<?= $profile['foto'] ?>">
                                                                     </p>
                                                                 </div>
                                                             </div>
                                                             <div class="col-md-8 profile-text mt">
                                                                 <div class="form-group">
                                                                     <label for="ij_nama1">Nama</label>
                                                                     <input type="hidden" name="ij_id1" id="ij_id1">
                                                                     <input type="text" value="<?= ucwords($profile['nama_pegawai']) ?>" readonly name="ij_nama1" id="ij_nama1" class="form-control round-form">
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
                                                                 <?php if ($setting['status'] == 1) : ?>
                                                                     <a data-ij_id="<?= $u->id_jurnal ?>" data-ij_ket="<?= $u->kegiatan_keluar ?>" data-toggle="modal" data-target="#modalJurnalSelesai" class="btn btn-warning btn-round tombol_acckembaliku"><i class="fa fa-pencil"></i> ACC TELAH KEMBALI</a>
                                                                 <?php else : ?>
                                                                     <span class="badge bg-primary">Belum kembali</span>
                                                                 <?php endif ?>
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