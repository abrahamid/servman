<?php
session_start();
session_destroy();
session_unset();

setcookie('jumlah','',time() - 3600 );
setcookie('wkwkwk','',time() - 3600);

header("Location:login.php");
exit;

?>