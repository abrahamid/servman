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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Sign UP</title>
</head>
<body>
<ul class="nav navbar-expand-lg navbar-dark bg-dark justify-content-end fixed-top text-capitalize">
    <li class="nav-item">
        <a class="nav-link" href="status.php?status=antri">Job</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="daftar.php">Tambah admin</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php">Tambah User</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="logout.php">keluar</a>
    </li>
</ul>
<div style="margin-top:50px;">
<h1 class="text-center text-capitalize">halaman registrasi</h1>
<div class="container">
<form action="" method="post">
    <div class="form-group">
    <label for="username">Username : </label>
    <input type="text" class="form-control" name="username" id="username" autocomplete="off" autofocus value="" placeholder="Username">
    </div>

    <div class="form-group">
    <label for="password">Password : </label>
    <input type="password" class="form-control" name="password" id="password" autocomplete="off" value="" placeholder="Password">
    </div>

    <div class="form-group">
    <label for="password1">Konfirmasi Password</label>
    <input type="password" class="form-control" name="password1" id="password1" placeholder="Konfirmasi Password">
    </div>
    <button class="btn btn-primary" type="submit" name="daftar">daftar</button>
</form>
</div>
</body>
</html>
