<?php
// Mulai session
session_start();

// Hancurkan semua session yang ada
session_destroy();

// Arahkan kembali ke halaman awal (index.php)
header("location:index.php");
?>