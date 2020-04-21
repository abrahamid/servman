<?php
session_start();
if(!isset($_SESSION["login"])){
  header("location: login.php");
}
include 'functions.php';
// mengambil resi
$resi=$_GET['resi'];
//mengambil semua data
$data = query("SELECT * FROM service WHERE resi=$resi")[0];


//mengecek post
if(isset($_POST["submit"])){
  if( ubah($_POST)>0){
    echo "<script>alert('data berhasil diubah');document.location.href='job.php';</script>";
  }else{
    echo "<script>alert('data gagal diubah');</script>";
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
    <h1>admin form</h1>
    <a href="job.php">gawean</a>
    <div class="box_login">
      <form action="" method="post">
        <label for="resi">resi:</label>
        <input type="hidden" name="id" value="<?= $data["id"];?>">
        <input type="hidden" name="qr" class="form_input" qr="qr" placeholder="qr" autocomplete="off" value="<?= $data["qr"];?>" disabled>
        <input type="text" name="resi" class="form_input" id="resi" placeholder="resi" autocomplete="off" value="<?= $resi;?>" disabled>

        <label for="nama">nama:</label>
        <input type="text" name="nama" class="form_input" id="nama" placeholder="nama" autocomplete="off" value="<?= $data["nama"];?>" >

        <label for="alamat">alamat/kantor:</label>
        <input type="text" name="alamat" class="form_input" id="alamat" placeholder="alamt/kantor" autocomplete="off" value="<?= $data["alamat"];?>" >

        <label for="hp">Nomer HP</label>
        <input type="text" name="nomerhp" class="form_input" id="hp" placeholder="nomer hp" autocomplete="off" value="<?= $data["hp"];?>" >

        <label for="seri">seri</label>
        <input type="text" name="seri" class="form_input" id="seri" placeholder="seri" autocomplete="off" value="<?= $data["seri"];?>" >

        <label for="kerusakan">Kerusakan</label>
        <textarea name="kerusakan" id="kerusakan" placeholder="kerusakan" autocomplete="off"><?= $data["kerusakan"];?></textarea>

        <label for="tanggal masuk">tanggal masuk</label>
        <input type="text" name="tanggal_masuk" class="form_input" id="tanggal masuk" placeholder="tanggal masuk" autocomplete="off" value="<?= $data["tanggalmasuk"];?>" disabled>

        <label for="penerima">penerima</label>
        <input type="text" name="penerima" class="form_input" id="penerima" placeholder="penerima" autocomplete="off" value="<?= $data["penerima"];?>" disabled>

        <label for="status">status</label>
        <input type="text" name="status" class="form_input" id="status" placeholder="status" autocomplete="off" value="<?= $data["status"];?>" >

        <label for="biaya">biaya</label>
        <input type="text" name="biaya" class="form_input" id="biaya" placeholder="biaya" autocomplete="off" value="<?= $data["biaya"];?>" >

        <label for="admin">admin</label>
        <input type="text" name="admin" class="form_input" id="admin" placeholder="catatan admin" autocomplete="off" value="<?= $data["admin"];?>" >

        
        <button type="submit" name="submit" class="login_button">simpan</button>

      </form>
    </div>
  </body>
</html>
