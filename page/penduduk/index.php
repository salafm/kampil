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
		margin-right:35px;
		float:right;
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
            Database Penduduk
            <small>Data</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li class="active">Database Penduduk</li>
          </ol>
        </section>
		
        <!-- Main content -->
		<div class="row">
        <section class="content">
		<form method='get' action="cari.php">
          <?php 
				//include our login information
				require_once('../../config.php');
				//Connect
				$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
				
				if (mysqli_connect_errno()){
					die ("Could not connect to the database: <br/>". mysqli_connect_error());
				} 
				
				if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
				  //we give the value of the starting row to 0 because nothing was found in URL
				  $startrow = 0;
				//otherwise we take the value from the URL
				} else {
				  $startrow = (int)$_GET['startrow'];
				}
				
				$query1 = "SELECT * FROM penduduk WHERE pindah = '' ";
				$result1 = mysqli_query($con,$query1);
				$max = mysqli_num_rows($result1);
				
				// Assign the query
				$query = "SELECT * FROM penduduk WHERE pindah = '' LIMIT $startrow, 10"; 

				// Execute the query 
				$result = mysqli_query($con,$query);
				if (!$result){
				   die ("Could not query the database: <br />". mysqli_error($con));
				}
				
				$page=($startrow+10)/10; 
				$last=ceil($max/10);
				if($last == 0){
					$last = 1;
				}
				
				echo '<div class="box">';
				echo '<div style="overflow-x:auto;">';
				echo '<table id="example" class="table table-striped table-bordered table-hover" border="1">';
				echo '<tr>';
				echo '<th colspan="10" style="text-align:center" class="bg-navy">Data Penduduk</th>';
				echo '</tr>';
				echo "<tr>";
					echo '<th>No.</th>';
					echo "<th>No. KK</th>";
					echo "<th>NIK</th>";
					echo "<th>Nama</th>";
					echo "<th>Jenis Kelamin</th>";
					echo "<th>Tempat Lahir</th>";
					echo "<th>Tanggal Lahir</th>";
					echo "<th>Detail</th>";
				echo "</tr>";
				$i=$startrow+1;
				// Fetch and display the results
				while ($row = mysqli_fetch_array($result)){
				  echo '<tr>';
					  echo '<td>'.$i.'</td>'; 
					  echo '<td>'.$row['noKK'].'</td>';
					  echo '<td>'.$row['nik'].'</td>';
					  echo '<td>'.$row['nama'].'</td>';
					  echo '<td>'.$row['jenisKelamin'].'</td>';
					  echo '<td>'.$row['tmptLahir'].'</td>';
					  echo '<td>'.$row['tglLahir'].'</td>';
					  echo '<td><a href="detail.php?id='.$row["id"].'" role="button">details</a></td>';
				  echo '</tr>';
				  $i = $i+1;
				}
				echo '</table>';
				echo '</div></div>';
				echo '<div style="overflow-x:auto;">';
				echo '<input type="submit" name="submit" value="Cari" class="btn bg-blue float"/>';
				echo '<input type="text" name="cari" size="16"  placeholder="Cari no. KK / NIK/ Nama" style="padding-bottom:13px" autofocus required/ >';
				
				echo '<div class="btn-group" style="float:left">';
				$prev = $startrow - 10;
				if ($prev >= 0){$href2= $_SERVER['PHP_SELF'].'?startrow=0';}
				else{$disable='disabled';$href2='#';}
				echo '<a id="a" href="'.$href2.'" class ="btn bg-blue-active '.$disable.'">Awal</a>';
				if ($prev >= 0){$href1= $_SERVER['PHP_SELF'].'?startrow='.$prev;}
				else{$disable='disabled';$href1='#';}
				echo '<a  href="'.$href1.'" class ="btn bg-blue '.$disable.'">Sebelumnya</a>';
				
				$next= $startrow+10;
				if($next < $max){$href= $_SERVER['PHP_SELF'].'?startrow='.$next;}
				else{$dis='disabled'; $href='#';}
				echo '<a id="a" href="'.$href.'" class ="btn bg-blue '.$dis.'" >Selanjutnya</a>';
				if($next < $max){$href3= $_SERVER['PHP_SELF'].'?startrow='.($last-1)*10;}
				else{$dis='disabled'; $href3='#';}
				echo '<a href="'.$href3.'" class ="btn bg-blue-active '.$dis.'" >Akhir</a>';
				echo '</div>';
				echo '<div style="float:left;margin-left:10px">';
				echo '<input type="text" onchange="kosong()" class="form-control" size="3" id="hal" placeholder="Ke hal.."/>';
				echo '</div>';
				echo '<a type="button" onClick="halaman()" class="btn bg-blue disabled" id="go">Ke</a>';
				echo '<b style="margin:0 100px;" >Halaman '.$page.' dari '.$last.' halaman</b>';
				echo '</div>';
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
	function halaman(){
		var hal = document.getElementById('hal').value;
		var max = "<?php echo $last;?>";
		if(hal >= parseInt(max)){
			hal = parseInt(max);
		}
		var link = "index.php?startrow="+(hal-1)*10;
		document.getElementById('go').setAttribute("href",link);
	}
	
	function kosong(){
		var att = "btn bg-blue disabled";
		var att2 = "btn bg-blue";
		var hal = document.getElementById('hal').value;
		if (hal === ''){
			document.getElementById('go').setAttribute("class",att);
		}
		else{
			document.getElementById('go').setAttribute("class",att2);
		}
	}
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