<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/dokter_functions.php';

// Ambil data dari tabel poli
$jadwal_periksa = // Ambil data dari tabel daftar_poli dengan JOIN ke tabel pasien dan jadwal_periksa
$data_periksa = query("SELECT *
                      FROM daftar_poli
                      JOIN pasien ON daftar_poli.id_pasien = pasien.id
                    ");

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    // Cek apakah data berhasil ditambahkan atau tidak
    if(tambah($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
            </script>
        ";
        header("Location: jadwal_periksa.php");
    } else{
        echo "
             <script>
                alert('Data gagal ditambahkan!');
            </script>
        ";
        header("Location: jadwal_periksa.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex gap-5 bg-[#1A1F2B]">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_dokter.php"); ?>
    <!-- Side Bar End -->

    <main class="flex flex-col w-full bg-[#292E3B bg-white pb-10">
        <header class="flex items-center gap-3 px-8 py-7 shadow-lg">
            <img src="../../assets/icons/notebook-pen.svg" alt="" width="30px" class="invert">
            <h1 class="text-3xl font-medium">Riwayat Pasien</h1>
        </header>

        <article class="mx-5 mt-8 ">
            <table class="w-full table-fixed border border-yellow-500">
                <thead class="">
                    <tr>
                        <th class="w-[5%] border border-slate-500 py-3">No</th>
                        <th class="w-[20%] border border-slate-500 py-3">Nama Pasien</th>
                        <th class="w-[25%] border border-slate-500 py-3">Alamat</th>
                        <th class="w-[30%] border border-slate-500 py-3">No KTP</th>
                        <th class="w-[30%] border border-slate-500 py-3">No Telepon</th>
                        <th class="w-[30%] border border-slate-500 py-3">No RM</th>
                        <th class="w-[30%] border border-slate-500 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="">
                    <?php $index = 1; ?>
                    <?php foreach($data_periksa as $item) : ?>
                    <tr>
                        <td class="border border-slate-500 py-5 text-center">
                            <?= $index  ?>
                        </td>

                        <td class="border border-slate-500 py-5 text-center">
                             <?= $item["nama"] ?>
                        </td>

                        <td class="border border-slate-500 py-5 text-center">
                             <?= $item["alamat"] ?>
                        </td>

                        <td class="border border-slate-500 py-5 text-center">
                             <?= $item["no_ktp"] ?>
                        </td>

                        <td class="border border-slate-500 py-5 text-center">
                             <?= $item["no_hp"] ?>
                        </td>

                        <td class="border border-slate-500 py-5 text-center">
                            <?= $item["no_rm"] ?>
                        </td>

                        <td class="border border-slate-500 py-5 text-center">
                            <a href="detail_periksa.php?id=<?= $item["id"] ?>" class="bg-green-500 px-6 py-2
                                rounded-lg text-white mr-3">Detail</a>
                        </td>
                    </tr>
                    <?php $index++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </article>
    </main>
</body>

</html>