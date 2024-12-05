<?php
include 'connect.php';

// Ambil data terbaru
$sql = "SELECT * FROM sensor_data ORDER BY id DESC LIMIT 1";
$query = mysqli_query($connect, $sql);

if ($data = mysqli_fetch_assoc($query)) {
    // Bangun array respons
    $response = [
        'kelembapan' => $data['kelembapan'],
        'cahaya' => $data['cahaya'] == 1 ? 'Kurang Cukup' : 'Cukup',
        'status_kelembapan' => $data['kelembapan'] > 1500 ? 'Kering' : ($data['kelembapan'] >= 1000 ? 'Lumayan' : 'Lembab/Basah')
    ];

    // Kembalikan sebagai JSON
    echo json_encode($response);
} else {
    // Respons jika data tidak ditemukan
    echo json_encode(['error' => 'Data tidak ditemukan']);
}
?>
