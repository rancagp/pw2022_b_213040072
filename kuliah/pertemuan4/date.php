<?php
  
echo date("l, d M Y j");
// Time
// UNIX Timestamp / EPOCH time
// detik yang sudah berlalu sejak 1 januari 1970 ini tuh awal mula komputer itu kapan
echo "<br>";
echo Time();

// untuk mengetahui 100 hari kedepan atau kebelakang
echo date("l", time() + 60 * 60 * 24 * 100);
echo date("l", time() - 60 * 60 * 24 * 100);


// mktime
// untuk membuat detik sendiri
// mktime(0,0,0,0,0,0)
// utrutan: jam, menit, detik, bulan, tanggal, tahun

echo date("l", mktime(0, 0, 0, 12, 20, 2002));

// strtotime
echo date(
    "l",
    strtotime("20 december 2002")
);
echo date("l", strtotime("20 dec 2002"));
