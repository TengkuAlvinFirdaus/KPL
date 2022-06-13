<?php

// Koneksi kedatabase
$conn = mysqli_connect("localhost", "root", "", "absensi_kemenag_kampar");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		# code...
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data) {
	global $conn;
	// ambil data dari tiap elemen dalam form
	$file = $_FILES['file']['name'];
	$tanggal = $data["tanggal"];

	// query insert data
		$query = "INSERT INTO t_absen(user_id, file, tanggal)
					VALUES
				('".$_SESSION['user_id']."',
				'$file',
				'$tanggal')
				";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
}

function hapus($id) {
	global $conn;
	$query = mysqli_query($conn, "SELECT file FROM t_absen WHERE id = $id");

	$data = mysqli_fetch_assoc($query);

	unlink('./upload/'.$data['file']);

	mysqli_query($conn, "DELETE FROM t_absen WHERE id = $id");
	return mysqli_affected_rows($conn);
}


// function ubah($data) {
// 	global $conn;
// 	// ambil data dari tiap elemen dalam form
// 	$id = $data["id"];
// 	$data_tanki = htmlspecialchars($data["data_tanki"]);
// 	$meteran_sounding = htmlspecialchars($data["meteran_sounding"]);
// 	$suhu = htmlspecialchars($data["suhu"]);
// 	$volume = htmlspecialchars($data["volume"]);
// 	$faktor_koreksi = htmlspecialchars($data["faktor_koreksi"]);
// 	$densitity_produk = htmlspecialchars($data["densitity_produk"]);
// 	$volume_x_FKoreksi = htmlspecialchars($data["faktor_koreksi"]) * htmlspecialchars($data["densitity_produk"]);
// 	$massa_tanki = $volume_x_FKoreksi * htmlspecialchars($data["densitity_produk"]);

// 	// query insert data
// 		$query = "UPDATE t_data SET
// 					data_tanki = '$data_tanki',
// 					meteran_sounding = '$meteran_sounding',
// 					suhu = '$suhu',
// 					volume = '$volume',
// 					faktor_koreksi = '$faktor_koreksi',
// 					densitity_produk = '$densitity_produk',
// 					volume_x_FKoreksi = '$volume_x_FKoreksi',
// 					massa_tanki = '$massa_tanki'
// 				WHERE id = $id
// 				";
// 		mysqli_query($conn, $query);

// 		return mysqli_affected_rows($conn);
// }


function registrasi($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$npm = strtolower(stripslashes($data["npm"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$domisili = $data["domisili"];
	$level = $data["level"];


	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if (mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar!')
			  </script>";
		return false;
	}

	// cek konfirmasi password
	// if ( $password !== $password2 ) {
	// 	echo "<script>
	// 			alert('konfirmasi password tidak sesuai!');
	// 		</script>";
	// 	return false;
	// }

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan user ke database
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$npm', '$password', '$domisili', '$level')");

	return mysqli_affected_rows($conn);

}

function isRole($role = 'pegawai')
{
	if ($_SESSION['level'] !== $role) {
		require('logout.php');

		return;
	}
}