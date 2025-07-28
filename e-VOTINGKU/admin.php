<?php
// File: admin.php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            background:
                linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                url('uploads/kpuu.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(251, 3, 3, 0.19);
            border-radius: 36px;
            box-shadow: 0 8px 32px rgba(255, 255, 255, 1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 40px;
            width: 90%;
            max-width: 370px;
            text-align: center;
            color: white;
        }
        .container img.logo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 3px solid #fff;
        }
        h2 {
            margin-bottom: 25px;
            font-weight: 600;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin: 15px 0;
        }
        a.btn {
            display: block;
            background-color: #ffffff;
            color: #0066cc;
            text-decoration: none;
            padding: 12px 0;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        a.btn:hover {
            background-color: #0066cc;
            color: white;
        }
        a.btn.logout {
            background-color: #dc3545;
            color: white;
        }
        a.btn.logout:hover {
            background-color: #a71d2a;
        }

        @media (max-width: 500px) {
            .container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo bulat di atas judul -->
        <img src="uploads/kpu2.jpg" alt="Logo Admin" class="logo">

        <h2>Dashboard Admin</h2>
        <ul>
            <li><a href="data/data_calon.php" class="btn">Kelola Calon</a></li>
            <li><a href="data/data_pemilih.php" class="btn">Kelola Pemilih</a></li>
            <li><a href="hasil.php" class="btn">Lihat Hasil</a></li>
            <li><a href="logout.php" class="btn logout">Logout</a></li>
        </ul>
    </div>
</body>
</html>
