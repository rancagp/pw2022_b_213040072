<!-- ANALOGI TEMEN NUNJUKIN BAJU KELUARIN DULU BAJUNYA KEBASKOM BARU TUNJUKIN -->

<!-- RESULT ITU DI ANALOGIKAN LEMARI -->

<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "allaboutmusic");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}



function conn($query) {
    global $conn;
    
    $result = mysqli_query($conn, $query);
    
    return $result;
}



// TAMBAH
function tambah($data) {
    global $conn;
    $jenis_produk =($data["jenis_produk"]);
    $kode_produk= htmlspecialchars($data["kode_produk"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga = htmlspecialchars($data["harga"]);
    $keterangan = htmlspecialchars($data["keterangan"]);

    $kodeProduk= str_replace("'","",$kode_produk);
    $namaProduk= str_replace("'","",$nama_produk);
    $hargaBaru=preg_replace("/[^0-9]/", "", $harga);
    $keteranganBaru= str_replace("'","",$keterangan);

    $gambar=upload();

    if(!$gambar){
        return false;
    }

    // query insert data
    $query ="INSERT INTO `produk`(`jenis_produk`, `kode_produk`, `nama_produk`, `harga`, `keterangan`, `gambar`) VALUES ('$jenis_produk','$kodeProduk','$namaProduk','$hargaBaru','$keteranganBaru','$gambar');";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// Function Upload
function upload(){
    $namaFile= $_FILES['gambar']['name'];
    $ukuranFile=$_FILES['gambar']['size'];
    $error=$_FILES['gambar']['error'];
    $tmpName=$_FILES['gambar']['tmp_name'];

// cek apakah tidak ada gambar yang diupload
if($error===4){
    echo"<script>
    alert('pilih gambar terlebih dahulu!');    
    </script>";
    return false;
}

//  cek apakah yang diupload adalah gambar
$ekstensiGambarValid=['jpg', 'jpeg', 'png'];
$ekstensiGambar = explode('.', $namaFile);
$ekstensiGambar= strtolower(end($ekstensiGambar));
if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
        echo"<script>
alert('Yang anda upload bukan gambar!');    
    </script>";
    return false;
}

//  Cek jika ukuran nya terlalu besar
if($ukuranFile > 1000000){
          echo"<script>
alert('Ukuran gambar terlalu besar!');    
    </script>";
    return false;
}

// lolos pengecekan, gambar siap upload
// generate nama gambar baru
$namaFileBaru=uniqid();
$namaFileBaru.='.';
$namaFileBaru.=$ekstensiGambar;



move_uploaded_file($tmpName, '../img/'.$namaFileBaru); 
return $namaFileBaru;
}








// Function delete
function delete($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM produk WHERE `produk`.`id` = '$id'");
    return mysqli_affected_rows($conn);
}


// Ubah data
function ubah($data) {
    global $conn;
    $id=htmlspecialchars($data["id"]);
    $jenis_produk =($data["jenis_produk"]);
    $kode_produk= htmlspecialchars($data["kode_produk"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga = htmlspecialchars($data["harga"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $gambarLama=htmlspecialchars($data["gambarLama"]);


    $kodeProduk= str_replace("'","",$kode_produk);
    $namaProduk= str_replace("'","",$nama_produk);
    $hargaBaru=preg_replace("/[^0-9]/", "", $harga);
    $keteranganBaru= str_replace("'","",$keterangan);

    // cek apakah user pilih gambar baru atau tidak
if($_FILES['gambar']['error']===4){
    $gambar=$gambarLama;
}else{
    $gambar=upload();
}



    $query = "UPDATE `produk` SET `id`='$id',`jenis_produk`='$jenis_produk',`kode_produk`='$kodeProduk',`nama_produk`='$namaProduk',`harga`='$hargaBaru',`keterangan`='$keteranganBaru',`gambar`='$gambar' WHERE `id`='$id';
                ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);


}




//  Function cari
function cari($keyword){

$keyword=$_GET['cari'];

   $query = "SELECT * FROM produk
             WHERE jenis_produk = '$keyword';
            ";

              return query($query);

}




// Signup
function signup($data){
    global $conn;

    $username= strtolower(stripslashes($data["username"]));
    $password= mysqli_real_escape_string($conn, $data["password"]);
    $password2= mysqli_real_escape_string($conn,$data["password2"]);


// Cek username sudah ada atau belum
    $result=mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");

if(mysqli_fetch_assoc($result)){
echo"
<script>
alert('Username sudah terdaftar!')
document.location.href='signup.php'
</script>
";

return false;
}






    // cek konsfirmasi password
    if($password !== $password2){
        echo "
        <script>
        alert('konfirmasi password tidak sesuai!');
        document.location.href='signup.php'
        </script>
        ";
        
        return false;
    }


    // enkriosi password
$password=password_hash($password, PASSWORD_DEFAULT);   




    // tambahkan user baru ke database
mysqli_query($conn, "INSERT INTO `users`(`username`, `password`, `level`) VALUES ('$username','$password', 'user')");

return mysqli_affected_rows($conn);

}





// Change Password
// mencari username
function confrim($data){
    global $conn;

    $username= strtolower(stripslashes($data["username"]));


// Cek username sudah ada atau belum
    $result=mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");

$user='location:forgot.php?username='.$username.'';

if(mysqli_num_rows($result)==0){
echo"
<script>
alert('Username tidak ditemukan!')
document.location.href='forgot.php'
</script>
";
return false;
}else if(mysqli_num_rows($result)>0){  
echo'
<script>
alert("Username ditemukan!")
</script>
';

header("$user");

}



}




// Change
function changepw($data){
    global $conn, $username;

    $username= strtolower(stripslashes($data["username"]));
    $password= mysqli_real_escape_string($conn, $data["password"]);
    $password2= mysqli_real_escape_string($conn,$data["password2"]);


    $user="        <script>
        alert('konfirmasi password tidak sesuai!');
        document.location.href='forgot.php?username=".$username."'
        </script>";
    // cek konsfirmasi password
    if($password !== $password2){
        echo $user;
        
        return false;
    }


    // enkriosi password
$password=password_hash($password, PASSWORD_DEFAULT);   

$result=mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");
if(mysqli_num_rows($result)==0){
echo"
<script>
alert('Username tidak diketahui!')
document.location.href='forgot.php'
</script>
";
return false;
}else if(mysqli_num_rows($result)>0){

    // tambahkan user baru ke database
mysqli_query($conn, "UPDATE users SET password='$password' WHERE username='$username'");


return mysqli_affected_rows($conn);

}


}



//rupiah
function rupiah($harga){
	global $conn;

	$hasil_rupiah = "Rp " . number_format($harga,2,',','.');
	return $hasil_rupiah;
 




}

?>