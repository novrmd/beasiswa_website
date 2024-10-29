<?php
include '../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $inputData = [
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'nomorhp' => $_POST['noHp'],
        'nim_mhs' => $_POST['nim_mhs'],
        'semester' => $_POST['semester'],
        'ipk' => $_POST['last_ipk'],
        'beasiswa' => $_POST['beasiswa'],
        'berkas' => $_FILES['berkas']
    ];

    $status = '0';

    if (in_array('', $inputData)) {
        echo "<script>alert('Semua kolom harus diisi')</script>";
    } elseif ($inputData['beasiswa'] == '0' || $inputData['beasiswa'] == '') {
        echo "Tidak Memenuhi Syarat beasiswa";
    } elseif ($inputData['berkas']['error'] === 0) {
        $allowedExts = ['pdf', 'doc', 'docx'];
        $berkas_ext = strtolower(pathinfo($inputData['berkas']['name'], PATHINFO_EXTENSION));

        if (in_array($berkas_ext, $allowedExts)) {
            $upload_dir = '../uploads/';
            $berkas_path = $upload_dir . basename($inputData['berkas']['name']);

            if (move_uploaded_file($inputData['berkas']['tmp_name'], $berkas_path)) {
                $sql = "INSERT INTO daftar (nama, email, no_hp, nim_mhs, semester, last_ipk, beasiswa, syarat_berkas, status_ajuan) 
                        VALUES ('{$inputData['nama']}', '{$inputData['email']}', '{$inputData['nomorhp']}', '{$inputData['nim_mhs']}', '{$inputData['semester']}', '{$inputData['ipk']}', '{$inputData['beasiswa']}', '{$inputData['berkas']['name']}', '$status')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Data berhasil ditambahkan'); window.location.href='hasil.php';</script>";
                } else {
                    echo "<script>alert('Data gagal ditambahkan ke database')</script>";
                }
            } else {
                echo "<script>alert('Gagal mengupload berkas')</script>";
            }
        } else {
            echo "<script>alert('Berkas tidak diperbolehkan. Harus dalam format pdf, doc, atau docx.')</script>";
        }
    } else {
        echo "<script>alert('Terjadi kesalahan dalam upload berkas')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/css/pendaftaran.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
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

    <!-- Form Section -->
    <div class="container mt-5">
        <div class="form-section bg-light p-4 shadow rounded">
            <h3>Form Pendaftaran</h3>
            <form id="beasiswaForm" action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="noHp" class="form-label">No. HP</label>
                            <input type="tel" class="form-control" id="noHp" name="noHp" pattern="[0-9]+" required>
                        </div>
                        <div class="mb-3">
                            <label for="nim_mhs" class="form-label">NIM Mahasiswa</label>
                            <input type="text" class="form-control" id="nim_mhs" name="nim_mhs" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester Saat Ini</label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="" disabled selected>Pilih Semester</option>
                                <?php for ($i = 1; $i <= 8; $i++): ?>
                                    <option value="<?= $i ?>">Semester <?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ipk" class="form-label">IPK Terakhir</label>
                            <input type="text" class="form-control" id="ipk" disabled required>
                            <input type="hidden" name="last_ipk" id="last_ipk">
                        </div>
                        <div class="mb-3">
                            <label for="beasiswa" class="form-label">Pilih Beasiswa</label>
                            <select class="form-select" id="beasiswa" name="beasiswa" disabled>
                                <option value="" disabled selected>Pilih Beasiswa</option>
                                <option value="akademik">Beasiswa Akademik</option>
                                <option value="non-akademik">Beasiswa Non-Akademik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="berkas" class="form-label">Upload Berkas Syarat</label>
                            <span>Semua berkas syarat digabung menjadi satu format .pdf</span>
                            <input class="form-control" type="file" id="berkas" name="berkas" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-danger">Batal</button>
                    <button type="submit" name="submit" id="submitBtn" class="button" disabled>Daftar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const semesterSelect = document.getElementById('semester');
            const beasiswaSelect = document.getElementById('beasiswa');
            const ipkField = document.getElementById('ipk');
            const submitBtn = document.getElementById('submitBtn');
            const emailInput = document.getElementById('email');
            const noHpInput = document.getElementById('noHp');

            const ipkValues = {1: 3.00, 2: 3.10, 3: 3.20, 4: 3.30, 5: 3.40, 6: 3.50, 7: 3.60, 8: 3.70};

            semesterSelect.addEventListener('change', function () {
                const ipkValue = ipkValues[semesterSelect.value] || 0;
                ipkField.value = ipkValue.toFixed(2);
                document.getElementById('last_ipk').value = ipkValue;
                beasiswaSelect.disabled = ipkValue < 3;
            });

            document.getElementById('beasiswaForm').addEventListener('input', function () {
                submitBtn.disabled = !this.checkValidity();
            });

            emailInput.addEventListener('input', function () {
                this.setCustomValidity(this.value.includes('@') ? '' : 'Email harus mengandung karakter @');
                this.reportValidity();
            });

            noHpInput.addEventListener('input', function () {
                this.setCustomValidity(/^[0-9]+$/.test(this.value) ? '' : 'Nomor HP hanya boleh berisi angka');
                this.reportValidity();
            });
        });
    </script>
</body>
</html>
