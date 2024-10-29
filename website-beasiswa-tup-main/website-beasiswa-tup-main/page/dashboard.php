<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Beasiswa</title>
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="container">
            <div class="telyu"> <!-- Set background color to red here -->
                <img src="../asset/img/tel-u.png" alt="Logo Kampus" height="60">
                <span class="span-text">Pendaftaran Beasiswa</span>
            </div>
            <ul>
                <li><a href="dashboard.php">Kategori Beasiswa</a></li>
                <li><a href="pendaftaran.php">Daftar Beasiswa</a></li>
                <li><a href="hasil.php">Hasil</a></li>
                <li><a href="../function/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <?php
    session_start();
    ?>

    <div class="scholarship-section">
        <h1>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h1>
        <h2>Daftar beasiswa sesuai dengan pilihanmu sekarang!</h2>

        <!-- Scholarship Cards -->
        <div class="scholarship-cards">
            <!-- Beasiswa Akademik Card -->
            <a href="../page/akademik.php" style="text-decoration:none; color:inherit;">
                <div class="card">
                    <img src="../asset/img/akademik.jpg" alt="Beasiswa Akademik" style="width:100%;">
                    <h4>Beasiswa Akademik</h4>
                    <p><strong>Syarat:</strong> Memiliki IPK minimal 3.0 dan aktif berpartisipasi dalam kegiatan ilmiah.</p>
                </div>
            </a>

            <!-- Beasiswa Non-Akademik Card -->
            <a href="../page/non_akademik.php" style="text-decoration:none; color:inherit;">
                <div class="card">
                    <img src="../asset/img/non-akademik.jpg" alt="Beasiswa Non-Akademik" style="width:100%;">
                    <h4>Beasiswa Non-Akademik</h4>
                    <p><strong>Syarat:</strong> Memiliki IPK minimum 3.0, serta berprestasi dalam kegiatan non-akademik, seperti olahraga dan seni.</p>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
