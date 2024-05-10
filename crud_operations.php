<?php

function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "eventlink_database";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Mendapatkan semua data event
function getAllData() {
    $conn = connectDB();
    $sql = "SELECT * FROM events";
    $result = $conn->query($sql);

    $data = array();
    // Periksa apakah ada data yang ditemukan
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    $conn->close();

    return $data;
}
