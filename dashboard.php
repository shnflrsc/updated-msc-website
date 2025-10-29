<?php include '_header.php'; ?>

<main class="pt-28 flex-row justify-center">
    <!-- Security Modal -->
    <div id="security-reminder"
        class="hidden fixed top-6 right-6 z-50 bg-[#011538] border border-[#b9da05] text-white shadow-lg rounded-lg w-80 p-4">
        <p class="text-gray-700 mb-4">
            For your security, please update your personal information and change your password.
        </p>
        <div class="flex justify-end">
        </div>
    </div>

    <section
        class="relative w-11/12 max-w-7xl mx-auto p-6 md:p-8 bg-[#011538] border border-[#b9da05] text-white rounded-2xl shadow-2xl cursor-pointer transition transform hover:-translate-y-1"
        id="dashboard-header">
        <div class="absolute inset-0 bg-gradient-to-r from-custom-primary via-custom-secondary to-custom-primary-light rounded-2xl opacity-70 animate-glowing"
            style="filter: blur(15px); background-size: 400% 400%; z-index: -1;"></div>
        <h2 class="text-xl sm:text-xl md:text-2xl lg:text-3xl font-bold mb-1" id="welcome-msg"></h2>
        <p class="text-base sm:text-md md:text-lg lg:text-xl text-gray-300 mb-6">
            Here's what's happening with your membership and upcoming events.
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div
                class="bg-white/10 backdrop-blur-sm border border-white/50 p-4 rounded-lg text-center hover:bg-white/20 transition-all">
                <p class="text-xs sm:text-sm font-semibold text-gray-300 mb-1">Membership</p>
                <div class="text-xl sm:text-2xl font-bold text-white" id="membershipStatus"></div>
            </div>
            <div
                class="bg-white/10 backdrop-blur-sm border border-white/50 p-4 rounded-lg text-center hover:bg-white/20 transition-all">
                <p class="text-xs sm:text-sm font-semibold text-gray-300 mb-1">Events Joined</p>
                <div class="text-xl sm:text-2xl font-bold text-white" id="attendedCount"></div>
            </div>
            <div
                class="bg-white/10 backdrop-blur-sm border border-white/50 p-4 rounded-lg text-center hover:bg-white/20 transition-all">
                <p class="text-xs sm:text-sm font-semibold text-gray-300 mb-1">Pre-Registered</hp>
                <div class="text-xl sm:text-2xl font-bold text-white" id="registeredCount"></div>
            </div>
        </div>
    </section>

    <!-- Member Profile -->
    <section id="memberProfile"
        class="flex flex-col lg:flex-row items-stretch w-11/12 max-w-7xl mx-auto my-8 gap-5">
        <div
            class="w-full lg:w-5/12 p-6 py-4 shadow-xl rounded-lg bg-[#011538] border border-white/20 text-white flex flex-col">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/20">
                <h3 class="text-base sm:text-lg font-semibold text-gray-200">Member Profile</h3>
                <div
                    class="p-2 w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center text-[#b9da05] bg-white/10 rounded-full">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            <div class="">
                <div class="w-28 h-28 mx-auto mb-4 mt-8 rounded-full border-4 border-[#b9da05] shadow-md overflow-hidden"
                    id="profile-picture-container">
                    <!-- Default: Profile pic thru user's initials -->
                </div>
            </div>

            <div class="flex flex-col items-center justify-center text-center">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold" id="lastName"></h2>
                    <h2 class="text-xl text-gray-300" id="firstName"></h2>
                    <p class="text-l text-gray-300" id="studentNo"></p>
                    <p class="text-m font-medium text-white" id="program"></p>
                </div>
            </div>

            <div class="flex justify-center gap-4 m-4">
                <span class="w-5/12 bg-[#03850a] text-m text-white py-1 px-2 rounded-full text-center">Active</span>
                <span class="w-5/12 bg-[#03378f]  text-white py-1 px-2 rounded-full text-center" id="role"></span>
            </div>

            <section class="grid grid-cols-1 sm:grid-cols-2 w-full gap-4 rounded-lg">
                <div class="bg-white/10 p-6 rounded-lg">
                    <label class="block text-xs text-gray-300">College</label>
                    <p id="user-college" class="font-medium text-white"></p>
                </div>
                <div class="bg-white/10 p-6 rounded-lg">
                    <label class="block text-xs text-gray-300">Year Level</label>
                    <p id="user-year-level" class="font-medium text-white"></p>
                </div>
                <div class="bg-white/10 p-6 rounded-lg">
                    <label class="block text-xs text-gray-300">Membership ID</label>
                    <p id="user-msc-id" class="font-medium text-white"></p>
                </div>
                <div class="bg-white/10 p-6 rounded-lg">
                    <label class="block text-xs text-gray-300">Last Login</label>
                    <p id="user-last-login" class="font-medium text-white"></p>
                </div>
            </section>

            <div class="w-full flex flex-col sm:flex-row gap-2 py-2">
                <a href="edit_profile.html"
                    class="w-full sm:w-6/12 bg-[#b9da05] text-[#011538] font-semibold py-2 px-4 rounded-lg transition-colors duration-300 hover:bg-[#9abc04] shadow-md text-center flex items-center justify-center gap-2">
                    <i class="fa-solid fa-user-pen"></i>
                    Edit Profile
                </a>

                <a href="change_passwordform.html"
                    class="w-full sm:w-6/12 bg-[#b9da05] text-[#011538] font-semibold py-2 px-4 rounded-lg transition-colors duration-300 hover:bg-[#9abc04] shadow-md text-center flex items-center justify-center gap-2">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                    Change Password
                </a>
            </div>

            <button onclick="logout()"
                class="w-full bg-[#d60202] text-white py-2 px-2 rounded-lg transition-colors duration-300 hover:bg-[#b03030] shadow-md">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out
            </button>

        </div>

        <!-- Right Tabs -->
        <div
            class="w-full lg:w-8/12 p-4 shadow-lg rounded-lg mx-auto bg-[#011538] border border-white/20 text-white flex flex-col">
            <div class="flex justify-between items-center border-b border-white/20 pb-2">
                <div class="flex flex-wrap gap-4 sm:gap-6" id="tabs">
                    <h3 class="tab text-xs sm:text-base font-semibold cursor-pointer text-[#b9da05] border-b-2 border-[#b9da05] active-tab"
                        data-tab="announcements">Announcements</h3>
                    <h3 class="tab text-xs sm:text-base text-gray-200 font-semibold cursor-pointer hover:text-[#b9da05]"
                        data-tab="events">Events</h3>
                    <h3 class="tab text-xs sm:text-base text-gray-200 font-semibold cursor-pointer hover:text-[#b9da05]"
                        data-tab="univ-calendar">University Calendar</h3>
                </div>

                <div
                    class="relative p-1 w-8 h-8 sm:p-2 sm:w-10 sm:h-10 bg-white/10 text-[#b9da05] rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-bell text-sm sm:text-base"></i>
                    <span
                        class="absolute top-0 right-0 block h-2 w-2 sm:h-3 sm:w-3 rounded-full bg-red-500 border-2 border-[#011538]"></span>
                </div>
            </div>

            <!-- Tab Contents -->
            <div class="mt-6 space-y-2">
                <div class="tab-content max-h-[38rem] overflow-y-auto" id="tab-announcements">
                    <p class="text-gray-300"></p>

                </div>
                <div class="tab-content hidden max-h-[38rem] overflow-y-auto" id="tab-events">
                    <p class="text-gray-300"></p>
                </div>

                <!-- relative max-w-5xl w-full mx-auto text-sm -->
                <div class="tab-content hidden" id="tab-univ-calendar">
                    <div class="">
                        <div id="univ-calendar" class="mt-2 px-4">
                            <div class="flex justify-between items-center mb-4">
                                <button id="prevWeek"
                                    class="px-2.5 py-1 text-xs sm:px-3 sm:py-1.5 sm:text-sm md:px-4 md:py-2 md:text-base 
                                                bg-white/10 border border-white/20 text-white rounded-lg hover:bg-[#b9da05] hover:text-[#011538] transition">
                                    Previous
                                </button>
                                <p class="text-sm sm:text-base md:text-lg lg:text-xl font-semibold text-gray-200"
                                    id="week-range"></p>
                                <button id="nextWeek"
                                    class="px-2.5 py-1 text-xs sm:px-3 sm:py-1.5 sm:text-sm md:px-4 md:py-2 md:text-base 
                                                bg-white/10 border border-white/20 text-white rounded-lg hover:bg-[#b9da05] hover:text-[#011538] transition">
                                    Next
                                </button>
                            </div>
                            <div class="border border-white/20 rounded-lg overflow-hidden">
                                <div id="univ-calendar-grid"
                                    class="grid grid-rows-7 gap-2 text-xs text-gray-200 w-full">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Univ Calendar -->
            </div>
        </div>
    </section>

    <!-- Registered Events -->
    <section class="flex flex-col lg:flex-row w-11/12 max-w-7xl mx-auto my-8 gap-5">
        <div
            class="lg:w-5/12 max-h-[37rem] p-4 shadow-lg rounded-lg bg-[#011538] border border-white/20 flex flex-col text-white">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/20">
                <h3 class="text-base sm:text-lg font-bold">My Registered Events</h3>
                <div
                    class="p-2 w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center text-[#b9da05] bg-white/10 rounded-full">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>

            <!-- Registered Events List -->
            <div id="registered-events-list" class="space-y-4 overflow-y-auto pr-2 pt-4 flex-grow">
            </div>
        </div>

        <!-- General Calendar: with Event dots -->
        <div
            class="w-full lg:w-8/12 p-4 shadow-lg rounded-lg bg-[#011538] border border-white/20 text-white flex flex-col">
            <div class="flex items-center justify-between mb-4 border-b border-white/20 pb-2">
                <h3 class="text-base sm:text-lg font-bold">Calendar</h3>
                <div
                    class="p-2 w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center text-[#b9da05] bg-white/10 rounded-full">
                    <i class="fa-solid fa-calendar text-sm sm:text-base md:text-lg"></i>
                </div>
            </div>

            <div class="flex justify-between items-center mb-4 pb-2">
                <button onclick="goToToday()"
                    class="px-2.5 py-1 text-xs sm:px-3 sm:py-1.5 sm:text-sm md:px-4 md:py-2 md:text-base 
                        bg-white/10 border border-white/20 text-white rounded-lg hover:bg-[#b9da05] hover:text-[#011538] transition">
                    Today
                </button>
                <div class="flex items-center space-x-2">
                    <button onclick="navigateCalendar(-1)"
                        class="p-1.5 rounded-full bg-white/10 border border-white/20 text-gray-300 hover:bg-[#b9da05] hover:text-[#011538] transition text-sm">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>
                    <p id="calendar-month-title"
                        class="text-xs sm:text-sm md:text-lg lg:text-xl text-whitefont-semibold text-center truncate max-w-[120px] sm:max-w-none">
                    </p>
                    <button onclick="navigateCalendar(1)"
                        class="p-1.5 rounded-full bg-white/10 border border-white/20 text-gray-300 hover:bg-[#b9da05] hover:text-[#011538] transition text-sm">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="border border-white/20 rounded-lg flex-grow flex flex-col">
                <div
                    class="grid grid-cols-7 p-2 bg-[#b9da05]/20 text-[#b9da05] text-center text-sm font-medium border-b border-white/20">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div id="calendar-grid" class="grid grid-cols-7 flex-1 h-full auto-rows-[1fr]"></div>
            </div>
        </div>

        <!-- Modal: University Calendar -->
        <div id="univ-modal-overlay"
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
            <div
                class="bg-[#011538] border border-white/20 rounded-lg shadow-xl max-w-md w-full mx-4 p-6 relative text-white">
                <button onclick="closeUnivCalendarModal()"
                    class="absolute top-3 right-3 text-gray-400 hover:text-red-500">
                    ✕
                </button>
                <p id="univ-modal-title" class="text-xl font-semibold text-white mb-4"></p>
                <div id="univ-modal-content" class="space-y-2 text-gray-200 text-sm"></div>
            </div>
        </div>
    </section>
</main>

<script>
    const API_BASE = "/updated-msc-website/api";

    async function apiCall(endpoint, method = "GET", data = null, title = "") {
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

    //const loadingScreen = document.getElementById("loading-screen");
    async function fetchProfile() {
        const data = await apiCall("/auth/profile", "GET");

        if (!data || !data.success) {
            window.location.href = "login.html";
            loadingScreen.classList.add("opacity-0");
            setTimeout(() => window.location.href = "login.html", 800);
            return;
        }

        const user = data.data;

        if (user.password_updated === 0) {
            document.getElementById("security-reminder").classList.remove("hidden");
        }

        fetchStudentEventStats(user.id);
        loadRegisteredEvents(user.id);
        fetchMembershipStatus();
        loadAnnouncements();
        loadEvents();

        document.getElementById("welcome-msg").innerHTML = `Welcome back, <span class="text-[#b9da05]">${user.first_name} ${user.last_name}!</span>`;
        document.getElementById("lastName").textContent = `${user.last_name},`;
        document.getElementById("firstName").textContent = user.first_name;
        document.getElementById("studentNo").textContent = user.student_no;
        document.getElementById("program").textContent = user.program;
        document.getElementById("role").textContent = user.role;
        document.getElementById("user-college").textContent = user.college;
        document.getElementById("user-year-level").textContent = user.year_level;
        document.getElementById("user-msc-id").textContent = user.msc_id;
        document.getElementById("user-last-login").textContent = new Date().toLocaleString();

        const initials = `${user.first_name?.charAt(0) || ""}${user.last_name?.charAt(0) || ""}`.toUpperCase();
        renderProfilePicture(user.profile_image_path, initials);

        document.documentElement.classList.remove("loading");
        // After rendering all user data and stats
        document.body.classList.remove("loading"); // <-- Add this
        //loadingScreen.classList.add("opacity-0");
        //setTimeout(() => loadingScreen.remove(), 800);
    };

    document.addEventListener("DOMContentLoaded", () => {
        fetchProfile();
    });

    async function fetchMembershipStatus() {
        try {
            const response = await apiCall(`/students/membership-status`, "GET");

            if (response && response.success && response.data) {
                document.getElementById("membershipStatus").textContent = response.data.status;
            } else {
                document.getElementById("membershipStatus").textContent = "-";
            }
        } catch (error) {
            console.error("Error fetching membership status:", error);
            document.getElementById("membershipStatus").textContent = "Error";
        }
    }


    // COUNT: Events Joined & Pre-Registered
    async function fetchStudentEventStats(user_id) {
        const response = await apiCall(`/events/student-event-stats/${user_id}`, "GET");
        console.log("Event Stats:", response);

        if (response.success) {
            document.getElementById("attendedCount").textContent = response.data.attended_count ?? 0;
            document.getElementById("registeredCount").textContent = response.data.registered_count ?? 0;
        } else {
            document.getElementById("registeredCount").textContent = 0;
            document.getElementById("attendedCount").textContent = 0;
        }
    }

    function renderProfilePicture(profilePictureUrl, initials) {
        const container = document.getElementById("profile-picture-container");
        if (!container) return;

        container.innerHTML = "";

        if (profilePictureUrl) {
            const img = document.createElement("img");

            let fullUrl = profilePictureUrl;
            if (profilePictureUrl.startsWith("/uploads")) {
                fullUrl = `${API_BASE.replace("/api", "")}${profilePictureUrl}`;
            }

            img.src = fullUrl;
            img.alt = "Profile Picture";
            img.className = "w-full h-full object-cover";
            container.appendChild(img);
        } else {
            const div = document.createElement("div");
            div.className =
                "w-full h-full rounded-full bg-[#03378f] text-white flex items-center justify-center text-4xl font-bold";
            div.textContent = initials;
            container.appendChild(div);
        }
    }

    async function fetchEventStats(studentId) {
        try {
            const data = await apiCall(`/events/stats/${studentId}`);

            if (data && data.success) {
                document.getElementById('registeredCount').innerText = data.data.registered_count;
                document.getElementById('attendedCount').innerText = data.data.attended_count;
            } else {
                console.error("Failed to load event stats:", data?.message || "Unknown error");
            }
        } catch (error) {
            console.error("Error fetching event stats:", error);
        }
    }

    async function loadRegisteredEvents() {
        try {
            const profileData = await apiCall("/auth/profile");
            if (!profileData || !profileData.success) {
                console.error("Student is not logged in.");
                return;
            }

            const studentId = profileData.data.id;

            const eventsData = await apiCall(`/events/student/${studentId}`);
            const list = document.getElementById("registered-events-list");

            if (!eventsData || !eventsData.success || !Array.isArray(eventsData.data) || eventsData.data.length === 0) {
                list.innerHTML = `
                    <div class="flex flex-col py-8 items-center justify-center text-center text-gray-400 text-sm gap-2">
                        <i class="fa-solid fa-calendar-xmark text-2xl"></i>
                        <p class='sm:text-base md:text-lg'>No registered events.</p>
                    </div>
                    `;
                //showEmptyState("tab-announcements", "fa-calendar-xmark", "No registered events.");
                return;
            }
            list.innerHTML = "";

            eventsData.data.forEach(evt => {
                const eventDateTime = new Date(`${evt.event_date}T${evt.event_time_start}`);
                const formattedDateTime = eventDateTime.toLocaleString("en-US", {
                    month: "short",
                    day: "numeric",
                    year: "numeric",
                    hour: "numeric",
                    minute: "2-digit",
                    hour12: true
                });

                const html = `
                    <div class="relative flex flex-row gap-4 p-5 m-4 bg-[#011538] border border-white/20 
                        rounded-xl shadow-md transition-all duration-300 ease-out group text-white
                        hover:shadow-2xl hover:-translate-y-1 hover:border-[#b9da05]/60 overflow-hidden">
                        <span class="absolute left-0 top-0 h-full w-1 bg-[#b9da05] scale-y-0 group-hover:scale-y-100 
                            transition-transform duration-300 origin-top"></span>
                        <div class="w-24 h-24 flex-shrink-0 rounded-md bg-[#1a1f3a] text-[#64748b] text-sm 
                            flex items-center justify-center overflow-hidden">
                            ${evt.event_batch_image
                            ? `<img src="${evt.event_batch_image}" alt="Event Badge" class="rounded-md object-cover w-full h-full" />`
                            : `<i class="bi bi-calendar-event"></i>`}
                        </div>
                        <div class="flex-grow">
                            <div class="flex justify-between items-center flex-wrap gap-2">
                                <h4 class="text-md md:text-xl font-semibold">
                                    ${evt.event_name}
                                </h4>
                                <span class="text-xs text-[#3b82f6]/50 bg-[#3b82f6]/20 px-3 py-2 rounded-full 
                                    font-semibold uppercase tracking-wide">
                                    ${evt.event_status}
                                </span>
                            </div>
                            <p class="text-sm text-gray-300 mt-2">${evt.description}</p>

                            <div class="flex flex-wrap gap-3 mt-2 items-center">
                                <span class="text-xs text-[#64748b]">
                                    <i class="bi bi-calendar text-[#b9da05]"></i> ${formattedDateTime}
                                </span>
                                <span class="text-xs text-[#64748b]">
                                    <i class="bi bi-geo-alt text-[#b9da05]"></i> ${evt.location}
                                </span>
                            </div>
                        </div>
                    </div>
                    `;
                list.insertAdjacentHTML("beforeend", html);
            });
        } catch (error) {
            console.error("Error loading registered events:", error);
        }
    }

    function showEmptyState(targetId, iconClass, message) {
        const container = document.getElementById(targetId);
        if (!container) return;

        container.innerHTML = `
            <div class="flex flex-col py-8 items-center justify-center text-center text-gray-400 text-sm gap-2">
                <i class="fa-solid ${iconClass} text-2xl"></i>
                <p class='sm:text-base md:text-lg'>${message}</p>
            </div>
            `;
    }

    async function loadAnnouncements() {
        try {
            const data = await apiCall("/announcements/recentPreviewMember");

            const container = document.getElementById("tab-announcements");

            // if (!data || !data.success || !Array.isArray(data.data.announcements) || data.data.announcements.length === 0) {
            //     showEmptyState("tab-announcements", "fa-bullhorn", "No announcements available.");
            //     return;
            // }

            if (!data || !data.success || !Array.isArray(data.data) || data.data.length === 0) {
                showEmptyState("tab-announcements", "fa-bullhorn", "No announcements available.");
                return;
            }

            container.innerHTML = "";
            data.data.forEach(ann => {
                const announcementDateTime = new Date(ann.date_posted);
                const pad = (n) => n.toString().padStart(2, "0");
                const formattedDateTime = `${pad(announcementDateTime.getMonth() + 1)}-${pad(announcementDateTime.getDate())}-${announcementDateTime.getFullYear()}`;

                // console.log(ann.image_url);
                // const imagePath = ann.image_url.startsWith("/")
                //     ? ann.image_url.substring(1)  // remove the leading /
                //     : ann.image_url;

                const imgSrc = `${API_BASE}/${ann.image_url}`;

                const html = `
                    <div class="relative p-5 m-4 border border-white/20 bg-[#011538] rounded-lg shadow-sm transition-all duration-300 ease-out hover:shadow-xl hover:scale-[1.02] hover:bg-[#0a1d4a] group">
                        <div class="flex items-start gap-3">
                            <div class="w-24 h-24 rounded-md bg-[#1a1f3a] text-[#64748b] text-sm flex items-center justify-center overflow-hidden">
                                ${ann.image_url
                            ? `<img src="${imgSrc}" alt="Event Badge" class="rounded-md object-cover w-full h-full" />`
                            : `<i class="bi bi-megaphone"></i>`}
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-sm sm:text-base md:text-base lg:text-lg text-white font-semibold">
                                    ${ann.title}
                                </h4>
                                <p class="text-sm text-gray-300 mt-2">${ann.content}</p>
                                <p class="text-xs text-gray-500 mt-2 tracking-wide">${formattedDateTime}</p>
                            </div>
                        </div>
                    </div>
                    `;
                container.insertAdjacentHTML("beforeend", html);
            });
            container.insertAdjacentHTML("beforeend", `
                    <a href="announcements.html"
                        class="text-blue-400 hover:text-blue-300 text-sm font-medium px-4 mt-2 inline-block">
                        View All Announcements →
                    </a>
                    `);
        } catch (err) {
            console.error("Announcement load error:", err);
            showEmptyState("tab-announcements", "fa-bullhorn", "Failed to load announcements.");
        }
    }

    async function loadEvents() {
        try {
            const data = await apiCall("/events/upcomingPreviewMember");

            const container = document.getElementById("tab-events");
            if (!data || !data.success || !Array.isArray(data.data) || data.data.length === 0) {
                showEmptyState("tab-events", "fa-calendar-days", "No events available.");
                return;
            }

            container.innerHTML = "";

            data.data.forEach(evt => {
                const eventDateTime = new Date(`${evt.event_date}T${evt.event_time_start}`);
                const formattedDateTime = eventDateTime.toLocaleString("en-US", {
                    month: "short",
                    day: "numeric",
                    year: "numeric",
                    hour: "numeric",
                    minute: "2-digit",
                    hour12: true
                });

                const html = `
                    <div class="relative flex flex-row gap-4 p-5 m-4 bg-[#011538] border border-white/20 
                        rounded-xl shadow-md transition-all duration-300 ease-out group text-white
                        hover:shadow-2xl hover:-translate-y-1 hover:border-[#b9da05]/60 overflow-hidden">
                        <span class="absolute left-0 top-0 h-full w-1 bg-[#b9da05] scale-y-0 group-hover:scale-y-100 
                            transition-transform duration-300 origin-top"></span>
                        <div class="w-24 h-24 flex-shrink-0 rounded-md bg-[#1a1f3a] text-[#64748b] text-sm 
                            flex items-center justify-center overflow-hidden">
                            ${evt.event_batch_image
                            ? `<img src="${evt.event_batch_image}" alt="Event Badge" class="rounded-md object-cover w-full h-full" />`
                            : `<i class="bi bi-calendar-event"></i>`}
                        </div>
                        <div class="flex-grow">
                            <div class="flex justify-between items-center flex-wrap gap-2">
                                <h4 class="text-md md:text-xl font-semibold">
                                    ${evt.event_name}
                                </h4>
                                <span class="text-xs text-[#3b82f6]/50 bg-[#3b82f6]/20 px-3 py-2 rounded-full 
                                    font-semibold uppercase tracking-wide">
                                    ${evt.event_status}
                                </span>
                            </div>
                            <p class="text-sm text-gray-300 mt-2">${evt.description}</p>

                            <div class="flex flex-wrap gap-3 mt-2 items-center">
                                <span class="text-xs text-[#64748b]">
                                    <i class="bi bi-calendar text-[#b9da05]"></i> ${formattedDateTime}
                                </span>
                                <span class="text-xs text-[#64748b]">
                                    <i class="bi bi-geo-alt text-[#b9da05]"></i> ${evt.location}
                                </span>
                            </div>
                        </div>
                    </div>
                    `;
                container.insertAdjacentHTML("beforeend", html);
            });
            container.insertAdjacentHTML("beforeend", `
                    <a href="events-and-register-events.html"
                        class="text-blue-400 hover:text-blue-300 text-sm font-medium px-6 mt-2 inline-block">
                        View All Events →
                    </a>
                `);
        } catch (err) {
            console.error("Events tab error:", err);
            showEmptyState("tab-events", "fa-calendar-days", "Failed to load events.");
        }
    }

    async function logout() {
        const result = await apiCall("/auth/logout", "POST");
        if (result && result.success) {
            console.log("✅ Logout successful");
            window.location.href = "login.html"; // Redirect after logout
        } else {
            console.error("❌ Logout failed");
        }
    }
</script>

<?php include '_footer.php'; ?>