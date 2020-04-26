<?php
session_start();
if(!isset($_SESSION["login"])){
  header("location: login.php");
}
//SEMUA FUNGSI ADA DISINI
include 'functions.php';
//GENERATE QR CODE
include 'phpqrcode/qrlib.php';

//JIKA TOMBOL SIMPAN DI TEKAN
if(isset($_POST["submit"])){

//ALERT GAGAL ATA BERHASIL
if( tambah($_POST)>0){
  echo "<script>alert('data berhasil ditambahkan');document.location.href='status.php';</script>";
}else{
  echo mysqli_error($koneksi);
}

}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Form</title>
  </head>
  <body>
  <ul class="nav navbar-expand-lg navbar-dark bg-dark justify-content-end sticky-top text-capitalize">
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
    <!-- HEADER -->
    <h1>admin form</h1>
    <!-- FORM -->
    <div class="box_login">
      <form action="index.php" method="post">
        <label for="nama">nama :</label>
        <input type="text" name="nama" class="form_input" id="nama" placeholder="nama" autocomplete="off" required>

        <label for="alamat">alamat / kantor / personal :</label>
        <input type="text" name="alamat" class="form_input" id="alamat" placeholder="alamt/kantor" autocomplete="off" required>

        <label for="hp">Nomer HP :</label>
        <input type="text" name="nomerhp" class="form_input" id="hp" placeholder="nomer hp" autocomplete="off" required>

        <label for="seri">seri :</label>
        <input type="text" name="seri" class="form_input" id="seri" placeholder="seri" autocomplete="off" required>

        <label for="kerusakan">Kerusakan :</label>
        <textarea name="kerusakan" placeholder="kerusakan" autocomplete="off" required></textarea>
              
        <button type="submit" name="submit" class="login_button">simpan</button>

      </form>
    </div>
  </body>
</html>
