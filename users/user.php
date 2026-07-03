<?php
require_once "../config/koneksi.php";

session_start();
require_once "../config/koneksi.php";

if(!isset($_SESSION['id'])){
    header("Location: ../index.php");
    exit;
}

$id = $_SESSION['id'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
$user = mysqli_fetch_assoc($query);

// Foto default jika belum ada
$foto="../assets/img/avatar.png";

if(
isset($user['foto']) &&
$user['foto']!="" &&
file_exists("../assets/uploads/profile/".$user['foto'])
){

$foto="../assets/uploads/profile/".$user['foto'];

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile | SUCROSE</title>

    <link rel="stylesheet" href="../assets/css/user.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<header>

    <div class="logo">

        <img src="../assets/img/logo.png" class="logo-img">

        <h2>SUCROSE</h2>

    </div>

    <nav>

        <a href="../dashboard.php">
            <i class="fa-solid fa-house"></i>
            Home
        </a>
        <a href="../logout.php"
       class="btn btn-danger">

        <i class="fa-solid fa-right-from-bracket"></i>

        Logout

    </a>

    </nav>

</header>

<div class="profile-container">

    <!-- PROFILE -->

    <div class="profile-card">

        <div class="profile-photo">

            <img src="<?= $foto ?>" id="preview">

            <label for="foto">

                <i class="fa-solid fa-camera"></i>

                Ganti Foto

            </label>

        </div>

        <div class="profile-info">

            <h2><?= $user['nama']; ?></h2>

            <p>

                <i class="fa-solid fa-user"></i>

                <?= $user['username']; ?>

            </p>

            <span class="badge">

                <?= strtoupper($user['role']); ?>

            </span>

        </div>

    </div>

    <!-- FORM -->

    <div class="edit-card">

        <h3>

            <i class="fa-solid fa-user-pen"></i>

            Edit Profil

        </h3>

        <?php if(isset($_GET['success'])){ ?>

<div class="success">

<i class="fa-solid fa-circle-check"></i>

Profil berhasil diperbarui.

</div>

<?php } ?>

        <form action="update_user.php"
            method="POST"
            enctype="multipart/form-data">

            <input type="hidden"
                name="id"
                value="<?= $user['id']; ?>">

            <div class="form-group">

                <label>Nama Lengkap</label>

                <input
                    type="text"
                    name="nama"
                    value="<?= $user['nama']; ?>"
                    required>

            </div>

            <div class="form-group">

                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    value="<?= $user['username']; ?>"
                    required>

            </div>

            <div class="form-group">

                <label>Password Baru</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Kosongkan jika tidak diubah">

            </div>

            <div class="form-group">

    <label>Foto Profil</label>

    <label class="upload-btn" for="foto">
        <i class="fa-solid fa-image"></i>
        Pilih Foto
    </label>

    <input
        type="file"
        id="foto"
        name="foto"
        accept="image/*"
        hidden>

</div>

            <button type="submit">

                <i class="fa-solid fa-floppy-disk"></i>

                Simpan Perubahan

            </button>

        </form>

    </div>

</div>

<script>

const foto = document.getElementById("foto");
const preview = document.getElementById("preview");

foto.addEventListener("change", function(){

    const file = this.files[0];

    if(file){

        preview.src = URL.createObjectURL(file);

    }

});

</script>
<footer>

    <div class="footer-content">

        <p>
            <i class="fa-solid fa-seedling"></i>
            © 2026 <strong>SUCROSE</strong> | Sucrose Kelompok 1 [ 6 IKKA ]

        </p>

    </div>

</footer>
</body>

</html>