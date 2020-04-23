<?php
//koneksi ke database silahkan diubah sesua database masing masing
require 'config.php';
//timezone
date_default_timezone_set("Asia/Bangkok");

//query sederhana
function query($query){
  global $koneksi;
  $result = mysqli_query($koneksi,$query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  return $rows;
}


function tambah($data){
  global $koneksi;
  //grap data dari input
  $resi=date("ym").time();
  $nama=htmlspecialchars($data['nama']);
  $alamat=htmlspecialchars($data['alamat']);
  $nomerhp=htmlspecialchars($data['nomerhp']);
  $seri=htmlspecialchars($data['seri']);
  $kerusakan=htmlspecialchars($data['kerusakan']);
  $penerima=htmlspecialchars($data['penerima']);
  $tanggalmasuk = date("Y-m-d H:i:s");

  $urlresi = "http://localhost/?resi=$resi";

  $tempdir = "img/"; //Nama folder tempat menyimpan file qrcode


  //isi qrcode jika di scan
  $codeContents = $urlresi;
  //nama file qrcode yang akan disimpan
  $namaFile=$resi.".png";
  //ECC Level
  $level=QR_ECLEVEL_H;
  //Ukuran pixel
  $UkuranPixel=10;
  //Ukuran frame
  $UkuranFrame=4;

  QRcode::png($codeContents, $tempdir.$namaFile, $level, $UkuranPixel, $UkuranFrame);
  //membuat isi database
  $create = "INSERT INTO service VALUES (NULL, '$resi', '$nama', '$alamat', '$nomerhp', '$seri', '$kerusakan', $tanggalmasuk', '$penerima', 'antri', 0, NULL,'$namaFile');";
  mysqli_query($koneksi,$create);

  return mysqli_affected_rows($koneksi);

}

function hapus($resi){
  global $koneksi;
  $target = "img/".$resi.".png";
  mysqli_query($koneksi,"DELETE FROM service WHERE resi =$resi");
  unlink($target);

  return mysqli_affected_rows($koneksi);
}


function ubah($data){
  global $koneksi;
  $id = $data['id']; //1
  $resi=$data['resi'];//2
  $nama=$data['nama'];//3
  $alamat=$data['alamat'];//4
  $nomerhp=$data['nomerhp'];//5
  $seri=$data['seri'];//6
  $kerusakan=$data['kerusakan'];//7
  $tanggalmasuk=$data['tanggal_masuk'];//8
  $penerima=$data['penerima'];//9
  $status=$data['status'];//10
  $biaya=$data['biaya'];//11
  $admin=$data['admin'];//12
  $qr=$data['qr'];//13

  //$query ="UPDATE service SET resi = '$resi', nama = '$nama', alamat = '$alamat', hp = '$nomerhp', seri = '$seri', kerusakan = '$kerusakan', tanggalmasuk = '$tanggalmasuk', penerima = '$penerima', status = '$status', biaya = '$biaya', admin = '$admin', qr = '$qr' WHERE service.id = $id";
  $query ="UPDATE `service` SET `nama` = '$nama', `alamat` = '$alamat', `hp` = '$nomerhp', `seri` = '$seri', `kerusakan` = '$kerusakan', `status` = '$status', `biaya` = '$biaya', `admin` = '$admin' WHERE `service`.`id` = $id ";
  mysqli_query($koneksi,$query);

  return mysqli_affected_rows($koneksi);

}

function rupiah($angka){

  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;

}
function cari($keyword){
  $query = "SELECT * FROM service WHERE
  nama LIKE '%$keyword%' OR
  resi LIKE '%$keyword%' OR
  seri LIKE '%$keyword%' OR
  kerusakan LIKE '%$keyword%'
  ";
  return query($query);
}
function daftar($data){
  global $koneksi;
  $username = strtolower(stripslashes($data["username"]));
  $password = $data["password"];
  $password1 = $data["password1"];

  //cek nama username sudah ada atau belum

  $result = mysqli_query($koneksi,"SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
      echo "<script>alert('USERNAEM sudah digunakan');</script>";
      return false;
    }

  //cek password garus sama
  if($password !== $password1){
    echo "<script>alert('password tidak cocok');</script>";
    return false;
  }

  //encrypt password
  $password = password_hash($password,PASSWORD_DEFAULT);


  //meamsukan ke database
  $isidata ="INSERT INTO user VALUES (NULL, '$username', '$password', '1');";
  mysqli_query($koneksi,$isidata);
  return mysqli_affected_rows($koneksi);
}


?>
