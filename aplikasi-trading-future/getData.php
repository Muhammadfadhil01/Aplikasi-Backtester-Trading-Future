<?php
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$dbname = "db_trading";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, '', $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data profitloss dari tabel trade
$sql = "SELECT profitloss FROM trade";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        $data[] = $row['profitloss'];
    }
}

// Mengembalikan data dalam format JSON
echo json_encode($data);

$conn->close();
?>
