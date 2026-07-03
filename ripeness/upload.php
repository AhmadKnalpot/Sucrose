<?php

$folder="../uploads/";

$nama=time().".jpg";

move_uploaded_file(

$_FILES['melon']['tmp_name'],

$folder.$nama

);

header("Location:result.php?img=".$nama);

?>