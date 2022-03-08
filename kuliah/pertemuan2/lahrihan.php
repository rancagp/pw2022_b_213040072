<?php
//ini komentar
/* 
ini komentar
juga
*/

// Pertemuan ke 2 - PHP Dasar
// Sintaks PHP

// Standar Output
// eco, print
// print_r
// var_dump

// echo "Ranca Gigih Pramuditha";
// echo 123;
// echo true;
// echo false;
// echo "Jum'at";

// Penulisan Shintaks
// 1. PHP di dalam HTML 
// 2. HTML di dalam PHP
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar PHP</title>
</head>

<body>
    <!-- PHP Di Dalam HTML  lebih bagus ini-->
    <h1>Hello, Selamat Datang <?php echo "Ranca Gigih Pramudhita"; ?></h1>
    <p><?php echo "ini adalah paragraf"; ?></p>

    <!-- HTML Di Dalam PHP -->
    <?php echo "<h1>Hello, Selamat Datang Ranca</h1>"; ?>
</body>

</html>


<?php
// Variabel dan Tipe Data
// Variabel

$nama = "Ranca";

?>

<!-- PHP Di Dalam HTML  lebih bagus ini-->
<h1>Hello, Selamat Datang <?php echo $nama; ?></h1>
<p><?php echo "ini adalah paragraf"; ?></p>


<?php
// Oprator
// - Aritmatika
// +    -   *   /   %
$x = 10;
$y = 20;
echo $x * $y;

// Penggabung string / concatenation / concat / jadi terhubung
// .
$nama_depan = "Muhamad";
$nama_belakang = "Jamaludin";
echo $nama_depan . " " . $nama_belakang;
// " " untunk sepasi . untuk menggabungakn nama

// Assignment Oprator
// =, +=, *=, /=, %=, .=
$x = 1;
$x -= 5;
echo $x;

// gabungan nama juga
$nama = "Muhamad";
$nama .= " ";
$nama .= "Jamaludin";
echo $nama;

// Oprator Perbandingan
// <, >, <=, >=, ==, !=
// cara buat != -> "! ="
// var_dump. buat mengecek kebenaran true or false

// ini true
var_dump(1 < 5);
// ini false
var_dump(1 > 5);

// ini true
var_dump(1 == "1");

// Oprator Identitas
// ===, !==

// ini false
var_dump(1 === "1");

// ini true
var_dump(1 !== "1");



// Oprator Logika
// &&, ||, !

// ini true
$x = 5;
var_dump($x < 20 && $x % 2 == 1);


// ini true
$x = 10;
var_dump($x < 20 && $x % 2 == 0);

// ini false
$x = 30;
var_dump($x < 20 && $x % 2 == 0);

$x = 30;
var_dump($x < 20 || $x % 2 == 0);

?>