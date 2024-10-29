<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Beasiswa Akademik</title>
    <link rel="stylesheet" href="../asset/css/artikel.css?v=1.1">
</head>
<body>

    <!-- Navbar Section -->
    <nav>
        <div class="container">
            <div class="telyu">
                <img src="../asset/img/tel-u.png" alt="Logo Telkom University" height="60">
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

    <!-- Header Section -->
    <header>
        <h1>Beasiswa Akademik</h1>
    </header>

    <!-- Main Content Area -->
    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="image-container">
                        <img src="../asset/img/akademik.jpg" alt="Beasiswa Akademik" style="width:100%; max-width:600px;">
                    </div>
                </div>

                <div class="col-md-6">
                    <h2>Persyaratan Pendaftaran</h2>
                    <p><strong>Syarat:</strong> Memiliki IPK minimal 3.0 dan aktif berpartisipasi dalam kegiatan ilmiah.</p>
                    <p><strong>Dokumen yang Diperlukan:</strong></p>
                    <ul>
                        <li>Fotokopi Kartu Tanda Mahasiswa (KTM)</li>
                        <li>Salinan transkrip nilai terbaru</li>
                        <li>Surat keterangan tidak sedang menerima beasiswa lain</li>
                        <li>Pas foto berukuran 4x6</li>
                    </ul>
                    <h2>Manfaat Beasiswa</h2>
                    <ul>
                        <li>Biaya pendidikan UKT penuh</li>
                        <li>Biaya hidup sebesar Rp750.000 per bulan</li>
                    </ul>

                    <!-- Contact Information Section -->
                    <h2>Informasi Kontak</h2>
                    <p>Untuk informasi lebih lanjut, silakan hubungi kami di <strong>admin@telkomuniversity.ac.id</strong>.</p>
                </div>
            </div>

            <!-- Additional Information and Chart Section -->
            <div class="row mt-5">
                <div class="col-md-6">
                    <h1>Ringkasan Penerima Beasiswa</h1>
                    <p>Beasiswa ini ditujukan bagi mahasiswa yang menunjukkan prestasi tinggi di bidang akademik. Setiap pendaftar harus memenuhi kriteria yang telah ditetapkan dan akan melalui proses seleksi yang ketat.</p>
                    <p>Penerima beasiswa akan mendapatkan dukungan biaya pendidikan untuk satu tahun akademik, dengan kemungkinan untuk diperpanjang jika memenuhi syarat prestasi.</p>
                </div>
                <div class="col-md-6">
                    <h3>Data Pendaftar Beasiswa</h3>
                    <canvas id="scholarshipChart"></canvas> <!-- Placeholder for Bar Chart -->
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('scholarshipChart').getContext('2d');
            const scholarshipChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['2019', '2020', '2021', '2022'], // Update years
                    datasets: [{
                        label: 'Jumlah Pendaftar Beasiswa',
                        data: [60, 80, 120, 150], // Update example data
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </main>
</body>
</html>
