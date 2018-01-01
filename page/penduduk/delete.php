<?php
session_start();
error_reporting(0);
if (isset($_SESSION['kategori']))
{ if($_SESSION['kategori'] == "admin"){
include'header.php';
?>
<html>
	<body>
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			  <h1>
				Database Penduduk
				 <small>Hapus Data</small>
			  </h1>
			  <ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
				<li>Database Penduduk</li>
				<li>Detail</li>
				<li class="active">Hapus data</li>
			  </ol>
			</section>

			<!-- Main content -->
			<section class="content">

			  <?php
				$id = $_GET['id'];
				// Connect database
				require_once('../../config.php');
				$con = mysqli_connect ($db_host, $db_username, $db_password, $db_database);
				if(!$con){
					die("Could not connect to the database: <br />".mysqli_connect_error());
				}
				// delete data into database
				// escape inputs data
				// Asign a query
				$query = "DELETE FROM penduduk WHERE id= ".$id." ";
				// Execute the query
				$result = mysqli_query($con, $query);
				if(!$result){
					die("Could  not query the database : <br />".mysqli_connect_error());
				}else{
					echo 'Data berhasil dihapus <div class="fa fa-check"></div><br><br>';
					echo '<a class="btn bg-red" href="index.php">Kembali ke database penduduk</a>';
					mysqli_close($con);
					exit;
				}
			?>

			</section><!-- /.content -->
		  </div><!-- /.content-wrapper 
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
