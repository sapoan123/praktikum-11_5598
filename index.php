<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Tugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>Daftar Tugas</h3>
    <div class="d-flex justify-content-end mb-3">
        <a href="tambah_tugas.php" class="btn btn-primary me-2">Tambah Tugas</a>
        <a href="kategori.php" class="btn btn-secondary">Kelola Kategori</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT tasks.*, kategori.nama AS category_name 
                      FROM tasks 
                      LEFT JOIN kategori ON tasks.kategori_id = kategori.id";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['judul']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['category_name']) . "</td>";

                    $status_label = match($row['status']) {
                        'pending' => 'Menunggu',
                        'onprogress', 'Sedang Dikerjakan' => 'Sedang Dikerjakan',
                        'completed', 'Selesai' => 'Selesai',
                        default => 'Tidak Diketahui'
                    };
                    echo "<td>" . $status_label . "</td>";

                    echo "<td>
                            <a href='edit_tugas.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='hapus_tugas.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus?');\">Hapus</a>
                            <a href='selesaikan_tugas.php?id={$row['id']}' class='btn btn-success btn-sm'>Selesai</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center text-info'>Tidak ada tugas</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
