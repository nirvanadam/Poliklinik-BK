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
$pasien = query("SELECT * FROM pasien WHERE id = $id")[0];

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    // Cek apakah data berhasil diedit atau tidak
    if(edit_pasien($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diedit!');
                document.location.href = 'kelola_pasien.php';
            </script>
        ";
    } else{
        echo "
             <script>
                alert('Data gagal diedit!');
                document.location.href = 'kelola_pasien.php';
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
    <title>Edit Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center h-[100vh] gap-5 bg-[#1A1F2B]">
    <main class="bg-white w-[750px] p-9 rounded-2xl">
        <form action="" method="post" class="flex flex-col gap-5 mt-5">
            <input type="hidden" name="id" id="id" value="<?= $pasien["id"] ?>">
            <div class="flex flex-col gap-3">
                <label for="nama" class="text-lg font-medium">Nama Pasien</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Pasien" value="<?= $pasien["nama"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <div class="flex flex-col gap-3">
                <label for="alamat" class="text-lg font-medium">Alamat</label>
                <input type="text" name="alamat" id="alamat" placeholder="Alamat" value="<?= $pasien["alamat"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <div class="flex flex-col gap-3">
                <label for="no_ktp" class="text-lg font-medium">Nomor KTP</label>
                <input type="text" name="no_ktp" id="no_ktp" placeholder="Nomor KTP" value="<?= $pasien["no_ktp"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <div class="flex flex-col gap-3">
                <label for="no_hp" class="text-lg font-medium">Nomor Telepon</label>
                <input type="text" name="no_hp" id="no_hp" placeholder="Nomor Telepon" value="<?= $pasien["no_hp"] ?>"
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <div class="flex flex-col gap-3">
                <label for="no_rm" class="text-lg font-medium">Nomor RM</label>
                <input type="text" name="no_rm" id="no_rm" placeholder="Nomor RM" value="<?= $pasien["no_rm"] ?>" readonly
                    class="px-4 py-3 border border-gray-400 outline-none rounded-lg">
            </div>

            <button type="submit" name="submit" class="bg-[#004079] w-fit py-3 px-6 text-white font-medium rounded-lg">Edit
                Data</button>
        </form>
    </main>
</body>

</html>