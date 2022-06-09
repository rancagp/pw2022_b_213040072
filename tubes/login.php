<?php
// cek udah login apa belum
session_start();

// menghubungkan php dengan koneksi database
require 'functions.php';

// cek cookie
if(isset($_COOKIE['id'])&&isset($_COOKIE['key'])){
  $id=$_COOKIE['id'];
  $key=$_COOKIE['key'];

  // ambil username berdasarkan id
  $result= mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
  $row=mysqli_fetch_assoc($result);

  // cek cookie dan username
  if($key===hash('sha256', $row['username'])){
	$_SESSION['level']=$row['level'];
	$_SESSION['username']=$row['username'];

  }
}


if(isset($_COOKIE['level'])){
  if($_COOKIE['level']=='true'){
    $_SESSION['level']=$row['level'];
		$_SESSION['username']=$row['username'];
  }
}

// cek apakah sudah login
if(isset($_SESSION["level"])){

if($_SESSION['level']=="admin"){
	header("location:admin/index.php");
exit;
}else if($_SESSION['level']=="user"){
	header("location:index.php");
exit;
}


}






// cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["login"])) {

$username=$_POST["username"];
$password=$_POST["password"];


// Cek user name
$result=mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

if(mysqli_num_rows($result)){

    // Cek password
$row=mysqli_fetch_assoc($result);


	// cek jika user login sebagai admin
	if($row['level']=="admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";


		// alihkan ke halaman dashboard admin
		header("location:admin/index.php");

	// cek jika user login sebagai pegawai
	}else if($row['level']=="user"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "user";

		// alihkan ke halaman dashboard pegawai
		header("location:index.php");

	}else{
	$error=true;
	}	

// cek remember me
if(isset($_POST['remember'])){
  // buat cookie
  setcookie('id', $row['id'], time() + 60);
  setcookie('key', hash('sha256', $row['username']), time() + 60);

		// cek jika user login sebagai admin
	if($row['level']=="admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		
		// alihkan ke halaman dashboard admin
		header("location:admin/index.php");

	// cek jika user login sebagai pegawai
	}else if($row['level']=="user"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "user";

		// alihkan ke halaman dashboard pegawai
		header("location:index.php");

	}else{
	$error=true;
	}	
}


}

$error=true;

}



?>

<!DOCTYPE html>
<html>

<head>
	<!--icon  -->
	<link rel="icon" href="icon/icon.png">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Font-Awessome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">

	<title>AllAboutMusic</title>

	<!-- link my css -->
	<link rel="stylesheet" href="css/login.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>

</head>


<body>

	<?php if (isset($error)){
echo"";

					}else{
						echo"	<div id='preloader'></div>";
					} ?>

	<div class="container-fluid">

		<div class="logo">
			<h1>AllAboutMusic</h1>
			<h6 class="subtitle">tempat jual alat musik</h6>
		</div>

		<div class="content">

			<form action="" method="post" class="px-4 py-3">
				<div class="mb-3">
					<?php if (isset($error)) : ?>
					<p>username / password salah!</p>
					<?php endif; ?>

					<label for="exampleDropdownFormEmail1" class="form-label">Username</label>
					<input type="text" name="username" class="form-control" id="exampleDropdownFormEm"
						placeholder="Masukan Username" required autofocus>
				</div>
				<div class="mb-3">
					<label for="exampleDropdownFormPassword1" class="form-label">Password</label>
					<input type="password" name="password" class="form-control" id="exampleDropdownFormPassword1"
						placeholder="Masukan Password" required autofocus>
				</div>
				<div class="mb-3">
					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="dropdownCheck" name="remember">
						<label class="form-check-label" for="dropdownCheck">
							Remember me
						</label>
					</div>
				</div>
				<button type="submit" class="btn btn-dark" name="login">Sign in</button>
			</form>
			<div class="ig" style="text-align:right;">
			</div>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="signup.php">New around here? Sign up</a>
		</div>
	</div>

	<script type="text/javascript">
	$(window).load(function() {
		$("#preloader").delay(300).fadeOut("slow");
	})
	</script>


	<!-- my javascript -->
	<script src="js/script.js"></script>


	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
	</script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>

<!-- selesai -->