<?php
session_start();
// Tetap gunakan pengaman session agar halaman PDF tidak bisa diakses orang asing
if($_SESSION['status'] != "sudah_login"){
    header("location:login.php");
    exit;
}

include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS khusus saat halaman di-print/di-ekspor ke PDF */
        @media print {
            @page { margin: 2cm; }
            body { font-family: Arial, sans-serif; }
            /* Menyembunyikan elemen yang tidak perlu di PDF (jika ada) */
            .no-print { display: none; }
        }
    </style>
</head>
<body class="p-4">

    <div class="text-center mb-4">
        <h3 class="fw-bold">LAPORAN DATA PENGUNJUNG</h3>
        <p>Buku Tamu Digital MyProfile</p>
        <hr style="border: 1px solid #000;">
    </div>

    <table class="table table-bordered border-dark">
        <thead class="table-light">
            <tr>
                <th width="5%">No.</th>
                <th width="35%">Nama</th>
                <th width="20%">Status</th>
                <th width="40%">Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query_tampil = mysqli_query($koneksi, "SELECT * FROM buku_tamu_naufal_2430511010 ORDER BY id ASC");
            while ($row = mysqli_fetch_assoc($query_tampil)) {
            ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td>
                    <?php 
                    // Konversi data berupa teks agar rapi di PDF (tanpa badge warna warni)
                    echo ($row['status'] == 1) ? 'Hadir' : 'Titip Salam'; 
                    ?>
                </td>
                <td class="text-center">
                    <img src="<?= $row['tanda_tangan']; ?>" alt="TTD" style="max-height: 50px;">
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>