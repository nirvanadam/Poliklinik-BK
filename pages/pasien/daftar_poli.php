<?php
session_start();

$username = $_SESSION['username'];

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/admin_functions.php';

// Ambil data dari tabel poli
$poli = query("SELECT * FROM poli");

// Menggunakan Query SQL untuk Mengambil no_rm berdasarkan username
$query = "SELECT no_rm FROM pasien WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// Eksekusi Query dan Mendapatkan Hasil
if ($row = mysqli_fetch_assoc($result)) {
    $no_rm = $row['no_rm'];
}

// Memeriksa apakah tombol submit sudah ditekan atau belum dan melakukan aksi
if(isset($_POST["submit"])){
    $_SESSION['no_rm'] = $_POST["no_rm"];
    $_SESSION['id_poli'] = $_POST["poli"];
    header("Location: pilih_jadwal.php");
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
        </header>

        <article class="flex gap-2 px-3">
            <div class="w-1/2 mt-8 mx-auto">
                <h1 class="bg-[#1A1F2B] px-5 py-4 text-white text-xl font-medium rounded-t-2xl">Langkah 1</h1>
                <form action="" method="post" class="flex flex-col gap-5 h-fit px-6 py-5 bg-[#e0e0e0] rounded-b-2xl">
                    <div class="flex flex-col gap-3">
                        <label for="no_rm" class="text-lg font-medium">Nomor Rekam Medis</label>
                        <input type="text" name="no_rm" id="no_rm" value="<?= $no_rm?>" readonly placeholder="Nomor Rekam Medis"
                            class="px-4 py-3 outline-none rounded-lg text-gray-500">
                    </div>
    
                    <div class="flex flex-col gap-3">
                        <label for="poli" class="text-lg font-medium">Pilih Poli</label>
                        <select id="poli" name="poli" class="px-4 py-3 outline-none rounded-lg">
                            <?php foreach($poli as $item) : ?>
                            <option value="<?= $item["id"] ?>"><?= $item["nama_poli"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
    
                    <button type="submit" name="submit"
                        class="bg-[#004079] w-full mx-auto py-3 px-6 text-white font-medium rounded-lg">Lanjut</button>
                </form>
            </div>
        </article>
    </main>
</body>

</html>