<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beasiswa Non-Akademik</title>
    <link rel="stylesheet" href="../asset/css/artikel.css?v=1.1">
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="container">
            <div class="telyu">
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

    <header>
        <h1>Beasiswa Non-Akademik</h1>
    </header>

    <main>
        <div class="content">
            <div class="flex-container"> 
            <div class="col-md-6">
                    <div class="image-container">
                        <img src="../asset/img/non-akademik.jpg" alt="Beasiswa Non Akademik" style="width:100%; max-width:1000px;">
                    </div>
                </div>

                <div class="article1">
                    <h2>Persyaratan Pendaftaran</h2>
                    <p><strong>Syarat:</strong> Memiliki IPK minimum 3.0, serta berprestasi dalam kegiatan non-akademik, seperti olahraga dan seni.</p>
                    <p><strong>Dokumen yang Diperlukan:</strong></p>
                    <ul>
                        <li>KTM (Kartu Tanda Mahasiswa)</li>
                        <li>Transkrip nilai terbaru</li>
                        <li>Portofolio kejuaraan atau prestasi</li>
                        <li>Pas foto ukuran 4x6</li>
                    </ul>
                    <h2>Manfaat Beasiswa</h2>
                    <ul>
                        <li>Penggantian biaya pendidikan UKT</li>
                        <li>Bantuan biaya hidup sebesar Rp750.000 per bulan</li>
                    </ul>
                    <section>
                        <h2>Informasi Kontak</h2>
                        <p>Untuk pertanyaan lebih lanjut, silakan hubungi kami di <strong>admin@telkomuniversity.ac.id</strong>.</p>
                    </section>
                </div>
            </div>

            <section class="container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Ringkasan Penerima Beasiswa</h1>
                        <p>Beasiswa ini ditujukan untuk mahasiswa berprestasi di bidang non-akademik, mencakup olahraga, seni, dan kreativitas. Setiap pendaftar wajib memenuhi syarat dan melalui proses seleksi yang ketat.</p>
                        <p>Penerima beasiswa akan mendapatkan bantuan biaya pendidikan dan biaya hidup selama satu semester, yang dapat diperpanjang jika prestasi yang dicapai terus memenuhi kriteria.</p>
                    </div>
                    <div class="col-md-6">
                        <h3>Data Pendaftar Beasiswa Non-Akademik</h3>
                        <canvas id="nonAcademicChart"></canvas> <!-- Placeholder for Bar Chart -->
                    </div>
                </div>
            </section>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                const ctxNonAcademic = document.getElementById('nonAcademicChart').getContext('2d');
                const nonAcademicChart = new Chart(ctxNonAcademic, {
                    type: 'bar',
                    data: {
                        labels: ['2020', '2021', '2022', '2023'],
                        datasets: [{
                            label: 'Jumlah Pendaftar Non-Akademik',
                            data: [30, 50, 70, 90], // Updated data values
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
        </div>
    </main>

</body>
</html>
