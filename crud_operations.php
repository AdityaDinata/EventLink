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

// Function to get events by user ID
function getEventsByUserId($user_id) {
    $conn = connectDB();
    $sql = "SELECT * FROM events WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $data;
}


// Mendapatkan semua data event
function getAllData() {
    $conn = connectDB();
    $sql = "SELECT * FROM events WHERE status = 'Disetujui'";

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

function getAllData2() {
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

// Mencari data event berdasarkan keyword
function searchData($keyword) {
    $conn = connectDB();
    // Persiapkan query pencarian
    $sql = "SELECT * FROM events WHERE nama LIKE '%$keyword%' OR kategori LIKE '%$keyword%'";
    $result = $conn->query($sql);

    $searchResults = [];

    // Periksa apakah ada hasil
    if ($result->num_rows > 0) {
        // Ambil hasil dan simpan dalam array
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
    }

    // Tutup koneksi
    $conn->close();

    // Kembalikan hasil pencarian dalam bentuk array
    return $searchResults;
}