<?php
include 'database/connection.php';

// Fungsi untuk men-download file
function downloadFile($file) {
    $file_path = '../../uploads/' . basename($file); // Sanitasi nama file

    // Periksa apakah file ada
    if (file_exists($file_path)) {
        // Set header untuk transfer file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));

        // Bersihkan output buffer sebelum membaca file
        ob_clean();
        flush();
        readfile($file_path);
        exit;
    } else {
        // Tampilkan pesan jika file tidak ditemukan
        alertAndRedirect('File tidak ditemukan.', '../hasil.php');
    }
}

// Fungsi untuk menampilkan alert dan mengarahkan
function alertAndRedirect($message, $redirectUrl) {
    echo "<script>alert('$message'); window.location.href='$redirectUrl';</script>";
}

// Periksa apakah parameter file ada di URL
if (!empty($_GET['file'])) {
    downloadFile($_GET['file']); // Panggil fungsi download
} else {
    alertAndRedirect('Nama file tidak ditentukan.', '../hasil.php');
}
?>
