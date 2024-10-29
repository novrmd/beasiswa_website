<?php
require '../database/connection.php';

// Query to retrieve all scholarship applications from the database
$applicationsQuery = "SELECT * FROM daftar"; // Modify this query as needed
$applicationsResult = $conn->query($applicationsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/css/pendaftaran.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="container">
            <div class="telyu">
                <img src="..\asset\img\tel-u.png" alt="Logo Kampus" height="60">
                <span class="span1-text">Pendaftaran Beasiswa</span>
            </div>
            <ul>
                <li><a href="dashboard.php">Kategori Beasiswa</a></li>
                <li><a href="pendaftaran.php">Daftar Beasiswa</a></li>
                <li><a href="hasil.php">Hasil</a></li>
                <li><a href="../function/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Results Table -->
    <div class="container mt-5">
        <h3 class="text-center mb-4">Daftar Pendaftaran Beasiswa</h3>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>NIM Mahasiswa</th>
                    <th>Semester</th>
                    <th>IPK Terakhir</th>
                    <th>Pilihan Beasiswa</th>
                    <th>Berkas Syarat</th>
                    <th>Status Ajuan</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($applicationsResult->num_rows > 0): ?>
                    <?php while ($row = $applicationsResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
                            <td><?php echo htmlspecialchars($row['nim_mhs']); ?></td>
                            <td><?php echo htmlspecialchars($row['semester']); ?></td>
                            <td><?php echo htmlspecialchars($row['last_ipk']); ?></td>
                            <td><?php echo htmlspecialchars(ucfirst($row['beasiswa'])); ?></td>
                            <td>
                                <a href='/website-beasiswa-tup-main/website-beasiswa-tup-main/uploads/<?php echo htmlspecialchars($row['syarat_berkas']); ?>' target='_blank'>Lihat Berkas</a>
                            </td>
                            <td>
                                <?php echo ($row['status_ajuan'] == '1') ? "Sudah terverifikasi" : "Belum diverifikasi"; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan='9' class='text-center'>Belum ada pendaftaran</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
