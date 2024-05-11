<?php
require_once "crud_operations.php";

// Pastikan form telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];
    $kategori = $_POST["kategori"];
    $static_map_url = $_POST["static_map_url"];
    $tanggal = $_POST["tanggal"]; // Tambahkan penanganan tanggal

    // Mendapatkan nama file gambar
    $gambar_name = $_FILES["gambar"]["name"];
    // Mendapatkan tipe file
    $gambar_type = $_FILES["gambar"]["type"];
    // Mendapatkan ukuran file
    $gambar_size = $_FILES["gambar"]["size"];
    // Mendapatkan path file sementara
    $gambar_tmp = $_FILES["gambar"]["tmp_name"];

    // Baca data gambar dari file sementara
    $gambar_data = file_get_contents($gambar_tmp);

    // Lakukan koneksi ke database
    $conn = connectDB();

    // Periksa apakah pengguna telah masuk
    session_start(); // Mulai sesi
    if (!isset($_SESSION["id"])) {
        echo "<script>alert('Anda harus masuk untuk menambahkan event.');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
        exit(); // Hentikan eksekusi lebih lanjut
    }

    // Dapatkan ID pengguna yang saat ini masuk
    $user_id = $_SESSION["id"];

    // Persiapkan query SQL INSERT
    $sql = "INSERT INTO events (nama, harga, deskripsi, kategori, static_map_url, gambar, user_id, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameter ke query
    $stmt->bind_param("sdssssis", $nama, $harga, $deskripsi, $kategori, $static_map_url, $gambar_data, $user_id, $tanggal); // Tambahkan tanggal

    // Jalankan query
    if ($stmt->execute()) {
        // Berhasil menambahkan data, beri peringatan berhasil
        echo "<script>alert('Data berhasil ditambahkan.');</script>";
    } else {
        // Gagal menambahkan data, beri peringatan gagal
        echo "<script>alert('Gagal menambahkan data: " . $stmt->error . "');</script>";
    }

    // Kembali ke halaman add_event.php
    echo "<script>window.location.href = 'add_event.php';</script>";

    // Tutup statement dan koneksi database
    $stmt->close();
    $conn->close();
}

