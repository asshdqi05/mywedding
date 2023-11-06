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


$perPage = 5;
$currentPage = isset($_POST['page']) ? $_POST['page'] : 1;

// Hitung offset untuk pagination
$offset = ($currentPage - 1) * $perPage;


$sql = "SELECT * FROM rsvp order by tanggal desc LIMIT $perPage OFFSET $offset";
$result = $conn->query($sql);

$sql_jumlah_data = "SELECT * FROM rsvp";
$result_jumlah = $conn->query($sql_jumlah_data);
// var_dump($result);
// exit;

$data = array();
$dataArray = '';

$totalData = $result_jumlah->num_rows;
// Jumlah data per halaman
$totalPages = ceil($totalData / $perPage);


while ($row = $result->fetch_assoc()) {
    $dataArray .= '
                    
                            <div class="card card-ucapan h-100 mb-2" data-aos="fade-up">
                               
                                <div class="card-body">
                                <h5 class="card-title">' . $row["nama"] . '</h5> 
                                
                                <p class="card-text">' . $row["ucapan"] . '</p>
                                <small class="text-body-secondary"><i class="bi bi-calendar3"></i> ' . $row["tanggal"] . '</small>
                                </div>
                               
                            </div>
                       
                    ';
}

$dataArray .= '<ul class="pagination justify-content-center">';
if ($currentPage > 1) {
    $dataArray .= '<li class="page-item"><span class="page-link pagination-link" data-page="' . ($currentPage - 1) . '">Previous</span></li>';
}

for ($i = 1; $i <= $totalPages; $i++) {
    if ($i == $currentPage) {
        $dataArray .= '<li class="page-item active"><span class="page-link pagination-link" data-page="' . $i . '">' . $i . '</span></li>';
    } else {
        $dataArray .= '<li class="page-item"><span class="page-link pagination-link" data-page="' . $i . '">' . $i . '</span></li>';
    }
}

if ($currentPage < $totalPages) {
    $dataArray .= '<li class="page-item"><span class="page-link pagination-link" data-page="' . ($currentPage + 1) . '">Next</span></li>';
}



echo $dataArray;

$conn->close();
