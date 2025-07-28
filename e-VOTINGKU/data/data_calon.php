<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$calon = mysqli_query($conn, "SELECT * FROM calon");
if (!$calon) {
    die("Query error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Data Calon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        /* Reset & base */
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('../uploads/kpuu.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            max-width: 850px;
            width: 100%;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            padding: 30px 35px;
        }
        h2 {
            margin: 0 0 25px 0;
            font-weight: 700;
            color: #222;
            font-size: 1.8rem;
            text-align: center;
        }
        /* Buttons */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            user-select: none;
            border: none;
            color: #fff;
            font-size: 1rem;
        }
        .btn.add {
            background: #4caf50;
            box-shadow: 0 4px 12px rgba(76,175,80,0.4);
        }
        .btn.add:hover {
            background: #45a047;
            box-shadow: 0 6px 18px rgba(69,160,71,0.5);
        }
        .btn.back {
            background: #607d8b;
            margin-top: 25px;
            box-shadow: 0 4px 12px rgba(96,125,139,0.4);
        }
        .btn.back:hover {
            background: #546e7a;
            box-shadow: 0 6px 18px rgba(84,110,122,0.5);
        }
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            font-size: 1rem;
            color: #444;
        }
        thead tr {
            background: #1976d2;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
        }
        thead th {
            padding: 14px 20px;
            text-align: left;
        }
        tbody tr {
            background: #f4f6f8;
            transition: background-color 0.3s ease;
        }
        tbody tr:hover {
            background: #e3f2fd;
        }
        tbody td {
            padding: 14px 20px;
            vertical-align: middle;
        }
        /* Foto calon kecil */
        .foto-calon {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            margin-right: 12px;
        }
        /* Action buttons */
        .action-btn {
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 8px;
            user-select: none;
            text-decoration: none;
            display: inline-block;
        }
        .action-btn.edit {
            background: #fbc02d;
        }
        .action-btn.edit:hover {
            background: #f9a825;
        }
        .action-btn.delete {
            background: #e53935;
        }
        .action-btn.delete:hover {
            background: #c62828;
        }
        /* Responsive */
        @media(max-width: 600px) {
            .container {
                padding: 20px;
            }
            h2 {
                font-size: 1.5rem;
            }
            thead th, tbody td {
                padding: 10px 12px;
                font-size: 0.9rem;
            }
            .btn, .action-btn {
                font-size: 0.9rem;
                padding: 10px 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Calon</h2>
        <a href="tambah_calon.php" class="btn add">+ Tambah Calon</a>
        <table>
            <!-- Bagian <thead> -->
<thead>
    <tr>
        <th>No</th>
        <th>Foto & Nama</th>
        <th>Visi</th>
        <th>Misi</th> <!-- Tambahan -->
        <th>Aksi</th>
    </tr>
</thead>

<!-- Bagian <tbody> -->
<tbody>
    <?php if (mysqli_num_rows($calon) > 0): ?>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($calon)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td style="display:flex; align-items:center;">
                    <?php
                    $nama = strtolower($row['nama']);
                    if (strpos($nama, 'prabowo') !== false) {
                        $imgSrc = "../uploads/prabowo.jpg";
                    } elseif (strpos($nama, 'anies') !== false) {
                        $imgSrc = "../uploads/anies.jpg";
                    } elseif (strpos($nama, 'ganjar') !== false) {
                        $imgSrc = "../uploads/ganjar.jpg";
                    } elseif (strpos($nama, 'jokowi') !== false || strpos($nama, 'joko widodo') !== false) {
                        $imgSrc = "../uploads/jokowi.jpg";
                    } elseif (!empty($row['foto'])) {
                        $imgSrc = "../uploads/" . htmlspecialchars($row['foto']);
                    } else {
                        $imgSrc = "https://via.placeholder.com/50?text=No+Image";
                    }
                    ?>
                    <img src="<?= $imgSrc ?>" alt="Foto <?= htmlspecialchars($row['nama']) ?>" class="foto-calon" />
                    <span><?= htmlspecialchars($row['nama']) ?></span>
                </td>
                <td><?= nl2br(htmlspecialchars($row['visi'])) ?></td>
                <td><?= nl2br(htmlspecialchars($row['misi'])) ?></td> <!-- Tambahan -->
                <td style="white-space:nowrap;">
                    <a href="edit_calon.php?id=<?= $row['id'] ?>" class="action-btn edit">Edit</a>
                    <a href="hapus_calon.php?id=<?= $row['id'] ?>" class="action-btn delete" onclick="return confirm('Yakin ingin menghapus calon ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="5" style="text-align:center; color:#999;">Belum ada data calon.</td></tr>
    <?php endif; ?>
</tbody>

        </table>
        <a href="../admin.php" class="btn back">← Kembali ke Dashboard</a>
    </div>
</body>
</html>
