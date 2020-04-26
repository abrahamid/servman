<?php

//session
session_start();
if(!isset($_SESSION["login"])){
  header("location: login.php");
  exit;
}

if(!isset($_GET['status'])){
    header("Location: status.php?status=all");
}

include 'functions.php';
$status = $_GET['status'];
//page nation
$rows = 10;
$jumlahData = count(query("SELECT * FROM service WHERE status = '$status'"));
if($status === 'all'){
    $jumlahData = count(query("SELECT * FROM service"));
};
$jumlahHalaman = ceil($jumlahData / $rows);
$halamanAktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awal = ($rows * $halamanAktif) - $rows;
//query
$service = query("SELECT * FROM service WHERE status='$status' LIMIT $awal,$rows");
if($status === 'all'){
    $service = query("SELECT * FROM service LIMIT $awal,$rows");
}
//mencari data
if(isset($_POST["cari"])){
  $service = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>DAFTAR GARAPAN</title>
  </head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand disable" href="#">SERVMAN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<!-- navbar -->
  <div class="collapse navbar-collapse sticky-top" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Tambah Service</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="?status=all" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Status
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="?status=all">Tampilkan Semua</a>
            <a class="dropdown-item" href="?status=antri">Antri</a>
            <a class="dropdown-item" href="?status=proses">Proses</a>
            <a class="dropdown-item" href="?status=selesai">Selesai</a>
            <a class="dropdown-item" href="?status=gagal">Gagal</a>
            <a class="dropdown-item" href="?status=cancel">Cancel</a>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link"  href="logout.php" tabindex="-1" aria-disabled="true">Keluar</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="?status=<?= $status; ?>" method="post">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" name="" type="submit" onclick="alert('fitur masih dalam pengembangan');">Search</button>
    </form>
  </div>
</nav>

<div style="margin-top:0;">
  <?php if($_SESSION["name"] === 'abraham' ): ?>
    <div class="mx-auto btn-danger"><h6>GARAPAN MU AKEH SEK SEMANGAT RASAH NGANTUK!</h6></div>
    <?php else: ?>
    <h1 class="text-center">selamat datang <?= $_SESSION["name"];?></h1>
  <?php endif; ?>
</div>
<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover">
    <thead>
    <div class="sticky-top">
      <tr>
        <th>No.</th>
        <th>Resi</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No. Hp</th>
        <th>Seri</th>
        <th>kerusakan</th>
        <th>Tanggal Masuk</th>
        <th>Penerima</th>
        <th>Status</th>
        <th>Biaya</th>
        <th>Catatan</th>
        <th>Update</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = $awal + 1; 
      foreach ( $service as $data):?>
      <tr>
        <td scope="row"><?= $no; ?></td>
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
        <td>
            <a href="edit.php?resi=<?= $data['resi']; ?>">update</a>||
            <a href="del.php?resi=<?= $data['resi']; ?>"onclick="return confirm('ingin menghapus?');">hapus </a>
        </td>
      </tr>
      <?php $no++ ?>
      <?php endforeach; ?>
    </tbody>
    </table>
    </div>

    <!-- tombol pagenation -->
  <nav aria-label="Page navigation example">
    <ul class="pagination text-center">

      <!-- previews button -->
      <?php if($halamanAktif > 1 ):?>
        <li class="page-item"><a class="page-link" href="?status=<?= $status;?>&halaman=<?= $halamanAktif - 1;?>">Previous</a></li>
          <?php else:?>
        <li class="page-item"><a class="page-link disabled" >Previous</a></li>
      <?php endif; ?>

      <!-- pagenation button -->
      <?php for($i = 1; $i <= $jumlahHalaman; $i++): ?>

      <?php if($i == $halamanAktif) : ?>
        <!-- halaman aktif akan bewarna hijau -->
        <li class="page-item link active"><a class="page-link" href="?status=<?= $status;?>&halaman=<?=$i;?>"> <?= $i; ?> </a></li>
            <?php else: ?>
           <!-- halaman lain akan biasa -->
           <li class="page-item"><a class="page-link" href="?status=<?= $status;?>&halaman=<?=$i;?>"><?= $i; ?></a></li>
      <?php endif; ?>
      <?php endfor ?>
      
      <!-- next button -->
      <?php if($halamanAktif < $jumlahHalaman ):?>
        <li class="page-item"><a class="page-link" href="?status=<?= $status;?>&halaman=<?= $halamanAktif + 1;?>">Next</a></li>
          <?php else : ?>
        <li class="page-item"><a class="page-link disabled" >Next</a></li>
      <?php endif; ?>
    </ul>
  </nav>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
