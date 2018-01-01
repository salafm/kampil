<?php
session_start();
$idpetugas = $_SESSION['id'];
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
    <title>gembulStore</title>
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
            Database Penduduk
            <small>Simpan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> gembulStore</a></li>
            <li>Database Penduduk</li>
			<li>Detail</li>
			<li>Edit data</li>
			<li class="active">Simpan</li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
			<?php
				$id = $_GET['id'];
				require_once('../../config.php');
				//Connect
				$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
				if (mysqli_connect_errno()){
					die ("Could not connect to the database: <br/>". mysqli_connect_error());
					} 
				
				if(isset($_POST['submit'])){
					$rt	= $_POST['rt'];
					$rw	= $_POST['rw'];
					$dusun	= $_POST['dusun'];
					
						// Asign a query
						$query = " UPDATE desa SET rt = '$rt', rw = '$rw', dusun = '$dusun' WHERE id = '$id'";	
						// Execute the query
						$result = mysqli_query($con,$query);
						if (!$result){
							die ("Could not query the database: <br />". mysqli_error($con));
							}
						else{
							echo 'Data telah terupdate <div class="fa fa-check"></div><br><br>';
							echo '<a href="index.php" class="btn bg-red">Kembali data wilayah desa</a><br>';
							echo $msg;
						}
					}
				
				//close connection
				mysqli_close($con);
				
			?>
        </section><!-- /.content -->
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
}else{
	header('location:../../dashboard.php');
}
}
if (!isset($_SESSION['kategori']))
{
	header('location:../../index.php');
}
?>