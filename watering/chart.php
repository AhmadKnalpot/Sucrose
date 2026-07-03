<?php

include "../config/koneksi.php";

$query = mysqli_query($conn,"
SELECT
TIME(created_at) AS waktu,
soil
FROM monitoring
ORDER BY id DESC
LIMIT 20
");

$data = [];

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
}

echo json_encode(array_reverse($data));

?>