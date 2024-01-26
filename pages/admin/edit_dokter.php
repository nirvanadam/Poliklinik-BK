<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/admin_functions.php';

// Ambil data id di URL
$id = $_GET["id"];

// Query data dokter berdasarkan id
$dokter = query("SELECT * FROM dokter WHERE id = $id")[0];

// Ambil data dari tabel poli
$poli = query("SELECT * FROM poli");

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    // Cek apakah data berhasil diedit atau tidak
    if(edit_dokter($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diedit!');
                document.location.href = 'kelola_dokter.php';
            </script>
        ";
    } else{
        echo "
             <script>
                alert('Data gagal diedit!');
                document.location.href = 'kelola_dokter.php';
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
    <title>Edit Obat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center h-[100vh] gap-5 bg-[#1A1F2B]">
    <main class="bg-white w-[750px] p-9 rounded-2xl">
        <form action="" method="post" class="flex flex-col gap-5 mt-5">
            <input type="hidden" name="id" id="id" value="<?= $dokter["id"] ?>">
            <div class="flex flex-col gap-3">
                <label for="nama" class="text-lg font-medium">Nama Dokter</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Dokter" value="<?= $dokter["nama"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <div class="flex flex-col gap-3">
                <label for="alamat" class="text-lg font-medium">Alamat</label>
                <input type="text" name="alamat" id="alamat" placeholder="Alamat" value="<?= $dokter["alamat"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <div class="flex flex-col gap-3">
                <label for="no_hp" class="text-lg font-medium">Nomor Telepon</label>
                <input type="text" name="no_hp" id="no_hp" placeholder="Nomor Telepon" value="<?= $dokter["no_hp"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <div class="flex flex-col gap-3">
                <label for="nama_poli" class="text-lg font-medium">Poli</label>
                <select id="nama_poli" name="nama_poli" class="px-4 py-3 outline-none rounded-lg border border-gray-400">
                    <?php foreach ($poli as $item) : ?>
                        <option value="<?= $item["id"]  ?>"><?= $item["nama_poli"]  ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" name="submit" class="bg-[#004079] w-fit py-3 px-6 text-white font-medium rounded-lg">Edit
                Data</button>
        </form>
    </main>
</body>

</html>