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
    <title>Multimedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; background-color: #f4f9f9; } </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5 text-center">
        <h2 class="fw-bold mb-4">Kepoin Lagu & Video Favoritku 🎧</h2>
        
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm p-3" style="border-radius: 15px; border:none;">
                    <h5>Video Perkenalan / Hobi</h5>
                    <video width="100%" controls style="border-radius: 10px;">
                        <source src="./assets/kiminonawa.mp4" type="video/mp4">
                        Browser kamu tidak mendukung pemutar video.
                    </video>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm p-3" style="border-radius: 15px; border:none;">
                    <h5>Musik Kesukaan</h5>
                    <audio controls class="w-100 mt-3">
                        <source src="./assets/radwimps.mp3" type="audio/mpeg">
                        Browser kamu tidak mendukung pemutar audio.
                    </audio>
                </div>
            </div>
        </div>
    </div>
</body>
</html>