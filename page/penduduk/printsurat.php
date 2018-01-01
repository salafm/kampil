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
			width: 21cm;
			min-height: 29.7cm;
			padding: 2cm;
			margin: 1cm auto;
			border: 1px #D3D3D3 solid;
			border-radius: 5px;
			background: white;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}
		.subpage {
			height: 256mm;
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
				width: initial;
				min-height: initial;
				box-shadow: initial;
				background: initial;
				page-break-after: always;
			}
		}
		.main-sidebar{
			height:270%;
		}
		.float{
			float:left;
		}
		.kop{
			color:black;
			font-size: 14pt;
			font-family: "Times New Roman";
		}
		.imgs{
			margin-left:1cm;
		}
		h2{
			padding-bottom:5px;
			border-bottom : 1px black solid;
		}
		.border{
			display:block;
			border-top: 5px black solid;
		}
		.isi{
			color:black;
			font-size: 12pt;
		}
		table.opsi {
			width: 70%;
			margin-left: auto;
			margin-right: auto;
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
			$id = $_GET['id']; 
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
			
			$cek = mysqli_fetch_array(mysqli_query($con, "SELECT nomorsurat FROM surat ORDER BY id DESC LIMIT 1"));
			$ex = explode(' / ', $cek['nomorsurat']);
			 
			if (date('d')=='01'){ $a = '01'; }
			else{ $a = $ex[1]+1; }
			 
			$b = '474';
			$c = array('','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
			$d = date('Y');
			$no_surat = $b.' / '.$a.' / '.$c[date('n')].' / '.$d;
			
			setlocale(LC_ALL, 'IND');
			$tgl = strftime("&nbsp; %d %B %Y", strtotime('now'));
		?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<br>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li>Database Penduduk</li>
			<li>Detail</li>
			<li class="active">Print Surat</li>
          </ol>
        </section>
		
        <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
			<a style="margin-top:20px; text-decoration: none" onClick="cetak(); kliks();" class="btn btn-md bg-blue pull-right" role="button"><c class="fa fa-print"></c>&ensp;Print</a>
			<form id="foo" method="post" action="simpansurat.php">
			<input type="hidden" name="idpend" value="<?php echo $id ?>">
			<input type="hidden" name="judul" id="injdl" value="">
			<input type="hidden" name="nosurat" value="<?php echo $no_surat ?>">
			<input type="submit" name="submit" id="tombol" style="margin:20px 10px; text-decoration: none" class="btn btn-md bg-green pull-right" value="Simpan ke database" disabled="disabled"
			onClick="return confirm('Cetak dan simpan sebagai pdf dahulu sebelum melanjutkan.\nSurat akan hilang jika tidak disimpan dahulu.\nApakah anda yakin ingin melanjutkan??');"/>
            <h4><i class="fa fa-info"></i> Note:</h4>
            Silahkan edit surat terlebih dahulu sebelum diprint. Tabel edit surat ada dibawah. <br>
			Cetak dan simpan sebagai pdf sebelum disimpan ke database.
          </div>
        </div>
		
		<div class="book">
			<div class="page">
				<div class="subpage">
					<h2 class="">
						<img src="../../dist/img/pkl.jpg" class="float imgs" width="100px" height="100px"/>
						<div align="center" class="kop">PEMERINTAH KABUPATEN PEKALONGAN<br>
						KECAMATAN WIRADESA <br>
						<b style="font-size:20pt">KANTOR KEPALA DESA KAMPIL <br>
						<i style="font-size:9pt">Alamat  :  Jl. Mayjend. Sutoyo No. 24 Desa Kampil Kec. Wiradesa Kab. Pekalongan Kp.51152</i></b></div>
					</h2>
					<div class="border" style="position: relative; top: -9px;"></div>
					<div class="isi">
						<div>No. Kode Desa : <br> 3326.160.009</div>
						<div align="center">
							<b><u><c id="title" style="text-transform:uppercase">judul dan jenis surat</c></u></b><br>
							Nomor : <?php echo $no_surat; ?>
						</div> <br>
						<table width="100%">
							<tr>
								<td colspan="3">1. Yang bertanda tangan dibawah ini :</td>
							</tr>
							<tr>
								<td style="padding-left:15px" width="30%">a.&ensp;Nama</td>
								<td width="2%">:</td>
								<td width="65%" id="nama" style="text-transform: uppercase; font-weight: bold"></td>
							</tr>
							<tr>
								<td style="padding-left:15px">b.&ensp;Jabatan</td>
								<td>:</td>
								<td id = "jbtn"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style="padding-left:15px" colspan="3">Dengan ini menerangkan bahwa :</td>
							</tr>
							<tr>
								<td style="padding-left:15px">a.&ensp;Nama</td>
								<td>:</td>
								<td style="text-transform: uppercase"><b><?php echo $row['nama']?></b></td>
							</tr>
							<tr>
								<td style="padding-left:15px">b.&ensp;Tempat Tanggal Lahir</td>
								<td>:</td>
								<td><?php echo $row['tmptLahir']?>,&ensp;<?php echo $row['tglLahir']?></td>
							</tr>
							<tr>
								<td style="padding-left:15px">c.&ensp;Kewarganegaraan</td>
								<td>:</td>
								<td>Indonesia</td>
							</tr>
							<tr>
								<td style="padding-left:15px">d.&ensp;Agama</td>
								<td>:</td>
								<td><?php echo $row['agama']?></td>
							</tr>
							<tr>
								<td style="padding-left:15px">e.&ensp;Pekerjaan</td>
								<td>:</td>
								<td><?php echo $row['pekerjaan']?></td>
							</tr>
							<tr>
								<td style="padding-left:15px" valign="top">f.&ensp;Alamat</td>
								<td valign="top">:</td>
								<td><?php echo $row['alamat']?> Rt. <?php echo $row['rt']?> Rw. <?php echo $row['rw']?></td>
							</tr>
							<tr>
								<td style="padding-left:30px">Kecamatan</td>
								<td>:</td>
								<td>Wiradesa</td>
							</tr>
							<tr>
								<td style="padding-left:30px">Kabupaten</td>
								<td>:</td>
								<td>Pekalongan</td>
							</tr>
							<tr>
								<td style="padding-left:30px">Propinsi</td>
								<td>:</td>
								<td>Jawa Tengah</td>
							</tr>
							<tr>
								<td style="padding-left:30px" valign="top">Keperluan</td>
								<td valign="top">:</td>
								<td><c id="perlu"></c></td>
							</tr>
							<tr>
								<td style="padding-left:30px" valign="top">Keterangan</td>
								<td  valign="top">:</td>
								<td><d>Tersebut adalah Penduduk Rt. <?php echo $row['rt']?> Rw. <?php echo $row['rw']?>
										Desa Kampil Kecamatan Wiradesa Kabupaten Pekalongan dan <c id="ktrg"> </c></d></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3">2. 	Berhubung maksud yang bersangkutan, diminta agar yang berwenang </td>
							</tr>
							<tr>
								<td colspan="3" style="padding-left:15px">dapat memberikan bantuan serta fasilitas seperlunya.</td>
							</tr>
							<tr>
								<td colspan="3">3. 	Demikian surat pengantar ini di buat untuk dapat dipergunakan seperlunya.</td>
							</tr>
						</table><br><br>
						<div class="pull-right" align="center">
							Kampil, <?php echo $tgl; ?> <br>
							<c id = "jabatan">Jabatan</c><br><br><br><br>
							<b><u><c id ="name" style="text-transform: uppercase">Nama</c></u></b><br>
							<c id ="nip">NIP.</c>
						</div>
					</div>
				</div>    
			</div>
		</div>
		
		<div class="no-print">
			<table class="table table-bordered box opsi" width="100%">
			<tr>
				<th colspan="3" class="bg-navy">Edit surat</th>
			</tr>
			<tr>
				<td>Jenis Surat</td>
				<td>:</td>
				<td><input type="radio" id="supen" name="surat" value="kades">  Surat Pengantar<br>
				<input type="radio" name="surat" id="suket" value="carik">  Surat Keterangan</td>
			</tr>
			<tr>
				<td width="30%">Judul Surat</td>
				<td width="2%">:</td>
				<td ><input type="text" id="sp" size="35" placeholder="Tambahkan keterangan agar lebih spesifik"></td>
			</tr>
			<tr>
				<td>Keperluan</td>
				<td>:</td>
				<td><textarea type="text" id="kep" rows="2" cols="30" placeholder="Form ini untuk mengisi keperluan surat"></textarea></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>:</td>
				<td><textarea type="text" id="ket" rows="2" cols="30" placeholder="Form ini untuk mengisi keterangan surat"></textarea></td>
			</tr>
			<tr>
				<td>Yang Menandatangani</td>
				<td>:</td>
				<td><input type="radio" id="ttd1" name="ttd">  Kepala Desa<br><input type="radio" name="ttd" id="ttd2">  Sekretaris Desa</td>
			</tr>
			<tr>
				<td colspan="3"><a role="button" onClick="simpan()" class="btn bg-green">Simpan</a></td>
			</tr>
			</table>
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
	function simpan(){
		if (document.getElementById('supen').checked){
			var jdl = 'Surat Pengantar '
			document.getElementById("title").innerHTML = jdl;
			document.getElementById("injdl").value = jdl;
		}else if (document.getElementById('suket').checked){
			var jdl = 'Surat Keterangan '
			document.getElementById("title").innerHTML = jdl;
			document.getElementById("injdl").value = jdl;
		}
		
		var judul = document.getElementById("sp").value;
		document.getElementById("title").innerHTML = jdl+judul;
		document.getElementById("injdl").value = jdl+judul;
		
		var perlu = document.getElementById("kep").value;
		document.getElementById("perlu").innerHTML = perlu;
		
		var ket = document.getElementById("ket").value;
		document.getElementById("ktrg").innerHTML = ket;
		
		if (document.getElementById('ttd1').checked){
			<?php
				$query1 = "SELECT * FROM perangkat WHERE id = '1'";
				$hasil1 = mysqli_query($con, $query1);
				if (!$hasil1){
				   die ("Could not query the database: <br />". mysqli_error($con));
				}
				$data = mysqli_fetch_array($hasil1);
			?>
			document.getElementById("nama").innerHTML = "<?PHP echo $data['nama']; ?>";
			document.getElementById("name").innerHTML = "<?PHP echo $data['nama']; ?>";
			document.getElementById("nip").innerHTML = "<?PHP if ($data['nip'] == null) {} else {echo 'NIP. '.$data['nip'];} ?>";
			document.getElementById("jbtn").innerHTML = "<?PHP echo $data['jabatan']; ?>";
			document.getElementById("jabatan").innerHTML = "<?PHP echo $data['jabatan']; ?> Kampil";
		}else if (document.getElementById('ttd2').checked){
			<?php
				$query1 = "SELECT * FROM perangkat WHERE id = '2'";
				$hasil1 = mysqli_query($con, $query1);
				if (!$hasil1){
				   die ("Could not query the database: <br />". mysqli_error($con));
				}
				$data = mysqli_fetch_array($hasil1);
			?>
			document.getElementById("nama").innerHTML = "<?PHP echo $data['nama']; ?>";
			document.getElementById("name").innerHTML = "<?PHP echo $data['nama']; ?>";
			document.getElementById("nip").innerHTML = "<?PHP if ($data['nip'] == null) {} else {echo 'NIP. '.$data['nip'];} ?>";
			document.getElementById("jbtn").innerHTML = "<?PHP echo $data['jabatan']; ?>";
			document.getElementById("jabatan").innerHTML = "an. Kepala Desa Kampil <br><?PHP echo $data['jabatan']; ?>,";
		}
	}
	
	function cetak(){
		window.print();
	}
	
	var klik = 0;
	function kliks(){
		klik += 1;
		if (klik >= 2){
			var submit = document.getElementById("tombol");
			submit.attributes.removeNamedItem("disabled");
		}
	}
	</script>
<?php
//close connection
mysqli_close($con);
echo '<div class="no-print">';
include'footer.html';
echo '</div>';
echo '</html>';

}else{
	header('location:../../dashboard.php');
}
}
if (!isset($_SESSION['kategori']))
{
	header('location:../../index.php');
}
?>