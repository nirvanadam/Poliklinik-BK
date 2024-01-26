<?php
session_start();

if(isset($_SESSION["login"])){
    header("Location: ../index.php");
    exit;
}

require '../functions/connect_database.php';

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM pasien WHERE username = '$username'"); // Cek di database apakah ada username yg cocok atau tidak

    // Cek username
    if(mysqli_num_rows($result) === 1){ //cek ada berapa baris yang ditemukan (pasti 1)
        // Cek Password
        $row = mysqli_fetch_assoc($result);
        if($password === $row["password"]){
            // Set Session
            $_SESSION["login"] = "true";
            $_SESSION["username"] = $username;
            header("Location: ../pages/pasien/dashboard_pasien.php?username=$username");
            exit;
        }
    }

    if($username === 'admin'){
        if($password === '123'){
             $_SESSION["login"] = "true";
             $_SESSION["username"] = $username;
            header("Location: ../pages/admin/dashboard_admin.php");
        }
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-[100vh] bg-[#1A1F2B]">
    <figure class="basis-1/2 flex justify-center items-center h-full">
        <img src="../assets/images/ilust-patient.svg" alt="" width="75%">
    </figure>

    <main class="basis-1/2 relative flex justify-center items-center bg-white">
        <a href="../index.php">
            <img src="../assets/icons/arrow-left.svg" alt="" width="30px" class="absolute top-8 left-10">
        </a>
        <form action="" method="post" class="w-full px-20">
            <h1 class="text-center text-3xl font-semibold">Login Pasien</h1>
            <div class="flex flex-col gap-5 mt-7">
                <input type="text" name="username" id="" required placeholder="Username"
                    class="bg-gray-200 px-5 py-3 outline-none rounded-lg">
    
                <input type="password" name="password" id="" required placeholder="Password"
                    class="bg-gray-200 px-5 py-3 outline-none rounded-lg">
                
                <?php if(isset($error)) : ?>
                    <!-- <script>alert('Username / Password salah!');</script> -->
                    <h1 class="text-red-500">Username / Password salah!</h1>
                <?php endif; ?>
    
                <button type="submit" name="login" class="mt-3 bg-[#2C3E50] text-white py-3 text-lg font-medium rounded-lg">Login</button>
    
                <div class="flex gap-2 mx-auto">
                    <h1>Belum punya akun?</h1>
                    <a href="registrasi_pasien.php" class="font-medium underline">Registrasi</a>
                </div>
            </div>
        </form>
    </main>
</body>

</html>