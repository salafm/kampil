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
            <small>Isi Form</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Desa Kampil</a></li>
            <li class="active">Input Data Penduduk</li>
          </ol>
        </section>
		
        <!-- Main content -->
		<div class="row">
        <section class="content">
		<form method="POST" autocomplete="on" action="simpan.php" enctype="multipart/form-data">
		<div class="col-xs-8">
		<div class='box'>
		<table class="table table-bordered table-hover">
			<tr>
				<th class="bg-navy" colspan="3" style="text-align:center">
					Tambah Data Penduduk
				</th>
			</tr>
			<tr>
				<td>No. Kartu Keluarga</td>
				<td>:</td>
				<td>
					<input type ="text" name="nokk" size="30" maxlength="16" placeholder="16 digit angka" pattern="^(0|[0-9][0-9]*)$"  title="Hanya angka yg diperbolehkan" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>No. Induk Kependudukan </td>
				<td>:</td>
				<td>
					<input type ="text" name="nik" size="30" maxlength="16" placeholder="16 digit angka" pattern="(0|[0-9][0-9]*)$" title="Hanya angka yg diperbolehkan" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Nama Lengkap </td>
				<td>:</td>
				<td>
					<input type ="text" name="nama" size="30" maxlength="30" placeholder="Maksimal 30 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>
					<input type="radio" checked="checked" name="gender" value="Laki-Laki"> Laki-laki<br>
					<input type="radio" name="gender" value="Perempuan"> Perempuan
				</td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td>:</td>
				<td>
					<input type ="text" name="tl" size="30" maxlength="20" placeholder="Maksimal 20 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td>
					<input type ="text" name="tgl" size="30" maxlength="10" placeholder="DD-MM-YYYY" pattern="^(?=.*?[1-9])[0-9()/]+$" title="Hanya angka dan simbol / yg diperbolehkan" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Golongan Darah</td>
				<td>:</td>
				<td>
					<select name="goldar" width="100%">
						<option class="active" value="">Pilih pilihan yang tersedia</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="AB">AB</option>
						<option value="O">O</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td>:</td>
				<td>
					<select name="agama" width="100%" required>
						<option class="active" value="">Pilih pilihan yang tersedia</option>
						<option value="Islam">Islam</option>
						<option value="Kristen">Kristen</option>
						<option value="Katolik">Katolik</option>
						<option value="Hindu">Hindu</option>
						<option value="Budha">Budha</option>
						<option value="Khonghucu">Khonghucu</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Marital Status </td>
				<td>:</td>
				<td>
					<select name="status" width="100%" required>
						<option class="active" value="">Pilih pilihan yang tersedia</option>
						<option value="Kawin">Kawin</option>
						<option value="Belum Kawin">Belum Kawin</option>
						<option value="Cerai Mati">Cerai Mati</option>
						<option value="Cerai Hidup">Cerai Hidup</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Status Hubungan Dalam Keluarga</td>
				<td>:</td>
				<td>
					<input type ="text" name="sdhk" size="30" maxlength="20" placeholder="Maksimal 30 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Pendidikan Akhir</td>
				<td>:</td>
				<td>
					<select name="pend" width="100%" required>
						<option class="active" value="">Pilih pilihan yang tersedia</option>
						<option value="Tidak/Belum Sekolah">Tidak/Belum Sekolah</option>
						<option value="Tidak Tamat SD/Sederajat">Tidak Tamat SD/Sederajat</option>
						<option value="Tamat SD/Sederajat">Tamat SD/Sederajat</option>
						<option value="SLTP/Sederajat">SLTP/Sederajat</option>
						<option value="SLTA/Sederajat">SLTA/Sederajat</option>
						<option value="Diploma I/II">Diploma I/II</option>
						<option value="Akademi/Diploma III/S. Muda">Akademi/Diploma III/S. Muda</option>
						<option value="Diploma IV/Strata I">Diploma IV/Strata I/option>
						<option value="Strata II">Strata II</option>
						<option value="Strata III">Strata III/option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td>:</td>
				<td>
					<input type ="text" name="kerja" size="30" maxlength="20" placeholder="Maksimal 30 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Nama Ibu</td>
				<td>:</td>
				<td>
					<input type ="text" name="ibu" size="30" maxlength="20" placeholder="Maksimal 30 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Nama Ayah</td>
				<td>:</td>
				<td>
					<input type ="text" name="ayah" size="30" maxlength="20" placeholder="Maksimal 30 karakter" pattern="^([^0-9]*)$" title="Isian angka tidak diperbolehkan" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>
					<textarea name="alamat" rows="1" cols="28" placeholder="Maksimal 100 karakter"></textarea>
				</td>
			</tr>
			<tr>
				<td>RW</td>
				<td>:</td>
				<td>
					<input type ="text" name="rw" size="10" maxlength="3" placeholder="Maksimal 3 digit" pattern="(0|[0-9][0-9]*)$" title="Hanya angka yg diperbolehkan" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>RT</td>
				<td>:</td>
				<td>
					<input type ="text" name="rt" size="10" maxlength="3" placeholder="Maksimal 3 digit" pattern="(0|[0-9][0-9]*)$" title="Hanya angka yg diperbolehkan" autofocus required/>
				</td>
			</tr>
			<tr>
				<td>Foto</td>
				<td>:</td>
				<td>
					<input type ="file" name="gambar" accept="image/*" placeholder="Ukuran file maks 2 MB">
					<div style="color:grey">Nama file harus berbeda, maksimal ukuran file 2 MB</div>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<input type="submit" name="submit" value="Simpan" class="btn btn-m bg-green">
					<a type="submit" onClick="pop_up('upload.php')" class="btn btn-m bg-blue">Import data</a>
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
	<script>
	function pop_up(url){
		upload = window.open(url,'win2','status=no,toolbar=no,scrollbars=no,titlebar=no,menubar=no,resizable=0,width=500,height=300,directories=no,location=no') 
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