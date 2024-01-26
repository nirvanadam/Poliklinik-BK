<?php 
// Connect ke database
$conn = mysqli_connect("localhost", "root", "", "poli" ); // host, username, password, nama database

function query($query){
    global $conn;
    $data_pack = mysqli_query($conn, $query);
    $data = [];
    while ($item = mysqli_fetch_assoc($data_pack)) {
        $data[] = $item;
    }
    return $data;
}
 ?>