<?php 
session_start();

if(!isset($_SESSION["login"])){
    header("Location: ../../index.php");
    exit;
}

require '../../functions/connect_database.php';
require '../../functions/admin_functions.php';

$id = $_GET["id"];

if(hapus_obat($id) > 0){
     echo "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'kelola_obat.php';
            </script>
        ";
} else{
     echo "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'kelola_obat.php';
            </script>
        ";
}
 ?>