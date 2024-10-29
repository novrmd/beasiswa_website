<?php
session_start();

// Koneksi ke database
require 'database/connection.php';

// Inisialisasi variabel untuk error
$errorMessage = [
    'email' => '',
    'password' => '',
    'general' => ''
];

// Proses pendaftaran saat form dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Mengamankan input dari form
    $nama = $conn->real_escape_string(trim($_POST['nama']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // Meng-hash password

    // Periksa apakah email sudah terdaftar
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    
    if ($result && $result->num_rows > 0) {
        // Jika email sudah terdaftar, set pesan kesalahan
        $errorMessage['email'] = "Email ini sudah terdaftar, silakan gunakan email lain.";
    } else {
        // Menyimpan data pengguna baru ke database
        $insertQuery = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$hashedPassword')";
        
        if ($conn->query($insertQuery) === TRUE) {
            // Jika registrasi berhasil, arahkan ke halaman login
            header("Location: login.php");
            exit();
        } else {
            $errorMessage['general'] = "Registrasi gagal, silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - Beasiswa</title>
    <link rel="stylesheet" href="asset/css/style.css?v=1.0">
    <script>
        // Fungsi untuk memvalidasi email secara real-time
        function validateEmail() {
            const emailField = document.querySelector('input[name="email"]');
            const emailError = document.getElementById('emailError');
            const email = emailField.value.trim();

            // Mengosongkan pesan kesalahan sebelumnya
            emailError.textContent = '';

            // Validasi karakter '@' di dalam email
            if (!email.includes('@')) {
                emailField.setCustomValidity('Email harus mengandung karakter @');
                emailField.reportValidity();
                return;
            } else {
                emailField.setCustomValidity('');
            }

            // Validasi format email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                emailError.textContent = 'Email tidak valid.';
                return;
            }

            // Memeriksa apakah email sudah terdaftar
            fetch('check_email.php?email=' + encodeURIComponent(email))
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        emailError.textContent = 'Email ini sudah terdaftar, silakan gunakan email lain.';
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function validatePassword() {
            const passwordField = document.querySelector('input[name="password"]');
            const password = passwordField.value;

            // Validasi panjang minimal 8 karakter
            if (password.length < 8) {
                passwordField.setCustomValidity('Password harus mengandung minimal 8 karakter');
                passwordField.reportValidity();
            } else {
                passwordField.setCustomValidity('');
            }
        }
    </script>
</head>
<body>

    <!-- Navigasi -->
    <nav>
        <div class="container">
            <div class="logo-text">
                <img src="asset/img/tel-u.png" alt="Logo Kampus" height="50"> <!-- Logo Kampus -->
                <span class="navbar-text">Platform Beasiswa Telkom University</span>
            </div>
        </div>
    </nav>
    
    <!-- Bagian Registrasi -->
    <div class="form-section">
        <h2>Daftar untuk Akun Beasiswa</h2>

        <!-- Tampilkan pesan kesalahan umum jika ada -->
        <?php if (!empty($errorMessage['general'])): ?>
            <p class="error"><?= $errorMessage['general'] ?></p>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($nama ?? '') ?>" required>
            
            <label for="email">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required onblur="validateEmail()">
            <p class="error" id="emailError"><?= $errorMessage['email'] ?></p>
            
            <label for="password">Password</label>
            <input type="password" name="password" required onblur="validatePassword()">
            <?php if (!empty($errorMessage['password'])): ?>
                <p class="error"><?= $errorMessage['password'] ?></p>
            <?php endif; ?>
            
            <button type="submit">Daftar</button>
        </form>

        <div class="menu">
            <p>Sudah memiliki akun?<a href="login.php">Masuk di sini</a></p>
        </div>
    </div>

</body>
</html>
