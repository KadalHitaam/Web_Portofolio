<?php
session_start();
// Cek apakah user sudah punya tiket login
if($_SESSION['status'] != "sudah_login"){
    // Kalau belum login, tendang balik ke halaman login
    header("location:login.php?pesan=belum_login");
    exit; // Hentikan script agar kode HTML di bawahnya tidak sempat dimuat
}
// Panggil koneksi database
include 'koneksi.php';

// ==== PROSES SIMPAN DATA (CREATE & UPLOAD MULTIPLE) ====
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $status = $_POST['status']; // Mengambil nilai dropdown status
    $ttd_base64 = $_POST['ttd_base64']; // Mengambil data gambar TTD dari input hidden

    // 1. Simpan ke tabel buku_tamu
    $query_tamu = mysqli_query($koneksi, "INSERT INTO buku_tamu (nama, status, tanda_tangan) VALUES ('$nama', '$status', '$ttd_base64')");
    
    if ($query_tamu) {
        // Ambil ID tamu yang baru saja masuk
        $id_tamu = mysqli_insert_id($koneksi);

        // 2. Proses Upload Multiple File
        $jumlah_file = count($_FILES['files']['name']);
        for ($i = 0; $i < $jumlah_file; $i++) {
            $nama_file = $_FILES['files']['name'][$i];
            $tmp_name = $_FILES['files']['tmp_name'][$i];
            
            // Cek jika ada file yang diupload
            if ($nama_file != "") {
                $folder_tujuan = "uploads/" . $nama_file;
                move_uploaded_file($tmp_name, $folder_tujuan); // Pindahkan file ke folder uploads
                
                // Simpan nama file ke tabel file_tamu
                mysqli_query($koneksi, "INSERT INTO file_tamu (id_tamu, nama_file) VALUES ('$id_tamu', '$nama_file')");
            }
        }
        echo "<script>alert('Data berhasil disimpan!'); window.location='guestbook.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; background-color: #f4f9f9; } </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm p-4" style="border-radius: 15px; border: none;">
                    <h4>Isi Buku Tamu 📝</h4>
                    <form action="guestbook.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Nama Pengunjung</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="1">Hadir</option>
                                <option value="2">Titip Salam</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload File (Bisa Banyak)</label>
                            <input type="file" class="form-control" name="files[]" multiple required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanda Tangan Digital</label><br>
                            <canvas id="canvasTTD" width="300" height="150" style="border: 2px dashed #a4cbee; background: #fff; border-radius: 10px;"></canvas>
                            <br>
                            <button type="button" class="btn btn-sm btn-warning mt-2" onclick="clearCanvas()">Hapus TTD</button>
                            <input type="hidden" name="ttd_base64" id="ttd_base64" required>
                        </div>
                        <button type="submit" class="btn w-100" style="background-color: #a4cbee; border:none; color:#333; font-weight:bold;">Simpan Data</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm p-4" style="border-radius: 15px; border: none;">
                    <h4>Data Pengunjung</h4>
                    <table class="table table-striped mt-3" id="tabelTamu">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Mengambil data dari database
                            $no = 1;
                            $query_tampil = mysqli_query($koneksi, "SELECT * FROM buku_tamu ORDER BY id DESC");
                            while ($row = mysqli_fetch_assoc($query_tampil)) {
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td>
                                    <?php if($row['status'] == 1): ?>
                                        <span class="badge bg-success">Hadir</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Titip Salam</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info text-white fw-bold" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id']; ?>">Detail</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalDetail<?= $row['id']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #d0e8f2;">
                                            <h5 class="modal-title">Detail Pengunjung</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p><strong>Nama:</strong> <?= $row['nama']; ?></p>
                                            <p><strong>Tanda Tangan:</strong></p>
                                            <img src="<?= $row['tanda_tangan']; ?>" alt="TTD" style="border:1px solid #ccc; max-width: 100%;">
                                            
                                            <hr>
                                            <p><strong>File yang diupload:</strong></p>
                                            <ul style="list-style: none; padding:0;">
                                                <?php
                                                // Ambil file terkait dari tabel file_tamu
                                                $id_tamu_sekarang = $row['id'];
                                                $query_file = mysqli_query($koneksi, "SELECT * FROM file_tamu WHERE id_tamu = '$id_tamu_sekarang'");
                                                while($file = mysqli_fetch_assoc($query_file)){
                                                    echo "<li><a href='uploads/".$file['nama_file']."' target='_blank'>".$file['nama_file']."</a></li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        // 1. Inisialisasi DataTables
        $(document).ready(function() {
            $('#tabelTamu').DataTable();
        });

        // 2. Script Logika Canvas Tanda Tangan
        const canvas = document.getElementById('canvasTTD');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;

        // Saat mouse ditekan, mulai menggambar
        canvas.addEventListener('mousedown', (e) => {
            isDrawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        });

        // Saat mouse digeser, buat garis
        canvas.addEventListener('mousemove', (e) => {
            if (isDrawing) {
                ctx.lineTo(e.offsetX, e.offsetY);
                ctx.stroke();
                ctx.lineWidth = 2; // Ketebalan tinta
                ctx.lineCap = 'round'; // Ujung garis membulat
            }
        });

        // Saat mouse dilepas, stop menggambar & simpan hasilnya ke input hidden
        canvas.addEventListener('mouseup', () => {
            isDrawing = false;
            document.getElementById('ttd_base64').value = canvas.toDataURL(); // Convert coretan jadi kode Base64
        });

        // Fungsi Tombol Hapus TTD
        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            document.getElementById('ttd_base64').value = ""; // Kosongkan input hidden
        }
    </script>
</body>
</html>