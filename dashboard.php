<?php
session_start();
error_reporting(0);
if (isset($_SESSION['kategori']))
{
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
	<style>
	</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Desa Kampil | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Desa <b>Kampil</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
				<a href="logout.php" >Keluar</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p> <?php echo $_SESSION['nama'];?></p>
              <i class="fa fa-user text-primary"></i><?php echo ' '.$_SESSION['kategori'];?>
            </div> 
          </div> 
			
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="page/input"><i class="fa fa-pencil-square-o"></i> <span>Input Data Penduduk</span></a></li>
            <li><a href="page/penduduk"><i class="fa fa-users"></i> <span>Database Penduduk</span></a></li>
            <li><a href="page/nonpenduduk"><i class="fa fa-user-times"></i> <span>Database Non Penduduk</span></a></li>
			<li><a href="page/surat"><i class="fa fa-envelope"></i> <span>Database Surat</span></a></li>
			<li><a href="page/rekap"><i class="fa fa-newspaper-o"></i> <span>Rekapitulasi Penduduk</span></a></li>
            
			<?php
			
			if ($_SESSION['kategori'] == "admin")
			{
			?>
            <li class="header">OPTIONS</li>
			<li><a href="page/perangkat"><i class="fa fa-user-secret"></i> <span>Pengaturan Perangkat Desa</span></a></li>
			<li><a href="page/desa"><i class="fa fa-institution"></i> <span>Pengaturan Wilayah Desa</span></a></li>
            <li><a href="page/ubah"><i class="fa fa-key"></i> <span>Ubah Password</span></a></li>
			<?php } ?>
			<li class="header">CREDITS</li>
            <li><a href="page/credits"><i class="glyphicon glyphicon-user"></i> <span>Developer</span></a></li>
			
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content ------------------------------------------------------------>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Main Menu</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
		  <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>1</h3>
                  <p>Input Data</p>
                </div>
                <div class="icon">
                  <a class="fa fa-pencil-square-o" href="page/input" ></a>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>2</h3>
                  <p>Database Penduduk</p>
                </div>
                <div class="icon">
                  <a class="fa fa-group" href="page/penduduk"></a>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>3</h3>
                  <p>Rekapitulasi Data</p>
                </div>
                <div class="icon">
                  <a class="fa fa-newspaper-o" href="page/rekap"></a>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>4</h3>
                  <p>Credits Developer</p>
                </div>
                <div class="icon">
                  <a class="fa fa-user" href="page/credits"></a>
                </div>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
			
        </section><!-- /.content -->
      </div><!-- /.content-wrapper --------------------------------------------------------------------------->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          KKN Tim II Undip 2017
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2017, Muhammad Salafudin.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
 
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
<?php
}
if (!isset($_SESSION['kategori']))
{
	header('location:index.php');
}
?>