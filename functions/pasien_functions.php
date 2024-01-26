<?php 
// Fungsi Registrasi
function registrasi($data_form){
    global $conn;

    $username = strtolower(stripslashes($data_form["username"]));
    $password = mysqli_real_escape_string($conn, $data_form["password"]);
    $nama = mysqli_real_escape_string($conn, $data_form["nama"]);
    $alamat = mysqli_real_escape_string($conn, $data_form["alamat"]);
    $no_ktp = mysqli_real_escape_string($conn, $data_form["no_ktp"]);
    $no_hp = mysqli_real_escape_string($conn, $data_form["no_hp"]);

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM pasien WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "
            <script>
                alert('Username sudah terdaftar!');
            </script>
        ";
        return false;
    }
    
    // Enkripsi Password
    // $password = password_hash($password, PASSWORD_DEFAULT);

    // Mengambil nomor RM terakhir
    $result = mysqli_query($conn, "SELECT MAX(CAST(SUBSTRING(no_rm, 8) AS SIGNED)) as max_no_rm FROM pasien");
    $row = mysqli_fetch_assoc($result);
    $max_no_rm = $row['max_no_rm'];

    // Membuat nomor RM baru
    if ($max_no_rm === null) {
        $new_no_rm = '202312-1';
    } else {
        $new_no_rm = '202312-' . ($max_no_rm + 1);
    }
    
    // Tambahkan user baru ke database dengan nomor RM baru
    mysqli_query($conn, "INSERT INTO pasien VALUES('', '$username', '$password', '$nama', '$alamat', '$no_ktp', '$no_hp', '$new_no_rm')");

    return mysqli_affected_rows($conn);
}

// Fungsi Tambah Daftar Poli
function tambah_poli($data_form){
    global $conn;

     // Ambil data dari tiap elemen dalam form
    $id_pasien = htmlspecialchars($data_form["id_pasien"]);
    $id_jadwal = htmlspecialchars($data_form["id_jadwal"]);
    $keluhan = htmlspecialchars($data_form["keluhan"]);
    $status_periksa = htmlspecialchars($data_form["status_periksa"]);

    // Query insert data
    $query = "INSERT INTO daftar_poli VALUES ('', '$id_pasien', '$id_jadwal', '$keluhan', '', '$status_periksa')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>
