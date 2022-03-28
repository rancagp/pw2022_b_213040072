<?php 

// SUPERGLOBALS
// Variable milik PHP yang bisa kita gunakan
// bentuknya Array Associative
// $_GET
// $_POST
// $_SERVER

// $_GET["nama"] = "RancaGP";
// $_GET["email"] = "ranca632@gmail.com";
// var_dump($_GET);

// var_dump($_GET);
// var_dump($_POST);

if(isset($_GET["nama"])) {
    $nama = $_GET["nama"];
} else {
    $nama = 'Tidak Diketahui!';
};

?>

<h1>Halo, <?= $nama; ?> </h1>
<ul>
    <li>
        <a href="kuliah_latihan1.php?nama=ranca">ranca</a>
    </li>
    <li>
        <a href="?nama=rizki">rizki</a>
    </li>
</ul>



