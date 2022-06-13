<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

if (isset($_POST['hitung'])) {
		// ambil data dari tiap elemen dalam kalkulator
		$data_tanki = htmlspecialchars($_POST["data_tanki"]);
		$meteran_sounding = htmlspecialchars($_POST["meteran_sounding"]);
		$suhu = htmlspecialchars($_POST["suhu"]);
		$volume = htmlspecialchars($_POST["volume"]);
		$faktor_koreksi = htmlspecialchars($_POST["faktor_koreksi"]);
		$densitity_produk = htmlspecialchars($_POST["densitity_produk"]);
	}

require 'functions.php';

// ambil data di url
$id = $_GET["id"];

// Query data berdasarkan id
$dta = query("SELECT * FROM t_data WHERE id = $id")[0];


	if (isset($_POST['hitung'])) {
		
		// cek keberhasilan
		if ( ubah($_POST) > 0) {
			echo "
				<script>
					alert('data berhasil diubah!');
					document.location.href = 'laporan.php';
				</script>
			";
		} else {
			echo "
				<script>
					alert('data gagal diubah!');
					document.location.href = 'laporan.php';
				</script>
			";
		}

		$operasi = $_POST['operasi'];
		switch ($operasi) {
			case 'kalkulator':
				$hasil_v_X_f = $volume*$faktor_koreksi;
				$massa_tanki = $volume*$faktor_koreksi*$densitity_produk;
				break;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data Sounding</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
	<div class="container">
		<div class="header">
			<h1>Ubah Data Sounding</h1>
			<div class="navbar">
				<ul>
					<li><a href="index.php">Beranda</a></li>
					<li><a href="kalkulator.php">Kalkulator</a></li>
					<li><a href="laporan.php">Laporan</a></li>
				</ul>
			</div>
		</div>
		<div class="kalkulator">
			<h2 class="judul">Kalkulator Data Sounding</h2>
			<form method="post" action="">
				<input type="hidden" name="id" value="<?= $dta["id"]; ?>">
				<input type="text" name="data_tanki" autocomplete="off"
				placeholder="Masukan Data Tanki" required value="<?= $dta["data_tanki"]; ?>">
				<input type="text" name="meteran_sounding" autocomplete="off"
				placeholder="Masukan Meteran Sounding" required value="<?= $dta["meteran_sounding"]; ?>">
				<input type="text" name="suhu" autocomplete="off"
				placeholder="Masukan Suhu" required value="<?= $dta["suhu"]; ?>">
				<input type="text" name="volume" class="bil" autocomplete="off"
				placeholder="Masukan Volume Tanki" required value="<?= $dta["volume"]; ?>">
				<select class="opt" name="operasi">
					<option value="kalkulator">*</option>
				</select>
				<input type="text" name="faktor_koreksi" class="bil" autocomplete="off"
				placeholder="Masukan Faktor Koreksi" required value="<?= $dta["faktor_koreksi"]; ?>">
				<select class="opt" name="operasi">
					<option value="kalkulator">*</option>
				</select>
				<input type="text" name="densitity_produk" class="bil" autocomplete="off"
				placeholder="Masukan Densitity Produk" required value="<?= $dta["densitity_produk"]; ?>">
				<button type="submit" name="hitung" value="" class="tombol">Ubah Data</button>

			</form>
			<?php if (isset($_POST['hitung'])){ ?>
				<input type="text" value="<?php echo $hasil_v_X_f; ?>" class="bil">
			<?php }else{ ?>
				<input type="text" placeholder="Hasil Volume X Faktor Koreksi" class="bil">
			<?php } ?>
			<?php if (isset($_POST['hitung'])){ ?>
				<input type="text" value="<?php echo $massa_tanki; ?>" class="bil">
			<?php }else{ ?>
				<input type="text" placeholder="Hasil Massa Tanki" class="bil">
			<?php } ?>
		</div>
	</div>

</body>
</html>