<?php
session_start();
error_reporting(0);
if (isset($_SESSION['kategori']))
{ if($_SESSION['kategori'] == "admin"){

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
    <title>Desa Kampil Upload File</title>
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
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="../../dist/css/skins/skin-blue.min.css">

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
            Upload File
            <small>Simpan</small>
          </h1>
        </section>
		
        <!-- Main content -->
		<div class="row">
        <section class="content">
			<?php
				$id = $_GET['id'];
				require_once('../../config.php');
				//Connect
				$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
				if (mysqli_connect_errno()){
					die ("Could not connect to the database: <br/>". mysqli_connect_error());
					} 
				
				echo '<div class="col-xs-8" >';
				if(isset($_POST['submit'])){
					$target_dir = "../../dist/surat/";					
					$name = $_FILES["file"]["name"];
					$target_file = $target_dir . basename($_FILES["file"]["name"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					$maxsize    = 2097152;
					$size = filesize($_FILES['file']['tmp_name']);
					if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
						if($size > $maxsize){
							$msg = 'Maksimal ukuran file adalah 2 MB';
							$$uploadOk = 0;
						}
						else{
							if (file_exists($target_file)) {
								$msg = "Nama file sudah ada, silahkan ganti nama file ";
								$uploadOk = 0;
							}
						}
					}
					else{
						$msg = "Belum ada file terpilih <br> Silahkan pilih file yang akan diupload";
						$uploadOk = 0;
					}
					
					if ($uploadOk == 0) {
						echo $msg.'<div class="fa fa-remove"></div><br><br>';
						echo '<a href="upload.php" class="btn bg-red">Kembali ke Upload File</a>';
						
					} else {
						move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
						
						$query = "UPDATE surat SET surat = '$name' WHERE id = '$id'";
						$hasil = mysqli_query($con,$query);
						if (!$hasil){
							die ("Could not query the database: <br />". mysqli_error($con));
							}
						else{
							echo 'File berhasil diupload dan berhasil disimpan <div class= "fa fa-check"></div><br><br>';
							echo '<a role="button" onClick="closeWindow()" class="btn bg-red">Selesai</a>';
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
	<script>
		function closeWindow() { 
			opener.location.reload(true);
			self.close(); 
		}
	</script>
</html>

<?php
}else{
	header('location:../../dashboard.php');
}
}
if (!isset($_SESSION['kategori']))
{
	header('location:../../index.php');
}
?>