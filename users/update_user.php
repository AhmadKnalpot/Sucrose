<?php
session_start();
require_once "../config/koneksi.php";

$id = $_POST['id'];
$nama = mysqli_real_escape_string($conn,$_POST['nama']);
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = $_POST['password'];

$sql = "UPDATE user SET
nama='$nama',
username='$username'";

if(!empty($password)){
    $password = md5($password);
    $sql .= ", password='$password'";
}

if(isset($_FILES['foto']) && $_FILES['foto']['error']==0){

    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

    $namaFoto = "user_".$id."_".time().".".$ext;

    move_uploaded_file(
        $_FILES['foto']['tmp_name'],
        "../assets/uploads/profile/".$namaFoto
    );

    $sql .= ", foto='$namaFoto'";
}

$sql .= " WHERE id='$id'";

if(mysqli_query($conn,$sql)){

    $_SESSION['nama']=$nama;
    $_SESSION['username']=$username;

    header("Location:user.php?success=1");

}else{

    echo mysqli_error($conn);

}