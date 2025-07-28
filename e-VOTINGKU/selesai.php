<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Terima Kasih</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .thanks-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            text-align: center;
        }
        .thanks-box h1 {
            color: #2ecc71;
            margin-bottom: 16px;
        }
        .thanks-box p {
            color: #333;
            font-size: 1.1rem;
        }
        .btn {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 18px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #2c80b4;
        }
    </style>
</head>
<body>
    <div class="thanks-box">
        <h1>Terima Kasih</h1>
        <p>Suara Anda telah berhasil direkam.</p>
        <a class="btn" href="logout.php">Logout</a>
    </div>

    <!-- Audio element -->
    <audio id="thanks-audio" src="uploads/Sound Effect Terima Kasih (Layla The Aspirants).mp3" preload="auto"></audio>

    <script>
        window.addEventListener('load', function() {
            var audio = document.getElementById('thanks-audio');
            audio.play().catch(function(e) {
                console.log('Autoplay gagal, mungkin browser memblokirnya:', e);
            });
        });
    </script>
</body>
</html>
