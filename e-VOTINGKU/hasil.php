<?php
session_start();
include 'koneksi.php';

// Cek login dan role admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil data calon dari database
$query = "SELECT nama, visi, suara FROM calon ORDER BY suara DESC";
$hasil = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pemilihan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        body {
            background: 
                linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url("uploads/kpuu.jpg") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 15px;
        }
        .container {
            width: 100%;
            max-width: 900px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            padding: 40px 35px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 2rem;
            color: #222;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        thead {
            background: #007bff;
            color: white;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: center;
        }
        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }
        tbody tr:hover {
            background: #eef4ff;
        }
        .back-btn {
            display: inline-block;
            background-color: #6c757d;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }

        @media (max-width: 600px) {
            .container {
                padding: 25px 20px;
            }
            h2 {
                font-size: 1.5rem;
            }
            th, td {
                font-size: 0.9rem;
                padding: 10px;
            }
            .back-btn {
                font-size: 0.9rem;
                padding: 10px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hasil Pemungutan Suara</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Calon</th>
                    <th>Visi</th>
                    <th>Jumlah Suara</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($hasil) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($hasil)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['visi'])) ?></td>
                            <td><?= $row['suara'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Belum ada hasil pemilihan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="admin.php" class="back-btn">← Kembali ke Dashboard</a>
    </div>
</body>
</html>
