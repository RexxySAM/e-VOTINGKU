<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pemilih') {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['user']['id'];
$cek = mysqli_query($conn, "SELECT * FROM pemilih WHERE id_user = $id_user");
if (!$cek) die("Query error: " . mysqli_error($conn));
$data = mysqli_fetch_assoc($cek);

if (!$data) {
    echo "<h2>Data pemilih tidak ditemukan untuk user ID: $id_user</h2>";
    exit();
}

if ($data['sudah_memilih']) {
    header("Location: selesai.php");
    exit();
}

$calon = mysqli_query($conn, "SELECT * FROM calon ORDER BY id ASC");
if (!$calon || mysqli_num_rows($calon) === 0) {
    echo "<h2>Tidak ada calon tersedia untuk dipilih.</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<title>Halaman Pemilih</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
    *, *::before, *::after { box-sizing: border-box; }
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f0f4f8;
        color: #2c3e50;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        padding: 40px 20px;
    }
    .container {
        background: #ffffff;
        max-width: 1000px;
        width: 100%;
        border-radius: 12px;
        padding: 40px 32px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 36px;
    }
    header h2 {
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
        color: #34495e;
    }
    .logout a {
        color: #e74c3c;
        font-weight: 600;
        text-decoration: none;
        font-size: 1rem;
        padding: 8px 12px;
        border: 2px solid #e74c3c;
        border-radius: 6px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .logout a:hover {
        background-color: #e74c3c;
        color: white;
    }
    .grid-calon {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
    }
    .card {
        background: #f9fbfc;
        border-radius: 14px;
        box-shadow: 0 4px 16px rgba(52, 73, 94, 0.1);
        padding: 24px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 10px 30px rgba(52, 73, 94, 0.18);
        transform: translateY(-6px);
    }
    .nomor {
        font-size: 1.1rem;
        font-weight: bold;
        color: #3498db;
        margin-bottom: 8px;
    }
    .card img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 12px;
        border: 3px solid #ddd;
    }
    .card h3 {
        font-size: 1.3rem;
        margin-bottom: 12px;
        color: #2c3e50;
    }
    .visi-misi {
        font-size: 0.9rem;
        color: #566573;
        text-align: left;
        margin-bottom: 16px;
        width: 100%;
    }
    .visi-misi strong {
        display: block;
        margin-bottom: 4px;
        color: #2c3e50;
    }
    .btn-pilih {
        background: #2980b9;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px;
        width: 100%;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    .btn-pilih:hover {
        background: #1c5980;
    }
</style>
</head>
<body>
<main class="container">
    <header>
        <h2>Silakan Pilih Calon</h2>
        <nav class="logout">
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <section class="grid-calon">
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($calon)) :
            $nama = strtolower($row['nama']);
            if (strpos($nama, 'prabowo') !== false) {
                $imgSrc = "uploads/prabowo.jpg";
            } elseif (strpos($nama, 'anies') !== false) {
                $imgSrc = "uploads/anies.jpg";
            } elseif (strpos($nama, 'ganjar') !== false) {
                $imgSrc = "uploads/ganjar.jpg";
            } elseif (strpos($nama, 'jokowi') !== false) {
                $imgSrc = "uploads/jokowi.jpg";
            } else {
                $imgSrc = "https://via.placeholder.com/140?text=No+Image";
            }
        ?>
        <article class="card" role="region" aria-labelledby="calon-<?= $row['id'] ?>" tabindex="0">
            <div class="nomor">No. <?= $no++ ?></div>
            <img src="<?= htmlspecialchars($imgSrc) ?>" alt="Foto <?= htmlspecialchars($row['nama']) ?>">
            <h3 id="calon-<?= $row['id'] ?>"><?= htmlspecialchars($row['nama']) ?></h3>
            <div class="visi-misi">
                <strong>Visi:</strong>
                <?= nl2br(htmlspecialchars($row['visi'])) ?>
                <br>
                <strong>Misi:</strong>
                <?= nl2br(htmlspecialchars($row['misi'])) ?>
            </div>
            <form action="proses/simpan_suara.php" method="POST" onsubmit="return confirm('Yakin memilih <?= htmlspecialchars(addslashes($row['nama'])) ?>?')">
                <input type="hidden" name="id_calon" value="<?= $row['id'] ?>">
                <input type="hidden" name="id_pemilih" value="<?= $data['id'] ?>">
                <button type="submit" class="btn-pilih" aria-label="Pilih calon <?= htmlspecialchars($row['nama']) ?>">Pilih</button>
            </form>
        </article>
        <?php endwhile; ?>
    </section>
</main>
</body>
</html>
