<?php
$conn = new mysqli("localhost", "root", "", "prak_5598");

$id = (int)$_GET['id'];
// Ambil data tugas berdasarkan ID
$tugas = $conn->query("SELECT * FROM tasks WHERE id = $id")->fetch_assoc();
$kategori = $conn->query("SELECT * FROM kategori");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $conn->real_escape_string($_POST['judul']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $kategori_id = (int)$_POST['kategori'];
    $status = $conn->real_escape_string($_POST['status']);

    $conn->query("UPDATE tasks SET judul='$judul', deskripsi='$deskripsi', kategori_id=$kategori_id, status='$status' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tugas</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h5 class="card-title mb-4">Edit Tugas</h5>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($tugas['judul']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required><?= htmlspecialchars($tugas['deskripsi']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <?php while($k = $kategori->fetch_assoc()): ?>
                                <option value="<?= $k['id'] ?>" <?= ($k['id'] == $tugas['kategori_id']) ? 'selected' : '' ?>><?= $k['nama'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" <?= ($tugas['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="Sedang Dikerjakan" <?= ($tugas['status'] == 'Sedang Dikerjakan') ? 'selected' : '' ?>>Sedang Dikerjakan</option>
                            <option value="Selesai" <?= ($tugas['status'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                            <option value="completed" <?= ($tugas['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
