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
            Import File
            <small>Simpan</small>
          </h1>
        </section>
		
        <!-- Main content -->
		<div class="row">
        <section class="content">
			<?php
				require_once('../../config.php');
				require_once('../../dist/PHPExcel/PHPExcel.php');
				//Connect
				$pdo = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_username, $db_password); 
				
				echo '<div class="col-xs-8" >';
				if(isset($_POST['submit'])){
					$target_dir = "../../dist/data/";					
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
								unlink($target_file);
								$uploadOk = 1;
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
						
						$excelreader = new PHPExcel_Reader_Excel2007();  
						$loadexcel = $excelreader->load('../../dist/data/'.$name); // Load file excel yang tadi diupload ke folder tmp  
						$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);    

						// Buat query Insert  
						$sql = $pdo->prepare("INSERT INTO penduduk (noKK, nik, nama, jenisKelamin, tmptLahir, tglLahir, golDar, agama, status, hubKel, pendAkhir, pekerjaan, namaIbu, namaAyah, alamat, rt, rw) 
										VALUES (:noKK,:nik,:nama,:jenisKelamin,:tmptLahir,:tglLahir,:golDar,:agama,:status,:hubKel,:pendAkhir,:pekerjaan,:namaIbu,:namaAyah,:alamat,:rt,:rw)");

						$numrow = 1;  foreach($sheet as $row){    // Ambil data pada excel sesuai Kolom     
							$noKK 			= $row['B']; // Ambil data nama    
							$nik 			= $row['C']; // Ambil data jenis kelamin    
							$nama 			= $row['D']; // Ambil data telepon    
							$jenisKelamin 	= $row['E']; // Ambil data alamat  
							$tmptLahir		= $row['F']; // Ambil data alamat  
							$tglLahir 		= $row['G']; // Ambil data alamat  
							$golDar 		= $row['H']; // Ambil data alamat  
							$agama 			= $row['I']; // Ambil data alamat  
							$status 		= $row['J']; // Ambil data alamat  
							$hubKel 		= $row['K']; // Ambil data alamat  
							$pendAkhir 		= $row['L']; // Ambil data alamat  
							$pekerjaan 		= $row['M']; // Ambil data alamat  
							$namaIbu 		= $row['N']; // Ambil data alamat  
							$namaAyah 		= $row['O']; // Ambil data alamat  
							$alamat 		= $row['P']; // Ambil data alamat  
							$rw 			= $row['Q']; // Ambil data alamat  
							$rt 			= $row['R']; // Ambil data alamat 
							
							if(empty($noKK) && empty($nik) && empty($nama) && empty($jenisKelamin) && empty($tmptLahir) 
							&& empty($tglLahir) && empty($golDar) && empty($agama) && empty($status) && empty($hubKel) 
							&& empty($pendAkhir) && empty($pekerjaan) && empty($namaIbu) && empty($namaAyah) && 
							empty($alamat) && empty($rt) && empty($rw))      
							continue;

							if($numrow > 1){      // Proses simpan ke Database      
								$sql->bindParam(':noKK', $noKK);   
								$sql->bindParam(':nik', $nik);      
								$sql->bindParam(':nama', $nama);      
								$sql->bindParam(':jenisKelamin', $jenisKelamin);      
								$sql->bindParam(':tmptLahir', $tmptLahir);      
								$sql->bindParam(':tglLahir', $tglLahir);  
								$sql->bindParam(':golDar', $golDar);  
								$sql->bindParam(':agama', $agama);  
								$sql->bindParam(':status', $status);  
								$sql->bindParam(':hubKel', $hubKel);  
								$sql->bindParam(':pendAkhir', $pendAkhir);  
								$sql->bindParam(':pekerjaan', $pekerjaan);  
								$sql->bindParam(':namaIbu', $namaIbu);  
								$sql->bindParam(':namaAyah', $namaAyah);  
								$sql->bindParam(':alamat', $alamat);  
								$sql->bindParam(':rt', $rt); 
								$sql->bindParam(':rw', $rw);      
								$sql->execute(); // Eksekusi query insert    
							}        
							$numrow++; // Tambah 1 setiap kali looping  
						}
						echo 'File berhasil diupload dan berhasil disimpan <div class= "fa fa-check"></div><br><br>';
						echo '<a role="button" onClick="closeWindow()" class="btn bg-red">Selesai</a>';
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
			opener.location.replace('../penduduk');
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