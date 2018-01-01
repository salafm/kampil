<?php
// memulai session
session_start();
error_reporting(0);
if (isset($_SESSION['kategori']))
{
	// jika level admin
	if ($_SESSION['kategori'] == "admin")
   {   
   	echo "<h1>Admin</h1>";
   	
   	echo "<a href=''>barang</a><br>";	
   	echo "<a href=''>petugas</a><br>";
	echo "<a href=''>transaksi</a><br>";
	echo "<a href=''>rekap</a><br/>";
	echo "<a href=''>jihad ganteng</a>";
   }
   // jika kondisi level user maka akan diarahkan ke halaman lain
   else if ($_SESSION['kategori'] == "kasir")
   {
	   echo "<h1>Kasir</h1>";
	   echo "<a href=''>transaksi</a><br>";
	   echo "<a href=''>rekap</a><br>";
	   echo "<a href=''>jihad ganteng</a>";
   } 
   echo "<br>";
   echo "<hr>";
   echo "<a href='logout.php'>Logout</a>";
}
if (!isset($_SESSION['kategori']))
{
	header('location:index.php');
}
 ?>