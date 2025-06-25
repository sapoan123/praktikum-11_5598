<?php
$conn = new mysqli("localhost", "root", "", "prak_5598");

// Ambil kategori untuk dropdown
$kategori = $conn->query("SELECT * FROM kategori");

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $conn->real_escape_string($_POST['judul']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $kategori_id = (int) $_POST['kategori'];
    $status = $conn->real_escape_string($_POST['status'] ?? 'pending');

    $conn->query("INSERT INTO tasks (judul, deskripsi, kategori_id, status) VALUES ('$judul', '$deskripsi', $kategori_id, '$status')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tugas</title>
    <!-- Tambahkan Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h5 class="card-title mb-4">Tambah Tugas</h5>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <?php while($row = $kategori->fetch_assoc()): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" selected>Pending</option>
                            <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Opsional, hanya jika butuh fitur JS-nya) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
