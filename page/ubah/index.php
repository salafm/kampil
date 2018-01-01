<?php
session_start();
error_reporting(0);
if (isset($_SESSION['kategori']))
{ if($_SESSION['kategori'] == "admin"){

include'header.php';
	?>
	
	

<!DOCTYPE>
<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gembul Store | Petugas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>
	<body>
	<!-- Content Wrapper. Contains page content ------------------------------------------------------------>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ubah Password
            <small>Ubah</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li class="active">Ubah Password</li>
          </ol>
        </section>
		
        <!-- Main content -->
		<div class="row">
        <section class="content">
		<form method="POST" autocomplete="on" action="ubah.php">
		<div class="col-xs-8">
		<table class="table table-bordered table-hover">
			<tr>
				<td>
					<input type ="text" name="passlama" size="40" maxlength="20" placeholder="Masukkan Password Lama" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>
					<input type ="text" name="passbaru" size="40" maxlength="20" placeholder="Password Baru Minimal 6 karakter" pattern="[a-zA-Z0-9].{6,}" title="Password minimal 7 karakter dan hanya berupa huruf dan angka" required/>
				</td>
			</tr>
			<tr>
				<td>
					<input type ="text" name="passbaru2" size="40" maxlength="20" placeholder="Ulangi Masukkan Password Baru" required/>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<input type="submit" name="submit" value="Ubah Password" class="btn bg-green">
				</td> 
			</tr>
		</table>
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
include'footer.html';
}else{
	header('location:../../dashboard.php');
}
}
if (!isset($_SESSION['kategori']))
{
	header('location:../../index.php');
}
?>