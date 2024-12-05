<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IoT Real-Time Monitoring</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <h1>Real-Time Monitoring</h1>
    </header>
    <main>
        <div class="data-container" id="data-container">
            <h2>Data Sensor</h2>
            <p>Kelembapan Tanah: <span id="kelembapan">--</span></p>
            <p>Cahaya: <span id="cahaya">--</span></p>
        </div>
        <button id="toggle-lamp" class="lamp-button">
            <i class="fas fa-lightbulb"></i>
            <span>Toggle Lampu</span>
        </button>
    </main>
    <footer>
        <p>© 2024 IoT Monitoring by PANDAWA FARM</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Fungsi untuk memuat ulang data sensor dari server
        async function refreshSensorData() {
        try {
            const response = await fetch('./fetch_sensor_data.php'); // Ambil data dari PHP
            const data = await response.json(); // Ambil data sebagai JSON

            if (data.error) {
                console.error(data.error); // Tampilkan pesan error jika ada
                return;
            }

            // Perbarui data sensor di halaman
            document.getElementById('kelembapan').textContent = `${data.status_kelembapan} (${data.kelembapan})`;
            document.getElementById('cahaya').textContent = data.cahaya;
        } catch (error) {
            console.error('Error fetching sensor data:', error); // Tangani error jika terjadi
        }
    }


        // Fungsi untuk mengubah status lampu
async function toggleLampStatus() {
         try {
        const response = await fetch('./update_lamp_status.php', { 
            method: 'POST' 
        });

        if (response.ok) {
            const data = await response.json(); // Parsing respons JSON

            if (data.error) {
                alert(data.error); // Menampilkan pesan error jika ada
            } else {
                alert(data.message); // Menampilkan pesan sukses
                refreshSensorData(); // Muat ulang data sensor setelah perubahan
            }
        } else {
            alert('Gagal mengubah status lampu.');
        }
        } catch (error) {
        console.error('Error updating lamp status:', error);
        alert('Terjadi kesalahan saat mengubah status lampu.');
        }
}

        // Tambahkan event listener ke tombol lampu
        document.getElementById('toggle-lamp').addEventListener('click', toggleLampStatus);

        // Jalankan fungsi refresh setiap 2 detik
        setInterval(refreshSensorData, 2000);

        // Panggil fungsi pertama kali saat halaman dimuat
        refreshSensorData();
    </script>
</body>

</html>
