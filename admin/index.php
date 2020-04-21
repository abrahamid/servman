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
  echo "<script>alert('data berhasil ditambahkan');document.location.href='job.php';</script>";
}else{
  echo mysqli_error($koneksi);
}

}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Form</title>
  </head>
  <body>
    <!-- HEADER -->
    <h1>admin form</h1>
    <!-- TOMBOL NAVIGASI -->
    <a href="job.php">gawean</a> <br>
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
        <input type="text" name="kerusakan" class="form_input" id="kerusakan" placeholder="kerusakan" value="" autocomplete="off" required>
        
        <!-- penerima diisi sesuai nama username -->
        <input type="hidden" name="penerima" id="penerima" value="<?= $_SESSION['name']; ?>">
        
        <button type="submit" name="submit" class="login_button">simpan</button>

      </form>
    </div>
  </body>
</html>
