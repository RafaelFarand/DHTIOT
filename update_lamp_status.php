<?php
include 'connect.php';

$id = 1; // Asumsikan id adalah 1 (atau sesuai dengan id yang digunakan)

// Query untuk toggle status lampu
$sql = "
    UPDATE status 
    SET status_lampu = CASE 
        WHEN status_lampu = 'ON' THEN 'OFF'
        ELSE 'ON'
    END
    WHERE id = $id";

if ($connect->query($sql) === TRUE) {
    // Ambil status terbaru untuk memberikan feedback
    $result = $connect->query("SELECT status_lampu FROM status WHERE id = $id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row['status_lampu'];

        // Kirimkan status terbaru dalam format JSON
        echo json_encode(['message' => "Status lampu berhasil diubah menjadi $status", 'status_lampu' => $status]);
    } else {
        // Jika tidak ada data ditemukan
        echo json_encode(['error' => 'Tidak ada data status lampu']);
    }
} else {
    echo json_encode(['error' => 'Gagal mengubah status lampu: ' . $connect->error]);
}

$connect->close();
?>
