<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/dokter_functions.php';

$id = $_GET["id"];

if(hapus_jadwal($id) > 0){
     echo "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'jadwal_periksa.php';
            </script>
        ";
} else{
     echo "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'jadwal_periksa.php';
            </script>
        ";
}
 ?>