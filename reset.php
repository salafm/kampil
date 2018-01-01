<?php
session_start();
include 'config.php';
?>
<html>
	<head>	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Desa Kampil | Reset Password</title>
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
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  </head>
<body class="hold-transition login-page">
	<?php 
		//include our login information
		require_once('config.php');
		//Connect
		$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
		if (mysqli_connect_errno()){
			die ("Could not connect to the database: <br/>". mysqli_connect_error());
		} 
		
		if(isset($_POST['submit'])){
			$pass = $_POST['pass']; }
			
		$query = "UPDATE petugas SET password = '$pass' WHERE nama = 'admin'";
		$result = mysqli_query($con,$query);
		if (!$result){
		   die ("Could not query the database: <br />". mysqli_error($con));
		}
	?>
    <div class="login-box"> 
      <div class="login-logo">
        <a href="#">Reset <b>Password</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body" >
		<div align="center">Password berhasil direset <span class="fa fa-check"></span><br>Hubungi kontak dibawah untuk password baru.</div><br>					
		<div style="text-align:center"><span class="fa fa-whatsapp"></span>  Whatsapp : 085875927428<br>
		<span class="fa fa-phone"></span> Telphone : 085800381603<br>
		<span class="fa fa-envelope-o"></span> E-mail : salafudin.muhammad@if.undip.ac.id</div><br>
		<a href='index.php' class='btn btn-block btn-lg btn-xs btn-primary' role='button'>Halaman Login</a>
       </div>
	</div><!-- /.login-box-body -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>

  </body>
</html>