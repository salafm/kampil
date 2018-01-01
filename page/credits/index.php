<?php 	
	session_start();
	error_reporting(0);
	if (isset($_SESSION['kategori']))
	{
	include'header.php'; 
?>


<!DOCTYPE>
<html>
	<head>
	<style>
		.img-edit{
			border-radius:50%;
			margin-top : 20px;
			margin-left : 20px;
			border:5px solid #367fa9;
			background-color:#000000;
			display:inline-block;
			float: left;
		}
		.ket{
			margin-left:270px;
			margin-top: 30px;
			font-family: Serif;
			font-size:15px;
			line-height:150%;
		}
		.teks{
			font-size:27px;
			line-height:150%;
		}
		.fa-facebook {
		    padding: 12px;
			font-size: 15px;
			width: 40px;
			text-align: center;
			text-decoration: none;
			background: #3B5998;
			color: white;
			border-radius:50%;
		}
		.fa-twitter {
			padding: 12px;
			font-size: 15px;
			width: 40px;
			text-align: center;
			text-decoration: none;
			background: #55ACEE;
			color: white;
			border-radius:50%;
		}
		
		.fa-twitter {
			padding: 12px;
			font-size: 15px;
			width: 40px;
			text-align: center;
			text-decoration: none;
			background: #55ACEE;
			color: white;
			border-radius:50%;
		}
		
		.fa-instagram {
			padding: 12px;
			font-size: 15px;
			width: 40px;
			text-align: center;
			text-decoration: none;
			background: #12568a;
			color: white;
			border-radius:50%;
		}
		
		.fa-google-plus {
			padding: 12px;
			font-size: 15px;
			width: 40px;
			text-align: center;
			text-decoration: none;
			background: #dd4b39;
			color: white;
			border-radius:50%;
		}
		
		.sosmed{
			padding-top: 10px;
		}
		
	</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Desa Kampil | Credits Developer</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
	<!-- Content Wrapper. Contains page content ---------------------------------------------------->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Credits
            <small>Developer</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../dashboard.php"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li class="active">Developer</li>
          </ol>
        </section>
		
        <!-- Main content -->
		<div class="row">
        <section class="content">
		<div class="col-xs-1">
			<img class= "img-edit" src="../../dist/img/logo.png" height="200px" width="200px">
		</div>
		<div class="ket">
			<div class="teks">Muhammad Salafudin</div>
			<div>Ilmu Komputer/ Informatika 2014</div>
			<div>Universitas Diponegoro</div>
			<div class="fa fa-envelope-o"> email : salafudin.muhammad@if.undip.ac.id </div><br>
			<div class="fa fa-phone"> telfon : 085800381603 </div>
			<div class="sosmed">
				<a href="http://fb.com/utiinn" class="fa fa-facebook"></a>
				<a href="http://twitter.com/utiinsfm" class="fa fa-twitter"></a>
				<a href="http://instagram.com/utinslfm" class="fa fa-instagram"></a>
				<a href="https://plus.google.com/u/0/103118962924372344478" class="fa fa-google-plus"></a>
			</div>
		</div>
        </section><!-- /.content -->
		</div>
      </div><!-- /.content-wrapper --------------------------------------------------------------------------->
		<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../dist/js/app.min.js"></script>
	</body>
</html>
<?php
include('footer.html');
}
if (!isset($_SESSION['kategori']))
{
	header('location:../../index.php');
}
?>
