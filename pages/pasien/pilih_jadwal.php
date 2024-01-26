<?php
session_start();

$no_rm = $_SESSION['no_rm'];
$id_poli = $_SESSION['id_poli'];

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/pasien_functions.php';

// Ambil data dari tabel jadwal_periksa dengan JOIN ke tabel dokter
$query = "SELECT jadwal_periksa.*, dokter.nama
          FROM jadwal_periksa
          JOIN dokter ON jadwal_periksa.id_dokter = dokter.id
          WHERE dokter.id_poli = $id_poli";

$jadwal_periksa = mysqli_query($conn, $query);

// Menggunakan Query SQL untuk Mengambil no_rm berdasarkan username
$query = "SELECT id FROM pasien WHERE no_rm = '$no_rm'";
$result = mysqli_query($conn, $query);

// Eksekusi Query dan Mendapatkan Hasil
if ($row = mysqli_fetch_assoc($result)) {
    $id_pasien = $row['id'];
}

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    // Cek apakah data berhasil ditambah atau tidak
    if(tambah_poli($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil ditambah!');
                document.location.href = 'dashboard_pasien.php';
            </script>
        ";
    } else{
        echo "
             <script>
                alert('Data gagal ditambah!');
                document.location.href = 'dashboard_pasien.php';
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
    <title>Dashboard Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex gap-5 bg-[#1A1F2B]">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_pasien.php"); ?>
    <!-- Side Bar End -->

    <main class="flex flex-col w-full bg-[#292E3B bg-white pb-10">
         <header class="flex items-center gap-3 px-8 py-7 shadow-lg">
            <img src="../../assets/icons/cross.svg" alt="" width="30px" class="invert">
            <h1 class="text-3xl font-medium">Daftar Poli</h1>
            <h1>No RM: <?= $_SESSION['no_rm'] ?></h1>
            <h1>Poli: <?= $_SESSION['id_poli'] ?></h1>
            <?= $id_pasien ?>
        </header>

        <article class="flex gap-2 px-3">
            <div class="w-1/2 mt-8 mx-auto">
                <h1 class="bg-[#1A1F2B] px-5 py-4 text-white text-xl font-medium rounded-t-2xl">Langkah 2</h1>
                <form action="" method="post" class="flex flex-col gap-5 h-fit px-6 py-5 bg-[#e0e0e0] rounded-b-2xl">
                    <input type="hidden" name="id_pasien" value="<?= $id_pasien ?>" id="">
                    <input type="hidden" name="status_periksa" value="Menunggu" id="">

                    <div class="flex flex-col gap-3">
                        <label for="id_jadwal" class="text-lg font-medium">Jadwal Periksa</label>
                        <select id="id_jadwal" name="id_jadwal" class="px-4 py-3 outline-none rounded-lg">
                            <?php foreach($jadwal_periksa as $item) : ?>
                            <option value="<?= $item["id"] ?>">dr. <?= $item["nama"] ?> | <?= $item["hari"] ?> | <?= $item["jam_mulai"] ?> - <?= $item["jam_selesai"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col gap-3">
                        <label for="keluhan" class="text-lg font-medium">Keluhan</label>
                        <textarea name="keluhan" rows="10" cols="" class="p-3 rounded-2xl"></textarea>
                    </div>
    
                    <button type="submit" name="submit"
                        class="bg-[#004079] w-full mx-auto py-3 px-6 text-white font-medium rounded-lg">Lanjut</button>
                </form>
            </div>
        </article>
    </main>
</body>

</html>