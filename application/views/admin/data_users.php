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
                     <li class="active"><a href="<?= base_url("admin/data_users") ?>">Data Users & Jabatan</a></li>
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
 <!-- Modal -->
 <div class="modal fade" id="lihatprofil" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Profil Pegawai</h4>
             </div>
             <div class="modal-body">

                 <div class="col-lg-12 custom-box">
                     <div class="profile-pic">
                         <p><img src="<?= base_url("assets/img/profile/") ?>default.jpg" class="img-circle" id="foto_u"></p>
                     </div>
                     <h3 class="bbold" id="nama_up"></h3>
                     <div class="col-lg-6">
                         <ul class="pricing">
                             <li>
                                 <h6 class="text-primary bbold">Jabatan : </h6>
                                 <h5 id="jabatan_up"></h5>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Tempat, Tanggal Lahir : </h6>
                                 <h5 id="ttl_up"></h5>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Pendidikan Terakhir : </h6>
                                 <h5 id="pend_up"></h5>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Alumni : </h6>
                                 <h5 id="alumni_up"></h5>
                             </li>
                         </ul>

                     </div>
                     <div class="col-lg-6">
                         <ul class="pricing">
                             <li>
                                 <h6 class="text-primary bbold">Keahlian : </h6>
                                 <h5 id="keahlian_up"></h5>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">No HP : </h6>
                                 <h5 id="nohp_up"></h5>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Asal : </h6>
                                 <h5 id="asal_up"></h5>
                             </li>
                             <li>
                                 <h6 class="text-primary bbold">Alamat : </h6>
                                 <h5 id="alamat_up"></h5>
                             </li>
                         </ul>
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                 </div>
             </div>

         </div>
     </div>
 </div>
 <!-- modal edit password -->
 <div class="modal fade" id="modalEditPassword" tabindex="-1" role="dialog" aria-labelledby="modalTKelas" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Edit Password</h4>
             </div>
             <!-- <div class="modal-body"> -->
             <div class="">
                 <form action="<?= base_url('admin/edit_password') ?>" method="post">

                     <!-- /col-md-4 -->
                     <div class="col-md-4 centered">
                         <div class="profile-pic">
                             <p>
                                 <img class="img-circle" id="ep_foto">
                             </p>
                         </div>
                     </div>
                     <div class="col-md-8 profile-text mt">
                         <div class="form-group">
                             <label for="ep_nama">Nama</label>
                             <input type="hidden" name="ep_id" id="ep_id">
                             <input type="text" readonly name="ep_nama" id="ep_nama" class="form-control round-form">
                         </div>
                         <div class="form-group">
                             <label for="password">Password</label>
                             <input type="password" placeholder="password" name="ep_password" id="ep_password" class="form-control round-form">
                         </div>
                         <div class="form-group">
                             <label for="ulangipassword">Ulangi Password</label>
                             <input type="password" placeholder="ulangi password" name="ep_ulangipassword" id="ep_ulangipassword" class="form-control round-form">
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
 <!-- Modal -->
 <div class="modal fade" id="editprofil" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Edit Profil Pegawai</h4>
             </div>
             <div class="modal-body">
                 <form action="<?= base_url('admin/update_user') ?>" method="post">
                     <div class="col-lg-5 col-lg-offset-1" id="nohp_e">
                         <input type="hidden" name="id_ep" id="id_ep">
                         <label for="nama_ep" class="">Nama*</label>
                         <input type="text" name="nama_ep" id="nama_ep" maxlength="22" autocomplete="off" class="form-control round-form" autofocus value="<?= set_value('nama') ?>" placeholder="Nama walikelas">
                         <label for="tl_ep" class="">Tempat Lahir*</label>
                         <input type="text" name="tl_ep" id="tl_ep" autocomplete="off" class="form-control round-form" value="<?= set_value('tl') ?>" placeholder="Tempat lahir">
                         <label for="tgl_ep" class="">Tanggal Lahir*</label>
                         <input type="date" name="tgl_ep" id="tgl_ep" class="form-control round-form" value="<?= set_value('tgl') ?>">
                         <label for="jabatan_ep" class="">Jabatan*</label>
                         <select class="form-control round-form" name="jabatan_ep" id="jabatan_ep">
                             <option value="">~Pilih~</option>
                             <?php foreach ($jabatan as $j) : ?>
                                 <option value="<?= $j->id_jabatan ?>"><?= $j->nama_jabatan ?></option>
                             <?php endforeach ?>
                         </select>
                         <label for="nohp_ep" class="">Nomor HP</label>
                         <input type="tel" pattern="^\d{12}$" name="nohp_ep" id="nohp_ep" class="form-control round-form" autocomplete="off" maxlength="12" value="<?= set_value('nohp') ?>" placeholder="Nomor Handphone">
                         <label for="username_ep" class="">Username*</label>
                         <input type="text" name="username_ep" id="username_ep" readonly maxlength="15" autocomplete="off" class="form-control round-form" value="<?= set_value('username') ?>" placeholder="Username">
                         <label for="level_ep" class="">Level User*</label>
                         <select class="form-control round-form" name="level_ep" id="level_ep">
                             <option value="">~Pilih~</option>
                             <option value=1>Admin</option>
                             <option value=2>Satpam</option>
                             <option value=3>User Biasa</option>
                         </select>
                     </div>

                     <div class="col-md-5">
                         <label for="pend_ep" class="">Pendidikan Terakhir*</label>
                         <select class="form-control round-form" name="pend_ep" id="pend_ep">
                             <option value="">~Pilih~</option>
                             <option value="SD Sederajat">SD Sederajat</option>
                             <option value="SMP Sederajat">SMP Sederajat</option>
                             <option value="SMA Sederajat">SMA Sederajat</option>
                             <option value="D1">D1</option>
                             <option value="D2">D2</option>
                             <option value="D3">D3</option>
                             <option value="S1">S1</option>
                             <option value="S2">S2</option>
                             <option value="S3">S3</option>
                         </select>
                         <label for="tamatan_ep" class="">Tamatan*</label>
                         <input type="text" name="tamatan_ep" id="tamatan_ep" autocomplete="off" class="form-control round-form" value="<?= set_value('tamatan') ?>" placeholder="Tamatan">
                         <label for="keahlian_ep" class="">Keahlian</label>
                         <input type="text" name="keahlian_ep" id="keahlian_ep" autocomplete="off" class="form-control round-form" value="<?= set_value('keahlian') ?>" placeholder="Keahlian">

                         <label for="asal_ep" class="">Asal*</label>
                         <input type="text" name="asal_ep" id="asal_ep" autocomplete="off" class="form-control round-form" value="<?= set_value('asal') ?>" placeholder="Asal">
                         <label for="alamat_ep" class="">Alamat Lengkap</label>
                         <textarea rows="3" name="alamat_ep" id="alamat_ep" class=" form-control round-form" placeholder="  Alamat lengkap... "><?= set_value('alamat') ?></textarea>
                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-default mt" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary mt"><i class="fa fa-save"></i> SIMPAN</button>
                     </div>
                 </form>
             </div>

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
                         <?= $this->session->flashdata('message'); ?>
                         <ul class="nav nav-tabs nav-justified">
                             <li class="active">
                                 <a data-toggle="tab" href="#data_users">Data Users</a>
                             </li>
                             <li>
                                 <a data-toggle="tab" href="#jabatan">Data Jabatan</a>
                             </li>
                         </ul>
                     </div>
                     <!-- /panel-heading -->
                     <div class="panel-body">
                         <div class="tab-content">
                             <div id="data_users" class="tab-pane active">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="col-md-10">
                                             <h2 style="font-weight: bold" class="mb">Data Seluruh User</h2>
                                         </div>
                                         <div class="col-md-2">
                                             <h4 class="gen-case">
                                                 <a class="btn btn-theme btn-round" href="<?= base_url("admin/tambah_user") ?>">
                                                     <i class="fa fa-plus"></i> Tambah User
                                                 </a>
                                             </h4>
                                         </div>
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>
                                                     <th>No</th>
                                                     <th>Foto</th>
                                                     <th>Nama</th>
                                                     <th>Jabatan</th>
                                                     <th>Level User</th>
                                                     <th>Online</th>
                                                     <th>Aksi</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1; ?>
                                                 <?php foreach ($users as $u) : ?>
                                                     <tr class="gradeX">
                                                         <td><?= $no++ ?></td>
                                                         <td>
                                                             <img src="<?= base_url("assets/img/profile/") ?><?= $u->foto ?>" alt="" width="50" class="img-circle">
                                                         </td>
                                                         <td><?= strtoupper($u->nama_pegawai) ?></td>
                                                         <td><?= strtoupper($u->nama_jabatan) ?></td>
                                                         <td><?= ucwords($u->level) ?></td>
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
                                                             <a data-foto_u="<?= $u->foto ?>" data-id_u="<?= $u->id_user ?>" data-jabatan_u="<?= $u->nama_jabatan ?>" data-nama_u="<?= $u->nama_pegawai ?>" data-tl_u="<?= $u->t_lahir ?>" data-tgl_lahir_u="<?= $u->tgl_lahir ?>" data-pend_u="<?= $u->pendidikan_terakhir ?>" data-alumni_u="<?= $u->tamatan ?>" data-keahlian_u="<?= $u->keahlian ?>" data-nohp_u="<?= $u->nohp ?>" data-asal_u="<?= $u->asal ?>" data-alamat_u="<?= $u->alamat ?>" class="btn btn-success btn-xs lihatprofilpegawai" data-toggle="modal" data-target="#lihatprofil"><i class="fa fa-user"></i></a>
                                                             <a data-username_e="<?= $u->username ?>" data-nohp_e="<?= $u->nohp ?>" data-level_e="<?= $u->fk_level ?>" data-id_e="<?= $u->id_user ?>" data-jabatan_e="<?= $u->jabatan ?>" data-nama_e="<?= $u->nama_pegawai ?>" data-tl_e="<?= $u->t_lahir ?>" data-tgl_lahir_e="<?= $u->tgl_lahir ?>" data-pend_e="<?= $u->pendidikan_terakhir ?>" data-alumni_e="<?= $u->tamatan ?>" data-keahlian_e="<?= $u->keahlian ?>" data-nohp_e="<?= $u->nohp ?>" data-asal_e="<?= $u->asal ?>" data-alamat_e="<?= $u->alamat ?>" href="" class="btn btn-primary btn-xs editprofilpegawai" data-toggle="modal" data-target="#editprofil"><i class="fa fa-edit"></i></a>
                                                             <a data-foto_ep="<?= $u->foto ?>" data-id_ep="<?= $u->id_user ?>" data-nama_ep="<?= $u->nama_pegawai ?>" class="btn btn-warning btn-xs editpassword" data-toggle="modal" data-target="#modalEditPassword"><i class="fa fa-unlock"></i></a>
                                                             <a href="<?= base_url("admin/hapus_user") ?>/<?= $u->id_user ?>" class="btn btn-danger btn-xs tombol-hapus"><i class="fa fa-trash"></i></a>
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
                             <div id="jabatan" class="tab-pane">
                                 <div class="row">
                                     <div class="col-md-12">

                                         <!-- Modal -->
                                         <div class="modal fade" id="modalTambahJabatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                             <div class="modal-dialog">
                                                 <div class="modal-content">
                                                     <div class="modal-header">
                                                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                         <h4 class="modal-title" id="myModalLabel">Tambah Jabatan</h4>
                                                     </div>
                                                     <div class="modal-body">
                                                         <form action="<?= base_url('admin/add_jabatan') ?>" method="post">
                                                             <div class="form-group">
                                                                 <label for="jabatan">Nama Jabatan</label>
                                                                 <input type="text" name="jabatan" id="jabatan" autocomplete="off" class="form-control round-form" autofocus placeholder="Nama Jabatan">
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
                                         <!-- Modal edit j-->
                                         <div class="modal fade" id="modalEditJabatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                             <div class="modal-dialog">
                                                 <div class="modal-content">
                                                     <div class="modal-header">
                                                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                         <h4 class="modal-title" id="myModalLabel">Tambah Jabatan</h4>
                                                     </div>
                                                     <div class="modal-body">
                                                         <form action="<?= base_url('admin/update_jabatan') ?>" method="post">
                                                             <div class="form-group">
                                                                 <label for="jabatan_ej">Nama Jabatan</label>
                                                                 <input type="hidden" name="id_ej" id="id_ej">
                                                                 <input type="text" name="jabatan_ej" id="jabatan_ej" autocomplete="off" class="form-control round-form" autofocus placeholder="Nama Jabatan">
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
                                         <div class="col-md-10">
                                             <h2 style="font-weight: bold" class="mb">Data Seluruh Jabatan</h2>
                                         </div>
                                         <div class="col-md-2">
                                             <h4 class="gen-case">
                                                 <a class="btn btn-theme btn-round" href="" data-toggle="modal" data-target="#modalTambahJabatan">
                                                     <i class="fa fa-plus"></i> Tambah Jabatan
                                                 </a>
                                             </h4>
                                         </div>
                                         <table class="table display" id="" width="100%">
                                             <thead>
                                                 <tr>
                                                     <th>No</th>
                                                     <th>ID Jabatan</th>
                                                     <th>Jabatan</th>
                                                     <th>Aksi</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1; ?>
                                                 <?php foreach ($jabatan as $j) : ?>
                                                     <tr class="gradeX">
                                                         <td><?= $no++ ?></td>
                                                         <td><?= strtoupper($j->id_jabatan) ?></td>
                                                         <td><?= strtoupper($j->nama_jabatan) ?></td>
                                                         <td>
                                                             <a data-id_j="<?= $j->id_jabatan ?>" data-nama_j="<?= $j->nama_jabatan ?>" data-toggle="modal" data-target="#modalEditJabatan" class="btn btn-primary btn-xs tombol_editjabatan"><i class="fa fa-edit"> Edit</i></a>
                                                             <a href="<?= base_url("admin/hapus_jabatan") ?>/<?= $j->id_jabatan ?>" class="btn btn-danger btn-xs tombol-hapus"><i class="fa fa-trash"> Hapus</i></a>
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