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

    <main class="grid grid-cols-2 divide-x divide-y divide-gray-500 overflow-hidden w-full bg-[#292E3B bg-white rounded-2xl my-7 mr-5">
            <a href="daftar_poli.php"
                class="flex flex-col justify-center items-center gap-5 g-[#004079] px-14 py-10 hover:bg-gray-500 group transition-all duration-300 group">
                <img src="../../assets/icons/cross.svg" alt="" width="100px" class="p-2 rounded-lg invert group-hover:invert-0">
                <h1 class="scale-0 text-white text-4xl font-semibold group-hover:scale-100 transition-all duration-300 uppercase">Daftar Poli</h1>
            </a>

            <a href="riwayat_daftar.php"
                class="flex flex-col justify-center items-center gap-5 g-[#004079] px-14 py-10 hover:bg-gray-500 group transition-all duration-300">
                <img src="../../assets/icons/notebook-pen.svg" alt="" width="100px" class="p-2 rounded-lg invert group-hover:invert-0">
                <h1 class="scale-0 text-white text-4xl font-semibold group-hover:scale-100 transition-all duration-300 uppercase">Riwayat Daftar Poli</h1>
            </a>
    </main>
</body>

</html>