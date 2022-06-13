<?php
require 'functions.php';

if ( isset($_POST["register"]) ) {
	
	if ( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
				document.location.href = 'login.php';
			  </script>";
	} else {
		echo mysqli_error($conn);
	}
	
}
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="loter.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">

    <title>Halaman Registrasi</title>
  </head>
<body>

<div class="container">
	
    <h4 class="text-center">FORM REGISTRASI</h4>
   	<hr>
	<form action="" method="post">
	   	<div class="form-group">
	        <label for="username">Username</label>

	        <div class="input-group">
	            <div class="input-group-prepend">
	            	<div class="input-group-text"><i class="fas fa-user"></i></div>
	            </div>
	            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username Anda">
	        </div>
	    </div>
	    <div class="form-group">
	        <label for="npm">NPM</label>
	        <div class="input-group">
	         	<div class="input-group-prepend">
	          		<div class="input-group-text"><i class="fas fa-user"></i></div>
	            </div>
	          	<input type="number" name="npm" id="npm" class="form-control" placeholder="Masukkan NPM Anda">
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
	    <div class="form-group">
	    	<label for="domisili">Domisili</label>
	        <select class="input-group" name="domisili" id="domisili">
						<optgroup label="Pilih Domisili">
							<option hidden>Pilih Domisili</option>
							<?php
								$city = [
									'XIII Koto Kampar',
									'Bangkinang',
									'Bangkinang Kota',
									'Gunung Sahilan',
									'Kampar',
									'Kampar Kiri Hilir',
									'Kampar Kiri Hulu',
									'Kampar Kiri Tengah',
									'Kampar Utara',
									'Kota kampar Hulu',
									'Kuok',
									'Perhentian Raja',
									'Rumbio Jaya',
									'Salo',
									'Siak Hulu',
									'Tambang',
									'Tapung hilir',
									'Tapung Hulu',
									'Tapung',
									'Kampar',
									'Kampar Kiri'
								];

								foreach ($city as $item) {
							?>
								<option><?= $item ?></option>
							<?php } ?>
						</optgroup>
					</select>
	    </div>
	    <br>
	    <div class="form-group">
	        <label for="level">Status</label>
	        <div class="input-group">
	         	<div class="input-group-prepend2">
	          	<div class="input-group-text"><i class="fas fa-id-card"></i></div>
	          </div>
	          <div class="blok">
	          	<input type="radio" name="level" id="level" value="pegawai">
	          	<label for="level">pegawai</label>
	          </div>
	        </div>
	    </div>
	    <br>
	    <button type="submit" name="register" class="btn btn-primary">REGISTER</button>
	    <button type="reset" class="btn btn-danger">RESET</button>
	    <p>Silahkan <a href="login.php">Login</a> jika sudah mendaftar</p>
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