<!DOCTYPE html>
<html>
<head>
  <title>webcom</title>
</head>
<body>
  <h1>selamat datang</h1>
  </br>
   <form action="index.php" method="get">
     <table border="1px">
       <tr>
         <td><input type="number" name="resi" placeholder="resi"></td>
       </tr>
       <tr>
         <td>
           <input type="submit" value="cari">
         </td>
       </tr>
     </table>
   </form>
<?php
  require 'admin/functions.php';

  $resi = $_GET['resi'];
  $d = query("SELECT * FROM service WHERE resi=$resi")[0];
  ?>
  <?php if(isset($_GET["resi"])):?>
    <table border="1px">
    <tr><td>resi</td><td><?php echo $d['resi'];?></td></tr>
    <tr><td>nama</td><td><?php echo $d['nama'];?></td></tr>
    <tr><td>seri</td><td><?php echo $d['seri']; ?></td></tr>
    <tr><td>status</td><td><?php echo $d['status']; ?></td></tr>
    <tr><td>keterangan</td><td><?php echo $d['admin']; ?></td></tr>
    <tr><td>biaya</td><td><?php echo rupiah($d['biaya']); ?></td></tr>
  </table>
  <?php endif; ?>
</body>
</html>
