<?php
header("Content-Type: application/json");
include "db.php";

$base_url = "http://localhost/web_gis_sekolah/";

// Menangani pagination
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
$offset = ($page - 1) * $limit;

$sql = "SELECT id, nama_sekolah, telepon, latitude, longitude, foto FROM sekolah";
$result = mysqli_query($conn, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    if (!empty($row['foto'])) {
        // Hindari duplikasi "uploads/"
        if (strpos($row['foto'], 'uploads/') === 0) {
            $row['foto'] = $base_url . $row['foto'];
        } else {
            $row['foto'] = $base_url . "uploads/" . $row['foto'];
        }
    } else {
        $row['foto'] = null; // Jika tidak ada foto
    }
    $data[] = $row;
}

// Menghitung total jumlah data untuk pagination
$sql_count = "SELECT COUNT(*) as total FROM sekolah";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$totalRecords = $row_count['total'];

// Output JSON data
echo json_encode($data, JSON_PRETTY_PRINT);
mysqli_close($conn);
?>
