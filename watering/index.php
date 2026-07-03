<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login.php");
    exit;
}

include "../config/koneksi.php";
/**
 * @var mysqli $conn */

$query = mysqli_query($conn,"SELECT * FROM monitoring ORDER BY id DESC LIMIT 1");

$row = mysqli_fetch_assoc($query);

$statusTanah = "";

if ($row['soil'] < 40) {
    $statusTanah = "TANAH KERING";
}
elseif ($row['soil'] < 70) {
    $statusTanah = "TANAH LEMBAB";
}
else {
    $statusTanah = "TANAH BASAH";
}

// Jika belum ada data
if(!$row){
    $row = [
        "soil" => 0,
        "status_tanah" => "-",
        "pump" => "-",
        "created_at" => "-"
    ];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Watering System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{

background:linear-gradient(rgba(0,100,0,.5),
rgba(0,100,0,.5)),
url("https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=1600&q=80");

background-size:cover;

background-position:center;

min-height:100vh;

}

.card{

border:none;

border-radius:20px;

}

.value{

font-size:45px;

font-weight:bold;

color:#198754;

}

.navbar{

background:#14532d;

}

.footer{

color:white;

text-align:center;

margin-top:30px;

}

</style>

</head>


<body>

<nav class="navbar navbar-dark">

<div class="container">

<a class="navbar-brand d-flex align-items-center" href="#">

<img src="../assets/img/logo.png"
     alt="Logo Sucrose"
     width="70"
     height="70"
     class="me-3">

<span>SUCROSE</span>
<nav class="navbar">

    <a href="../dashboard.php" class="nav-link">
        <i class="fa-solid fa-house"></i>
        <span>Home</span>
    </a>
    <a href="../users/user.php">
        <i class="fa-solid fa-users"></i>
        User
    </a>
        <a href="../logout.php"
       class="btn btn-danger">

        <i class="fa-solid fa-right-from-bracket"></i>

        Logout

    </a>

</nav>

</a>

</div>

</nav>

<div class="container mt-5">

<div class="row">

<div class="col-lg-3 col-md-6 mb-4">

<div class="card shadow">

<div class="card-body text-center">

<i class="fa-solid fa-seedling fa-3x text-success"></i>

<h5 class="mt-3">

Soil Moisture

</h5>

<div class="value" id="soilValue">

<?= $row['soil']; ?>%

</div>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card shadow">

<div class="card-body text-center">

<i class="fa-solid fa-leaf fa-3x text-success"></i>

<h5 class="mt-3">

Status Tanah

</h5>

<div class="value"
id="statusTanah"
style="font-size:28px;">

<?= $statusTanah; ?>

</div>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card shadow">

<div class="card-body text-center">

<i class="fa-solid fa-faucet-drip fa-3x text-primary"></i>

<h5 class="mt-3">

Pompa

</h5>

<div class="value"
id="statusPompa"
style="font-size:30px;">

<?= $row['pump']; ?>

</div>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card shadow">

<div class="card-body text-center">

<i class="fa-solid fa-clock fa-3x text-warning"></i>

<h5 class="mt-3">

Last Update

</h5>

<p id="lastUpdate">

<?= $row['created_at']; ?>

</p>

</div>

</div>

</div>

</div>

<div class="card shadow mt-4">

<div class="card-header bg-success text-white">

Monitoring Soil Moisture

</div>

<div class="card-body">

<div class="progress" style="height:30px;">

<div
id="progressBar"
class="progress-bar bg-success"
style="width:<?= $row['soil']; ?>%;">

<span id="progressText">

<?= $row['soil']; ?>%

</span>

</div>

</div>

</div>

</div>

<div class="card shadow mt-4">

    <div class="card-header bg-success text-white">
        Grafik Soil Moisture
    </div>

    <div class="card-body">

        <canvas id="soilChart"></canvas>

    </div>

</div>

<div class="mt-4">

<div class="d-flex gap-2">

<a href="../dashboard.php"
class="btn btn-success">

<i class="fa-solid fa-arrow-left"></i>

Dashboard

</a>

<a href="../export/export_excel.php"
class="btn btn-primary">

<i class="fa-solid fa-file-excel"></i>

Download Excel

</a>

</div>

</div>

</div>

<div class="footer">

<br>

© 2026 Sucrose Kelompok 1 [ 6 IKKA ]


</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

const ctx = document.getElementById('soilChart');

const soilChart = new Chart(ctx,{

type:'line',

data:{

labels:[],

datasets:[{

label:'Soil Moisture (%)',

data:[],

borderColor:'#28a745',

backgroundColor:'rgba(40,167,69,0.2)',

fill:true,

tension:0.4

}]

},

options:{

responsive:true,

plugins:{

legend:{
display:true
}

},

scales:{

y:{

beginAtZero:true,

max:100

}

}

}

});

function loadChart(){

fetch('chart.php')

.then(res=>res.json())

.then(data=>{

if(data.length==0) return;

let label=[];

let soil=[];

data.forEach(item=>{

label.push(item.waktu);

soil.push(item.soil);

});

soilChart.data.labels=label;

soilChart.data.datasets[0].data=soil;

soilChart.update();

});

}

function loadData(){

fetch("latest.php")

.then(res=>res.json())

.then(data=>{

document.getElementById("soilValue").innerHTML =
data.soil + "%";

document.getElementById("statusPompa").innerHTML =
data.pump;

document.getElementById("lastUpdate").innerHTML =
data.created_at;

document.getElementById("progressBar").style.width =
data.soil + "%";

document.getElementById("progressText").innerHTML =
data.soil + "%";

// Update Status Tanah
let status = "";

if(data.soil < 40){

    status = "TANAH KERING";

}
else if(data.soil < 70){

    status = "TANAH LEMBAB";

}
else{

    status = "TANAH BASAH";

}

document.getElementById("statusTanah").innerHTML = status;

});

}

loadChart();
loadData();

setInterval(function(){

    loadChart();
    loadData();

},5000);

</script>

</body>

</html>