<?php
session_start();

if ( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}

require 'functions.php';

if ( isset($_POST["login"]) ) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	// cek username
	if ( mysqli_num_rows($result) === 1 ) {
		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;

			$_SESSION['user_id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['level'] = $row['level'];

			// die($row['level']);
		 
			// cek jika user login sebagai admin
			if($row['level'] == "admin"){
				// alihkan ke halaman dashboard admin
				header("Location:index.php");
		 
			}

			// cek jika user login sebagai pegawai
			if($row['level'] == "pegawai"){
				// alihkan ke halaman dashboard pegawai
				header("Location:index-pegawai.php");
		 
			}
		}
	}

	$error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="loter.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">

    <title>Halaman Login</title>
  </head>
<body>

<div class="container">
	
    <h4 class="text-center">FORM LOGIN</h4>
   	<hr>
   	<?php if (isset($error) ) : ?>
		<p style="color: red; font-style: italic;">username / password salah</p>
	<?php endif; ?>
	<form action="" method="post">
	   	<div class="form-group">
	        <label for="username">Username</label>

	        <div class="input-group">
	            <div class="input-group-prepend">
	            	<div class="input-group-text"><i class="fas fa-user"></i></div>
	            </div>
	            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username Anda">
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="password">Password</label>
	         	<div class="input-group">
	            	<div class="input-group-prepend">
	              		<div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
	            	</div>
	          		<input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Anda">
	          	</div>
	    </div>
	    <br>
	    <button type="submit" name="login" class="btn btn-primary">LOGIN</button>
	    <button type="reset" class="btn btn-danger">RESET</button>
	    <p>Belum punya akun? Ayo <a href="registrasi.php">Daftar!</a></p>
	</form>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>