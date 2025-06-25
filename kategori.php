<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "prak_5598");

// Tambah kategori jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nama_kategori'])) {
    $nama = $conn->real_escape_string($_POST['nama_kategori']);
    $conn->query("INSERT INTO kategori (nama) VALUES ('$nama')");
    header("Location: kategori.php"); // Redirect setelah submit
}

// Ambil semua kategori
$result = $conn->query("SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Kategori</title>
    <!-- Tambah Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h4 class="mb-4">Kelola Kategori</h4>

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Daftar Kategori</h5>
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Tambah Kategori Baru</h5>
                <form method="post" class="d-flex gap-2">
                    <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" required>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
