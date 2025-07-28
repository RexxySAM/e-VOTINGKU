<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama     = $_POST['nama'];
    $nik     = $_POST['nik'];
    $password = $_POST['password'];
    $status   = $_POST['status'];

    // Cek apakah NISN sudah terdaftar
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$nik'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('NIK/Username sudah terdaftar!'); window.location='register.php';</script>";
        exit();
    }

    // Simpan ke tabel users
    $insertUser = mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$nik', '$password', 'pemilih')");

    if ($insertUser) {
        $id_user = mysqli_insert_id($conn);
        // Simpan ke tabel pemilih
        $insertPemilih = mysqli_query($conn, "INSERT INTO pemilih (nama, nik, status, sudah_memilih, id_user)
                                              VALUES ('$nama', '$nik', '$status', 0, $id_user)");
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal: " . mysqli_error($conn) . "');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pemilih</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            margin: 0;
            padding: 0;
            background: 
                linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                url('uploads/kpuu.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .register-box {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 40px;
            width: 90%;
            max-width: 370px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
            color: white;
        }
        .register-box img.logo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid #fff;
        }
        .register-box h2 {
            margin-bottom: 20px;
            font-weight: 600;
        }
        .register-box input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 10px;
            outline: none;
        }
        .register-box input::placeholder {
            color: #888;
        }
        .register-box button {
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
        .register-box button:hover {
            background-color: #0066cc;
            color: white;
        }
        .register-box .login-link {
            margin-top: 15px;
            display: block;
            font-size: 14px;
            color: white;
            text-decoration: underline;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @media (max-width: 500px) {
            .register-box {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-box">
        <!-- Logo bulat -->
        <img src="uploads/kpu2.jpg" alt="Logo Registrasi" class="logo">

        <h2>Registrasi Pemilih</h2>
        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="text" name="nik" placeholder="NIK/Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="status" placeholder="Status (misal: Aktif)" required>
            <button type="submit" name="register">Daftar</button>
        </form>
        <a href="index.php" class="login-link">Sudah punya akun? Login di sini</a>
    </div>
</body>
</html>
