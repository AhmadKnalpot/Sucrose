<?php

include "../config/koneksi.php";

// Header Download Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Sucrose_".date("Ymd_His").".xls");

// Statistik
$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM monitoring"));

$rata = mysqli_fetch_assoc(mysqli_query($conn,"SELECT ROUND(AVG(soil),2) rata FROM monitoring"));

$max = mysqli_fetch_assoc(mysqli_query($conn,"SELECT MAX(soil) nilai FROM monitoring"));

$min = mysqli_fetch_assoc(mysqli_query($conn,"SELECT MIN(soil) nilai FROM monitoring"));

$on = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) jumlah FROM monitoring WHERE pump='ON'"));

$off = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) jumlah FROM monitoring WHERE pump='OFF'"));

$query = mysqli_query($conn,"SELECT * FROM monitoring ORDER BY created_at DESC");

?>

<html>

<head>

<meta charset="UTF-8">

<style>

body{

font-family:Calibri;

font-size:11pt;

}

table{

border-collapse:collapse;

width:100%;

}

th{

background:#198754;

color:white;

border:1px solid black;

padding:8px;

}

td{

border:1px solid black;

padding:6px;

}

.judul{

font-size:22px;

font-weight:bold;

text-align:center;

}

.subjudul{

font-size:14px;

text-align:center;

}

.green{

background:#198754;

color:white;

font-weight:bold;

}

.red{

background:#dc3545;

color:white;

font-weight:bold;

}

.yellow{

background:#ffc107;

font-weight:bold;

}

.info td{

border:none;

padding:3px;

}

</style>

</head>

<body>

<table style="width:100%; border:0;">

<tr>

<td colspan="5"
style="background:#198754;
color:white;
font-size:24px;
font-weight:bold;
text-align:center;
padding:15px;">

SUCROSE SMART AGRICULTURE IoT

</td>

</tr>

<tr>

<td colspan="5"
style="text-align:center;
font-size:16px;
padding:10px;
font-weight:bold;">

LAPORAN MONITORING WATERING SYSTEM

</td>

</tr>

<tr>

<td colspan="5"
style="text-align:center;
font-size:12px;">

Internet of Things (IoT) untuk Monitoring Kelembapan Tanah
dan Penyiraman Otomatis Tanaman Melon

</td>

</tr>

</table>

<hr>

<hr>

<br>

<table class="info">

<tr>

<td width="200"><b>Tanggal Cetak</b></td>

<td><?=date("d F Y H:i:s")?></td>

</tr>

<tr>

<td><b>Total Monitoring</b></td>

<td><?=$total['total']?></td>

</tr>

</table>

<br>

<table>

<tr>

<th colspan="2">

RINGKASAN MONITORING

</th>

</tr>

<tr>

<td>Rata-rata Soil Moisture</td>

<td><?=$rata['rata']?> %</td>

</tr>

<tr>

<td>Soil Moisture Maksimum</td>

<td><?=$max['nilai']?> %</td>

</tr>

<tr>

<td>Soil Moisture Minimum</td>

<td><?=$min['nilai']?> %</td>

</tr>

<tr>

<td>Pompa Menyala</td>

<td><?=$on['jumlah']?> Kali</td>

</tr>

<tr>

<td>Pompa Mati</td>

<td><?=$off['jumlah']?> Kali</td>

</tr>

</table>

<br><br>

<table>

<tr>

<th>No</th>

<th>Waktu</th>

<th>Soil Moisture</th>

<th>Status Tanah</th>

<th>Status Pompa</th>

</tr>

<?php

$no=1;

while($row=mysqli_fetch_assoc($query)){

if($row['soil']<40){

$status="KERING";

$class="red";

}
elseif($row['soil']<70){

$status="LEMBAB";

$class="yellow";

}
else{

$status="BASAH";

$class="green";

}

?>

<tr>

<td><?=$no++?></td>

<td><?=$row['created_at']?></td>

<td><?=$row['soil']?> %</td>

<td class="<?=$class?>"><?=$status?></td>

<td><?=$row['pump']?></td>

</tr>

<?php

}

?>

</table>

<br><br>

<table class="info">

<tr>

<td>

Dicetak oleh :

<b>Sistem Sucrose Smart Agriculture IoT</b>

</td>

</tr>

<tr>

<td>

Tanggal :

<?=date("d-m-Y H:i:s")?>

</td>

</tr>

</table>

</body>

</html>