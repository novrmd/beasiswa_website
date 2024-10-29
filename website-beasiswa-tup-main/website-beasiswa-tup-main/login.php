<?php
session_start();

// Terminate session if user is already logged in
require 'database/connection.php';

// Redirect to dashboard if user is already logged in
if (isset($_SESSION['nama'])) {
    header("Location: page/dashboard.php");
    exit();
}

// Initialize error message variables
$errorMessage = [
    'email' => '',
    'password' => '',
    'general' => ''
];

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user data
    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email); // Bind the email parameter
    $query->execute();
    $resultSet = $query->get_result();

    if ($resultSet->num_rows > 0) {
        // Fetch user details
        $userData = $resultSet->fetch_assoc();

        // Verify the entered password with the stored hashed password
        if (password_verify($password, $userData['password'])) {
            // Store user name in session
            $_SESSION['nama'] = $userData['nama'];

            // Redirect to user dashboard
            header("Location: page/dashboard.php");
            exit();
        } else {
            $errorMessage['password'] = "Password yang Anda masukkan salah.";
        }
    } else {
        $errorMessage['email'] = "Pengguna tidak ditemukan.";
    }

    $query->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Beasiswa</title>
    <link rel="stylesheet" href="asset/css/style.css?v=1.0">
    <script>
        // Fungsi untuk memvalidasi email secara real-time
        function validateEmail() {
            const emailField = document.querySelector('input[name="email"]');
            const email = emailField.value.trim();

            // Validasi karakter '@' di dalam email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                emailField.setCustomValidity('Email harus mengandung karakter @');
                emailField.reportValidity();
                return;
            } else {
                emailField.setCustomValidity('');
            }
        }

    </script>
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="container">
            <div class="logo-text">
                <img src="asset/img/tel-u.png" alt="Logo Kampus" height="50"> <!-- Campus Logo -->
                <span class="navbar-text">Platform Beasiswa Telkom University</span>
            </div>
        </div>
    </nav>
    
    <h1>Masuk ke Akun Beasiswa</h1>

    <!-- Display error messages if they exist -->
    <?php if (!empty($errorMessage['general'])): ?>
        <p class="error"><?= $errorMessage['general'] ?></p>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
        <label for="email">Email</label>
        <input type="email" name="email" required onblur="validateEmail()">
        <p class="error" id="emailError"><?= $errorMessage['email'] ?></p>

        <label for="password">Password</label>
        <input type="password" name="password" required>
        <p class="error"><?= $errorMessage['password'] ?></p>

        <button type="submit">Masuk</button>
    </form>

    <div class="menu">
        <p>Belum memiliki akun?<a href="index.php">Daftar di sini</a></p>
    </div>
</body>
</html>
