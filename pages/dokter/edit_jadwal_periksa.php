<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/dokter_functions.php';

// Ambil data id di URL
$id = $_GET["id"];

// Query data mahasiswa berdasarkan id
$jadwal_periksa = query("SELECT * FROM jadwal_periksa WHERE id = $id")[0];

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    // Cek apakah data berhasil diedit atau tidak
    if(edit($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diedit!');
                document.location.href = 'jadwal_periksa.php';
            </script>
        ";
    } else{
        echo "
             <script>
                alert('Data gagal diedit!');
                document.location.href = 'jadwal_periksa.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Periksa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center h-[100vh] gap-5 bg-[#1A1F2B]">
    <main class="bg-white w-[750px] p-9 rounded-2xl">
        <form action="" method="post" class="flex flex-col gap-5 mt-5">
            <input type="hidden" name="id" id="id" value="<?= $jadwal_periksa["id"] ?>">
            <div class="flex flex-col gap-3">
                <label for="hari" class="text-lg font-medium">Hari</label>
                <select id="hari" name="hari" class="px-4 py-3 outline-none rounded-lg">
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
            </div>

            <div class="flex flex-col gap-3">
                <label for="jam_mulai" class="text-lg font-medium">Jam Mulai</label>
                <input type="text" name="jam_mulai" id="jam_mulai" placeholder="Jam Mulai" value="<?= $jadwal_periksa["jam_mulai"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <div class="flex flex-col gap-3">
                <label for="jam_selesai" class="text-lg font-medium">Jam Selesai</label>
                <input type="text" name="jam_selesai" id="jam_selesai" placeholder="Jam Selesai" value="<?= $jadwal_periksa["jam_selesai"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <button type="submit" name="submit" class="bg-[#004079] w-fit py-3 px-6 text-white font-medium rounded-lg">Edit
                Data</button>
        </form>
    </main>
</body>

</html>