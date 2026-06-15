<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_nama   = "toko";

<<<<<<< HEAD
$conn =  mysqli_connect($db_host, $db_user, $db_pass, $db_nama);
=======
$koneksi =  mysqli_connect($db_host, $db_user, $db_pass, $db_nama);
>>>>>>> master

if(mysqli_connect_error()){
     echo "gagal melakukan koneksi ke database :" . mysqli_connect_error();
   }
 ?>