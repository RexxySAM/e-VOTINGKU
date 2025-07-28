<?php
session_start();
include '../koneksi.php';


// Cek apakah user sudah login dan berperan sebagai pemilih
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pemilih') {
    header("Location: ../login.php");
    exit();
}

// Cek apakah data dikirim via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_calon = isset($_POST['id_calon']) ? (int) $_POST['id_calon'] : 0;
    $id_pemilih = isset($_POST['id_pemilih']) ? (int) $_POST['id_pemilih'] : 0;

    // Validasi ID
    if ($id_calon <= 0 || $id_pemilih <= 0) {
        echo "<script>alert('Data tidak valid.'); window.location='../pemilih.php';</script>";
        exit();
    }

    // Cek apakah pemilih memang belum memilih
    $cek_pemilih = mysqli_query($conn, "SELECT sudah_memilih FROM pemilih WHERE id = $id_pemilih");
    if (!$cek_pemilih) {
        die("Query error (cek_pemilih): " . mysqli_error($conn));
    }

    $pemilih_data = mysqli_fetch_assoc($cek_pemilih);
    if (!$pemilih_data) {
        echo "<script>alert('Data pemilih tidak ditemukan.'); window.location='../pemilih.php';</script>";
        exit();
    }

    if ($pemilih_data['sudah_memilih']) {
        echo "<script>alert('Anda sudah memilih sebelumnya.'); window.location='../pemilih.php';</script>";
        exit();
    }

    // Tambahkan suara ke calon
    $update_calon = mysqli_query($conn, "UPDATE calon SET suara = suara + 1 WHERE id = $id_calon");
    if (!$update_calon) {
        die("Gagal update calon: " . mysqli_error($conn));
    }

    // Tandai pemilih sudah memilih
    $update_pemilih = mysqli_query($conn, "UPDATE pemilih SET sudah_memilih = 1 WHERE id = $id_pemilih");
    if (!$update_pemilih) {
        die("Gagal update pemilih: " . mysqli_error($conn));
    }

    echo "<script>alert('Terima kasih, suara Anda sudah dicatat!'); window.location='../pemilih.php';</script>";
} else {
    header("Location: ../pemilih.php");
    exit();
}
?>
