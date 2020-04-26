<?php
session_start();
if(!isset($_SESSION["login"])){
  header("location: login.php");
}
include 'functions.php';

if(!isset($_GET['resi'])){
  header("Location: status.php?status=antri");
}else{
// mengambil resi
$resi=$_GET['resi'];
//mengambil semua data
$data = query("SELECT * FROM service WHERE resi=$resi")[0];
}

//mengecek post
if(isset($_POST["submit"])){
  if( ubah($_POST)>0){
    echo "<script>alert('data berhasil diubah');document.location.href='status.php';</script>";
  }else{
    echo "<script>alert('data gagal diubah');</script>";
  }

}

if(isset($_POST["batal"])){
  header("Location: status.php?status=antri");
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Form</title>
    </head>
  <body>
    <h1>edit form</h1>
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
        <select class="status" name="status">
          <option value="<?= $data["status"];?>"><?= $data["status"];?></option>
          <option value="antri">Antri</option>
          <option value="proses">Proses</option>
          <option value="selesai">Selesai</option>
          <option value="jadi">Sudah Jadi Belum Diambil</option>
          <option value="gagal">Gagal</option>
          <option value="cancel">Cancel</option>
        </select>

        <label for="biaya">biaya</label>
        <input type="text" name="biaya" class="form_input" id="biaya" placeholder="biaya" autocomplete="off" value="<?= $data["biaya"];?>" >

        <label for="admin">catatan</label>
        <input type="text" name="admin" class="form_input" id="admin" placeholder="catatan admin" autocomplete="off" value="<?= $data["admin"];?>" >

        
        <button type="submit" name="submit" class="login_button">Simpan</button>
</br><br>
        <button type="submit" name="batal" class="login_button">Batal</button>

      </form>
    </div>
  </body>
</html>
