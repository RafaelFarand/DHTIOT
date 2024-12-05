<?php

include 'connect.php';

$kelembapan = $_GET['kelembapan'];
$cahaya = $_GET['cahaya'];


if ($kelembapan != "" && $cahaya != "") {
    $dataa = mysqli_query(
        $connect,
        "INSERT INTO sensor_data (kelembapan, cahaya) VALUES ('$kelembapan', '$cahaya')"
    );

    if ($dataa) {
        echo "Berhasil mengirim data.";
    } else {
        echo "Gagal membaca data: " . mysqli_error($connect);
    }
} else {
    echo "Sensor Error";
}
