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
            <small>Detail</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li>Database Non Penduduk</li>
			<li class="active">Detail</li>
          </ol>
        </section>
		
        <!-- Main content -->
		<div class="row">
        <section class="content">
          <?php 
				$id = $_GET['id'];
				$samping = 131;
				//include our login information
				require_once('../../config.php');
				//Connect
				$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
				$id = mysqli_real_escape_string($con, $id);
				
				if (mysqli_connect_errno()){
					die ("Could not connect to the database: <br/>". mysqli_connect_error());
				} 
				
				$query = "SELECT * FROM penduduk WHERE id = '$id'";
				$result = mysqli_query($con,$query);
				if (!$result){
				   die ("Could not query the database: <br />". mysqli_error($con));
				}
				$row = mysqli_fetch_array($result);
				echo '<div class="cols-xs-8">';
				echo '<div style="overflow-x:auto;">';
				echo '<table class="table table-bordered table-striped" style="width:100%"> ';
				
				echo '<tr>';
				echo '<th colspan="4" class="bg-navy" align-text="center">Detail data penduduk 
						<div class="pull-right status">STATUS : '.$row['pindah'].'</div></th>';
				echo "</tr>";
				
				$img = "../../dist/img/".$row['gambar'];
				
				echo '<tr>';
				echo '<td rowspan="9" class="foto" align="center" width="25%"> <img src="'.$img.'" width="80%" height="80%" alt="Foto" class="imgs"/></td>';
				echo '<td width="25%">No. Kartu Keluarga</td>';
				echo '<td width="2%">:</td>';
				echo '<td width="48%">'.$row['noKK'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td>No. Induk Kependudukan</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['nik'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td>Nama Lengkap</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['nama'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td>Jenis Kelamin</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['jenisKelamin'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td>Tempat Lahir</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['tmptLahir'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td>Tanggal Lahir</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['tglLahir'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td>Golongan Darah</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['golDar'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td>Agama</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['agama'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td>Marital Status</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['status'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td align="center"><a onClick=\'javascript: return confirm("Apakah anda yakin akan menghapus data ini?");\' 
						href="delete.php?id='.$row["id"].'" class="btn btn-sm bg-red pisah" role="button">Hapus Data</a></td>';				
				echo '<td>Status Hubungan Dalam Keluarga</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['hubKel'].'</td>';
				echo "</tr>";
				
				echo '<tr>';				
				echo '<td align="center"></td>';
				echo '<td>Pendidikan Terakhir</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['pendAkhir'].'</td>';
				echo "</tr>";
				
				echo '<tr>';			
				echo '<td align="center"></td>';
				echo '<td>Pekerjaan</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['pekerjaan'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td></td>';
				echo '<td>Nama Ibu</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['namaIbu'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td></td>';
				echo '<td>Nama Ayah</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['namaAyah'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td></td>';
				echo '<td>Alamat</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['alamat'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td></td>';
				echo '<td>RW</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['rw'].'</td>';
				echo "</tr>";
				
				echo '<tr>';
				echo '<td></td>';
				echo '<td>RT</td>';
				echo '<td>:</td>';
				echo '<td>'.$row['rt'].'</td>';
				echo "</tr>";
				
				$last = $row['last'];
				setlocale(LC_ALL, 'IND');
				$last = strftime("%A, %d %B %Y %T", strtotime($last));
				
				echo '<tr>';
				echo '<td colspan="4" ><i class="pull-right">Terakhir diubah pada '.$last.'</i></td>';
				echo '</tr>';
				
				echo '</table>';
				echo '</div></div>';
				//close connection
				mysqli_close($con);
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
	<style>
		<?php header("Content-type: text/css");
		$fix = "$samping";
		?>

		.main-sidebar{
			height:<?= $fix."%" ?>;
		}
		}
		table{
			table-layout:fix;
		}
		.foto{
			width:10px;
			align-text:center;
		}
		.pisah{
			margin:0px 5px;
		}
	</style>
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