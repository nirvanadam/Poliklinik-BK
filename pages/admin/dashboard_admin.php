<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex gap-5 bg-[#1A1F2B]">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_admin.php"); ?>
    <!-- Side Bar End -->

    <main class="grid grid-cols-2 divide-x divide-y divide-gray-500 overflow-hidden w-full bg-[#292E3B bg-white rounded-2xl my-7 mr-5">
            <a href="kelola_dokter.php"
                class="flex justify-center items-center gap-5 g-[#004079] px-14 py-10 hover:bg-gray-500 group transition-all duration-300">
                <img src="../../assets/icons/stethoscope-icon.svg" alt="" width="100px" class="p-2 rounded-lg invert group-hover:invert-0">
            </a>

            <a href="kelola_pasien.php"
                class="flex justify-center items-center gap-5 g-[#004079] px-14 py-10 hover:bg-gray-500 group transition-all duration-300">
                <img src="../../assets/icons/pasien-icon.svg" alt="" width="100px" class="p-2 rounded-lg invert group-hover:invert-0">
            </a>

            <a href="kelola_poli.php"
                class="flex justify-center items-center gap-5 g-[#004079] px-14 py-10 hover:bg-gray-500 group transition-all duration-300">
                <img src="../../assets/icons/building-icon.svg" alt="" width="100px" class="p-2 rounded-lg invert group-hover:invert-0">
            </a>
            <a href="kelola_obat.php"
                class="flex justify-center items-center gap-5 g-[#004079] px-14 py-10 hover:bg-gray-500 group transition-all duration-300">
                <img src="../../assets/icons/pill-icon.svg" alt="" width="100px" class="p-2 rounded-lg invert group-hover:invert-0">
            </a>
    </main>
</body>

</html>