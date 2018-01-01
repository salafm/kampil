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
	.button {
		background-color: #e7e7e7; 
		color: black;
		border: none;
		border-radius: 5px;
		padding: 1px 10px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
	}
	.button:hover{
		color:#e7e7e7;
		background-color:black;
	}
	#a{
		margin-left:10px;
	}
	input{
		float:right;
		margin-left:10px;
	}
	.float{
		margin-right:10px;
		float:right;
	}
	.vertical-center {
		text-align:center;
		vertical-align: middle !important;
	}
	</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Starter</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
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
            Rekapitulasi Penduduk
            <small>Data</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li class="active">Rekapitulasi Penduduk</li>
          </ol>
        </section>
		
        <!-- Main content -->
		<div class="row">
        <section class="content">
		<form method='get' id="form1" action="">
          <?php 
				if(isset($_GET['submit'])){
					$bln = $_GET['bulan'];
					$thn = $_GET['tahun'];
				}
				//include our login information
				require_once('../../config.php');
				//Connect
				$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
				
				if (mysqli_connect_errno()){
					die ("Could not connect to the database: <br/>". mysqli_connect_error());
				} 
				
				setlocale(LC_ALL, 'IND');
				$bln2 = strftime('%B', mktime(20,0,0,$bln,30,17));
				
				// Assign the query
				$query = "SELECT id, tglLahir FROM penduduk WHERE (jenisKelamin='Laki-Laki' OR jenisKelamin='L')";
				$query1 = "SELECT id, tglLahir FROM penduduk WHERE (jenisKelamin='Perempuan' OR jenisKelamin='P')";
				$query2 = "SELECT id, tglLahir FROM penduduk WHERE (jenisKelamin='Laki-Laki' OR jenisKelamin='L') AND pindah='Meninggal' AND (year(buat) = $thn AND month(buat) = $bln)";
				$query3 = "SELECT id, tglLahir FROM penduduk WHERE (jenisKelamin='Perempuan' OR jenisKelamin='P') AND pindah='Meninggal' AND (year(buat) = $thn AND month(buat) = $bln)";
				$query4 = "SELECT id FROM penduduk WHERE (jenisKelamin='Laki-Laki' OR jenisKelamin='L') AND pindah='Pindah rumah' AND (year(buat) = $thn AND month(buat) = $bln)";
				$query5 = "SELECT id FROM penduduk WHERE (jenisKelamin='Perempuan' OR jenisKelamin='P') AND pindah='Pindah rumah' AND (year(buat) = $thn AND month(buat) = $bln)";
				$query6 = "SELECT id FROM penduduk WHERE (jenisKelamin='Laki-Laki' OR jenisKelamin='L') AND (year(buat) = $thn AND month(buat) = $bln)";
				$query7 = "SELECT id FROM penduduk WHERE (jenisKelamin='Perempuan' OR jenisKelamin='P') AND (year(buat) = $thn AND month(buat) = $bln)";
				$query8 = "SELECT id FROM penduduk WHERE (jenisKelamin='Laki-Laki' OR jenisKelamin='L') AND (year(buat) = $thn AND month(buat) < $bln) AND NOT((pindah='Meninggal') OR (pindah='Pindah rumah'))";
				$query9 = "SELECT id FROM penduduk WHERE (jenisKelamin='Perempuan' OR jenisKelamin='P') AND (year(buat) = $thn AND month(buat) < $bln) AND NOT((pindah='Meninggal') OR (pindah='Pindah rumah'))";

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
				
				if ((!$result) OR (!$result1) OR (!$result2) OR (!$result3) OR (!$result4) OR (!$result5) OR (!$result6) 
					OR (!$result7) OR (!$result8) OR (!$result9)){
				   die ("Could not query the database: <br />". mysqli_error($con));
				}
				
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
				
				echo '<div class="box">';
				echo '<div style="overflow-x:auto;">';
				echo '<table id="example" class="table table-striped table-bordered table-hover" border="1">';
				echo '<tr>';
				echo '<th colspan="10" class="bg-navy">Rekapitulasi Data Penduduk 
						<div class="pull-right status"> '.$bln2.' '.$thn.'</div></th>';
				echo '</tr>';
				echo "<tr>";
					echo '<th rowspan="2" class="vertical-center">No.</th>';
					echo "<th rowspan='2' class='vertical-center'> Data Jumlah Penduduk	</th>";
					echo "<th colspan='2' style='text-align:center'>WNI</th>";
					echo "<th colspan='2' style='text-align:center'>WNA</th>";
					echo "<th colspan='3' style='text-align:center'>Jumlah</th>";
				echo "</tr>";
				echo "<tr>";
					echo '<th class="vertical-center">Laki-laki</th>';
					echo "<th class='vertical-center'>Perempuan</th>";
					echo '<th class="vertical-center">Laki-laki</th>';
					echo "<th class='vertical-center'>Perempuan</th>";
					echo '<th class="vertical-center">Laki-laki</th>';
					echo "<th class='vertical-center'>Perempuan</th>";
					echo "<th class='vertical-center'>L+P</th>";
				echo "</tr>";
				// Fetch and display the results
				  echo '<tr class="vertical-center">';
					  echo '<td> 1 </td>'; 
					  echo '<td style="text-align:left">Jumlah Penduduk s.d bulan lalu</td>';
					  echo '<td>'.$jmllalulk.'</td>';
					  echo '<td>'.$jmllalupr.'</td>';
					  echo '<td>-</td>';
					  echo '<td>-</td>';
					  echo '<td>'.$jmllalulk.'</td>';
					  echo '<td>'.$jmllalupr.'</td>';
					  echo '<td>'.$jmllalu.'</td>';
				  echo '</tr>';
				  echo '<tr class="vertical-center">';
					  echo '<td> 2 </td>'; 
					  echo '<td style="text-align:left">Jumlah Lahir</td>';
					  echo '<td>'.$jmllahirlk.'</td>';
					  echo '<td>'.$jmllahirpr.'</td>';
					  echo '<td>-</td>';
					  echo '<td>-</td>';
					  echo '<td>'.$jmllahirlk.'</td>';
					  echo '<td>'.$jmllahirpr.'</td>';
					  echo '<td>'.$jmllahir.'</td>';
				  echo '</tr>';
				  echo '<tr class="vertical-center">';
					  echo '<td> 3 </td>'; 
					  echo '<td style="text-align:left">Jumlah Lahir Mati</td>';
					  echo '<td>'.$jmllahirmatilk.'</td>';
					  echo '<td>'.$jmllahirmatipr.'</td>';
					  echo '<td>-</td>';
					  echo '<td>-</td>';
					  echo '<td>'.$jmllahirmatilk.'</td>';
					  echo '<td>'.$jmllahirmatipr.'</td>';
					  echo '<td>'.$jmllahirmati.'</td>';
				  echo '</tr>';
				  echo '<tr class="vertical-center">';
					  echo '<td> 4 </td>'; 
					  echo '<td style="text-align:left">Jumlah Mati</td>';
					  echo '<td>'.$jmlmatilk.'</td>';
					  echo '<td>'.$jmlmatipr.'</td>';
					  echo '<td>-</td>';
					  echo '<td>-</td>';
					  echo '<td>'.$jmlmatilk.'</td>';
					  echo '<td>'.$jmlmatipr.'</td>';
					  echo '<td>'.$jmlmati.'</td>';
				  echo '</tr>';
				  echo '<tr class="vertical-center">';
					  echo '<td> 5 </td>'; 
					  echo '<td style="text-align:left">Jumlah Pindah</td>';
					  echo '<td>'.$jmlpinlk.'</td>';
					  echo '<td>'.$jmlpinpr.'</td>';
					  echo '<td>-</td>';
					  echo '<td>-</td>';
					  echo '<td>'.$jmlpinlk.'</td>';
					  echo '<td>'.$jmlpinpr.'</td>';
					  echo '<td>'.$jmlpin.'</td>';
				  echo '</tr>';
				  echo '<tr class="vertical-center">';
					  echo '<td> 6 </td>'; 
					  echo '<td style="text-align:left">Jumlah Datang</td>';
					  echo '<td>'.$jmldtglk.'</td>';
					  echo '<td>'.$jmldtgpr.'</td>';
					  echo '<td>-</td>';
					  echo '<td>-</td>';
					  echo '<td>'.$jmldtglk.'</td>';
					  echo '<td>'.$jmldtgpr.'</td>';
					  echo '<td>'.$jmldtg.'</td>';
				  echo '</tr>';
				  echo '<tr class="vertical-center">';
					  echo '<td> 7 </td>'; 
					  echo '<td style="text-align:left">Jumlah Penduduk s.d bulan ini</td>';
					  echo '<td>'.$jmlinilk.'</td>';
					  echo '<td>'.$jmlinipr.'</td>';
					  echo '<td>-</td>';
					  echo '<td>-</td>';
					  echo '<td>'.$jmlinilk.'</td>';
					  echo '<td>'.$jmlinipr.'</td>';
					  echo '<td>'.$jmlini.'</td>';
				  echo '</tr>';
				echo '</table>';
				echo '</div></div>';
				echo '<input type="submit" name="submit" style="float:left" value="Print" class="btn bg-blue" id="print"/>';
				echo '<input type="submit" name="submit" value="Rekap" class="btn bg-blue float" id="rekap"/>';
				echo '<select name="tahun" style="float:right;margin-top:7px;" required>
						<option value="">Tahun</option>';
						
				$thn2 = $thn;
				while( $thn2 >= 2017){
				echo '<option value="'.$thn2.'"'; if ($thn2 == $thn){ echo "selected";} echo '>'.$thn2.'</option>';
				$thn2 = $thn2-1;
				}
				
				echo '</select>';
				echo '<select name="bulan" style="float:right;margin-top:7px;" required>
						<option value="">Bulan</option>
						<option value="1"'; if ($bln == 1){ echo "selected";} echo '>Januari</option>
						<option value="2"'; if ($bln == 2){ echo "selected";} echo '>Februari</option>
						<option value="3"'; if ($bln == 3){ echo "selected";} echo '>Maret</option>
						<option value="4"'; if ($bln == 4){ echo "selected";} echo '>April</option>
						<option value="5"'; if ($bln == 5){ echo "selected";} echo '>Mei</option>
						<option value="6"'; if ($bln == 6){ echo "selected";} echo '>Juni</option>
						<option value="7"'; if ($bln == 7){ echo "selected";} echo '>Juli</option>
						<option value="8"'; if ($bln == 8){ echo "selected";} echo '>Agustus</option>
						<option value="9"'; if ($bln == 9){ echo "selected";} echo '>September</option>
						<option value="10"'; if ($bln == 10){ echo "selected";} echo '>Oktober</option>
						<option value="11"'; if ($bln == 11){ echo "selected";} echo '>November</option>
						<option value="12"'; if ($bln == 12){ echo "selected";} echo '>Desember</option>
					</select>';
				
				//close connection
				mysqli_close($con);
			?>
			
		</form>
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
	$('#rekap').click(function(){
		$('#form1').attr('action', 'rekap.php');
		$('#form1').submit();
	});

	$('#print').click(function(){
		$('#form1').attr('action', 'print.php');
		$('#form1').submit();
	});
	</script>
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