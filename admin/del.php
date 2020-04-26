<?php
session_start();
if(!isset($_SESSION["login"])){
  header("location: login.php");
}
include 'functions.php';
$resi=$_GET['resi'];


if(hapus($resi)>0){
  echo "<script>alert('data berhasil dihapus'); document.location=href='status.php?status=antri'</script>";
  }else{
  echo "<script>alert('data gagal dihapus');document.location=href='status.php?status=antri'</script>";
}

?>
