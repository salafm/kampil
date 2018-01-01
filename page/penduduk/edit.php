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
            Database Penduduk
            <small>Edit Data</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li>Database Penduduk</li>
			<li>Detail</li>
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
					$query = " SELECT * FROM penduduk WHERE id= '$id' ";
					// Execute the query
					$result = $db->query( $query );
					if (!$result){
						die ("Could not query the database: <br />". $db->error);
						}else{
							while ($row = $result->fetch_object()){
									$noKK = $row->noKK;
									$nik = $row->nik;
									$nama = $row->nama;
									$jenisKelamin = $row->jenisKelamin;
									$tmptLahir = $row->tmptLahir;
									$tglLahir = $row->tglLahir;
									$golDar = $row->golDar;
									$agama = $row->agama;
									$status = $row->status;
									$hubKel = $row->hubKel;
									$pendAkhir = $row->pendAkhir;
									$pekerjaan = $row->pekerjaan;
									$namaIbu = $row->namaIbu;
									$namaAyah = $row->namaAyah;
									$alamat = $row->alamat;
									$rw = $row->rw;
									$rt = $row->rt;
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
				<th class="bg-navy" colspan="3" style="text-align:center">
					Edit Data Penduduk
				</th>
			</tr>
			<tr>
				<td>No. Kartu Keluarga</td>
				<td>:</td>
				<td>
					<input type ="text" name="nokk" size="30" maxlength="16" placeholder="16 digit angka" pattern="(0|[0-9][0-9]*)$" title="Hanya angka yg diperbolehkan" value="<?php echo $noKK;?>" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>No. Induk Kependudukan </td>
				<td>:</td>
				<td>
					<input type ="text" name="nik" size="30" maxlength="16" placeholder="16 digit angka" pattern="(0|[0-9][0-9]*)$" title="Hanya angka yg diperbolehkan" value="<?php echo $nik;?>"autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Nama Lengkap </td>
				<td>:</td>
				<td>
					<input type ="text" name="nama" size="30" maxlength="30" placeholder="Maksimal 30 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" value="<?php echo $nama;?>" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td><?php
					switch($jenisKelamin){
					case "Laki-Laki" OR "L" :
						{
							echo '<input type="radio" checked="checked" name="gender" value="Laki-Laki"> Laki-laki<br>';
							echo '<input type="radio" name="gender" value="Perempuan"> Perempuan';
							break;
						}
						case "Perempuan" OR "P" :
						{
							echo '<input type="radio" name="gender" value="Laki-Laki"> Laki-laki<br>';
							echo '<input type="radio" checked="checked" name="gender" value="Perempuan"> Perempuan';
							break;
						}
					}
					?>
				</td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td>:</td>
				<td>
					<input type ="text" name="tl" size="30" maxlength="20" placeholder="Maksimal 20 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" value="<?php echo $tmptLahir;?>" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td>
					<input type ="text" name="tgl" size="30" maxlength="10" placeholder="DD-MM-YYYY" pattern="^(?=.*?[1-9])[0-9()/]+$" title="Hanya angka dan simbol / yg diperbolehkan" value="<?php echo $tglLahir;?>" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Golongan Darah</td>
				<td>:</td>
				<td>
					<select name="goldar" width="100%">
						<option value="">Pilih pilihan yang tersedia</option>
						<option <?php if($golDar=="A") echo 'selected="selected"'; ?> value="A">A</option>
						<option <?php if($golDar=="B") echo 'selected="selected"'; ?>value="B">B</option>
						<option <?php if($golDar=="AB") echo 'selected="selected"'; ?>value="AB">AB</option>
						<option <?php if($golDar=="O") echo 'selected="selected"'; ?>value="O">O</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td>:</td>
				<td>
					<select name="agama" width="100%" required>
						<option value="">Pilih pilihan yang tersedia</option>
						<option <?php if($agama=="Islam") echo 'selected="selected"'; ?> value="Islam">Islam</option>
						<option <?php if($agama=="Kristen") echo 'selected="selected"'; ?> value="Kristen">Kristen</option>
						<option <?php if($agama=="Katolik") echo 'selected="selected"'; ?> value="Katolik">Katolik</option>
						<option <?php if($agama=="Hindu") echo 'selected="selected"'; ?> value="Hindu">Hindu</option>
						<option <?php if($agama=="Budha") echo 'selected="selected"'; ?> value="Budha">Budha</option>
						<option <?php if($agama=="Khonghucu") echo 'selected="selected"'; ?> value="Khonghucu">Khonghucu</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Marital Status </td>
				<td>:</td>
				<td>
					<select name="status" width="100%" required>
						<option value="">Pilih pilihan yang tersedia</option>
						<option <?php if($status=="Kawin") echo 'selected="selected"'; ?> value="Kawin">Kawin</option>
						<option <?php if($status=="Belum Kawin") echo 'selected="selected"'; ?> value="Belum Kawin">Belum Kawin</option>
						<option <?php if($status=="Cerai Mati") echo 'selected="selected"'; ?> value="Duda">Cerai Mati</option>
						<option <?php if($status=="Cerai Hidup") echo 'selected="selected"'; ?> value="Duda">Cerai Hidup</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Status Hubungan Dalam Keluarga</td>
				<td>:</td>
				<td>
					<input type ="text" name="sdhk" size="30" maxlength="20" placeholder="Maksimal 30 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" value="<?php echo $hubKel;?>" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Pendidikan Akhir</td>
				<td>:</td>
				<td>
					<select name="pend" width="100%" required>
						<option value="">Pilih pilihan yang tersedia</option>
						<option <?php if($pendAkhir=="Tidak/Belum Sekolah") echo 'selected="selected"'; ?> value="Tidak/Belum Sekolah">Tidak/Belum Sekolah</option>
						<option <?php if($pendAkhir=="Tidak Tamat SD/Sederajat") echo 'selected="selected"'; ?> value="Tidak Tamat SD/Sederajat">Tidak Tamat SD/Sederajat</option>
						<option <?php if($pendAkhir=="Tamat SD/Sederajat") echo 'selected="selected"'; ?> value="Tamat SD/Sederajat">Tamat SD/Sederajat</option>
						<option <?php if($pendAkhir=="SLTP/Sederajat") echo 'selected="selected"'; ?> value="SLTP/Sederajat">SLTP/Sederajat</option>
						<option <?php if($pendAkhir=="SLTA/Sederajat") echo 'selected="selected"'; ?> value="SLTA/Sederajat">SLTA/Sederajat</option>
						<option <?php if($pendAkhir=="Diploma I/II") echo 'selected="selected"'; ?> value="Diploma I/II">Diploma I/II</option>
						<option <?php if($pendAkhir=="Akademi/Diploma III/S. Muda") echo 'selected="selected"'; ?> value="Akademi/Diploma III/S. Muda">Akademi/Diploma III/S. Muda</option>
						<option <?php if($pendAkhir=="Diploma IV/Strata I") echo 'selected="selected"'; ?> value="Diploma IV/Strata I">Diploma IV/Strata I</option>
						<option <?php if($pendAkhir=="Strata II") echo 'selected="selected"'; ?> value="Strata II">Strata II</option>
						<option <?php if($pendAkhir=="Strata III") echo 'selected="selected"'; ?> value="Strata III">Strata III</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td>:</td>
				<td>
					<input type ="text" name="kerja" size="30" maxlength="20" placeholder="Maksimal 30 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" value="<?php echo $pekerjaan;?>"autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Nama Ibu</td>
				<td>:</td>
				<td>
					<input type ="text" name="ibu" size="30" maxlength="20" placeholder="Maksimal 30 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" value="<?php echo $namaIbu;?>" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Nama Ayah</td>
				<td>:</td>
				<td>
					<input type ="text" name="ayah" size="30" maxlength="20" placeholder="Maksimal 30 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" value="<?php echo $namaAyah;?>" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>
					<textarea name="alamat" rows="1" cols="28" placeholder="Maksimal 100 karakter"><?php echo $alamat;?></textarea>
				</td>
			</tr>
			<tr>
				<td>RW</td>
				<td>:</td>
				<td>
					<input type ="text" name="rw" size="10" maxlength="3" placeholder="Maksimal 3 digit" pattern="(0|[0-9][0-9]*)$" title="Hanya angka yg diperbolehkan" value="<?php echo $rw;?>"autofocus required/>
				</td>
			</tr>
			<tr>
				<td>RT</td>
				<td>:</td>
				<td>
					<input type ="text" name="rt" size="10" maxlength="3" placeholder="Maksimal 3 digit" pattern="(0|[0-9][0-9]*)$" title="Hanya angka yg diperbolehkan" value="<?php echo $rt;?>" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Foto</td>
				<td>:</td>
				<td>
					<input type ="file" name="gambar" accept="image/*">
					<div style="color:grey">Nama file harus berbeda, maksimal ukuran file 2 MB</div>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<input type="submit" name="submit" value="Simpan" class="btn btn-m bg-green">
					<a role="button" href="detail.php?id=<?php echo $id ?>" class="btn btn-m bg-red">Batal</a>
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