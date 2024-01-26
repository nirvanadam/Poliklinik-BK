  <aside class="flex flex-col w-[250px] h-[100vh] order-r-4 border-slate-600 pl-6 pr-8 py-10 sticky top-0">
        <!-- Profile -->
        <div class="flex flex-col items-center gap-3">
            <img src="../../assets/images/profile.jpg" alt="" width="50px" class="rounded-full">
            <h1 class="text-lg text-white">Dokter</h1>
        </div>
        <!-- Profile End -->

        <!-- Menu -->
        <div class="flex flex-col gap-5 mt-10">
            <a href="dashboard_dokter.php"
                class="flex items-center gap-3 pr-5 pl-2 py-1 rounded-lg hover:bg-[#2C3E50] hover:translate-x-4 transition-all duration-300">
                <img src="../../assets/icons/dashboard-icon.svg" alt="" class="p-2 bg-[#2C3E50] rounded-lg">
                <h1 class="text-white font-medium">Dashboard</h1>
            </a>

            <a href="jadwal_periksa.php"
                class="flex items-center gap-3 pr-5 pl-2 py-1 rounded-lg hover:bg-[#2C3E50] hover:translate-x-4 transition-all duration-300">
                <img src="../../assets/icons/clipboard-list.svg" alt="" class="p-2 bg-[#2C3E50] rounded-lg">
                <h1 class="text-white font-medium">Jadwal Periksa</h1>
            </a>

            <a href="memeriksa_pasien.php"
                class="flex items-center gap-3 pr-5 pl-2 py-1 rounded-lg hover:bg-[#2C3E50] hover:translate-x-4 transition-all duration-300">
                <img src="../../assets/icons/stethoscope-icon.svg" alt="" class="p-2 bg-[#2C3E50] rounded-lg">
                <h1 class="text-white font-medium">Memeriksa Pasien</h1>
            </a>

            <a href="riwayat_pasien.php"
                class="flex items-center gap-3 pr-5 pl-2 py-1 rounded-lg hover:bg-[#2C3E50] hover:translate-x-4 transition-all duration-300">
                <img src="../../assets/icons/notebook-pen.svg" alt="" class="p-2 bg-[#2C3E50] rounded-lg">
                <h1 class="text-white font-medium">Riwayat Pasien</h1>
            </a>

            <a href="profil.php"
                class="flex items-center gap-3 pr-5 pl-2 py-1 rounded-lg hover:bg-[#2C3E50] hover:translate-x-4 transition-all duration-300">
                <img src="../../assets/icons/pasien-icon.svg" alt="" class="p-2 bg-[#2C3E50] rounded-lg">
                <h1 class="text-white font-medium">Profil</h1>
            </a>

            <a href="../../auth/logout.php"
                class="absolute bottom-7 flex items-center gap-3 pr-5 pl-2 py-1 rounded-lg hover:bg-red-500 hover:translate-x-4 transition-all duration-300">
                <img src="../../assets/icons/log-out.svg" alt="" class="p-2 rounded-lg">
                <h1 class="text-white font-medium">Log Out</h1>
            </a>
        </div>
        <!-- Menu End -->
    </aside>