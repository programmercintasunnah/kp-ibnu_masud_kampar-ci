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
                 <a class="active" href="<?= base_url("admin/pengaturan") ?>">
                     <i class="fa fa-cogs"></i>
                     <span>Pengaturan</span>
                 </a>
             </li>
         </ul>
         <!-- sidebar menu end-->
     </div>
 </aside>

 <section id="main-content">
     <section class="wrapper">
         <div class="row mt">
             <div class="col-lg-12 col-md-6 col-sm-12">
                 <!--  BASIC BUTTONS -->
                 <div class="showback">
                     <?= $this->session->flashdata('message1'); ?>
                     <?php if ($setting['status'] == 1) : ?>
                         <h4><i class="fa fa-angle-right"></i> Sistem Kejujuran Dalam Pengisian Jurnal <span class="badge bg-success"> Sedang Aktif</span></h4>
                         <a href="<?= base_url("admin/matikan") ?>" class="btn btn-danger tombol-mati"><i class="fa fa-power-off"></i> Matikan</a>
                     <?php else : ?>
                         <h4><i class="fa fa-angle-right"></i> Sistem Kejujuran Dalam Pengisian Jurnal <span class="badge bg-default"> Tidak Aktif</span></h4>
                         <a href="<?= base_url("admin/aktifkan") ?>" class="btn btn-success tombol-aktif"><i class="fa fa-power-off"></i> Aktifkan</a>
                     <?php endif ?>
                 </div>
                 <div class="showback">
                     <?= $this->session->flashdata('message1'); ?>
                     <h4><i class="fa fa-angle-right"></i> Hapus / Bersihkan Seluruh Data Pengumuman</h4>
                     <h6>Jumlah Semua Pengumuman di Dalam Database : <span class="badge bg-important"><?= $sp ?></span></h6>
                     <a href="<?= base_url("admin/hapus_seluruh_pengumuman") ?>" class="btn btn-danger tombol-hapussemua"><i class="fa fa-trash-o"></i> Hapus</a>
                 </div>
                 <div class="showback">
                     <?= $this->session->flashdata('message2'); ?>
                     <h4><i class="fa fa-angle-right"></i> Hapus / Bersihkan Seluruh Data Kehadiran Pegawai</h4>
                     <h6>Jumlah Seluruh Data Kehadiran di Dalam Database : <span class="badge bg-important"><?= $sdk ?></span></h6>
                     <a href="<?= base_url("admin/hapus_seluruh_kehadiran") ?>" class="btn btn-danger tombol-hapussemua"><i class="fa fa-trash-o"></i> Hapus</a>
                 </div>
                 <div class="showback">
                     <?= $this->session->flashdata('message3'); ?>
                     <h4><i class="fa fa-angle-right"></i> Hapus / Bersihkan Seluruh Data Jurnal Pegawai</h4>
                     <h6>Jumlah Seluruh Jurnal di Dalam Database : <span class="badge bg-important"><?= $jml_jsj_hi ?></span></h6>
                     <a href="<?= base_url("admin/hapus_seluruh_jurnal") ?>" class="btn btn-danger tombol-hapussemua"><i class="fa fa-trash-o"></i> Hapus</a>
                 </div>
                 <div class="showback">
                     <?= $this->session->flashdata('message_qrcode'); ?>
                     <h4><i class="fa fa-angle-right"></i> Hapus / Bersihkan Seluruh Data QR-Code</h4>
                     <h6>Jumlah Seluruh QR-Code di Dalam Database : <span class="badge bg-important"><?= $jml_qrcode ?></span></h6>
                     <a href="<?= base_url("admin/hapus_seluruh_qrcode") ?>" class="btn btn-danger tombol-hapussemua"><i class="fa fa-trash-o"></i> Hapus</a>
                 </div>
             </div>
             <!--/ row -->
     </section>
     <!-- /wrapper -->
 </section>
 <!-- /MAIN CONTENT -->
 <!--main content end-->