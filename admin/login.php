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
        $_SESSION["name"]   = $row['username'];
    }
}

if(isset($_SESSION["login"])){
  header("location: status.php?status=antri");
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
            $_SESSION["name"]   = $row['username'];
            
            //cek remember me
            //set cookie
            //namanya ngawur
            setcookie('jumlah',$row['id'],time()+3600*24);
            //ini juga ngawur
            setcookie('wkwkwk',hash('sha256',$row['username']),time()+3600*24);

            

            header("Location: status.php?status=antri");
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
    <link rel="stylesheet" href="login.css">
    <title>LOGIN</title>
</head>
<body>
<div class="box">
    <h1>Silahkan Login</h1>
    <form action="" method="post">
        <div class="inputBox">
            <!-- <input type="text" name="username" id="username" autocomplete="off" placeholder="USERNAME" autofocus>
            <label for="username"></label> -->
                <input type="text" name="username" autocomplete="off" required>
                <label>USERNAME</label>
        </div>

        <div class="inputBox">
                <input type="password" name="password" autocomplete="off" required>
                <label>PASSWORD</label>
        </div>
        <input type="submit" name="login" value="MASUK">
    </form>
</div>
</body>
</html>
