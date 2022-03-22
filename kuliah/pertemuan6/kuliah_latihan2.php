<?php 
// Array Associative
// Array yang indexnya string

$mahasiswa = [

        [
        "nama" => "Ranca Gigih Pramuditha", 
        "npm" => "213040072", 
        "email" => "ranca632@gmail.com", 
        "jurusan" => "Teknik Informatika"
        ],
        [
        "nama" => "Rizki Ajha Gitu", 
        "npm" => "213040086", 
        "email" => "rizki86@gmail.com", 
        "jurusan" => "Teknik Mesin"
        ],
        [
        "nama" => "Wildan", 
        "npm" => "213040047", 
        "email" => "wildan47@gmail.com", 
        "jurusan" => "Teknik Industri"
        ]
          
     ];
    //  var_dump($mahasiswa[1]["nilai_tugas"][1]);
?>

<?php foreach($mahasiswa as $mhs) { ?>
    
    <ul>
     <li>Nama: <?php echo $mhs["nama"]; ?></li>
     <li>NPM: <?php echo $mhs["npm"]; ?></li>
     <li>Email: <?php echo $mhs["email"]; ?></li>
     <li>Jurusan: <?php echo $mhs ["jurusan"]; ?></li>
    </ul>   
                
    <?php } ?>

    <hr>

    <?php foreach($mahasiswa as $mhs) { ?>
    <ul>
        <?php foreach($mhs as $key => $value) { ?>
            <li><?php echo $key; ?>: <?php echo $value; ?></li>
        <?php } ?>
    </ul>

    
    <?php } ?>

















