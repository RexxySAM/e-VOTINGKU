<?php
// File: dashboard/pemilih.php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'pemilih') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pemilih</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin: 15px 0;
        }
        ul li a {
            display: block;
            background: #0066cc;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 5px;
            text-align: center;
        }
        ul li a:hover {
            background: #004999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dashboard Pemilih</h2>
        <ul>
            <li><a href="../pilih.php">Masuk Halaman Pemilihan</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>