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

// Langkah 2: Menggunakan Query SQL untuk Mengambil id_dokter
$query = "SELECT no_rm FROM pasien WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// Langkah 3: Eksekusi Query dan Mendapatkan Hasil
if ($row = mysqli_fetch_assoc($result)) {
    $no_rm = $row['no_rm'];
}

if(isset($_POST["poli"])){
    echo "
        <script>
            alert('Hai!');
        </script>
    ";
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
    <!-- <script>
        var poli = "<?php echo $poli; ?>";
        alert(poli);
    </script> -->

    <!-- Side Bar -->
    <?= include("../../components/sidebar_pasien.php"); ?>
    <!-- Side Bar End -->

    <main class="flex flex-col w-full bg-[#292E3B bg-white pb-10">
         <header class="flex items-center gap-3 px-8 py-7 shadow-lg">
            <img src="../../assets/icons/notebook-pen.svg" alt="" width="30px" class="invert">
            <h1 class="text-3xl font-medium">Riwayat Daftar Poli</h1>
        </header>

        <article class="flex gap-2 px-3">
            <div class="mt-8">
                <h1 class="bg-[#1A1F2B] px-5 py-4 text-white text-xl font-medium rounded-t-2xl">Riwayat Daftar Poli</h1>
                <table class=" w-full  table-fixed border border-yellow-500">
                       <thead class="">
                           <tr>
                               <th class=" border border-slate-500 py-3">No</th>
                               <th class=" border border-slate-500 py-3">Poli</th>
                               <th class=" border border-slate-500 py-3">Dokter</th>
                               <th class=" border border-slate-500 py-3">Hari</th>
                               <th class=" border border-slate-500 py-3">Mulai</th>
                               <th class=" border border-slate-500 py-3">Selesai</th>
                               <th class=" border border-slate-500 py-3">Antrian</th>
                               <th class=" border border-slate-500 py-3">Aksi</th>
                           </tr>
                       </thead>
   
                       <!-- <tbody class="">
                           <?php $index = 1; ?>
                           <?php foreach($poli as $item) : ?>
                           <tr>
                               <td class="border border-slate-500 py-5 text-center">
                                   <?= $index  ?>
                               </td>
                               <td class="border border-slate-500 py-5 text-center">
                                   <?= $item["nama_obat"]  ?>
                               </td>
                               <td class="border border-slate-500 py-5 text-center">
                                   <?= $item["kemasan"] ?>
                               </td>
                               <td class="border border-slate-500 py-5 text-center">Rp
                                   <?= $item["harga"] ?>
                               </td>
                               <td class="border border-slate-500 py-5 text-center">
                                   <a href="edit_obat.php?id=<?= $item["id"] ?>" class="bg-green-500 px-6 py-2 rounded-lg text-white mr-3">Edit</a>
                                   <a href="hapus_obat.php?id=<?= $item["id"] ?>" class="bg-red-500
                                       px-6 py-2 rounded-lg text-white">Delete</a>
                               </td>
                           </tr>
                           <?php $index++ ?>
                           <?php endforeach; ?>
                       </tbody> -->
                   </table>
            </div>
        </article>
    </main>
</body>

</html>