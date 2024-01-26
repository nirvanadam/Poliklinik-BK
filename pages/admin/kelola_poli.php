<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/admin_functions.php';

// Ambil data dari tabel poli
$poli = query("SELECT * FROM poli");

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    // Cek apakah data berhasil ditambahkan atau tidak
    if(tambah_poli($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
            </script>
        ";
        header("Location: kelola_poli.php");
    } else{
        echo "
             <script>
                alert('Data gagal ditambahkan!');
            </script>
        ";
        header("Location: kelola_poli.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Poli</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex gap-5 bg-[#1A1F2B]">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_admin.php"); ?>
    <!-- Side Bar End -->

    <main class="flex flex-col w-full bg-[#292E3B bg-white pb-10">
        <header class="flex items-center gap-3 px-8 py-7 shadow-lg">
            <img src="../../assets/icons/building-icon.svg" alt="" width="30px" class="invert">
            <h1 class="text-3xl font-medium">Kelola Poli</h1>
        </header>

        <article>
            <form action="" method="post" class="flex flex-col gap-5 mt-8 mx-5 p-8 bg-[#e0e0e0] rounded-2xl">
                <div class="flex flex-col gap-3">
                    <label for="nama_poli" class="text-lg font-medium">Nama Poli</label>
                    <input type="text" name="nama_poli" id="nama_poli" placeholder="Nama Poli"
                        class="px-4 py-3 outline-none rounded-lg">
                </div>

                <div class="flex flex-col gap-3">
                    <label for="keterangan" class="text-lg font-medium">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" placeholder="Keterangan"
                        class="px-4 py-3 outline-none rounded-lg">
                </div>

                <button type="submit" name="submit"
                    class="bg-[#004079] w-fit py-3 px-6 text-white font-medium rounded-lg">Tambah
                    Data</button>
            </form>

            <section class="mt-8 mx-5 p-8 border border-gray-300 rounded-2xl">
                <h1 class="mb-5 text-2xl font-medium">Daftar Poli</h1>
                <table class="w-full table-fixed border border-yellow-500">
                    <thead class="">
                        <tr>
                            <th class="w-[5%] border border-slate-500 py-3">No</th>
                            <th class="w-[20%] border border-slate-500 py-3">Nama Poli</th>
                            <th class="w-[25%] border border-slate-500 py-3">Keterangan</th>
                            <th class="w-[30%] border border-slate-500 py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="">
                        <?php $index = 1; ?>
                        <?php foreach($poli as $item) : ?>
                        <tr>
                            <td class="border border-slate-500 py-5 text-center">
                                <?= $index  ?>
                            </td>

                            <td class="border border-slate-500 py-5 text-center">
                                <?= $item["nama_poli"]  ?>
                            </td>

                            <td class="border border-slate-500 py-5 text-center">
                                <?= $item["keterangan"] ?>
                            </td>

                            <td class="border border-slate-500 py-5 text-center">
                                <a href="edit_poli.php?id=<?= $item["id"] ?>" class="bg-green-500 px-6 py-2 rounded-lg text-white mr-3">Edit</a>
                                <a href="hapus_poli.php?id=<?= $item["id"] ?>" class="bg-red-500
                                    px-6 py-2 rounded-lg text-white">Delete</a>
                            </td>
                        </tr>
                        <?php $index++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </article>
    </main>
</body>

</html>