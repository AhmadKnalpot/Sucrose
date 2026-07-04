<?php
session_start();

if(isset($_SESSION['id'])){
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register | SUCROSE</title>

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

.register-box{

width:480px;

background:rgba(255,255,255,.93);

backdrop-filter:blur(12px);

padding:40px;

border-radius:20px;

box-shadow:0 15px 35px rgba(0,0,0,.25);

}

.logo{

text-align:center;
margin-bottom:25px;

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

margin-top:18px;

}

.input-group label{

display:block;
margin-bottom:8px;
font-weight:600;

}

.input-group input,
.input-group select{

width:100%;
padding:14px;
border-radius:10px;
border:1px solid #ddd;
outline:none;
font-size:15px;

}

.input-group input:focus,
.input-group select:focus{

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

.footer{

margin-top:20px;
text-align:center;
font-size:14px;

}

.footer a{

text-decoration:none;
font-weight:bold;
color:#2E7D32;

}

.footer a:hover{

text-decoration:underline;

}

@media(max-width:500px){

.register-box{

width:90%;
padding:30px;

}

}

</style>

</head>

<body>

<div class="register-box">

<div class="logo">

<img src="assets/img/logo.png">

<h2>SUCROSE</h2>

<p>Smart Agriculture IoT</p>

</div>

<form action="proses_register.php" method="POST">

<div class="input-group">

<label><i class="fa-solid fa-user"></i> Nama Lengkap</label>

<input
type="text"
name="nama"
required>

</div>

<div class="input-group">

<label><i class="fa-solid fa-user-tag"></i> Username</label>

<input
type="text"
name="username"
required>

</div>

<div class="input-group">

<label><i class="fa-solid fa-user-shield"></i> Role</label>

<select
name="role"
required>

<option value="">-- Pilih Role --</option>
<option value="admin">Admin</option>
<option value="user">User</option>

</select>

</div>

<div class="input-group">

<label><i class="fa-solid fa-lock"></i> Password</label>

<input
type="password"
name="password"
required>

</div>

<div class="input-group">

<label><i class="fa-solid fa-lock"></i> Konfirmasi Password</label>

<input
type="password"
name="konfirmasi"
required>

</div>

<button
type="submit">

<i class="fa-solid fa-user-plus"></i>

Daftar

</button>

</form>

<div class="footer">

Sudah punya akun?

<a href="login.php">

Login Sekarang

</a>

</div>

</div>

</body>

</html>