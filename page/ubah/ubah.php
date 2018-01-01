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
            <small>Konfirmasi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li>Ubah Password</li>
			<li class="active">Konfirmasi</li>
          </ol>
        </section>
		
        <!-- Main content -->
		<div class="row">
        <section class="content">
			<?php
				require_once('../../config.php');
				//Connect
				$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
				if (mysqli_connect_errno()){
					die ("Could not connect to the database: <br/>". mysqli_connect_error());
					} 
				
				if(isset($_POST['submit'])){
					$pass1	= $_POST['passlama'];
					$pass2	= $_POST['passbaru'];
					$pass3	= $_POST['passbaru2'];
					$pass1	= mysqli_real_escape_string($con, $pass1);
					$pass2	= mysqli_real_escape_string($con, $pass2);
					$pass3	= mysqli_real_escape_string($con, $pass3);
				}
				
				$query = "SELECT * FROM petugas WHERE nama = 'admin'";
				$hasil = mysqli_query($con,$query);
				$data = mysqli_fetch_array($hasil);
				echo '<div class="col-xs-8" >';
				if ($pass1 == $data['password']){
					if($pass3 == $pass2){
						$query1 = "UPDATE petugas SET password='$pass3' WHERE nama = 'admin'";
						$hasil1 = mysqli_query($con,$query1);
						if (!$hasil1){
							die ("Could not query the database: <br />". mysqli_error($con));
						}
						else{							
							echo 'Password berhasil diubah <div class="fa fa-check"></div><br><br>';
							echo '<a href="../../dashboard.php" class="btn bg-red">Kembali ke dashboard</a>';
						}
					}
					else
					{
						echo "Password baru tidak sama, silahkan ulangi <div class='fa fa-remove'></div><br><br>";
						echo '<a href="index.php" class="btn bg-red">Kembali</a>';
					}
				}
				else{
					echo "Password lama salah, silahkan ulangi <div class='fa fa-remove'></div><br><br>";
					echo '<a href="index.php" class="btn bg-red">Kembali</a>';
				}
				
				//close connection
				mysqli_close($con);
				
				echo '</div>';
				
				
			?>
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