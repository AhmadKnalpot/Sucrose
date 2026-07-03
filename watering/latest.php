<?php

include "../config/koneksi.php";

$query = mysqli_query($conn,"
SELECT *
FROM monitoring
ORDER BY id DESC
LIMIT 1
");

$row = mysqli_fetch_assoc($query);

echo json_encode($row);

?>