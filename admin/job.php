<?php
include 'functions.php';

session_start();
if(!isset($_SESSION["login"])){
  header("location: login.php");
}

$service = query("SELECT * FROM service");


//mencari data
if(isset($_POST["cari"])){
  $service = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>DAFTAR GARAPAN</title>
  <style>
    td{
      text-transform: capitalize;
    }
  </style>
</head>
<body>
  <h1>GARAPAN MU AKEH SEK SEMANGAT RASAH NGANTUK!</h1>
  <a href="index.php">Tambah user</a><br>
  

  <!-- form penacrian -->
  <form action="" method="post">
    <input type="text" name="keyword" placeholder="masukan nama/seri/resi" autocomplete="off" autofocus>
    <button type="submit" name="cari">CARI</button>
  </form>

    <table border="1px" cellpadding="10" cellspacing="0">
      <tr>
        <th>no</th>
        <th>resi</th>
        <th>nama</th>
        <th>alamat / kantor</th>
        <th>nomer hp</th>
        <th>seri</th>
        <th>kerusakan</th>
        <th>tanggal masuk</th>
        <th>penerima</th>
        <th>status</th>
        <th>biaya</th>
        <th>admin</th>
        <th>update</th>
      </tr>
      <?php $no = 1; 
      foreach ( $service as $data):?>
      <tr>
        <td><?= $no; ?></td>
        <td><?= $data['resi']; ?></td>
        <td><?= $data['nama']; ?></td>
        <td><?= $data['alamat']; ?></td>
        <td><?= $data['hp']; ?></td>
        <td><?= $data['seri']; ?></td>
        <td><?= $data['kerusakan']; ?></td>
        <td><?= $data['tanggalmasuk']; ?></td>
        <td><?= $data['penerima']; ?></td>
        <td><?= $data['status']; ?></td>
        <td><?= rupiah($data['biaya']); ?></td>
        <td><?= $data['admin']; ?></td>
        <td><a href="edit.php?resi=<?= $data['resi']; ?>">update</a>||<a href="del.php?resi=<?= $data['resi']; ?>"onclick="return confirm('yakin?');">hapus</a></td>
      </tr>
      <?php $no++ ?>
    <?php endforeach; ?>
    </table>
    <a href="logout.php">LOGOUT</a>
    </body>
</html>
