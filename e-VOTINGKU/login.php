<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $nik      = $_POST['nik'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$nik' AND password='$password' AND role='pemilih'");
    $data  = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['user'] = $data;
        header("Location: pemilih.php");
        exit();
    } else {
        echo "<script>alert('Login gagal! Periksa NISN/Usename dan password apakah sudah benar?.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Pemilih</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .login-box {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 40px;
            width: 90%;
            max-width: 370px;
            text-align: center;
            color: white;
        }
        .login-box img.logo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 3px solid #fff;
        }
        .login-box h2 {
            margin-bottom: 20px;
            font-weight: 600;
        }
        .login-box input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 10px;
            outline: none;
        }
        .login-box input::placeholder {
            color: #888;
        }
        .login-box button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border: none;
            border-radius: 10px;
            background-color: #ffffff;
            color: #0066cc;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .login-box button:hover {
            background-color: #0066cc;
            color: white;
        }
        .register-link,
        .admin-link {
            margin-top: 12px;
            display: block;
            font-size: 14px;
            color: white;
            text-decoration: underline;
        }

        @media (max-width: 500px) {
            .login-box {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-box">
        <!-- Tambahkan gambar logo bulat -->
        <img src="uploads/kpu2.jpg" alt="Logo KPU" class="logo">

        <h2>Login e-VOTINGKU</h2>
        <form method="POST">
            <input type="text" name="nik" placeholder="NIK/Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <a href="register.php" class="register-link">Belum punya akun? Daftar di sini</a>
        <a href="login_admin.php" class="admin-link">Login sebagai Admin</a>
    </div>
</body>
</html>
