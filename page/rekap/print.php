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
			$query = "SELECT id, tglLahir FROM penduduk WHERE (jenisKelamin='Laki-Laki' OR jenisKelamin='L')";
			$query1 = "SELECT id, tglLahir FROM penduduk WHERE (jenisKelamin='Perempuan' OR jenisKelamin='P')";
			$query2 = "SELECT id, tglLahir FROM penduduk WHERE (jenisKelamin='Laki-Laki' OR jenisKelamin='L') AND pindah='Meninggal' AND (year(last) = '$thn' AND month(last) = '$bln')";
			$query3 = "SELECT id, tglLahir FROM penduduk WHERE (jenisKelamin='Perempuan' OR jenisKelamin='P') AND pindah='Meninggal' AND (year(last) = '$thn' AND month(last) = '$bln')";
			$query4 = "SELECT id FROM penduduk WHERE (jenisKelamin='Laki-Laki' OR jenisKelamin='L') AND pindah='Pindah rumah' AND (year(last) = '$thn' AND month(last) = '$bln')";
			$query5 = "SELECT id FROM penduduk WHERE (jenisKelamin='Perempuan' OR jenisKelamin='P') AND pindah='Pindah rumah' AND (year(last) = '$thn' AND month(last) = '$bln')";
			$query6 = "SELECT id FROM penduduk WHERE (jenisKelamin='Laki-Laki' OR jenisKelamin='L') AND (year(buat) = '$thn' AND month(buat) = '$bln')";
			$query7 = "SELECT id FROM penduduk WHERE (jenisKelamin='Perempuan' OR jenisKelamin='P') AND (year(buat) = '$thn' AND month(buat) = '$bln')";
			$query8 = "SELECT id FROM penduduk WHERE (jenisKelamin='Laki-Laki' OR jenisKelamin='L') AND (buat <= STR_TO_DATE('1,$bln,$thn','%d,%m,%Y')) AND NOT((pindah='Meninggal') OR (pindah='Pindah rumah'))";
			$query9 = "SELECT id FROM penduduk WHERE (jenisKelamin='Perempuan' OR jenisKelamin='P') AND (buat <= STR_TO_DATE('1,$bln,$thn','%d,%m,%Y')) AND NOT((pindah='Meninggal') OR (pindah='Pindah rumah'))";
			$query10 = "SELECT * FROM perangkat WHERE id = '1'";
			$query11 = "SELECT DISTINCT noKK FROM penduduk";
			$query12 = "SELECT * FROM desa WHERE id = '1'";
			
			// Execute the query 
			$result = mysqli_query($con,$query);
			$result1 = mysqli_query($con,$query1);
			$result2 = mysqli_query($con,$query2);
			$result3 = mysqli_query($con,$query3);
			$result4 = mysqli_query($con,$query4);
			$result5 = mysqli_query($con,$query5);
			$result6 = mysqli_query($con,$query6);
			$result7 = mysqli_query($con,$query7);
			$result8 = mysqli_query($con,$query8);
			$result9 = mysqli_query($con,$query9);
			$result10 = mysqli_query($con,$query10);
			$result11 = mysqli_query($con,$query11);
			$result12 = mysqli_query($con,$query12);
			
			if ((!$result) OR (!$result1) OR (!$result2) OR (!$result3) OR (!$result4) OR (!$result5) OR (!$result6) 
				OR (!$result7) OR (!$result8) OR (!$result9) OR (!$result10) OR (!$result11) OR (!$result11)){
			   die ("Could not query the database: <br />". mysqli_error($con));
			}
			
			$data = mysqli_fetch_array($result10);
			$desa = mysqli_fetch_array($result12);
			$kk = mysqli_num_rows($result11);
			
			$jmllahirlk = 0;
			while($row = mysqli_fetch_array($result)){
				$tgl 	= explode('-', $row['tglLahir']);
				$bulan	= $tgl[1];
				$tahun	= $tgl[2];
				if(($bulan == $bln) AND ($tahun == $thn)){
					$jmllahirlk=$jmllahirlk+1;
				}
			}
			
			$jmllahirpr = 0;
			while($rows = mysqli_fetch_array($result1)){
				$tgl 	= explode('-', $rows['tglLahir']);
				$bulan	= $tgl[1];
				$tahun	= $tgl[2];
				if(($bulan == $bln) AND ($tahun == $thn)){
					$jmllahirpr=$jmllahirpr+1;
				}
			}
			
			$jmllahirmatilk = 0;
			while($rowss = mysqli_fetch_array($result2)){
				$tgl 	= explode('-', $rowss['tglLahir']);
				$bulan	= $tgl[1];
				$tahun	= $tgl[2];
				if(($bulan == $bln) AND ($tahun == $thn)){
					$jmllahirmatilk=$jmllahirmatilk+1;
				}
			}
			
			$jmllahirmatipr = 0;
			while($rowsss = mysqli_fetch_array($result3)){
				$tgl 	= explode('-', $rowsss['tglLahir']);
				$bulan	= $tgl[1];
				$tahun	= $tgl[2];
				if(($bulan == $bln) AND ($tahun == $thn)){
					$jmllahirmatipr=$jmllahirmatipr+1;
				}
			}
			
			$jmllahirmati = $jmllahirmatilk + $jmllahirmatipr;
			
			$jmllahirlk = $jmllahirlk - $jmllahirmatilk;
			$jmllahirpr = $jmllahirpr - $jmllahirmatipr;	
			$jmllahir = $jmllahirlk + $jmllahirpr;
			
			$jmlmatilk 	= mysqli_num_rows($result2) - $jmllahirmatilk;
			$jmlmatipr	= mysqli_num_rows($result3) - $jmllahirmatipr;
			$jmlmati 	= $jmlmatlk + $jmlmatipr;
			
			$jmlpinlk	= mysqli_num_rows($result4);
			$jmlpinpr 	= mysqli_num_rows($result5);
			$jmlpin 	= $jmlpinlk + $jmlpinpr;
			
			$jmldtglk	= mysqli_num_rows($result6) - $jmllahirlk - $jmllahirmatilk;
			$jmldtgpr	= mysqli_num_rows($result7) - $jmllahirpr - $jmllahirmatipr;
			$jmldtg		= $jmldtglk + $jmldtgpr;
			
			$jmllalulk 	= mysqli_num_rows($result8);
			$jmllalupr	= mysqli_num_rows($result9);
			$jmllalu 	= $jmllalulk + $jmllalupr;
			
			$jmlinilk 	= $jmllalulk + $jmldtglk + $jmllahirlk - $jmlmatilk - $jmlpinlk;
			$jmlinipr 	= $jmllalupr + $jmldtgpr + $jmllahirpr - $jmlmatipr - $jmlpinpr;
			$jmlini 	= $jmlinilk + $jmlinipr;
			
			setlocale(LC_ALL, 'IND');
			$tgl = strftime("&nbsp; %d %B %Y", strtotime('now'));
		?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<br>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li>Rekapitulasi Penduduk</li>
			<li class="active">Print Lampid</li>
          </ol>
        </section>
		
        <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
			<a style="margin-top:20px; text-decoration: none" onClick="cetak();" class="btn btn-md bg-blue pull-right" role="button"><c class="fa fa-print"></c>&ensp;Print</a>
			<div class="pull-right" >
				<form method="get" id="form1" action="">
				<select class="isi" id="cetak" onChange="pilih()">
					<option value='print.php' selected>LAMPID</option>
					<option value='print2.php'>Lahir</option>
					<option value='print3.php'>Lahir Mati</option>
					<option value='print4.php'>Mati</option>
					<option value='print5.php'>Pindah</option>
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
						<b>REKAPITULASI LAHIR, LAHIR MATI, MATI, PINDAH, DATANG (LAMPID)</b>
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
						<tr>
							<th rowspan="2" class="vertical-center">No.</th>
							<th rowspan='2' class='vertical-center'> Data Jumlah Penduduk	</th>
							<th colspan='2' style='text-align:center'>WNI</th>
							<th colspan='2' style='text-align:center'>WNA</th>
							<th colspan='3' style='text-align:center'>Jumlah</th>
						</tr>
						<tr>
							<th class="vertical-center">Laki-laki</th>
							<th class='vertical-center'>Perempuan</th>
							<th class="vertical-center">Laki-laki</th>
							<th class='vertical-center'>Perempuan</th>
							<th class="vertical-center">Laki-laki</th>
							<th class='vertical-center'>Perempuan</th>
							<th class='vertical-center'>L+P</th>
						</tr>
						 <tr class="vertical-center">
						   <td> 1 </td> 
						   <td style="text-align:left">Jumlah Penduduk s.d bulan lalu</td>
						   <td><?php echo $jmllalulk; ?></td>
						   <td><?php echo $jmllalupr;?></td>
						   <td>-</td>
						   <td>-</td>
						   <td><?php echo $jmllalulk;?></td>
						   <td><?php echo $jmllalupr;?></td>
						   <td><?php echo $jmllalu;?></td>
					   </tr>
					   <tr class="vertical-center">
						   <td> 2 </td> 
						   <td style="text-align:left">Jumlah Lahir</td>
						   <td><?php echo $jmllahirlk;?></td>
						   <td><?php echo $jmllahirpr;?></td>
						   <td>-</td>
						   <td>-</td>
						   <td><?php echo $jmllahirlk;?></td>
						   <td><?php echo $jmllahirpr;?></td>
						   <td><?php echo $jmllahir;?></td>
					   </tr>
					   <tr class="vertical-center">
						   <td> 3 </td> 
						   <td style="text-align:left">Jumlah Lahir Mati</td>
						   <td><?php echo $jmllahirmatilk;?></td>
						   <td><?php echo $jmllahirmatipr;?></td>
						   <td>-</td>
						   <td>-</td>
						   <td><?php echo $jmllahirmatilk;?></td>
						   <td><?php echo $jmllahirmatipr;?></td>
						   <td><?php echo $jmllahirmati;?></td>
					   </tr>
					   <tr class="vertical-center">
						   <td> 4 </td> 
						   <td style="text-align:left">Jumlah Mati</td>
						   <td><?php echo $jmlmatilk;?></td>
						   <td><?php echo $jmlmatipr;?></td>
						   <td>-</td>
						   <td>-</td>
						   <td><?php echo $jmlmatilk;?></td>
						   <td><?php echo $jmlmatipr;?></td>
						   <td><?php echo $jmlmati;?></td>
					   </tr>
					   <tr class="vertical-center">
						   <td> 5 </td> 
						   <td style="text-align:left">Jumlah Pindah</td>
						   <td><?php echo $jmlpinlk;?></td>
						   <td><?php echo $jmlpinpr;?></td>
						   <td>-</td>
						   <td>-</td>
						   <td><?php echo $jmlpinlk;?></td>
						   <td><?php echo $jmlpinpr;?></td>
						   <td><?php echo $jmlpin;?></td>
					   </tr>
					   <tr class="vertical-center">
						   <td> 6 </td> 
						   <td style="text-align:left">Jumlah Datang</td>
						   <td><?php echo $jmldtglk;?></td>
						   <td><?php echo $jmldtgpr;?></td>
						   <td>-</td>
						   <td>-</td>
						   <td><?php echo $jmldtglk;?></td>
						   <td><?php echo $jmldtgpr;?></td>
						   <td><?php echo $jmldtg;?></td>
					   </tr>
					   <tr class="vertical-center">
						   <td> 7 </td> 
						   <td style="text-align:left">Jumlah Penduduk s.d bulan ini</td>
						   <td><?php echo $jmlinilk ?></td>
						   <td><?php echo $jmlinipr;?></td>
						   <td>-</td>
						   <td>-</td>
						   <td><?php echo $jmlinilk;?></td>
						   <td><?php echo $jmlinipr;?></td>
						   <td><?php echo $jmlini;?></td>
					   </tr>
					</table><br><br>
					<table style="float:left" width="50%" border>
					<tr>
						<th  class="vertical-center">No</th>
						<th  class="vertical-center">Keterangan</th>
						<th  class="vertical-center">Jumlah</th>
					</tr>
					<tr>
						<td  class="vertical-center">1</td>
						<td  class="vertical-center">Jumlah RT</td>
						<td  class="vertical-center"><?php echo $desa['rt']; ?></td>
					</tr>
					<tr>
						<td  class="vertical-center">2</td>
						<td  class="vertical-center">Jumlah RW</td>
						<td  class="vertical-center"><?php echo $desa['rw']; ?></td>
					</tr>
					<tr>
						<td  class="vertical-center">3</td>
						<td  class="vertical-center">Jumlah Dusun</td>
						<td  class="vertical-center"><?php echo $desa['dusun']; ?></td>
					</tr>
					<tr>
						<td  class="vertical-center">4</td>
						<td  class="vertical-center">Jumlah KK</td>
						<td  class="vertical-center"><?php echo $kk; ?></td>
					</tr>
					</table>
					<div class="pull-right" align="center">
							Kampil, <?php echo $tgl; ?> <br>
							<c id = "jabatan">Mengetahui, <br> Kepala Desa Kampil</c><br><br><br><br>
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