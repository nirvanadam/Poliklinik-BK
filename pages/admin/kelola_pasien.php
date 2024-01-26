<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/admin_functions.php';

// Ambil data dari tabel poli
$pasien = query("SELECT * FROM pasien");

// Fungsi untuk mendapatkan nomor RM terakhir
function getLatestRMNumber() {
    global $conn;

    $query = "SELECT no_rm FROM pasien ORDER BY no_rm DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['no_rm'];
    }

    return null;
}

// Fungsi untuk menghasilkan nomor RM baru
function generateNewRMNumber($latestRM) {
    // Pisahkan tahun dan nomor urut
    list($tahun, $nomorUrut) = explode('-', $latestRM);

    // Tambah 1 ke nomor urut
    $newNomorUrut = intval($nomorUrut) + 1;

    // Gabungkan tahun dan nomor urut yang baru
    $newRMNumber = $tahun . '-' . $newNomorUrut;

    return $newRMNumber;
}

// Mendapatkan nomor RM terakhir
$latestRM = getLatestRMNumber();

// Jika tidak ada nomor RM sebelumnya, gunakan nomor RM awal
if (!$latestRM) {
    $latestRM = '202312-1';
}

// Menghasilkan nomor RM baru
$newRMNumber = generateNewRMNumber($latestRM);

// Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    // Cek apakah data berhasil ditambahkan atau tidak
    if(tambah_pasien($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
            </script>
        ";
        header("Location: kelola_pasien.php");
    } else{
        echo "
             <script>
                alert('Data gagal ditambahkan!');
            </script>
        ";
        header("Location: kelola_pasien.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex gap-5 bg-[#1A1F2B]">
    <!-- Side Bar -->
    <?= include("../../components/sidebar_admin.php"); ?>
    <!-- Side Bar End -->

    <main class="flex flex-col w-full bg-[#292E3B bg-white pb-10">
        <header class="flex items-center gap-3 px-8 py-7 shadow-lg">
            <img src="../../assets/icons/pasien-icon.svg" alt="" width="30px" class="invert">
            <h1 class="text-3xl font-medium">Kelola Pasien</h1>
        </header>

        <article>
            <form action="" method="post" class="flex flex-col gap-5 mt-8 mx-5 p-8 bg-[#e0e0e0] rounded-2xl">
                <div class="flex flex-col gap-3">
                    <label for="nama" class="text-lg font-medium">Nama Pasien</label>
                    <input type="text" name="nama" id="nama" placeholder="Nama Pasien"
                        class="px-4 py-3 outline-none rounded-lg">
                </div>

                <div class="flex flex-col gap-3">
                    <label for="alamat" class="text-lg font-medium">Alamat</label>
                    <input type="text" name="alamat" id="alamat" placeholder="Alamat"
                        class="px-4 py-3 outline-none rounded-lg">
                </div>

                <div class="flex flex-col gap-3">
                    <label for="no_ktp" class="text-lg font-medium">Nomor KTP</label>
                    <input type="text" name="no_ktp" id="no_ktp" placeholder="Nomor KTP"
                        class="px-4 py-3 outline-none rounded-lg">
                </div>

                <div class="flex flex-col gap-3">
                    <label for="no_hp" class="text-lg font-medium">Nomor Telepon</label>
                    <input type="text" name="no_hp" id="no_hp" placeholder="Nomor Telepon"
                        class="px-4 py-3 outline-none rounded-lg">
                </div>

                <div class="flex flex-col gap-3">
                    <label for="no_rm" class="text-lg font-medium">Nomor RM</label>
                    <input type="text" name="no_rm" value="<?php echo $newRMNumber; ?>" id="no_rm" readonly placeholder="Nomor RM"
                        class="px-4 py-3 outline-none rounded-lg">
                </div>

                <button type="submit" name="submit"
                    class="bg-[#004079] w-fit py-3 px-6 text-white font-medium rounded-lg">Tambah
                    Data</button>
            </form>

            <section class="mt-8 mx-5 p-8 border border-gray-300 rounded-2xl">
                <h1 class="mb-5 text-2xl font-medium">Daftar Obat</h1>
                <table class="w-full table-fixed border border-yellow-500">
                    <thead class="">
                        <tr>
                            <th class="w-[5%] border border-slate-500 py-3">No</th>
                            <th class="border border-slate-500 py-3">Nama Pasien</th>
                            <th class="border border-slate-500 py-3">Alamat</th>
                            <th class="border border-slate-500 py-3">No. KTP</th>
                            <th class="border border-slate-500 py-3">No. Telepon</th>
                            <th class="border border-slate-500 py-3">No. RM</th>
                            <th class="w-[20%] border border-slate-500 py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="">
                        <?php $index = 1; ?>
                        <?php foreach($pasien as $item) : ?>
                        <tr>
                            <td class="border border-slate-500 py-5 text-center">
                                <?= $index  ?>
                            </td>
                            <td class="border border-slate-500 py-5 text-center">
                                <?= $item["nama"]  ?>
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
                                <a href="edit_pasien.php?id=<?= $item["id"] ?>" class="bg-green-500 px-6 py-2 rounded-lg text-white mr-3">Edit</a>
                                <a href="hapus_pasien.php?id=<?= $item["id"] ?>" class="bg-red-500
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