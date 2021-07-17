<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>SIAJ - Ibnu Mas'Ud</title>

  <!-- Favicons -->
  <link href="<?= base_url("assets/") ?>img/icon.png" rel="icon">
  <link href="<?= base_url("assets/") ?>img/icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url("assets/") ?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="<?= base_url("assets/") ?>lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?= base_url("assets/") ?>lib/bootstrap-fileupload/bootstrap-fileupload.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url("assets/") ?>css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url("assets/") ?>lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="<?= base_url("assets/") ?>css/style.css" rel="stylesheet">
  <link href="<?= base_url("assets/") ?>css/style-responsive.css" rel="stylesheet">
  <script src="<?= base_url("assets/") ?>lib/chart-master/Chart.js"></script>

  <link rel="stylesheet" type="text/css" href="<?= base_url("assets/") ?>lib/bootstrap-timepicker/compiled/timepicker.css" />

  <!-- Main CSS untuk sweet alert-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>css/sweetalert.css">
  <!-- untuk datatables -->
  <!-- <link href="<?= base_url("assets/") ?>lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="<?= base_url("assets/") ?>lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url("assets/") ?>lib/advanced-datatable/css/DT_bootstrap.css" /> -->

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
  <style>
    .kotak-sk {
      box-shadow: 0px 1px 2px black;
      padding: 5px;
      border: 0px solid darkgrey;
    }

    .bbold {
      font-weight: bold;
    }

    video {
      width: 600px;
    }
  </style>
</head>

<body>

  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="" class="logo"><b>SIAJ<span>MTIM</span></b></a>
      <!--logo end-->
      <?php if ($lvl == 2) : ?>
        <div class="nav notify-row" id="top_menu">
          <!--  notification start -->
          <ul class="nav top-menu">
            <!-- settings start -->
            <!-- notification dropdown start-->
            <li id="header_notification_bar" class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                <i class="fa fa-clipboard"></i>
                <?php if ($jmlbelumacc != 0) : ?>
                  <span class="badge bg-success">
                    <?= $jmlbelumacc ?>
                  </span>
                <?php endif ?>
              </a>
              <ul class="dropdown-menu extended notification">
                <div class="notify-arrow notify-arrow-green"></div>
                <li>
                  <p class="green">Ada <?= $jmlbelumacc ?> Jurnal Belum di Acc</p>
                </li>
                <li>
                  <a href="<?= base_url("satpam/data_jurnal") ?>">
                    <span class="label label-success"><i class="fa fa-clipboard"></i></span>
                    Ada <?= $jmlbelumacc ?> Jurnal Belum di Acc
                  </a>
                </li>
              </ul>
            </li>
            <li id="header_notification_bar" class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                <i class="fa fa-bell-o"></i>
                <?php if ($phi != 0) : ?>
                  <span class="badge bg-warning">
                    <?= $phi ?>
                  </span>
                <?php endif ?>
              </a>
              <ul class="dropdown-menu extended notification">
                <div class="notify-arrow notify-arrow-yellow"></div>
                <li>
                  <p class="yellow">Ada <?= $sp ?> Seluruh Pengumuman</p>
                </li>
                <li>
                  <a href="<?= base_url("satpam") ?>">
                    <span class="label label-warning"><i class="fa fa-bell-o"></i></span>
                    Ada <?= $sp ?> Seluruh Pengumuman
                  </a>
                </li>
                <li>
                  <a href="<?= base_url("satpam") ?>">
                    <span class="label label-warning"><i class="fa fa-bell-o"></i></span>
                    Ada <?= $phi ?> Pengumuman Hari Ini
                  </a>
                </li>
              </ul>

            </li>
            <!-- notification dropdown end -->
          </ul>
          <!--  notification end -->
        </div>
      <?php endif ?>
      <?php if ($lvl == 3) : ?>
        <div class="nav notify-row" id="top_menu">
          <!--  notification start -->
          <ul class="nav top-menu">
            <!-- settings start -->
            <li id="header_notification_bar" class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                <i class="fa fa-bell-o"></i>
                <?php if ($phi != 0) : ?>
                  <span class="badge bg-warning">
                    <?= $phi ?>
                  </span>
                <?php endif ?>
              </a>
              <ul class="dropdown-menu extended notification">
                <div class="notify-arrow notify-arrow-yellow"></div>
                <li>
                  <p class="yellow">Ada <?= $sp ?> Seluruh Pengumuman</p>
                </li>
                <li>
                  <a href="<?= base_url("userbiasa") ?>">
                    <span class="label label-warning"><i class="fa fa-bell-o"></i></span>
                    Ada <?= $sp ?> Seluruh Pengumuman
                  </a>
                </li>
                <li>
                  <a href="<?= base_url("userbiasa") ?>">
                    <span class="label label-warning"><i class="fa fa-bell-o"></i></span>
                    Ada <?= $phi ?> Pengumuman Hari Ini
                  </a>
                </li>
              </ul>

            </li>
            <!-- notification dropdown end -->
          </ul>
          <!--  notification end -->
        </div>
      <?php endif ?>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="<?= base_url("logout") ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->