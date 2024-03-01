<?php
header("Content-Type: application/json");

$host = "localhost: 8111";
$username = "root";
$password = "";
$database = "db_tiket film";

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $koneksi->query("SELECT * FROM tiket_film");

    $tiket_film = array();
    while ($row = $result->fetch_assoc()) {
        $tiket_film[] = $row;
    }

    echo json_encode($tiket_film, JSON_PRETTY_PRINT);
}

$koneksi->close();
?>

