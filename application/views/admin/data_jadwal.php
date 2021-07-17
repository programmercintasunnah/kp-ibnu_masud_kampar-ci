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
                 <a class="active" href="javascript:;">
                     <i class="fa fa-th-list"></i>
                     <span>Data Master</span>
                 </a>
                 <ul class="sub">
                     <li class=""><a href="<?= base_url("admin/data_users") ?>">Data Users & Jabatan</a></li>
                     <li><a href="<?= base_url("admin/data_info") ?>">Data Informasi</a></li>
                     <li class="active"><a href="<?= base_url("admin/data_jadwal") ?>">Data Jadwal</a></li>
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
                         <h1 style="font-weight: bold" class="mb"><i class="fa fa-clipboard"></i> Data Jadwal Jam Datang & Pulang</h1>
                         <?= $this->session->flashdata('message'); ?>
                     </div>
                     <!-- /panel-heading -->
                     <div class="panel-body">
                         <div class="tab-content">

                         </div>
                         <div class="row">
                             <div class="col-md-12">

                                 <!-- Modal -->
                                 <div class="modal fade" id="modalEditJam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                     <div class="modal-dialog">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                 <h4 class="modal-title" id="myModalLabel">Edit Jam Datang & Pulang</h4>
                                             </div>
                                             <div class="modal-body">
                                                 <form action="<?= base_url('admin/edit_jam') ?>" method="post">
                                                     <div class="form-group">
                                                         <label for="ej_hari">Hari</label>
                                                         <input type="hidden" name="ej_id" id="ej_id">
                                                         <input type="text" readonly name="ej_hari" id="ej_hari" autocomplete="off" class="form-control round-form">
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="ej_jamd">Jam Datang</label>
                                                         <div class="input-group bootstrap-timepicker">
                                                             <input name="ej_jamd" id="ej_jamd" type="text" class="form-control timepicker-24" autocomplete="off">
                                                             <span class="input-group-btn">
                                                                 <button class="btn btn-theme01" type="button"><i class="fa fa-clock-o"></i></button>
                                                             </span>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="ej_jamp">Jam Pulang</label>
                                                         <div class="input-group bootstrap-timepicker">
                                                             <input name="ej_jamp" id="ej_jamp" type="text" class="form-control timepicker-24" autocomplete="off">
                                                             <span class="input-group-btn">
                                                                 <button id="bnt" class="btn btn-theme01" type="button"><i class="fa fa-clock-o"></i></button>
                                                             </span>
                                                         </div>
                                                     </div>

                                             </div>
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                 <button type="submit" class="btn btn-primary">Simpan</button>
                                             </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- Modal -->
                                 <div class="modal fade" id="modalIsiJam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                     <div class="modal-dialog">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                 <h4 class="modal-title" id="myModalLabel">Tambah Jam Datang & Pulang</h4>
                                             </div>
                                             <div class="modal-body">
                                                 <form action="<?= base_url('admin/isi_jam') ?>" method="post">
                                                     <div class="form-group">
                                                         <label for="ij_hari">Hari</label>
                                                         <input type="hidden" name="ij_id" id="ij_id">
                                                         <input type="text" readonly name="ij_hari" id="ij_hari" autocomplete="off" class="form-control round-form">
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="ij_jamd">Jam Datang</label>
                                                         <div class="input-group bootstrap-timepicker">
                                                             <input type="text" class="form-control timepicker-24" id="ij_jamd" name="ij_jamd" autocomplete="off">
                                                             <span class="input-group-btn">
                                                                 <button class="btn btn-theme01" type="button"><i class="fa fa-clock-o"></i></button>
                                                             </span>
                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="ij_jamp">Jam Pulang</label>
                                                         <div class="input-group bootstrap-timepicker">
                                                             <input type="text" class="form-control timepicker-24" id="ij_jamp" name="ij_jamp" autocomplete="off">
                                                             <span class="input-group-btn">
                                                                 <button class="btn btn-theme01" type="button"><i class="fa fa-clock-o"></i></button>
                                                             </span>
                                                         </div>
                                                     </div>

                                             </div>
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
                                             <th>Hari</th>
                                             <th>Jam Datang</th>
                                             <th>Jam Pulang</th>
                                             <th>Aksi</th>
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
                                                 <td>
                                                     <?php if ($j->jam_datang == null && $j->jam_pulang == null) : ?>
                                                         <a data-ij_id="<?= $j->id_jam ?>" data-ij_hari="<?= $j->hari ?>" href="" data-toggle="modal" data-target="#modalIsiJam" class="btn btn-success btn-xs tombol_isijam"><i class="fa fa-plus"></i> Masukkan Jam</a>
                                                     <?php else : ?>
                                                         <a data-ej_jamd="<?= $j->jam_datang ?>" data-ej_jamp="<?= $j->jam_pulang ?>" data-ej_id="<?= $j->id_jam ?>" data-ej_hari="<?= $j->hari ?>" href="" data-toggle="modal" data-target="#modalEditJam" class="btn btn-primary btn-xs tombol_editjam"><i class="fa fa-edit"></i> Edit</a>
                                                         <a href="<?= base_url("admin/hapus_jam") ?>/<?= $j->id_jam ?>" class="btn btn-danger btn-xs tombol-hapus"><i class="fa fa-trash"></i> Hapus</a>
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