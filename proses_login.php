<?php
// Wajib dipanggil untuk memulai session
session_start();

// Hubungkan ke database
include 'koneksi.php';

// Tangkap data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Cari username di tabel users
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$cek = mysqli_num_rows($query);

// Jika username ditemukan
if($cek > 0) {
    $data = mysqli_fetch_assoc($query);
    
    // Verifikasi password yang diketik dengan hash yang ada di database
    if(password_verify($password, $data['password'])) {
        // Jika cocok, buat session (kartu tamu)
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "sudah_login"; // Ini kunci utamanya
        
        // Arahkan ke dashboard
        header("location:dashboard.php");
    } else {
        // Jika password salah
        echo "<script>alert('Aduh, Password salah nih!'); window.location='login.php';</script>";
    }
} else {
    // Jika username tidak ada
    echo "<script>alert('Username tidak ditemukan!'); window.location='login.php';</script>";
}
?>