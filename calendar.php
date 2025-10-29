<?php include '_header.php'; ?>

<!-- Main -->
<main class="pt-28 p-3 flex flex-col items-center">
    <section id="header"
        class="w-11/12 max-w-7xl p-6 md:p-6 mx-auto mb-8 flex flex-col gap-5 items-stretch rounded-2xl bg-[#011538] border border-[#b9da05]">
        <div class="flex justify-between items-center mb-4 ">
            <button onclick="goToToday()"
                class="px-3 py-1 text-xs sm:px-3 sm:py-1.5 sm:text-sm md:px-4 md:py-2 md:text-base 
                        bg-white/10 border border-white/20 text-white rounded-lg hover:bg-[#b9da05] hover:text-[#011538] transition">
                Today
            </button>

            <div class="flex-1"></div>

            <!-- <div class="flex items-center space-x-4 text-white">
                    <button onclick="navigateCalendar(-1)"
                        class="text-2xl hover:text-[#b9da05] transition">&larr;</button>
                    <h2 id="calendar-month-title" class="text-xl font-bold font-orbitron"></h2>
                    <button onclick="navigateCalendar(1)"
                        class="text-2xl hover:text-[#b9da05] transition">&rarr;</button>
                </div> -->

            <div class="flex items-center space-x-2">
                <button onclick="navigateCalendar(-1)"
                    class="p-1.5 rounded-full bg-white/10 border border-white/20 text-gray-300 hover:bg-[#b9da05] hover:text-[#011538] transition text-sm">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
                <p id="calendar-month-title"
                    class="text-xs sm:text-sm md:text-lg lg:text-xl text-white font-semibold text-center truncate max-w-[120px] sm:max-w-none">
                </p>
                <button onclick="navigateCalendar(1)"
                    class="p-1.5 rounded-full bg-white/10 border border-white/20 text-gray-300 hover:bg-[#b9da05] hover:text-[#011538] transition text-sm">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>

        <!-- class="grid grid-cols-7 bg-[#02205c] text-center text-xs sm:text-xs md:text-base font-semibold text-white border-b border-white/10"> -->
        <div class="border border-white/10 rounded-lg flex flex-col flex-1 overflow-hidden">
            <div
                class="grid grid-cols-7 p-2 bg-[#b9da05]/20 text-[#b9da05] text-center text-xs sm:text-xs md:text-base font-medium border-b border-white/20">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            <div id="calendar-grid" class="grid grid-cols-7 flex-1 auto-rows-fr"></div>
        </div>
    </section>
</main>

<script>
    const API_BASE = "/updated-msc-website/api";

    async function apiCall(endpoint, method = "GET", data = null) {
        try {
            const options = {
                method: method,
                headers: {
                    "Content-Type": "application/json",
                },
                credentials: "include",
            };

            if (data) {
                options.body = JSON.stringify(data);
            }

            const response = await fetch(`${API_BASE}${endpoint}`, options);
            const result = await response.json();

            return result;
        } catch (error) {
            console.error("API Error:", error);
            return null;
        }
    }

    (async function fetchProfile() {
        document.documentElement.classList.add('loading'); // keep body hidden while checking
        const data = await apiCall("/auth/profile", "GET");

        if (!data || !data.success) {
            // Not logged in → redirect
            window.location.href = "login.html";
            return;
        }

        // Logged in → remove loading state
        document.documentElement.classList.remove('loading');
    })();
</script>

<?php include '_footer.php'; ?>