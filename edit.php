<?php
require_once "crud_operations.php";

// Pastikan form telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Terima data dari form
    $event_id = $_POST["event_id"];
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];
    $kategori = $_POST["kategori"];
    $static_map_url = $_POST["static_map_url"];
    $tanggal = $_POST["tanggal"]; // Tambah variabel untuk tanggal

    // Validasi input
    if (empty($event_id) || empty($nama) || empty($harga) || empty($deskripsi) || empty($kategori) || empty($static_map_url) || empty($tanggal)) { // Perbarui validasi dengan menambahkan tanggal
        echo "<script>alert('Semua bidang harus diisi.');</script>";
        echo "<script>window.location.href = 'admin.php';</script>";
    } else {
        // Periksa apakah pengguna telah masuk
        session_start(); // Mulai sesi jika belum dimulai
        if (!isset($_SESSION["id"])) {
            echo "<script>alert('Silakan login untuk mengubah event.');</script>";
            echo "<script>window.location.href = 'login_register.php';</script>";
            exit(); // Hentikan eksekusi lebih lanjut
        }

        // Lakukan koneksi ke database
        $conn = connectDB();

        // Dapatkan ID pengguna yang saat ini masuk
        $user_id = $_SESSION["id"];

        // Periksa apakah pengguna memiliki hak akses untuk mengubah event
        $sql_check_permission = "SELECT id FROM events WHERE id=? AND user_id=?";
        $stmt_check_permission = $conn->prepare($sql_check_permission);
        $stmt_check_permission->bind_param("ii", $event_id, $user_id);
        $stmt_check_permission->execute();
        $result_check_permission = $stmt_check_permission->get_result();
        
        if ($result_check_permission->num_rows == 0) {
            echo "<script>alert('Anda tidak memiliki izin untuk mengubah event ini.');</script>";
            echo "<script>window.location.href = 'admin.php';</script>";
            exit(); // Hentikan eksekusi lebih lanjut
        }

        // Persiapkan query SQL UPDATE
        $sql = "UPDATE events SET nama=?, harga=?, deskripsi=?, kategori=?, static_map_url=?, tanggal=? WHERE id=?"; // Perbarui query untuk mencakup tanggal
        $stmt = $conn->prepare($sql);

        // Bind parameter ke query
        $stmt->bind_param("sdssssi", $nama, $harga, $deskripsi, $kategori, $static_map_url, $tanggal, $event_id); // Perbarui tipe data dan binding parameter

        // Jalankan query
        if ($stmt->execute()) {
            echo "<script>alert('Data event berhasil diubah.');</script>";
            echo "<script>window.location.href = 'add_event.php';</script>";
        } else {
            echo "<script>alert('Gagal mengubah data event: " . $stmt->error . "');</script>";
            echo "<script>window.location.href = 'add_event.php';</script>";
        }

        // Tutup statement dan koneksi database
        $stmt->close();
        $conn->close();
    }
}
