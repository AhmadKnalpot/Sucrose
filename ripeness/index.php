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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sucrose | Ripeness Detection</title>

    <link rel="stylesheet" href="../assets/css/ripeness.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

    <header>

        <div class="logo">
    <img src="../assets/img/logo.png" alt="Sucrose Logo" class="logo-img">
    <h2>SUCROSE</h2>
</div>

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

    </header>

    <section class="hero">

        <div class="overlay">

            <h1>Melon Ripeness Detection</h1>

            <p>
                Deteksi tingkat kematangan buah melon berdasarkan
                kerapatan pola netting menggunakan Artificial Intelligence.
            </p>

        </div>

    </section>

    <section class="container">

        <div class="card">

            <h2>
                <i class="fa-solid fa-qrcode"></i>
                Scan QR Code
            </h2>

            <!-- Preview QR -->
            <div class="preview-box">
    <img
        src="../assets/img/qr.png"
        alt="QR Code"
        class="qr-image">
</div>

            <button id="predict">

                <i class="fa-solid fa-mobile-screen-button"></i>

                Scan Sekarang

            </button>

        </div>

    </section>

    <footer>

© 2026 Sucrose Kelompok 1 [ 6 IKKA ]

    </footer>

</body>

</html>