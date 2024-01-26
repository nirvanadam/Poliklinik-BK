<?php 
// ==================== Fungsi Kelola Dokter ====================
// Fungsi Tambah Dokter
function tambah_dokter($data_form){
    global $conn;

     // Ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data_form["nama"]);
    $alamat = htmlspecialchars($data_form["alamat"]);
    $no_hp = htmlspecialchars($data_form["no_hp"]);
    $nama_poli = htmlspecialchars($data_form["nama_poli"]);

    // Query insert data
    $query = "INSERT INTO dokter VALUES ('', '', '', '$nama', '$alamat','$no_hp', '$nama_poli')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Fungsi Delete Dokter
function hapus_dokter($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM dokter WHERE id = $id");
    
    return mysqli_affected_rows($conn); 
}

// Fungsi Edit Dokter
function edit_dokter($data_form){
    global $conn;

    // Ambil data dari tiap elemen dalam form
    $id = $data_form["id"]; 
    $nama = htmlspecialchars($data_form["nama"]);
    $alamat = htmlspecialchars($data_form["alamat"]);
    $no_hp = htmlspecialchars($data_form["no_hp"]);
    $id_poli = htmlspecialchars($data_form["nama_poli"]);

    // Query insert data
    $query = "UPDATE dokter SET nama = '$nama', alamat = '$alamat', no_hp = '$no_hp', id_poli = '$id_poli' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
// ==================== Fungsi Kelola Dokter End ====================

// ==================== Fungsi Kelola Pasien ====================

// Fungsi Tambah Pasien
function tambah_pasien($data_form){
    global $conn;

     // Ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data_form["nama"]);
    $alamat = htmlspecialchars($data_form["alamat"]);
    $no_ktp = htmlspecialchars($data_form["no_ktp"]);
    $no_hp = htmlspecialchars($data_form["no_hp"]);
    $no_rm = htmlspecialchars($data_form["no_rm"]);

    // Query insert data
    $query = "INSERT INTO pasien VALUES ('', '', '', '$nama', '$alamat', '$no_ktp', '$no_hp', '$no_rm')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Fungsi Delete Pasien
function hapus_pasien($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM pasien WHERE id = $id");
    
    return mysqli_affected_rows($conn); 
}

// Fungsi Edit Pasien
function edit_pasien($data_form){
    global $conn;

    // Ambil data dari tiap elemen dalam form
    $id = $data_form["id"]; 
    $nama = htmlspecialchars($data_form["nama"]);
    $alamat = htmlspecialchars($data_form["alamat"]);
    $no_ktp = htmlspecialchars($data_form["no_ktp"]);
    $no_hp = htmlspecialchars($data_form["no_hp"]);
    $no_rm = htmlspecialchars($data_form["no_rm"]);

    // Query insert data
    $query = "UPDATE pasien SET nama = '$nama', alamat = '$alamat', no_ktp = '$no_ktp', no_hp = '$no_hp', no_rm = '$no_rm' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
// ==================== Fungsi Kelola Pasien End ====================


// ==================== Fungsi Kelola Poli ====================

//Fungsi Create Poli
function tambah_poli($data_form){
    global $conn;

     // Ambil data dari tiap elemen dalam form
    $nama_poli = htmlspecialchars($data_form["nama_poli"]);
    $keterangan = htmlspecialchars($data_form["keterangan"]);

    // Query insert data
    $query = "INSERT INTO poli VALUES ('', '$nama_poli', '$keterangan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Fungsi Delete Poli
function hapus_poli($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM poli WHERE id = $id");
    
    return mysqli_affected_rows($conn); 
}

// Fungsi Edit Poli
function edit_poli($data_form){
    global $conn;

    // Ambil data dari tiap elemen dalam form
    $id = $data_form["id"]; 
    $nama_poli = htmlspecialchars($data_form["nama_poli"]);
    $keterangan = htmlspecialchars($data_form["keterangan"]);

    // Query insert data
    $query = "UPDATE poli SET nama_poli = '$nama_poli', keterangan = '$keterangan' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
// ==================== Fungsi Kelola Poli End ====================

// ==================== Fungsi Kelola Obat ====================

// Fungsi Create Obat
function tambah_obat($data_form){
    global $conn;

     // Ambil data dari tiap elemen dalam form
    $nama_obat = htmlspecialchars($data_form["nama_obat"]);
    $kemasan = htmlspecialchars($data_form["kemasan"]);
    $harga = htmlspecialchars($data_form["harga"]);

    // Query insert data
    $query = "INSERT INTO obat VALUES ('', '$nama_obat', '$kemasan', '$harga')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Fungsi Delete Obat
function hapus_obat($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM obat WHERE id = $id");
    
    return mysqli_affected_rows($conn); 
}

// Fungsi Edit Obat
function edit_obat($data_form){
    global $conn;

    // Ambil data dari tiap elemen dalam form
    $id = $data_form["id"]; 
    $nama_obat = htmlspecialchars($data_form["nama_obat"]);
    $kemasan = htmlspecialchars($data_form["kemasan"]);
    $harga = htmlspecialchars($data_form["harga"]);

    // Query insert data
    $query = "UPDATE obat SET nama_obat = '$nama_obat', kemasan = '$kemasan', harga = '$harga' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
// ==================== Fungsi Kelola Obat End ====================
?>