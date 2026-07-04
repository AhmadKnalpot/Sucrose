<?php
session_start();
include "config/koneksi.php";

$error = "";

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn,"SELECT * FROM user WHERE username='$username'");

   if(mysqli_num_rows($query) > 0){

    $user = mysqli_fetch_assoc($query);

    $loginBerhasil = false;

    // Password akun baru (password_hash)
    if(password_verify($password, $user['password'])){
        $loginBerhasil = true;
    }

    // Password akun lama (MD5)
    elseif(md5($password) == $user['password']){
        $loginBerhasil = true;

        // Upgrade otomatis ke password_hash
        $passwordBaru = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($conn, "UPDATE user
        SET password='$passwordBaru'
        WHERE id='".$user['id']."'");
    }

    if($loginBerhasil){

        $_SESSION['login'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header("Location: dashboard.php");
        exit;

    }else{

        $error = "Username atau Password salah!";

    }

}else{

    $error = "Username atau Password salah!";

}

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Login | SUCROSE</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins,sans-serif;
}

body{

height:100vh;

display:flex;

justify-content:center;

align-items:center;

background:
linear-gradient(rgba(20,60,20,.65),rgba(20,60,20,.65)),
url("assets/img/farm-bg.jpg");

background-size:cover;

background-position:center;

}

.login-box{

width:420px;

background:rgba(255,255,255,.92);

backdrop-filter:blur(10px);

padding:40px;

border-radius:20px;

box-shadow:0 15px 35px rgba(0,0,0,.25);

}

.logo{

text-align:center;

margin-bottom:20px;

}

.logo img{

width:80px;

}

.logo h2{

margin-top:10px;

color:#2E7D32;

}

.logo p{

color:#777;

font-size:14px;

}

.input-group{

margin-top:20px;

}

.input-group label{

display:block;

margin-bottom:8px;

font-weight:600;

}

.input-group input{

width:100%;

padding:14px;

border-radius:10px;

border:1px solid #ddd;

outline:none;

font-size:15px;

}

.input-group input:focus{

border-color:#2E7D32;

}

button{

margin-top:30px;

width:100%;

padding:15px;

background:#2E7D32;

color:white;

border:none;

border-radius:10px;

font-size:16px;

cursor:pointer;

transition:.3s;

}

button:hover{

background:#1B5E20;

}

.error{

margin-top:15px;

padding:12px;

background:#ffebee;

color:#d32f2f;

border-radius:10px;

text-align:center;

}

.footer{

margin-top:25px;

text-align:center;

font-size:13px;

color:#777;

}

@media(max-width:500px){

.login-box{

width:90%;

padding:30px;

}

}

</style>

</head>

<body>

<div class="login-box">

<div class="logo">

<img src="assets/img/logo.png">

<h2>SUCROSE</h2>

<p>Smart Agriculture IoT</p>

</div>

<form method="POST" action="login.php">
    <div class="input-group">

<label>

<i class="fa-solid fa-user"></i>

Username

</label>

<input
type="text"
name="username"
required>

</div>

<div class="input-group">

<label>

<i class="fa-solid fa-lock"></i>

Password

</label>

<input
type="password"
name="password"
required>

</div>

<button
type="submit"
name="login">

<i class="fa-solid fa-right-to-bracket"></i>

Login

</button>
<div style="margin-top:20px;text-align:center;">

Belum punya akun?

<a href="register.php"
style="
color:#2E7D32;
font-weight:bold;
text-decoration:none;
">

Daftar Sekarang

</a>

</div>

<?php

if($error!=""){

echo "<div class='error'>$error</div>";

}

?>

</form>

<div class="footer">

© 2026 SUCROSE<br>

Smart Agriculture IoT

</div>

</div>

</body>

</html>