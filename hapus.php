<?php
require_once "crud_operations.php";
session_start(); // Mulai sesi jika belum dimulai

// Pastikan form telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Terima ID event dari form
    $event_id = $_POST["event_id"];

    // Validasi input
    if (empty($event_id)) {
        echo "<script>alert('ID event tidak boleh kosong.');</script>";
        echo "<script>window.location.href = 'add_event.php';</script>";
    } else {
        // Periksa apakah pengguna telah masuk
        if (!isset($_SESSION["id"])) {
            echo "<script>alert('Silakan login untuk menghapus event.');</script>";
            echo "<script>window.location.href = 'login_register.php';</script>";
            exit(); // Hentikan eksekusi lebih lanjut
        }

        // Lakukan koneksi ke database
        $conn = connectDB();

        // Dapatkan ID pengguna yang saat ini masuk
        $user_id = $_SESSION["id"];

        // Periksa apakah pengguna memiliki hak akses untuk menghapus event
        $sql_check_permission = "SELECT id FROM events WHERE id=? AND user_id=?";
        $stmt_check_permission = $conn->prepare($sql_check_permission);
        $stmt_check_permission->bind_param("ii", $event_id, $user_id);
        $stmt_check_permission->execute();
        $result_check_permission = $stmt_check_permission->get_result();
        
        if ($result_check_permission->num_rows == 0) {
            echo "<script>alert('Anda tidak memiliki izin untuk menghapus event ini.');</script>";
            echo "<script>window.location.href = 'add_event.php';</script>";
            exit(); // Hentikan eksekusi lebih lanjut
        }

        // Persiapkan query SQL DELETE
        $sql = "DELETE FROM events WHERE id=?";
        $stmt = $conn->prepare($sql);

        // Bind parameter ke query
        $stmt->bind_param("i", $event_id);

        // Jalankan query
        if ($stmt->execute()) {
            echo "<script>alert('Data event berhasil dihapus.');</script>";
            echo "<script>window.location.href = 'add_event.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data event: " . $stmt->error . "');</script>";
            echo "<script>window.location.href = 'add_event';</script>";
        }

        // Tutup statement dan koneksi database
        $stmt->close();
        $conn->close();
    }
}
?>
