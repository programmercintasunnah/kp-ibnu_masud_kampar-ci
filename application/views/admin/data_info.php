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
                     <li><a href="<?= base_url("admin/data_users") ?>">Data Users & Jabatan</a></li>
                     <li class="active"><a href="<?= base_url("admin/data_info") ?>">Data Informasi</a></li>
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
 <!-- Modal edit -->
 <div class="modal fade" id="edit_pengumuman_modal" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Edit Pengumuman</h4>
             </div>
             <div class="modal-body">
                 <form action="<?= base_url("admin/update_pengumuman") ?>" method="post">
                     <h4 class="pull-left">Pengumuman :</h4><br><br>
                     <input type="hidden" id="idp" name="idp">
                     <textarea name="isip" id="isip" cols="30" rows="4" class="form-control round-form" placeholder=" Buat pengumuman. . . ."></textarea>
                     <h4 class="pull-left">Kepada :</h4><br><br>
                     <select class="form-control round-form mb" name="ke" id="ke">
                         <option value="">~ Pilih ~</option>
                         <option value=1>Seluruh User</option>
                         <option value=2>Seluruh Satpam</option>
                     </select>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Simpan</button>
             </div>
             </form>
         </div>
     </div>
 </div>

 <section id="main-content">
     <section class="wrapper">
         <div class="row mt">
             <div class="col-lg-12 col-md-6 col-sm-12">
                 <!--  BASIC BUTTONS -->
                 <div class="showback">
                     <h1 style="font-weight: bold" class="mb"><i class="fa fa-bell-o"></i> Pengumuman</h1>
                     <?= $this->session->flashdata('message'); ?>
                     <div class="room-desk">
                         <form action="<?= base_url("admin/add_pengumuman") ?>" method="post">
                             <h4 class="pull-left">Pengumuman :</h4><br><br>
                             <?= form_error('isi', '<p class="text-danger pl-1">', '</p>'); ?>
                             <textarea name="isi" id="isi" cols="30" rows="4" class="form-control round-form" placeholder=" Buat pengumuman. . . ."><?= set_value('isi') ?></textarea>
                             <h4 class="pull-left">Kepada :</h4><br><br>
                             <?= form_error('kepada', '<p class="text-danger pl-1">', '</p>'); ?>
                             <select class="form-control round-form mb" name="kepada" id="kepada">
                                 <option value="">~ Pilih ~</option>
                                 <option value=1>Seluruh User</option>
                                 <option value=2>Seluruh Satpam</option>
                             </select>
                             <button class="pull-right btn btn-theme mb btn-round"><i class="fa fa-save"></i> SIMPAN</button>
                         </form>
                         <?php foreach ($pengumuman as $p) : ?>
                             <div class="room-box">
                                 <a data-idp="<?= $p->id_pengumuman ?>" data-isip="<?= $p->isi ?>" data-ke="<?= $p->kepada ?>" href="" data-toggle="modal" data-target="#edit_pengumuman_modal" class="btn btn-primary btn-xs mb tombol_edit_pengumuman"><i class="fa fa-edit"></i></a>
                                 <a href="<?= base_url("admin/hapus_pengumuman") ?>/<?= $p->id_pengumuman ?>" class="btn btn-danger btn-xs mb tombol-hapus"><i class="fa fa-trash-o"></i></a>
                                 <h5 class="text-primary"><a href="">
                                         Kepada :
                                         <?php if ($p->kepada == 1) : ?>
                                             Seluruh pegawai
                                         <?php elseif ($p->kepada == 2) : ?>
                                             Seluruh satpam
                                         <?php endif ?>
                                     </a></h5>
                                 <p><?= ucwords($p->isi) ?></p>
                                 <p><span class="text-muted">
                                         <span class="text-muted"> Tanggal buat :</span> <?= $p->tanggal ?> <?= $p->pukul ?>
                                         <?php if ($p->ket_edit == 1) : ?>
                                             <span class="text-danger" style="font-style: oblique">Telah diedit</span>
                                         <?php endif ?>
                                 </p>
                             </div>
                         <?php endforeach ?>
                     </div>
                 </div>
                 <!--/ row -->
     </section>
     <!-- /wrapper -->
 </section>
 <!-- /MAIN CONTENT -->
 <!--main content end-->