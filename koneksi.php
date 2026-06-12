<?php
// koneksi.php

$host     = "localhost"; // Server database lokal
$username = "root";      // Default username XAMPP/Laragon
$password = "";          // Default password (biasanya kosong)
$database = "db_myprofile"; // Nama database yang baru saja dibuat

// Melakukan koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    // Jika gagal, hentikan program dan tampilkan error
    die("Aduh, koneksi ke database gagal nih: " . mysqli_connect_error());
}

// HAPUS ATAU KOMENTARI baris di bawah ini kalau koneksi sudah berhasil
// echo "Mantap! Koneksi ke database berhasil.";
?>