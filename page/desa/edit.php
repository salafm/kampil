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
	<style>
	.main-sidebar{
		height:150%;
	}
	</style>
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
            Pengaturan Wilayah Desa
            <small>Edit Data</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li>Pengaturan Wilayah Desa</li>
			<li class="active">Edit data</li>
          </ol>
        </section>
		
		<?php 
				$id = $_GET['id'];
				// connect database
				require_once('../../config.php');
				$db = new mysqli($db_host, $db_username, $db_password, $db_database);
				$id = mysqli_real_escape_string($db, $id);
				
				if ($db->connect_errno){
					die ("Could not connect to the database: <br />". $db->connect_error);
				}

				if (!isset($_POST["submit"])){
					$query = " SELECT * FROM desa WHERE id= '$id' ";
					// Execute the query
					$result = $db->query( $query );
					if (!$result){
						die ("Could not query the database: <br />". $db->error);
						}else{
							while ($row = $result->fetch_object()){
									$rt = $row->rt;
									$rw = $row->rw;
									$dusun = $row->dusun;
								}
							}
					}
					
				//close connection
				mysqli_close($con);
?>
		
        <!-- Main content -->
		<div class="row">
        <section class="content">
		<form method="POST" autocomplete="on" action="proses_edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data"> 
		<div class="col-xs-8">
		<div class='box'>
		<table class="table table-bordered table-hover">
			<tr>
				<th class="bg-navy" colspan="3">
					Edit Data Wilayah Desa
				</th>
			</tr>
			<tr>
				<td>Jumlah RT</td>
				<td>:</td>
				<td>
					<input type ="text" name="rt" size="5" maxlength="3" placeholder="Maksimal 30 karakter" pattern="(0|[0-9][0-9]*)$" title="Hanya angka dan yg diperbolehkan" value="<?php echo $rt;?>" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Jumlah RW</td>
				<td>:</td>
				<td>
					<input type ="text" name="rw" size="5" maxlength="3" placeholder="Maksimal 18 digit angka" pattern="(0|[0-9][0-9]*)$" title="Hanya angka dan yg diperbolehkan" value="<?php echo $rw;?>"/>
				</td>
			</tr>
			<tr>
				<td>Jumlah Dusun</td>
				<td>:</td>
				<td>
					<input type ="text" name="dusun" size="5" maxlength="3" placeholder="Maksimal 18 digit angka" pattern="(0|[0-9][0-9]*)$" title="Hanya angka dan yg diperbolehkan" value="<?php echo $dusun;?>"/>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<input type="submit" name="submit" value="Simpan" class="btn btn-m bg-green">
					<a role="button" href="index.php" class="btn btn-m bg-red">Batal</a>
				</td> 
			</tr>
		</table>
		</div></div>
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