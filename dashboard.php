<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Sucrose Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style> 
.content{
    flex:1;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html,
body{
    height:100%;
    margin:0;
}

body{
    background:#eef7ee;
    font-family:'Segoe UI',sans-serif;

    display:flex;
    flex-direction:column;
    min-height:100vh;
}

/* Navbar */

.navbar{

    background:#1b5e20;

}

.navbar-brand{

    font-size:28px;
    font-weight:bold;
    color:white !important;

}

/* Hero */

.hero{

    background:linear-gradient(135deg,#2e7d32,#66bb6a);

    color:white;

    border-radius:25px;

    padding:50px;

    margin-top:30px;

    box-shadow:0 15px 35px rgba(0,0,0,.2);

}

.hero h1{

    font-size:42px;
    font-weight:bold;

}

.hero p{

    font-size:18px;

}

/* Card */

.card{

    border:none;

    border-radius:20px;

    transition:.3s;

    overflow:hidden;

}

.card:hover{

    transform:translateY(-10px);

    box-shadow:0 15px 35px rgba(0,0,0,.25);

}

.icon{

    width:90px;

    height:90px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:40px;

    margin:auto;

    color:white;

}

.water{

    background:#2196f3;

}

.melon{

    background:#ff9800;

}

.btn-open{

    width:100%;

    border-radius:50px;

    font-weight:bold;

}

/* Footer */

footer{

    margin-top:auto;

    background:#1b5e20;

    color:white;

    text-align:center;

    padding:18px;

    font-weight:500;

}

.info{

    background:white;

    border-radius:20px;

    padding:25px;

    box-shadow:0 10px 20px rgba(0,0,0,.08);

}

.info h5{

    color:#2e7d32;

    font-weight:bold;

}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand d-flex align-items-center" href="#">

<img src="assets/img/logo.png"
     alt="Logo Sucrose"
     width="70"
     height="70"
     class="me-3">

<span>SUCROSE</span>

</a>
  <div class="ms-auto">
<nav class="navbar">

    <a href="users/user.php">
        <i class="fa-solid fa-users"></i>
        User
    </a>
    <a href="logout.php"
       class="btn btn-danger">

        <i class="fa-solid fa-right-from-bracket"></i>

        Logout

    </a>

</nav>
</div>

</div>

</nav>

<div class="container">

<div class="hero">

<h1>Smart Agriculture IoT</h1>

<p>

Sistem Monitoring Penyiraman Otomatis dan Deteksi Kematangan Melon Berbasis Artificial Intelligence

</p>

</div>

<div class="row mt-5">

<div class="col-md-6 mb-4">

<div class="card shadow">

<div class="card-body text-center p-5">

<div class="icon water">

<i class="fa-solid fa-droplet"></i>

</div>

<h3 class="mt-4">

Watering System

</h3>

<p class="text-muted">

Monitoring kelembapan tanah secara real-time, mengontrol pompa otomatis, serta melihat riwayat penyiraman tanaman melon.

</p>

<a href="watering/index.php"

class="btn btn-success btn-lg btn-open">

<i class="fa-solid fa-arrow-right"></i>

Masuk

</a>

</div>

</div>

</div>

<div class="col-md-6 mb-4">

<div class="card shadow">

<div class="card-body text-center p-5">

<div class="icon melon">

<i class="fa-solid fa-seedling"></i>

</div>

<h3 class="mt-4">

Ripeness Detection

</h3>

<p class="text-muted">

Mendeteksi tingkat kematangan buah melon menggunakan Artificial Intelligence berdasarkan pola jaring pada permukaan buah.

</p>

<a href="ripeness/index.php"

class="btn btn-warning btn-lg btn-open text-white">

<i class="fa-solid fa-camera"></i>

Masuk

</a>

</div>

</div>

</div>

</div>

<div class="info mt-4">

<h5>

<i class="fa-solid fa-circle-info"></i>

Tentang Sucrose

</h5>

<hr>

<p>

Sucrose merupakan sistem Smart Agriculture berbasis Internet of Things (IoT) yang dirancang untuk membantu petani melon dalam melakukan penyiraman otomatis berdasarkan kelembapan tanah serta mendeteksi tingkat kematangan buah melon menggunakan Artificial Intelligence. Sistem ini bertujuan meningkatkan produktivitas, mengurangi risiko gagal panen, dan membantu proses panen menjadi lebih efisien.

</p>

</div>

</div>

<footer>

© 2026 Sucrose Kelompok 1 [ 6 IKKA ]

</footer>

</body>

</html>