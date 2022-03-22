<?php
 // Array Numerik
 // Array yang index-nya ber-asosiasi / berpasangan dengan angka

 $mahasiswa = [
["Ranca Gigih Pramuditha", "213040072", "ranca632@gmail.com", "Teknik Informatika"],
["Rizki Ajha Gitu", "213040086", "rizki86@gmail.com", "Teknik Mesin"]
 ];


// var_dump ($mahasiswa[1][3]);


?>

<?php foreach($mahasiswa as $mhs) { ?>
    
<ul>
 <li>Nama: <?php echo $mhs[0]; ?></li>
 <li>NPM: <?php echo $mhs[1]; ?></li>
 <li>email: <?php echo $mhs[2]; ?></li>
 <li>Jurusan: <?php echo $mhs [3]; ?></li>
</ul>   
            
<?php } ?>
