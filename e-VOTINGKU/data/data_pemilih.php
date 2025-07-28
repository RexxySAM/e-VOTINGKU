<?php
session_start();
include '../koneksi.php';

// Cek apakah user admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$pemilih = mysqli_query($conn, "SELECT * FROM pemilih");
if (!$pemilih) {
    die("Query error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Data Pemilih</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        /* Reset & base */
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url("../uploads/kpuu.jpg") no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            max-width: 850px;
            width: 100%;
            background: rgba(255, 255, 255, 0.95); /* transparansi ringan agar teks tetap terlihat */
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            padding: 30px 35px;
        }
        h2 {
            margin-bottom: 25px;
            font-weight: 700;
            color: #222;
            font-size: 1.8rem;
            text-align: center;
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
        }
        /* Button */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 25px;
            border-radius: 8px;
            font-weight: 600;
            background: #4caf50;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(76,175,80,0.4);
            user-select: none;
        }
        .btn:hover {
            background: #45a047;
            box-shadow: 0 6px 18px rgba(69,160,71,0.5);
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
            .btn {
                font-size: 0.9rem;
                padding: 10px 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Pemilih</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Status</th>
                    <th>Sudah Memilih</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($pemilih) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($pemilih)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['nik']) ?></td>
                            <td><?= !empty($row['status']) ? htmlspecialchars($row['status']) : '-' ?></td>
                            <td><?= $row['sudah_memilih'] ? 'Sudah Memilih' : 'Belum Memilih' ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center; color:#999;">Data pemilih tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="../admin.php" class="btn">← Kembali ke Dashboard</a>
    </div>
</body>
</html>
