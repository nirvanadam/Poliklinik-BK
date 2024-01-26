<?php
session_start();

$username = $_SESSION["username"];

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/dokter_functions.php';

//Menggunakan Query SQL untuk Mengambil id_dokter
$query_id = "SELECT id FROM dokter WHERE username = '$username'";
$result_id = mysqli_query($conn, $query_id);

//Eksekusi Query dan Mendapatkan Hasil
if ($row = mysqli_fetch_assoc($result_id)) {
    $id_dokter = $row['id'];
}

$query_nama = "SELECT nama FROM dokter WHERE username = '$username'";
$result_nama = mysqli_query($conn, $query_nama);

if ($row = mysqli_fetch_assoc($result_nama)) {
    $nama_dokter = $row['nama'];
}

// Ambil data dari tabel poli
$jadwal_periksa = query("SELECT * FROM jadwal_periksa WHERE id_dokter = $id_dokter");

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    // Cek apakah data berhasil ditambahkan atau tidak
    if(tambah_jadwal($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'jadwal_periksa.php';
            </script>
        ";
        header("Location: jadwal_periksa.php");
    } else{
        echo "
             <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'jadwal_periksa.php';
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
    <title>Jadwal Periksa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex gap-5 bg-[#1A1F2B]">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_dokter.php"); ?>
    <!-- Side Bar End -->

    <main class="flex flex-col w-full bg-[#292E3B bg-white pb-10">
        <header class="flex items-center gap-3 px-8 py-7 shadow-lg">
            <img src="../../assets/icons/clipboard-list.svg" alt="" width="30px" class="invert">
            <h1 class="text-3xl font-medium">Jadwal Periksa dr. <?= $nama_dokter ?></h1>
        </header>

        <article>
            <form action="" method="post" class="flex flex-col gap-5 mt-8 mx-5 p-8 bg-[#e0e0e0] rounded-2xl">
                <input type="hidden" name="id_dokter" id="" value="<?= $id_dokter ?>">

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
                    <input type="time" name="jam_mulai" id="jam_mulai" placeholder="Jam Mulai"
                        class="px-4 py-3 outline-none rounded-lg">
                </div>

                <div class="flex flex-col gap-3">
                    <label for="jam_selesai" class="text-lg font-medium">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="jam_selesai" placeholder="Jam Selesai"
                        class="px-4 py-3 outline-none rounded-lg">
                </div>

                <button type="submit" name="submit"
                    class="bg-[#004079] w-fit py-3 px-6 text-white font-medium rounded-lg">Tambah
                    Data</button>
            </form>

            <section class="mt-8 mx-5 p-8 border border-gray-300 rounded-2xl">
                <h1 class="mb-5 text-2xl font-medium">Daftar Jadwal Periksa</h1>
                <table class="w-full table-fixed border border-yellow-500">
                    <thead class="">
                        <tr>
                            <th class="w-[5%] border border-slate-500 py-3">No</th>
                            <th class="w-[20%] border border-slate-500 py-3">Nama Dokter</th>
                            <th class="w-[25%] border border-slate-500 py-3">Hari</th>
                            <th class="w-[20%] border border-slate-500 py-3">Jam Mulai</th>
                            <th class="w-[20%] border border-slate-500 py-3">Jam Selesai</th>
                            <th class="w-[30%] border border-slate-500 py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="">
                        <?php $index = 1; ?>
                        <?php foreach($jadwal_periksa as $item) : ?>
                        <tr>
                            <td class="border border-slate-500 py-5 text-center">
                                <?= $index  ?>
                            </td>
                            <td class="border border-slate-500 py-5 text-center">
                                <?= $nama_dokter ?>
                            </td>
                            <td class="border border-slate-500 py-5 text-center">
                                <?= $item["hari"] ?>
                            </td>
                            <td class="border border-slate-500 py-5 text-center">
                                <?= $item["jam_mulai"] ?>
                            </td>
                            <td class="border border-slate-500 py-5 text-center">
                                <?= $item["jam_selesai"] ?>
                            </td>
                            <td class="border border-slate-500 py-5 text-center">
                                <a href="edit_jadwal_periksa.php?id=<?= $item["id"] ?>" class="bg-green-500 px-6 py-2 rounded-lg text-white mr-3">Edit</a>
                                <a href="hapus_jadwal_periksa.php?id=<?= $item["id"] ?>" class="bg-red-500
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