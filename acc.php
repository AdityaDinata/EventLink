<?php
require_once "crud_operations.php";
// Pastikan form telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Terima data dari form
    $event_id = $_POST["event_id"];

    // Lakukan koneksi ke database
    $conn = connectDB();

    // Persiapkan query SQL UPDATE
    $sql = "UPDATE events SET status='Disetujui' WHERE id=?";
    $stmt = $conn->prepare($sql);

    // Bind parameter ke query
    $stmt->bind_param("i", $event_id);

    // Jalankan query
    if ($stmt->execute()) {
        
        // Alert success
        echo "<script>alert('Berhasil disetujui'); setTimeout(function(){ window.location.href = 'admin.php'; }, 500);</script>";
        exit(); // Ensure script execution stops here
        
        
        
    } else {
        // Kirim respons ke AJAX jika diperlukan
        echo "Error";
    }

    // Tutup statement dan koneksi database
    $stmt->close();
    $conn->close();
}
