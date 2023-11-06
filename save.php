<?php
$servername = "localhost"; // Nama server database
$username = "root"; // Username database
$password = ""; // Password database
$database = "wedding"; // Nama database

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}



$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$status = $_POST['status'];
$ucapan = $_POST['ucapan'];
$tanggal = date('Y-m-d');

$sql = "INSERT INTO rsvp (nama, jumlah,status,ucapan,tanggal) VALUES ('$nama', '$jumlah','$status','$ucapan','$tanggal')";
if ($conn->query($sql) === TRUE) {
    $array = array('status' => 'success', 'message' => 'Data Berhasil disimpan.');
} else {
    $array = array('status' => 'fail', 'message' => 'Data Gagal disimpan :' . $sql . '<br>' . $conn->error);
}
echo json_encode($array);

$conn->close();
