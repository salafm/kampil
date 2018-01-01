<?php
session_start();
error_reporting(0);
if (isset($_SESSION['kategori']))
{ if($_SESSION['kategori'] == "admin"){

include('header.php');
?>

<!DOCTYPE>
<html>
	<head>
	<style>
		body {
			margin: 0;
			padding: 0;
			background-color: #FAFAFA;
		}
		* {
			box-sizing: border-box;
			-moz-box-sizing: border-box;
		}
		.page {
			height: 21cm;
			min-width: 29.7cm;
			padding: 2cm;
			margin: 1cm auto;
			border: 1px #D3D3D3 solid;
			border-radius: 5px;
			background: white;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}
		.subpage {
			width: 256mm;
			outline: 2cm #FFFFFF solid;
		}

		@page {
			size: A4;
			margin: 0;
		}
		@media print {
			.page {
				margin: 0;
				border: initial;
				border-radius: initial;
				height: initial;
				min-height: initial;
				box-shadow: initial;
				background: initial;
				page-break-after: always;
			}
		}
		.main-sidebar{
			height:160%;
		}
		.float{
			float:left;
		}
		.kop{
			color:black;
			font-size: 16pt;
			font-family: "Times New Roman";
		}
		.imgs{
			margin-left:1cm;
		}
		.border{
			display:block;
			border-top: 5px black solid;
		}
		.isi{
			color:black;
			font-size: 12pt;
		}
		.vertical-center {
		text-align:center;
		vertical-align: middle !important;
		}
	</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Transaksi</title>
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
    <!-- AdminLTE Skins. We have chosen the skin-yellow for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="../../dist/css/skins/skin.css">

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
	  	<?php
			if(isset($_GET['submit'])){
				$bln = $_GET['bulan'];
				$thn = $_GET['tahun'];
			}
			//include our login information
			require_once('../../config.php');
			//Connect
			$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
			$bln = mysqli_real_escape_string($con, $bln);
			$thn = mysqli_real_escape_string($con, $thn);
			
			if (mysqli_connect_errno()){
				die ("Could not connect to the database: <br/>". mysqli_connect_error());
			} 
			
			setlocale(LC_ALL, 'IND');
			$bln2 = strftime('%B', mktime(20,0,0,$bln,30,17));
			
			// Assign the query
			$query = "SELECT * FROM penduduk WHERE NOT(SUBSTRING_INDEX(SUBSTRING_INDEX(tglLahir,'/',2),'/',-1)+0 = '$bln' AND (SUBSTRING_INDEX(tglLahir,'/',-1)+0 = '$thn'))
							AND (year(buat) = '$thn' AND month(buat) = '$bln')";
			
			$query10 = "SELECT * FROM perangkat WHERE id = '1'";
			$query11 = "SELECT * FROM perangkat WHERE id = '3'";
			
			// Execute the query 
			$result = mysqli_query($con,$query);
			$result10 = mysqli_query($con,$query10);
			$result11 = mysqli_query($con,$query11);
			
			if ((!$result) OR (!$result10)){
			   die ("Could not query the database: <br />". mysqli_error($con));
			}
			
			$data = mysqli_fetch_array($result10);
			$data1 = mysqli_fetch_array($result11);
			setlocale(LC_ALL, 'IND');
			$tgl = strftime("&nbsp; %d %B %Y", strtotime('now'));
		?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<br>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li>Rekapitulasi Penduduk</li>
			<li class="active">Print Laporan Datang</li>
          </ol>
        </section>
		
        <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
			<a style="margin-top:20px; text-decoration: none" onClick="cetak();" class="btn btn-md bg-blue pull-right" role="button"><c class="fa fa-print"></c>&ensp;Print</a>
			<div class="pull-right" >
				<form method="get" id="form1" action="">
				<select class="isi" id="cetak" onChange="pilih()">
					<option value='print.php'>LAMPID</option>
					<option value='print2.php'>Lahir</option>
					<option value='print3.php'>Lahir Mati</option>
					<option value='print4.php'>Mati</option>
					<option value='print5.php' selected>Pindah</option>
					<option value='print6.php'>Datang</option>
				</select>
				<input type="hidden" value=<?php echo $bln;?> name="bulan">
				<input type="hidden" value=<?php echo $thn;?> name="tahun">
				<input type="submit" name="submit" style="margin:20px 10px; text-decoration:none" value="Rekap" class="btn btn-md bg-blue" id="print">
			</div>
            <h4><i class="fa fa-info"></i> Note:</h4>
            Silahkan pilih pilihan disamping untuk rekap data lainnya.
          </div>
        </div>
		
		<div class="book">
			<div class="page">
				<div class="subpage">
					<h2 align="center" class="kop">
						<b>LAPORAN PENCATATAN DATANG</b>
					</h2><br><br>
					<div class="isi">
						<table width="100%">
							<tr>
								<td width="20%">Provinsi</td>
								<td width="2%">:</td>
								<td width="44%">Jawa Tengah</td>
								<td width="20%">Desa</td>
								<td width="2%">:</td>
								<td width="">Kampil</td>
							</tr>
							<tr>
								<td>Kabupaten</td>
								<td>:</td>
								<td>Pekalongan</td>
								<td>Periode</td>
								<td>:</td>
								<td><?php echo $bln2.' '.$thn;?></td>
							</tr>
							<tr>
								<td>Kecamatan</td>
								<td>:</td>
								<td>Wiradesa</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table><br>
						<table width="100%" border="1">
						<?php
						echo "<tr>";
							echo '<th class="vertical-center">No.</th>';
							echo "<th class='vertical-center'>No. KK</th>";
							echo "<th class='vertical-center'>NIK</th>";
							echo "<th class='vertical-center'>Nama</th>";
							echo "<th class='vertical-center'>Jenis Kelamin</th>";
							echo "<th class='vertical-center'>Tempat Lahir</th>";
							echo "<th class='vertical-center'>Tanggal Lahir</th>";
							echo "<th class='vertical-center'>Nama Ayah</th>";
							echo "<th class='vertical-center'>Nama Ibu</th>";
						echo "</tr>";
						$i=1;
						// Fetch and display the results
						while ($row = mysqli_fetch_array($result)){
						  echo '<tr>';
							  echo '<td class="vertical-center">'.$i.'</td>'; 
							  echo '<td class="vertical-center">'.$row['noKK'].'</td>';
							  echo '<td class="vertical-center">'.$row['nik'].'</td>';
							  echo '<td class="vertical-center">'.$row['nama'].'</td>';
							  echo '<td class="vertical-center">'.$row['jenisKelamin'].'</td>';
							  echo '<td class="vertical-center">'.$row['tmptLahir'].'</td>';
							  echo '<td class="vertical-center">'.$row['tglLahir'].'</td>';
							  echo '<td class="vertical-center">'.$row['namaAyah'].'</td>';
							  echo '<td class="vertical-center">'.$row['namaIbu'].'</td>';
						  echo '</tr>';
						  $i = $i+1;
						}
						?>
					</table><br><br>
					<div class="pull-right" align="center">
							Kampil, <?php echo $tgl; ?> <br>
							<c id = "jabatan">Petugas Registrasi Dukcapil, <br>Desa Kampil</c><br><br><br><br>
							<b><u><c id ="name" style="text-transform: uppercase"><?php echo $data1['nama'];?></c></u></b><br>
							<?php
								if ($data1['nip'] == null) {}
								else {
									echo 'NIP. '.$data1['nip'];
								}
							?>
					</div>
					<div class="pull-right" align="center" style="margin-right:150px">
							<br>
							<c id = "jabatan">Mengetahui, <br>Kepala Desa Kampil</c><br><br><br><br>
							<b><u><c id ="name" style="text-transform: uppercase"><?php echo $data['nama'];?></c></u></b><br>
							<?php
								if ($data['nip'] == null) {}
								else {
									echo 'NIP. '.$data['nip'];
								}
							?>
					</div>
					</div>
				</div>    
			</div>
		</div>
        <div class="clearfix"></div>
      </div><!-- /.content-wrapper -->
	  <!--------------------------------------------------------------------------->

			<script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
			<!-- Bootstrap 3.3.5 -->
			<script src="../../bootstrap/js/bootstrap.min.js"></script>
			<!-- AdminLTE App -->
			<script src="../../dist/js/app.min.js"></script>
	</body>
	<script>	
	function cetak(){
		window.print();
	}
	
	function pilih(){
		var page = document.getElementById('cetak').value;
		document.getElementById('form1').setAttribute("action", page);
	}
	</script>
<?php
//close connection
mysqli_close($con);
 '<div class="no-print">';
include'footer.html';
 '</div>';
 '</html>';

}else{
	header('location:../../dashboard.php');
}
}
if (!isset($_SESSION['kategori']))
{
	header('location:../../index.php');
}
?>