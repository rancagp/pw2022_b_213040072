<?php
function salam($waktu = "Datang", $nama = "Ranca") {
    return "selamat $waktu, $nama!";
};


?>

<!DOCTYPE html>
<title>Function PHP</title>
</head>

<body>
    <h1><?= salam("Pagi"); ?></h1>
</body>

</html>