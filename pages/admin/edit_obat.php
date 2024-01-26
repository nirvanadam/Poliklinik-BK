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

// Query data mahasiswa berdasarkan id
$obat = query("SELECT * FROM obat WHERE id = $id")[0];

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    // Cek apakah data berhasil diedit atau tidak
    if(edit_obat($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diedit!');
                document.location.href = 'kelola_obat.php';
            </script>
        ";
    } else{
        echo "
             <script>
                alert('Data gagal diedit!');
                document.location.href = 'kelola_obat.php';
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
            <input type="hidden" name="id" id="id" value="<?= $obat["id"] ?>">
            <div class="flex flex-col gap-3">
                <label for="nama_obat" class="text-lg font-medium">Nama Obat</label>
                <input type="text" name="nama_obat" id="nama_obat" placeholder="Nama Obat" value="<?= $obat["nama_obat"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <div class="flex flex-col gap-3">
                <label for="kemasan" class="text-lg font-medium">Kemasan</label>
                <input type="text" name="kemasan" id="kemasan" placeholder="Kemasan" value="<?= $obat["kemasan"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <div class="flex flex-col gap-3">
                <label for="harga" class="text-lg font-medium">Harga</label>
                <input type="text" name="harga" id="harga" placeholder="Harga" value="<?= $obat["harga"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <button type="submit" name="submit" class="bg-[#004079] w-fit py-3 px-6 text-white font-medium rounded-lg">Edit
                Data</button>
        </form>
    </main>
</body>

</html>