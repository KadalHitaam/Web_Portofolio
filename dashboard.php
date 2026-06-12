<?php
session_start();
// Cek apakah user sudah punya tiket login
if($_SESSION['status'] != "sudah_login"){
    // Kalau belum login, tendang balik ke halaman login
    header("location:login.php?pesan=belum_login");
    exit; // Hentikan script agar kode HTML di bawahnya tidak sempat dimuat
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; background-color: #f4f9f9; } </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <div class="card shadow-sm p-4" style="border-radius: 15px; border: none;">
            <h2 class="fw-bold">Sekilas Aku</h2>
            <hr>
            <p class="fs-5">Hai, namaku Naufal, aku merupakan mahasiswa Teknik Informatika di Universitas Muhammadiyah Sukabumi.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>