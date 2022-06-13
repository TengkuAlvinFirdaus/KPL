<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

	require 'functions.php';

	// is role
	isRole('admin');

	$q = $_GET['q'] ?? '';


	$q = $q ? " WHERE username LIKE '%{$q}%' OR npm LIKE '%{$q}%' OR domisili LIKE '%{$q}%' OR file LIKE '%{$q}%' OR tanggal LIKE '%{$q}%'" : '';

	$data = query("SELECT * FROM t_absen JOIN user ON user.id = t_absen.user_id" . $q ?? '');

	// ketika tombol cari ditekan
	if ( isset($_POST["cari"]) ) {
		$data = cari($_POST["keyword"]);
	}


	// // Koneksi kedatabase
	// $conn = mysqli_connect("localhost", "root", "", "kalkulator_data_sounding");

	// ambildata dari t_data
	// $result = mysqli_query($conn, "SELECT * FROM t_data");

	// $data = mysqli_fetch_assoc($result);
	// var_dump($data);
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Tabel Hasil Sounding</title>	
</head>
<body id="page-top">
	<div class="container">
		<div class="header">
			<br>
			<img src="kemenag.png">
			<h1>Data Karyawan</h1>
			<br>

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
		  	<div class="container-fluid">
		    	<a class="navbar-brand" href="#page-top">Kemenag Kabupaten Kampar</a>
		    	<button class="navbar-toggler navbar-toggeler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		      	<span class="navbar-toggler-icon"></span>
		    	</button>
			    <div class="collapse navbar-collapse" id="navbarNav">
			      	<ul class="navbar-nav ml-auto">
			        	<li class="nav-item">
			          		<a class="nav-link js-scroll-trigger" href="index.php">Beranda</a>
			        	</li>
			        	<li class="nav-item js-scroll-trigger">
			          		<a class="nav-link active" href="absensi.php">Absensi</a>
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
			<div class="table">
				<br>
				<a class="cari" href="kalkulator.php">Tambah Data</a>
				<br>

				<form class="cari">				
					<input type="search" name="q" size="40" autofocus value="<?= $_GET['q'] ?? ''; ?>" placeholder="Masukkan keyword pencarian.." autocomplete="off">
					<button type="submit" name="cari">Cari!</button>
				</form> 
				<br>

				<table border="1" cellspacing="0" cellpadding="5">
					<tr>
						<th>no</th>
						<th>Nama</th>
						<th>NPM</th>
						<th>Domisili Kerja</th>
						<th>File</th>
						<th>Tanggal</th>
					</tr>
					<?php $i = 1; ?>
					<?php foreach ( $data as $row ) : ?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $row["username"]; ?></td>
						<td><?= $row["npm"]; ?></td>
						<td><?= $row["domisili"]; ?></td>
						<td>
							<a href="upload/<?= $row["file"]; ?>">
							<?= $row["file"]; ?>
							</a>
						</td>
						<td><?= $row["tanggal"]; ?></td>
					</tr>
					<?php $i++; ?>
					<?php endforeach; ?>
				</table>
				<br><br><br>
			</div>
		</div>
		<div class="footer">
			<p class="copy">Copyright 2021. Faiz Islami.</p>
		</div>
	</div>
<!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
</body>
</html>