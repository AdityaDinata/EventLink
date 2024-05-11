<?php
session_start();

include 'crud_operations.php'; // Include database connection file
$conn = connectDB(); // Connect to the database

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login_register.php");
    exit();
}

// Pastikan parameter member telah diterima dari URL
if (isset($_GET['member'])) {
    // Terima data member dari URL
    $member = $_GET["member"];

    // Lakukan koneksi ke database
    $conn = connectDB(); // Pastikan fungsi connectDB() telah didefinisikan

    // Dapatkan ID pengguna dari sesi
    $user_id = $_SESSION['id'];

    // Periksa apakah pengguna sudah menjadi anggota premium
    $sql_check = "SELECT Member FROM users WHERE id=?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $user_id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    $row = $result->fetch_assoc();
    $current_member_status = $row['Member'];

    // Jika pengguna sudah menjadi anggota premium, tampilkan pesan dan keluar dari skrip
    if ($current_member_status == 'Premium') {
        echo "<script>alert('Anda sudah menjadi anggota Premium.'); window.location.href = 'index2.php';</script>";
        exit();
    }

    // Lakukan pembaruan di database
    $sql = "UPDATE users SET Member=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $member, $user_id);

    // Jalankan query
    if ($stmt->execute()) {
        // Alert success
        echo "<script>alert('Berhasil Membeli Member'); setTimeout(function(){ window.location.href = 'index2.php'; }, 1000);</script>";
        exit(); // Ensure script execution stops here
    } else {
        // Tampilkan pesan kesalahan jika terjadi kesalahan saat menjalankan query
        echo "Terjadi kesalahan. Silakan coba lagi.";
    }

    // Tutup statement dan koneksi database
    $stmt->close();
    $conn->close();
} else {
    // Jika parameter member tidak diterima dari URL, tampilkan pesan kesalahan
    echo "Terjadi kesalahan. Silakan coba lagi.";
}
?>
