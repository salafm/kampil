<?php
session_start();
if (isset($_SESSION['kategori']))
{
	header('location:login.php');
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Desa Kampil | Lupa Password</title>
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
  <?php 
	require_once('config.php');
	$pass = array('admin','desakampil','sasem','sembung','cokrah','kampil','baldes');
	$password = $pass[date('w')];
?>
  <body class="hold-transition login-page">
    <div class="login-box"> 
      <div class="login-logo">
        <a href="#">Lupa <b>Password</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Password akan direset oleh sistem.</p>
        <form action="reset.php" method="post" id="form">
            <input type="hidden" name="pass" value="" id="pass">
			<button type="submit" name="submit" class="btn btn-block btn-lg btn-xs bg-green" 
				onClick="return confirm('Password akan direset \nAksi ini tidak bisa dibatalkan \nApakah anda ingin melanjutkan?')">Reset Password</button>
			<a href='index.php' class='btn btn-block btn-lg btn-xs bg-red' role='button'>Batal</a>
        </form>
       </div>
	</div><!-- /.login-box-body -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>

  </body>
  <script>
	$(document).ready(function() {
		$('#form').submit(function() { 
			document.getElementById("pass").value = "<?php echo $password; ?>";
		});
	});
  </script>
</html>
