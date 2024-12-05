<?php
include 'connect.php'; // Pastikan koneksi ke database berhasil

// Query untuk mengambil status dari tabel parkir
$dataa = mysqli_query($connect, "SELECT status_lampu FROM status WHERE id=1");
$response = array();
// Mengecek apakah query berhasil
if ($dataa) {
    // Jika data ditemukan, fetch resultnya
    if (mysqli_num_rows($dataa) > 0) {
        // Ambil hasilnya sebagai array asosiatif
        $row = mysqli_fetch_assoc($dataa);
        $response['lampu'] = $row['status_lampu'];
        
    } else {
        echo "Tidak ada data yang ditemukan.";
    }
    echo json_encode($response);
} else {
    // Jika query gagal, tampilkan error
    echo "Gagal membaca data: " . mysqli_error($conn);
}

?>
