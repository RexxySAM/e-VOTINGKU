<?php
// File: data/edit_calon.php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: data_calon.php");
    exit();
}

$id = (int)$_GET['id'];

// Ambil data calon dari database
$stmt = $conn->prepare("SELECT * FROM calon WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<p style='text-align:center; color:red;'>Data tidak ditemukan.</p>";
    exit();
}

$data = $result->fetch_assoc();
$pesan = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $visi = trim($_POST['visi']);
    $misi = trim($_POST['misi']);

    if ($nama && $visi && $misi) {
        $stmt_update = $conn->prepare("UPDATE calon SET nama = ?, visi = ?, misi = ? WHERE id = ?");
        $stmt_update->bind_param('sssi', $nama, $visi, $misi, $id);
        if ($stmt_update->execute()) {
            header("Location: data_calon.php");
            exit();
        } else {
            $pesan = "Gagal mengupdate data: " . $conn->error;
        }
    } else {
        $pesan = "Nama, visi, dan misi tidak boleh kosong!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Calon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            background-image: url('../uploads/kpuu.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0; padding: 40px 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            max-width: 600px;
            width: 100%;
            background: #fff;
            border-radius: 12px;
            padding: 30px 35px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.85);
        }
        h2 {
            text-align: center;
            font-weight: 700;
            color: #222;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 1rem;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 14px 16px;
            margin-bottom: 24px;
            border: 1.5px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color 0.3s ease;
            resize: vertical;
        }
        input[type="text"]:focus, textarea:focus {
            border-color: #1976d2;
            outline: none;
            box-shadow: 0 0 6px rgba(25, 118, 210, 0.5);
        }
        button {
            width: 100%;
            background-color: #1976d2;
            color: white;
            padding: 14px 0;
            font-size: 1.1rem;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 6px 15px rgba(25,118,210,0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            user-select: none;
        }
        button:hover {
            background-color: #155a9a;
            box-shadow: 0 8px 20px rgba(21, 90, 154, 0.6);
        }
        .back-link {
            display: inline-block;
            margin-top: 28px;
            text-decoration: none;
            font-weight: 600;
            color: #1976d2;
            font-size: 1rem;
            transition: color 0.3s ease;
            user-select: none;
        }
        .back-link:hover {
            color: #155a9a;
        }
        .error {
            color: #d32f2f;
            font-weight: 600;
            margin-bottom: 22px;
            text-align: center;
            font-size: 1rem;
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px 20px;
            }
            h2 {
                font-size: 1.5rem;
                margin-bottom: 24px;
            }
            input[type="text"], textarea {
                padding: 12px 14px;
                font-size: 0.95rem;
            }
            button {
                font-size: 1rem;
                padding: 12px 0;
            }
            .back-link {
                font-size: 0.95rem;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Calon</h2>

        <?php if ($pesan): ?>
            <p class="error"><?= htmlspecialchars($pesan) ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label for="nama">Nama Calon:</label>
            <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

            <label for="visi">Visi Calon:</label>
            <textarea id="visi" name="visi" rows="5" required><?= htmlspecialchars($data['visi']) ?></textarea>

            <label for="misi">Misi Calon:</label>
            <textarea id="misi" name="misi" rows="5" required><?= htmlspecialchars($data['misi']) ?></textarea>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <a href="data_calon.php" class="back-link">← Kembali ke Data Calon</a>
    </div>
</body>
</html>
