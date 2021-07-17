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
        <div class="col-lg-6">
            <div class="custom-box">
                <h3 style="margin-left: 10px">
                    QR-Code Pegawai
                </h3>
                <?= $this->session->flashdata('message'); ?>
                <br>
                <div id="profile-02">
                    <div class="user">
                        <img src="<?= base_url("assets/img/qrcode/") ?><?= $id ?>.png" width=" 200"><br><br>
                    </div>
                </div>
                <!-- /panel -->
            </div>
        </div>
        <div class="col-lg-6">
            <div class="custom-box">
                <h3 style="margin-left: 10px">
                    Profile Pegawai
                </h3>
                <div class="row">
                    <div class="white-panel pn">
                        <div class="white-header">
                            <h5>PEGAWAI PPS IBNU MAS'UD</h5>
                        </div>
                        <p><img src="<?= base_url("assets/") ?>img/profile/<?= $foto ?>" class="img-circle" width="100"></p>
                        <p><b><?= ucwords($nama_pegawai) ?></b></p>
                        <p><b><?= ucwords($profile['nama_jabatan']) ?></b></p>
                        <p><b><?= ucwords($profile['alamat']) ?></b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <a href="<?= base_url("userbiasa/pdf_kartu") ?>" class="btn btn-round btn-theme btn-lg mb" style="width: 200px"><i class="fa fa-print"></i> <b>Cetak Kartu</b></a>
        </div>
        <div class="col-lg-6">
            <a href="<?= base_url("userbiasa/kehadiran_hi") ?>" class="btn btn-round btn-warning btn-lg" style="width: 200px"> <i class="fa fa-arrow-left"></i><b> Back</b></a>
        </div>
        <!-- page end-->
    </section>
    <!-- /wrapper -->
</section>