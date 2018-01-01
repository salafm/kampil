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
			height:100%;
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
            Input Data Penduduk
            <small>Simpan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li >Input Data Penduduk</li>
			<li class="active">Simpan</li>
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
				
				echo '<div class="col-xs-8" >';
				if(isset($_POST['submit'])){
					$nik	= $_POST['nik'];
					$nokk	= $_POST['nokk']; 
					$nama	= $_POST['nama'];
					$nama	= mysqli_real_escape_string($con, $nama); 
					$jk		= $_POST['gender'];
					$tmpt	= $_POST['tl'];
					$tmpt	= mysqli_real_escape_string($con, $tmpt); 
					$tgl	= $_POST['tgl'];
					$goldar	= $_POST['goldar'];
					$agama	= $_POST['agama'];
					$status	= $_POST['status'];
					$sdhk	= $_POST['sdhk'];
					$sdhk	= mysqli_real_escape_string($con, $sdhk); 
					$pend	= $_POST['pend'];
					$kerja	= $_POST['kerja'];
					$kerja	= mysqli_real_escape_string($con, $kerja); 
					$ibu	= $_POST['ibu'];
					$ibu	= mysqli_real_escape_string($con, $ibu); 
					$ayah	= $_POST['ayah'];
					$ayah	= mysqli_real_escape_string($con, $ayah); 
					$alamat	= $_POST['alamat'];
					$alamat	= mysqli_real_escape_string($con, $alamat); 
					$rw		= $_POST['rw'];
					$rt		= $_POST['rt'];
					$target_dir = "../../dist/img/";					
					$name = $_FILES["gambar"]["name"];
					$target_file = $target_dir . basename($_FILES["gambar"]["name"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					$check = getimagesize($_FILES["gambar"]["tmp_name"]);
					if(isset($_FILES['gambar']) && !empty($_FILES['gambar']['name'])){
						if($check !== false) {
							if (file_exists($target_file)) {
								$msg = "Nama file sudah ada, silahkan ganti nama file ";
								$uploadOk = 0;
							}
						} 
						else {
							$msg = "Ukuran file tidak boleh lebih dari 2 MB ";
							$uploadOk = 0;
						}
					}
					else{
						$uploadOk=1;
					}
					
					if ($uploadOk == 0) {
						echo $msg.'<div class="fa fa-remove"></div><br><br>';
						echo '<a href="index.php">Kembali ke Input data</a>';
						
					} else {
						move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
						
						$query = "INSERT INTO penduduk(nik, noKK, nama, jenisKelamin, tmptLahir, tglLahir, golDar, agama, status, hubKel, pendAkhir, pekerjaan, namaIbu, namaAyah, alamat, rw, rt, gambar) 
						VALUES ('$nik','$nokk','$nama','$jk','$tmpt','$tgl','$goldar','$agama','$status','$sdhk','$pend','$kerja','$ibu','$ayah','$alamat','$rw','$rt','$name')";
						$hasil = mysqli_query($con,$query);
						if (!$hasil){
							die ("Could not query the database: <br />". mysqli_error($con));
							}
						else{
							echo 'Data telah masuk dan berhasil disimpan <div class= "fa fa-check"></div><br><br>';
							echo '<a class="btn bg-red"href="index.php">Kembali ke Input data</a>';
						}
					}
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