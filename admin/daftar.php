<?php 
session_start();
if(!isset($_SESSION["login"])){
  header("location: login.php");
}
require 'functions.php';

if(isset($_POST["daftar"])  ) {
    if(daftar($_POST) > 0 ) {
        echo "<script>alert('data berhasil ditambahkan');</script>";
    }
    else{
        //aktifkan ini untuk debuging
        echo mysqli_error($koneksi);
        
        //aktifkan ini untuk user biasa
        //echo "<script>alert('jika anda sudah memasukan dengan benar dan popup ini selalu muncul, hubungi admin');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign UP</title>
</head>
<body>
<h1>halaman registrasi</h1>
<form action="" method="post">
    <label for="username">Username : </label>
    <input type="text" style="text-align: left;
  box-sizing: border-box;
  width: 100%;
  height: 20px;
  padding: 10px;
  font-size: 15px;
  margin-bottom: 20px;text-transform: lowercase;" name="username" id="username" autocomplete="off" autofocus value="" placeholder="Username">
    
    <label for="password">Password : </label>
    <input type="password" class="form_input" name="password" id="password" autocomplete="off" value="" placeholder="Password">

    <label for="password1">Konfirmasi Password</label>
    <input type="password" class="form_input" name="password1" id="password1" placeholder="Konfirmasi Password">

    <button type="submit" name="daftar">daftar</button>
</form>
    
</body>
</html>