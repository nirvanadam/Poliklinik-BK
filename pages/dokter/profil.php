<?php
session_start();

$username = $_SESSION["username"];

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/dokter_functions.php';

// Ambil data dari tabel poli
$dokter = query("SELECT * FROM dokter WHERE username = '$username'")[0];

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    // Cek apakah data berhasil diedit atau tidak
    if(edit_profil($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diedit!');
                document.location.href = 'profil.php';
            </script>
        ";
    } else{
        echo "
             <script>
                alert('Data gagal diedit!');
                document.location.href = 'profil.php';
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
    <title>Profil Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex gap-5 bg-[#1A1F2B]">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_dokter.php"); ?>
    <!-- Side Bar End -->

    <main class="flex flex-col w-full bg-[#292E3B bg-white pb-10">
        <header class="flex items-center gap-3 px-8 py-7 shadow-lg">
            <img src="../../assets/icons/pasien-icon.svg" alt="" width="30px" class="invert">
            <h1 class="text-3xl font-medium">Profil Dokter</h1>
        </header>

        <article class="mx-5 mt-8">
            <h1 class="bg-[#1A1F2B] px-5 py-4 text-white text-xl font-medium rounded-t-2xl">Edit Data Dokter</h1>
            <form action="" method="post" class="flex flex-col gap-5 p-8 bg-[#e0e0e0] rounded-b-2xl">
                    <input type="hidden" name="username" id="username" value="<?= $username ?>">
                    <div class="flex flex-col gap-3">
                        <label for="nama" class="text-lg font-medium">Nama Dokter</label>
                        <input type="text" name="nama" id="nama" value=" <?= $dokter["nama"] ?>"
                            class="px-4 py-3 outline-none rounded-lg">
                    </div>
    
                    <div class="flex flex-col gap-3">
                        <label for="alamat" class="text-lg font-medium">Alamat Dokter</label>
                        <input type="text" name="alamat" id="alamat" value="<?= $dokter["alamat"] ?>"
                            class="px-4 py-3 outline-none rounded-lg">
                    </div>
    
                    <div class="flex flex-col gap-3">
                        <label for="no_hp" class="text-lg font-medium">Telepon Dokter</label>
                        <input type="text" name="no_hp" id="no_hp" value="<?= $dokter["no_hp"] ?>"
                            class="px-4 py-3 outline-none rounded-lg">
                    </div>
    
                    <button type="submit" name="submit"
                        class="bg-[#004079] w-fit mx-auto py-3 px-6 text-white font-medium rounded-lg">Simpan Perubahan</button>
                </form>
        </article>
    </main>
</body>

</html>