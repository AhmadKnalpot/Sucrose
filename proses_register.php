<?php

include "config/koneksi.php";

$nama       = htmlspecialchars($_POST['nama']);
$username   = htmlspecialchars($_POST['username']);
$role       = $_POST['role'];
$password   = $_POST['password'];
$konfirmasi = $_POST['konfirmasi'];

// Cek konfirmasi password
if ($password != $konfirmasi) {

    echo "<script>
    alert('Konfirmasi password tidak sesuai');
    window.history.back();
    </script>";

    exit;
}

// Cek username
$cek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

if (mysqli_num_rows($cek) > 0) {

    echo "<script>
    alert('Username sudah digunakan');
    window.history.back();
    </script>";

    exit;
}

// Hash password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$foto = "avatar.png";

// Simpan ke database
mysqli_query($conn, "INSERT INTO user
(nama, username, password, role, foto)
VALUES
('$nama','$username','$passwordHash','$role','$foto')");

echo "<script>
alert('Registrasi Berhasil');
window.location='login.php';
</script>";

?>