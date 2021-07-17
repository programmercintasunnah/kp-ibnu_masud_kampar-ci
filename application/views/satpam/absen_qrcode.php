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
                     <li class="active"><a href="<?= base_url("satpam/absen_qrcode") ?>">Absen QRCODE</a></li>
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
         <!-- page start-->
         <div class="col-lg-8">
             <div class="custom-box">
                 <h1 style="margin-left: 10px">
                     <i class="fa fa-qrcode"></i> SCAN QR CODE
                 </h1>
                 <?= $this->session->flashdata('message2'); ?>
                 <br>
                 <div id="preview">
                     <?php if (date('l') == 'Sunday') : ?>
                         <h4>
                             <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Hari Ini Libur (Hari Ahad)</div>
                         </h4>
                     <?php else : ?>
                         <video muted playsinline id="qr-video"></video>
                     <?php endif ?>
                 </div>
                 <span id="cam-qr-result"></span>
                 <!-- /panel -->
             </div>
             <div class="custom-box">
                 <h1 style="margin-left: 10px">
                     <i class="fa fa-qrcode"></i> ABSEN QR CODE
                 </h1>
                 <?= $this->session->flashdata('message'); ?>
                 <br>
                 <div id="profile-02">
                     <div class="user">
                         <?php if (date('l') == 'Sunday') : ?>
                             <img src="<?= base_url("assets/img/libur.jpg") ?>" width=" 200"><br><br>
                         <?php elseif ($terakhir['tanggal_qr'] != date('Y-m-d')) : ?>
                             <img src="<?= base_url("assets/img/no_qrcode.jpg") ?>" width=" 200"><br><br>
                         <?php else : ?>
                             <img src="<?= base_url("assets/img/qrcode/") ?>pps_ibnu_mas'ud.png" width=" 200"><br><br>
                         <?php endif ?>
                         <a href="<?= base_url("satpam/generate_qrcode") ?>" class="btn btn-round btn-theme btn-lg mb" style="width: 200px"> <b>Generate QR CODE</b></a>
                     </div>
                 </div>
                 <!-- /panel -->
             </div>
         </div>
         <div class="col-lg-4">
             <div class="custom-box">
                 <h3><b>Kehadiran Hari Ini</b></h3>
                 <ul class="chat-available-user">
                     <?php foreach ($kehadiran_hi as $u) : ?>

                         <li>
                             <a href="">
                                 <img class="img-circle" src="<?= base_url("assets/img/profile/") ?><?= $u->foto ?>" width="32">
                                 <?= ucwords($u->nama_pegawai) ?>
                                 <?php if ($u->ket_ahi != 0) : ?>
                                     <?php if ($u->jam_datang_ahi == null) : ?>
                                         <span class="badge bg-warning">Tidak Hadir</span>
                                     <?php else : ?>
                                         <?php if ($u->terlambat_ahi == 0) : ?>
                                             <span class="badge bg-success"><?= $u->jam_datang_ahi ?></span>
                                         <?php else : ?>

                                             <span class="badge bg-important"><?= $u->jam_datang_ahi ?></span>
                                         <?php endif ?>
                                     <?php endif ?>
                                 <?php else : ?>
                                     <span class="badge bg-theme">Belum Hadir</span>
                                 <?php endif ?> </a>
                         </li>

                     <?php endforeach ?></ul>
             </div>
         </div>
         <!-- page end-->
     </section>
     <!-- /wrapper -->
 </section>

 <script type="module">
     import QrScanner from "<?= base_url("assets/scann_qr") ?>/qr-scanner.min.js";
    QrScanner.WORKER_PATH = '<?= base_url("assets/scann_qr") ?>/qr-scanner-worker.min.js';
    const video = document.getElementById('qr-video');
    const camQrResult = document.getElementById('cam-qr-result');
    var isi = "0"
    function setResult(label, result) {
    
            label.textContent = result;
            isi = result;
            window.location.href = "<?= base_url() ?>satpam/scan?data=" + isi;
    }
    // Web Cam Scanning 
    const scanner = new QrScanner(video, result => setResult(camQrResult, result));
    scanner.start();

</script>