<?php
session_start();
require 'functions.php';
//set cookie
if(isset($_COOKIE["jumlah"])  && isset($_COOKIE['wkwkwk'])){
    //task set wkwkwk karna bingung mau tak kasih nama apa
    $wkwkwk = $_COOKIE['wkwkwk'];
    //ini juga ingung mau tak kasih nama apa
    $id = $_COOKIE['jumlah'];

    //ambil username
    $result = mysqli_query($koneksi,"SELECT * FROM user WHERE id = $id ");
    $row = mysqli_fetch_assoc($result);

    //cek kesamaan cookie dan username
    if($wkwkwk === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}

if(isset($_SESSION["login"])){
  header("location: job.php");
}


if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password  = $_POST["password"];

    $result = mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username'");

    //cek username
    if(mysqli_num_rows($result) ===1){

        //cek password
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password,$row["password"])){

            //set session
            $_SESSION["login"] = true ;
            $_SESSION["name"]   = $username;
            
            //cek remember me
            if(isset($_POST["remember"])){

                //set cookie
                //namanya ngawur
                setcookie('jumlah',$row['id'],time()+3600*24);
                //ini juga ngawur
                setcookie('wkwkwk',hash('sha256',$row['username']),time()+3600*24);

            }

            header("Location: job.php");
            exit;
        }else{
            echo "<script>alert('PASSWORD SALAH');</script>";
        }
    }else{
        echo "<script>alert('USERNAME TIDAK DITEMUKAN');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>
    <h1>Silahkan Login</h1>
    <form action="" method="post">
        <label for="username"></label>
        <input type="text" name="username" id="username" autocomplete="off" placeholder="USERNAME" autofocus>

        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="PASSWORD" autocomplete="off">

        <label for="remember">remember me</label>
        <input type="checkbox" name="remember" id="remember">

        <button type="submit" name="login">LOGIN</button>
    </form>

</body>
</html>
