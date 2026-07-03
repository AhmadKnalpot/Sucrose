<?php

include "../config/koneksi.php";

$soil=$_POST['soil'];
$status=$_POST['status'];
$pump=$_POST['pump'];

mysqli_query($conn,

"INSERT INTO monitoring(soil,status_tanah,pump)VALUES('$soil','$status','$pump')");

echo "SUCCESS";

?>