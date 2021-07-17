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
             <h6 class="centered">Pegawai</h6>
             <li class="mt">
                 <a class="" href="<?= base_url("userbiasa") ?>">
                     <i class="fa fa-dashboard"></i>
                     <span>Dashboard</span>
                 </a>
             </li>
             <li class="">
                 <a class="" href="<?= base_url("userbiasa/profile") ?>">
                     <i class="fa fa-user"></i>
                     <span>Profile</span>
                 </a>
             </li>
             <li class="">
                 <a class="" href="<?= base_url("userbiasa/jadwaldp") ?>">
                     <i class="fa fa-table"></i>
                     <span>Jadwal Datang & Pulang</span>
                 </a>
             </li>
             <li class="">
                 <a class="active" href="<?= base_url("userbiasa/kehadiran_hi") ?>">
                     <i class="fa fa-list"></i>
                     <span>Kehadiran Hari Ini</span>
                 </a>
             </li>
             <li class="sub-menu">
                 <a href="javascript:;">
                     <i class="fa fa-clipboard"></i>
                     <span>Rekap Data</span>
                 </a>
                 <ul class="sub">
                     <li><a href="<?= base_url("userbiasa/rekap_kehadiran") ?>">Rekap Kehadiran</a></li>
                     <li><a href="<?= base_url("userbiasa/rekap_jurnal") ?>">Rekap Jurnal</a></li>
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
                 <div class="" style="margin-right: 600px">
                     <a href="<?= base_url("userbiasa/kehadiran_hi") ?>" class="btn btn-round btn-warning"><i class="fa fa-mail-reply"> Kembali</i></a>
                 </div>
                 <h1 style="margin-left: 10px">
                     <i class="fa fa-qrcode"></i> SCAN QR CODE
                 </h1>
                 <?php if ($ahi['ket_absen'] == 0) : ?>
                     <input type="hidden" id="ket_hadir" value="a"></input>
                 <?php else : ?>
                     <h4 class="gen-case" id="ket_hadir">
                         <div class="alert alert-success" role="alert"><i class="fa fa-check-square-o"></i> Anda Telah di Absen!</div>
                     </h4>
                 <?php endif ?>
                 <?= $this->session->flashdata('message'); ?>
                 <br>
                 <div id="preview">
                     <video muted playsinline id="qr-video"></video>
                 </div>
                 <span id="cam-qr-result"></span>
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
    const ket_hadir = document.getElementById('ket_hadir').value;
    var isi = "0"
    // set isi dari yang di scan
    
    function setResult(label, result) {
        if(ket_hadir!='a'){
        swal({
            title: "ANDA SUDAH DI ABSEN",
            text: "Maka tidak bisa melakukan absen 2 kali!",
            type: "warning",
        });
        }else{
            label.textContent = result;
            isi = result;
            window.location.href = "<?= base_url() ?>satpam/scan?data=" + isi;
        }
    }

    // Web Cam Scanning 
    const scanner = new QrScanner(video, result => setResult(camQrResult, result));
    scanner.start();

</script>