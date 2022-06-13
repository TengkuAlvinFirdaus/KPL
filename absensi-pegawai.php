<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

	// is role
	isRole();


	if (isset($_POST['serahkan'])) {


		// ambil data dari tiap elemen dalam form absensi
		$fileName = $_FILES['file']['name'];
		$tanggal = $_POST["tanggal"];
		$direktori = "upload/";
		move_uploaded_file($_FILES['file']['tmp_name'],$direktori.$fileName);
		
		// cek keberhasilan
		if ( tambah($_POST) > 0) {
			echo "
				<script>
					alert('data berhasil ditambahkan!');
					document.location.href = 'index-pegawai.php';
				</script>
			";
		} else {
			echo "
				<script>
					alert('data gagal ditambahkan!');
					document.location.href = 'index-pegawai.php';
				</script>
			";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
	<title>Absensi Kemenag Kampar</title>
</head>
<body id="page-top">
	
	<div class="container">
		<div class="header">
			<br>
			<img src="Kemenag.png">
			<h1>Kementrian Agama Kabupaten Kampar</h1>
			<br>

			<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
			  	<div class="container-fluid">
			    	<a class="navbar-brand" href="#page-top">Form Absensi</a>
			    	<button class="navbar-toggler navbar-toggeler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			      	<span class="navbar-toggler-icon"></span>
			    	</button>
				    <div class="collapse navbar-collapse" id="navbarNav">
				      	<ul class="navbar-nav ml-auto">
				        	<li class="nav-item">
				          		<a class="nav-link js-scroll-trigger" aria-current="page" href="index-pegawai.php">Beranda</a>
				        	</li>
				        	<li class="nav-item">
				          		<a class="nav-link active js-scroll-trigger" href="absensi.php">Absensi</a>
				        	</li>
				        	<li class="nav-item">
				          		<a class="nav-link js-scroll-trigger" href="logout.php">Logout</a>
				        	</li>
				      	</ul>
				    </div>
			  	</div>
			</nav>
			<!-- <div class="navbar">
				<ul>
					<li><a href="index.php">Beranda</a></li>
					<li><a href="kalkulator.php">Kalkulator</a></li>
					<li><a href="laporan.php">Laporan</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div> -->
		</div>
		<div class="content">
			
				<!-- <div class="petunjuk">
					<br>
					<h3>Berikut adalah panduan pemakaian Kalkulator Data Sounding</h3>
					<ol>
						<li>Masukan data sesuai tulisan yang tertera dikolom.</li>
						<li>Kalkulator ini bisa digunakan untuk menjumlahkan bilangan bulat maupun bilangan berkoma.</li>
						<li>Gunakan tanda titik "." untuk memasukan bilangan berkoma.</li>
						<li>Angka yang telah dijumlahkan bisa anda lihat di menu <a href="laporan.php">Laporan.</a></li>
					</ol>
				</div> -->
				<div class="absen">
					<h2 class="text-center">Logbook Absen</h2>
					<hr>
					<form action="" method="post" enctype="multipart/form-data">
						<!-- <input type="hidden" name="username">
						<input type="hidden" name="npm">
						<input type="hidden" name="domisili"> -->
					   	<div class="form-group">
					        <label for="file">File</label>

					        <div class="input-group">
					            <div class="input-group-prepend">
					            	<div class="input-group-text"><i class="fas fa-file"></i></div>
					            </div>
					            <input type="file" name="file" id="file" class="form-control" placeholder="Masukkan File Anda">
					        </div>
					    </div>

					    <div class="form-group">
					        <label for="tanggal">Tanggal</label>
					         	<div class="input-group">
					            	<div class="input-group-prepend">
					              		<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
					            	</div>
					          		<input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Masukkan Tanggal Anda">
					          	</div>
					    </div>
					    <br>
					    <button type="submit" name="serahkan" class="btn btn-primary">SERAHKAN</button>
					    <button type="reset" class="btn btn-danger">RESET</button>
					</form>
				</div>
				<br><br>	
		</div>
		<div class="footer">
			<p class="copy">Copyright 2021. Faiz Islami.</p>
		</div>
	</div>
	<!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>