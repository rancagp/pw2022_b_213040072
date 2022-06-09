<?php

require_once __DIR__ . '/vendor/autoload.php';

// koneksi database
require 'functions.php';
$produk=query("SELECT * FROM produk");

ob_clean();


	$mpdf = new \Mpdf\Mpdf();


$html='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<!-- icon -->
	<link rel="icon" href="icon/icon.png">

		<link rel="icon" href="icon/icon.png">
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:wght@500&family=Montserrat:wght@300;400;500;600&family=Open+Sans:wght@600&display=swap"
		rel="stylesheet">
    <title>AllAboutMusic.</title>

		<style>
		tr:nth-child(even){
			background-color:#ddd;
		}
		</style>

</head>
<body>
   		<div class="logo">
			<h1 style="text-align: center;font-family: "Libre Bodoni", sans-serif;color: #151e3d;">AllAboutMusic</h1>

			<div class="container" style="font-family:sans-serif;">

<table  border="1" cellpadding="10" cellspacing="0">
				<thead>
					<tr style="background-color:black;">
						<th style="color:white;">No</th>
						<th style="color:white;">Gambar</th>
						<th style="color:white;">Kode Produk</th>
						<th style="color:white;">Nama Produk</th>
						<th style="color:white;">Jenis Produk</th>
						<th style="color:white;">Harga</th>
						<th style="color:white;">Keterangan</th>
					</tr>
				</thead>
			';

				$i=1;
foreach($produk as $row){
	$html.='<tbody>
	<tr>
	<td>'.$i++.'</td>
	<td><img src="img/'.$row["gambar"].'" style="width:100px; height:100px; object-fit:cover"/></td>
	<td>'.$row["kode_produk"].'</td>
	<td>'.$row["nama_produk"].'</td>
	<td>'.$row["jenis_produk"].'</td>
	<td>Rp.'.$row["harga"].'</td>
	<td>'.$row["keterangan"].'</td>
	</tr>

</tbody>

	';
}

 $html.= '
					</table>
					</div>
					</body>
					</html>';


$mpdf->WriteHTML($html);
$mpdf->Output('daftar-produk-goturthings.pdf', 'I');

?>