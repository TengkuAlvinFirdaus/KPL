<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
require 'functions.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"SELECT * FROM user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// buat session login dan username
	$_SESSION['username'] = $username;
	$_SESSION['level'] = $data['level'];
 
	// cek jika user login sebagai admin
	if($data['level']=="admin"){
		// alihkan ke halaman dashboard admin
		header("location:index.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['level']=="pegawai"){
		// alihkan ke halaman dashboard pegawai
		header("location:index-pegawai.php");
 
	}else{
 
		// alihkan ke halaman login kembali
		header("location:login.php?pesan=gagal");
	}	
}
 
?>