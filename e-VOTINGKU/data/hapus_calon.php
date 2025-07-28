<?php
// File: data/hapus_calon.php
session_start();
include '../koneksi.php';

// Cek apakah user sudah login sebagai admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Cek apakah ada parameter id di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cek apakah calon dengan ID tersebut ada
    $cek = mysqli_query($conn, "SELECT * FROM calon WHERE id = '$id'");
    if (mysqli_num_rows($cek) > 0) {
        // Hapus data calon
        $hapus = mysqli_query($conn, "DELETE FROM calon WHERE id = '$id'");
        if ($hapus) {
            header("Location: data_calon.php?pesan=hapus_berhasil");
            exit();
        } else {
            echo "Gagal menghapus data calon: " . mysqli_error($conn);
        }
    } else {
        echo "Data calon tidak ditemukan.";
    }
} else {
    echo "ID calon tidak diberikan.";
}
?>
