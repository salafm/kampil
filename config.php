<?php
	date_default_timezone_set("Asia/Jakarta");
	$db_host='localhost';
	$db_database='kampil';
	$db_username='root';
	$db_password='';
	$koneksi=mysqli_connect($db_host,$db_username,$db_password,$db_database) or 
	die("Maaf Anda gagal koneksi.!");
?>