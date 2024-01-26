<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to PoliBK!</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex gap-20 items-center h-[100vh] bg-[#1A1F2B] px-28">
    <!-- Left Side -->
    <div class="flex flex-col gap-5">
        <h1 class="text-white text-6xl font-medium leading-snug">Selamat datang di <span class="text-[#3498DB]">Poliklinik
                BK!</span>
        </h1>
        <h1 class="text-white text-xl">Temukan keseimbangan dan kebahagiaan hidup bersama kami. Bersama, kita jembatani
            kesehatan mental menuju kehidupan yang lebih baik.</h1>
        <div class="flex gap-5 mt-5">
            <a href="auth/login_pasien.php" class=" flex items-center justify-center bg-white px-10 py-3 font-medium">Login Pasien</a>
            <a href="auth/login_dokter.php"
                class=" flex items-center justify-center border border-white text-white px-10 py-3 font-medium">Login
                Dokter</a>
        </div>
    </div>
    <!-- Left Side End -->

    <!-- Right Side -->
    <img src="assets/images/ilust-doctor.svg" width="600px" alt="">
    <!-- Right Side End -->
</body>

</html>