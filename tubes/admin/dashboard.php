<?php 
// memeriksa sudah login atau belum
session_start();

$level=$_SESSION['level'];

if(!isset($_SESSION["level"])){
header("location:../logout.php");
exit;
}

if($_SESSION["level"]!='admin'){
	header("location:../index.php");
exit;
}



// koneksi database
require '../functions.php';


// pagination
// konfigurasi
$jumlahDataPerHalaman=5;
$jumlahData= count(query("SELECT * FROM produk"));
$jumlahHalaman= ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif=(isset($_GET["page"])) ? $_GET["page"] : 1;
$awalData=($jumlahDataPerHalaman * $halamanAktif)-$jumlahDataPerHalaman;

$produk = query("SELECT * FROM produk ORDER BY id DESC LIMIT $awalData,$jumlahDataPerHalaman");


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
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" autofocus
						autocomplete="off" name="keyword" id="keyword">
					<a class="btn btn-outline-dark" href="#">Search</a>
				</form>


				<a class="nav-link ms-5 d-lg-block d-none" href="../logout.php" id="logout">Logout</a>

			</div>
		</div>
	</nav>
	<!-- akhir navbar -->


	<div class="container-fluid" style="margin-top:100px;">

		<nav class="navbar navbar-light">
			<a href="../print.php" type="button" target="_blank" class="btn btn-dark ms-auto me-2">Print</a>
			<a href="tambah.php" class="btn btn-dark" type="button">Tambah</a>
		</nav>
	</div>

	<div id="container">
		<table class="table" cellpadding="10" cellspacing="0">

			<thead class="table-dark">
				<tr style="text-align:center;">
					<th>No</th>
					<th>Gambar</th>
					<th>Kode Produk</th>
					<th>Nama Produk</th>
					<th>Jenis Produk</th>
					<th>Harga</th>
					<th>Aksi</th>

				</tr>
			</thead>


			<!-- tidak ada -->
			<?php if(empty($produk)):?>
			<tbody>
				<tr>
					<td colspan="7">
						<h1
							style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;height:200px;display:;">
							Tidak Ada
							Data</h1>
					</td>
			</tbody>
			<?php endif; ?>


			<!-- isi tabel -->

			<?php $i=1; ?>
			<?php foreach ($produk as $row ) :?>
			<tbody>
				<tr style="text-align:center;">
					<td><?= $i; ?></td>
					<td><img src=" ../img/<?= $row["gambar"] ?>" style="width:100px; height:100px; object-fit:cover">
					</td>
					<td><?= $row["kode_produk"]; ?></td>
					<td><?= $row["nama_produk"]; ?></td>
					<td><?= $row["jenis_produk"]; ?></td>
					<td><?= rupiah($row["harga"]); ?></td>
					<td>


						<a href="ubah.php?id=<?= $row["id"] ?>" class="btn badge bg-warning">ubah</a>

						<a href="hapus.php?id=<?= $row["id"] ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')"
							class="btn badge bg-danger mt-2">hapus</a>



						<a href="detail.php?id=<?= $row["id"]?>" class="btn badge bg-info mt-2">detail</a>
					</td>

				</tr>

			</tbody>
			<?php $i++; ?>
			<?php endforeach; ?>

		</table>
	</div>

	<!-- Pagination -->
	<div id="page">
		<?php if($halamanAktif>1): ?>
		<a style="margin-right:5px;" href="?page=<?= $halamanAktif - 1; ?>">&lt</a>
		<?php endif; ?>

		<?php for($i=1;$i<=$jumlahHalaman;$i++) : ?>

		<?php if($i == $halamanAktif): ?>
		<a href="?page=<?= $i; ?>" style="font-weight:bold;color:red;margin:0 5px;"><?= $i; ?></a>

		<?php else: ?>
		<a style="margin:0 5px;" href="?page=<?= $i; ?>"><?= $i; ?></a>
		<?php endif; ?>

		<?php endfor; ?>

		<?php if($halamanAktif<$jumlahHalaman): ?>
		<a href="?page=<?= $halamanAktif + 1; ?>">&gt</a>
		<?php endif; ?>
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




	<script>
	// ambil elemen2 yang dibutuhkan
	var keyword = document.getElementById('keyword');
	var container = document.getElementById('container');
	var page = document.getElementById('page');



	// tambahkan event ketika keyboard ditulis
	keyword.addEventListener('keyup', function() {

		var page = document.getElementById('page');
		page.setAttribute("style", "display:none;");

		// buat object ajax
		var xhr = new XMLHttpRequest();

		// cek kesiapan ajax
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				container.innerHTML = xhr.responseText;
			}
		}

		// eksekusi ajax
		xhr.open('GET', 'ajax/produk.php?keyword=' + keyword.value, true);
		xhr.send();

		// memunculkan page atau refresh halaman
		if (keyword.value === '') {
			location.reload();
		}


	});
	</script>

	<script src="../js/script.js"></script>



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