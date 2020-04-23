<?php

//session
session_start();
if(!isset($_SESSION["login"])){
  header("location: login.php");
  exit;
}

include 'functions.php';

//page nation
$rows = 10;
$jumlahData = count(query("SELECT * FROM service"));
$jumlahHalaman = ceil($jumlahData / $rows);
$halamanAktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awal = ($rows * $halamanAktif) - $rows;
//query
$service = query("SELECT * FROM service LIMIT $awal,$rows");

//mencari data
if(isset($_POST["cari"])){
  $service = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>DAFTAR GARAPAN</title>
</head>
<body>
  <?php if($_SESSION["name"] === 'abraham' ): ?>
    <h1>GARAPAN MU AKEH SEK SEMANGAT RASAH NGANTUK!</h1>
    <?php else: ?>
    <h1>selamat datang <?= $_SESSION["name"];?></h1>
  <?php endif; ?>
  <a href="index.php" style="text-decoration: none; color: lime;">Tambah User</a> &nbsp; <a href="job.php" style="text-decoration: none; background:#fff;">refresh</a><br><br>
  

  <!-- form penacrian -->
  <form action="" method="post">
    <input type="text" name="keyword" placeholder="masukan nama/seri/resi" autocomplete="off" autofocus>
    <button type="submit" name="cari">CARI</button>
  </form><br>


  <!-- navigasi -->

  <!-- logika jika tombol cari ditekan akan menghilangkan bavigasi -->
<?php if(!isset($_POST["cari"])){ ?>


    <!-- logika jika navigasi sudah mencapai angka 1 tombol back tidak bisa ditekan -->
      <?php if($halamanAktif > 1 ):?>
          <a href="?halaman=<?= $halamanAktif - 1;?>">BACK</a>
          <?php else :?>
          BACK
      <?php endif; ?>


        <!-- logika pengulangan jumlah halaman -->
      <?php for($i = 1; $i <= $jumlahHalaman; $i++): ?>

          <?php if($i == $halamanAktif) : ?>
            <!-- halaman aktif akan bewarna hijau -->
            <a href="?halaman=<?=$i;?>" style="color:green;" > <?= $i; ?> </a>

          <?php else: ?>
            <!-- halaman lain akan biasa -->
            <a href="?halaman=<?=$i;?>"><?= $i; ?></a>
          <?php endif; ?>
      <?php endfor ?>


        <!-- logika jika navigasi sudah ke halaman terakhir tombol next tidak bisa ditekan -->
      <?php if($halamanAktif < $jumlahHalaman ):?>
              <a href="?halaman=<?= $halamanAktif + 1;?>">NEXT</a>
      <?php else : ?>
              NEXT
      <?php endif; ?>

        </br><br>


<!-- akhir dari logika pencarian -->
<?php }; ?>
<!-- akhir dari logika pencarian -->

    <table border="1px" cellpadding="10" cellspacing="0">
      <tr>
        <th>no</th>
        <th>resi</th>
        <th>nama</th>
        <th>alamat / kantor / personal</th>
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
      <?php $no = $awal + 1; 
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
    </table><br><br>
    <a href="logout.php">LOGOUT</a>
    </body>
</html>
