<?php
// memeriksa sudah login atau belum
session_start();

if(!isset($_SESSION["level"])){
header("location:../logout.php");
exit;
}

if($_SESSION["level"]!='admin'){
	header("location:../index.php");
exit;
}

require '../functions.php';

// Cek apakah tombol tambah di klik
if (isset($_POST["ubah"])) {
    if (ubah($_POST) > 0) {
        echo "<script>
            alert('data berhasil diubag');
            document.location.href='dashboard.php';
            </script>";
    }
}





// ambil data di URL
$id= $_GET["id"];

// query data mahasiswa berdasarkan id
$produk= query("SELECT * FROM produk WHERE id=$id")[0]; // supaya ga manggil 0 nya lagi



// jenis produk
$jenisProduk=query("SELECT * FROM jenis_produk");


?>
<!doctype html>
<html lang="en">

<head>

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Font-Awessome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

	<!-- AOS -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


	<!-- icon -->
	<link rel="icon" href="../icon/icon.png">
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:wght@500&family=Montserrat:wght@300;400;500;600&family=Open+Sans:wght@600&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Mono&display=swap"
		rel="stylesheet">
	<title>AllAboutMusic</title>

	<!-- link my css -->
	<link rel="stylesheet" href="../css/main.css">

</head>

<body class="d-flex flex-column min-vh-100">

	<!-- awal navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
		<div class="container">
			<a class="navbar-brand" href="index.php">AllAboutMusic</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
				aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarScroll">
				<ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="index.php">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							Shop
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">

							<?php foreach($jenisProduk as $jenis): ?>
							<li><a name="cari" class="dropdown-item"
									href="?cari=<?= $jenis['jenis_produk']; ?>#container"><?= $jenis['jenis_produk']; ?></a></li>
							<?php endforeach; ?>

							<li><a class="dropdown-item" href="index.php#container">All Items</a></li>

						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link d-lg-none " href="../logout.php" id="logout">Logout</a>
					</li>
				</ul>
				<form class="d-flex" action="" method="post">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" autocomplete="off"
						name="keyword" id="keyword">
					<a class="btn btn-outline-dark" href="dashboard.php">Search</a>
				</form>


				<a class="nav-link ms-5 d-lg-block d-none" href="../logout.php" id="logout">Logout</a>

			</div>
		</div>
	</nav>
	<!-- akhir navbar -->



	<div class="container" style="margin-top:100px;margin-bottom:50px;">
		<h1>UBAH DATA</h1>
		<div class="row mt-3">
			<div class="col-8">
				<form action="" method="post" enctype="multipart/form-data" id="us">
					<div class="mb-3">
						<input name="id" type="text" hidden class="form-control" id="id" name="kode_produk" required
							style="width: 150px;" value="<?= $produk['id'];?>">
						<input type="hidden" name="gambarLama" value="<?= $produk["gambar"];?>">
						<label for="npm" class="form-label">Kode Produk</label>
						<input type="text" class="form-control" id="kode_produk" name="kode_produk" required style="width: 150px;"
							readonly value="<?= $produk['kode_produk'];?>">
					</div>
					<div class="mb-3">
						<label for="nama" class="form-label">Nama Produk</label>
						<input type="text" class="form-control" id="nama" name="nama_produk" required
							value="<?= $produk['nama_produk'];?>">
					</div>
					<div class="mb-3">
						<label for="jenis_produk">Jenis :</label>
						<select id="jenis_produk" class="form-control" name="jenis_produk" required>
							<option value="<?= $produk['jenis_produk'];?>"><?= $produk['jenis_produk'];?></option>
							<?php foreach($jenisProduk as $jenis): ?>
							<option value="<?= $jenis['jenis_produk'];?>"><?= $jenis['jenis_produk']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<label for="harga" class="col-sm-2 col-form-label">Harga</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="harga" name="harga" maxlength="15" required
								value="Rp. <?= $produk['harga'];?>">
						</div>
					</div>

					<div class="mb-3">
						<label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="keterangan" name="keterangan" maxlength="200" required
								value="<?= $produk['keterangan'];?>">
						</div>
					</div>

					<div class="mb-3">
						<label for="gambar" class="form-label">Pilih Gambar:</label>
						<div class="col-sm-10">
							<img src="../img/<?= $produk["gambar"]?> " width="40px">
							<input class="form-control form-control-sm mt-2" id="gambar" type="file" name="gambar"
								value="<?= $produk["gambar"]?>">
						</div>
					</div>


					<button type="submit" name="ubah" class="btn btn-dark">Ubah</button>
					<button type="button" class="btn btn-danger" value="back" onclick="history.back();">Kemabli</button>
				</form>
			</div>
		</div>

	</div>



	<!-- awal footer -->
	<div class="border mb-2 mt-auto" style="border-top:black 1px solid;width:90%;margin:auto;"></div>

	<div class="footer container-fluid" id="footer">
		<p><i class="far fa-copyright"></i> 2022 <a href="https://www.instagram.com/rancaagp/" target="_blank"
				style="text-decoration:none;color:black;"> Ranca Gigih Pramudhita</a>.
		</p>
	</div>
	<!-- akhir footer -->

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
	</script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>