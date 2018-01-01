<?php
session_start();
include 'config.php';
$email = $_POST['nama'];
$password = $_POST['password'];
// query untuk mendapatkan record dari username
$query = "SELECT * FROM petugas WHERE nama = '$email'";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($hasil);
// cek kesesuaian password
if ($password == $data['password'])
{
echo "sukses";
    // menyimpan email dan kke dalam session
    $_SESSION['kategori'] = $data['kategori'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['id'] = $data['idpetugas'];
    header('location: dashboard.php');
}
else 
?>
<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Desa Kampil | Masuk</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  </head>
<body class="hold-transition login-page">
    <div class="login-box"> 
      <div class="login-logo">
        <a href="#">Upaya <b>Masuk </b>Gagal</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Password tidak cocok.</p>
		<a href='lupa.php' class='btn btn-block btn-lg btn-xs bg-green' role='button'>Lupa Password</a>
		<a href='index.php' class='btn btn-block btn-lg btn-xs bg-red' role='button'>Kembali</a>
       </div>
	</div><!-- /.login-box-body -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>

  </body>
</html>