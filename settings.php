<?php include '_header.php'; ?>

<div class="flex flex-col min-h-screen">
    <main class="flex-grow pt-28 p-3 flex flex-col items-center">
       <section id="settingOptions"
        class="w-11/12 max-w-7xl p-6 mx-auto flex flex-col md:flex-row gap-6 rounded-2xl bg-[#011538] border border-[#b9da05]">
            <aside class="w-64 h-full bg-[#011538] border-r border-[#b9da05] p-4 hidden md:flex flex-col space-y-2">
                <div class="flex-1 mt-4 md:mt-0 px-2 md:px-4">
                    <div class="w-3/5 flex flex-col justify-center">
                        <div id="profile-picture-container"
                            class="w-20 h-20 flex justify-center items-center text-4xl font-bold text-white rounded-full bg-[#1f2a40] border-4 border-[#b9da05]">
                        </div>
                    </div>
                    <div class="w-2/5 flex flex-col justify-center">
                        <p id="fullName" class="text-xl text-white font-semibold"></p>
                        <p id="username" class="text-base text-white"></p>
                    </div>
                </div>
                <button class="sidebar-btn active" onclick="showSection(event, 'profile')">
                    <i class="fa-solid fa-circle-user"></i>Profile</button>
                <!-- <i class="fa-solid fa-circle-user text-[#b9da05]"></i>  -->
                <button class="sidebar-btn" onclick="showSection(event, 'password')">
                    <i class="fa-solid fa-lock"></i>Password</button>
                <button class="sidebar-btn" onclick="showSection(event, 'notifications')">
                    <i class="fa-solid fa-bell"></i>Notifications</button>
                <button class="sidebar-btn text-red-400" onclick="logout()">
                    <i class="fa-solid fa-right-from-bracket block">
                    </i>Log Out</button>
            </aside>

            <div class="md:hidden flex flex-col items-center">
                <div id="mobile-profile-picture-container"
                    class="w-20 h-20 flex justify-center items-center text-4xl font-bold text-white rounded-full bg-[#1f2a40] border-4 border-[#b9da05] mb-2">
                </div>
                <p id="mobile-fullName" class="text-white font-semibold text-base"></p>
                <p id="mobile-username" class="text-gray-300 text-sm"></p>
            </div>

            <div class="md:hidden mobile-tabs flex justify-around border-b border-[#b9da05]">
                <button class="tab-btn active flex-1  text-sm sm:text-base text-center"
                    onclick="showSection(event, 'profile')">
                    <i class="fa-solid fa-circle-user block"></i>
                    Profile
                </button>
                <button class="tab-btn flex-1 text-sm sm:text-base text-center"
                    onclick="showSection(event, 'password')">
                    <i class="fa-solid fa-lock block"></i>
                    Password
                </button>
                <button class="tab-btn flex-1 text-sm sm:text-base text-center text-red-400" onclick="logout()">
                    <i class="fa-solid fa-right-from-bracket block"></i>
                    Log Out
                </button>
            </div>

            <div class="flex-1 px-4 mt-4 md:mt-0">
                <h2 class="sm:mr-8 text-2xl md:text-3xl font-bold text-[#b9da05] mb-4 tracking-wide text-left">
                    Settings
                </h2>
                <div id="profile" class="section-card flex flex-col gap-2">
                    <div class="bg-[#1f2a40] rounded-md p-6 shadow-lg">
                        <a href="profile.php"
                            class="text-base sm:text-lg md:text-xl font-semibold text-[#b9da05] hover:underline">Edit
                            Personal Information</a>
                        <p class="text-xs sm:text-sm md:text-base text-gray-400 mt-1">Update your name, birthday, contact
                            info, and
                            academic info.</p>
                    </div>

                    <div class="bg-[#1f2a40] rounded-md p-6 shadow-lg">
                        <p class="text-base sm:text-lg md:text-xl font-semibold text-[#b9da05] mb-1">Change Profile
                            Picture</p>
                        <div class=""> <input type="file" id="profileUpload" accept="image/*" />
                            <p class="text-gray-400 text-xs mt-1">Max 5MB. JPG, PNG only.</p>
                        </div>
                    </div>
                </div>

                <div id="password" class="section-card bg-[#1f2a40] rounded-md p-6 shadow-lg hidden">
                    <a href="change_password.php"
                        class="text-base sm:text-lg md:text-xl font-semibold text-[#b9da05] mb-2 hover:underline">Change
                        Password</a>
                    <p class="sm:text-sm md:text-base text-gray-400 mt-1">Update your account password for security.</p>
                </div>

                <div id="notifications" class="section-card bg-[#1f2a40] rounded-md p-6 shadow-lg hidden">
                    <div class="flex items-center justify-between">
                        <p class="text-xl font-semibold text-[#b9da05] flex items-center gap-2">Push Notifications</p>
                        <div class="toggle-container relative">
                            <div class="pulse-ring"></div>
                            <div class="toggle-switch" id="notification-toggle" onclick="toggleNotifications()">
                                <div class="toggle-slider">
                                    <svg class="toggle-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="status-indicator" id="notification-status-container">
                        <div class="status-dot"></div>
                        <p id="notification-status" class="text-base text-gray-400">
                            Enable push notifications to receive updates.
                        </p>
                    </div>
                </div>
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
                if (data) options.body = JSON.stringify(data);

                const response = await fetch(`${API_BASE}${endpoint}`, options);
                if (!response.ok) {
                    console.error(`API Error: ${response.status} ${response.statusText}`);
                    return null;
                }
                return await response.json();
            } catch (error) {
                console.error("API Error:", error);
                return null;
            }
        }

        // Settings
        function showSection(event, sectionId) {
            document.querySelectorAll('.section-card').forEach(sec => sec.classList.add('hidden'));
            document.getElementById(sectionId).classList.remove('hidden');

            document.querySelectorAll('.sidebar-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

            const clickedBtn = event.currentTarget;
            clickedBtn.classList.add('active');

            // Find and activate the corresponding button in the other view
            if (clickedBtn.classList.contains('sidebar-btn')) {
                document.querySelector(`.tab-btn[onclick*="${sectionId}"]`).classList.add('active');
            } else if (clickedBtn.classList.contains('tab-btn')) {
                document.querySelector(`.sidebar-btn[onclick*="${sectionId}"]`).classList.add('active');
            }
        }

        async function fetchProfile() {
            const data = await apiCall("/auth/profile");
            if (!data || !data.success) {
                window.location.href = "login.php";
                return;
            }

            const user = data.data;
            console.log(user);
            document.getElementById("fullName").textContent = `${data.data.first_name} ${data.data.last_name}`;
            document.getElementById("username").textContent = data.data.username;
            const initials = `${user.first_name?.charAt(0) || ""}${user.last_name?.charAt(0) || ""}`.toUpperCase();

            document.getElementById("mobile-fullName").textContent = `${user.first_name} ${user.last_name}`;
            document.getElementById("mobile-username").textContent = user.username;

            renderProfilePicture(user.profile_image_path, initials);
            document.documentElement.classList.remove("loading");
        }

        /*
        function renderProfilePicture(profilePictureUrl, initials) {
            const container = document.getElementById("profile-picture-container");
            if (!container) return;
            if (profilePictureUrl) {
                const img = document.createElement("img");

                let fullUrl = profilePictureUrl;
                if (profilePictureUrl.startsWith("/uploads")) {
                    fullUrl = `${API_BASE.replace("/api", "")}${profilePictureUrl}`;
                }

                img.src = fullUrl;
                img.alt = "Profile Picture";
                img.className = "w-full h-full object-cover rounded-full";
                container.innerHTML = '';
                container.appendChild(img);
            } else {
                const div = document.createElement("div");
                div.className =
                    "w-full h-full rounded-full bg-[#03378f] text-white flex items-center justify-center text-4xl font-bold";
                div.textContent = initials;
                container.innerHTML = '';
                container.appendChild(div);
            }
        }
            */
        function renderProfilePicture(profilePictureUrl, initials) {
            const desktopContainer = document.getElementById("profile-picture-container");
            const mobileContainer = document.getElementById("mobile-profile-picture-container");

            if (!desktopContainer || !mobileContainer) return;

            if (profilePictureUrl) {
                const img = document.createElement("img");
                let fullUrl = profilePictureUrl;
                if (profilePictureUrl.startsWith("/uploads")) {
                    fullUrl = `${API_BASE.replace("/api", "")}${profilePictureUrl}`;
                }
                img.src = fullUrl;
                img.alt = "Profile Picture";
                img.className = "w-full h-full object-cover rounded-full";

                desktopContainer.innerHTML = '';
                desktopContainer.appendChild(img);

                mobileContainer.innerHTML = '';
                mobileContainer.appendChild(img.cloneNode());
            } else {
                const divDesktop = document.createElement("div");
                divDesktop.className = "w-full h-full rounded-full bg-[#03378f] text-white flex items-center justify-center text-4xl font-bold";
                divDesktop.textContent = initials;

                const divMobile = divDesktop.cloneNode(true);

                desktopContainer.innerHTML = '';
                desktopContainer.appendChild(divDesktop);

                mobileContainer.innerHTML = '';
                mobileContainer.appendChild(divMobile);
            }
        }

        async function uploadProfilePicture(student_id) {
            const fileInput = document.getElementById("profileUpload");
            const file = fileInput?.files?.[0];
            if (!file) return null;

            const allowedTypes = ["image/jpeg", "image/png"];
            const maxSize = 5 * 1024 * 1024; // 5MB

            if (!allowedTypes.includes(file.type)) {
                showToast("Please upload a JPG or PNG image. Max size is 5MB.", "error");
                return null;
            }
            if (file.size > maxSize) {
                showToast("File too large. Max size is 5MB.", "error");
                return null;
            }

            const formData = new FormData();
            //formData.append("profile", file);
            formData.append("profile", fileInput.files[0]);

            try {
                const res = await fetch(`${API_BASE}/students/upload-profile/${student_id}`, {
                    method: "POST",
                    credentials: "include",
                    body: formData,
                });

                const result = await res.json();
                if (res.ok && result.success) {
                    return result.data.path;
                } else {
                    showToast(result.message || "Upload failed.", "error");
                    return null;
                }
            } catch (err) {
                console.error("Upload error:", err);
                showToast("An error occurred during upload.", "error");
                return null;
            }
        }

        document.getElementById("profileUpload")?.addEventListener("change", async () => {
            const fileInput = document.getElementById("profileUpload");
            const file = fileInput.files[0];

            if (!file) {
                return;
            }

            const allowedTypes = ["image/jpeg", "image/png"];
            const maxSize = 5 * 1024 * 1024; // 5MB

            if (!allowedTypes.includes(file.type)) {
                showToast("Please upload a JPG or PNG image. Max size is 5MB.", "error");
                fileInput.value = "";
                await fetchProfile();
                return;
            }

            if (file.size > maxSize) {
                showToast("File too large. Max size is 5MB.", "error");
                fileInput.value = "";
                await fetchProfile();
                return;
            }

            // --- PREVIEW (only if validation passes) ---
            const reader = new FileReader();
            // reader.onload = (e) => {
            //     const container = document.getElementById("profile-picture-container");
            //     container.innerHTML = "";
            //     container.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-full" />`;
            // };
            reader.onload = (e) => {
                const desktopContainer = document.getElementById("profile-picture-container");
                const mobileContainer = document.getElementById("mobile-profile-picture-container");

                const img = document.createElement("img");
                img.src = e.target.result;
                img.alt = "Profile Picture";
                img.className = "w-full h-full object-cover rounded-full";

                desktopContainer.innerHTML = '';
                desktopContainer.appendChild(img);

                mobileContainer.innerHTML = '';
                mobileContainer.appendChild(img.cloneNode());
            };
            reader.readAsDataURL(file);

            // --- UPLOAD ---
            const profileData = await apiCall("/auth/profile");
            if (profileData && profileData.success) {
                const uploadedPath = await uploadProfilePicture(profileData.data.id);
                if (uploadedPath) {
                    showToast("Profile picture updated successfully!", "success");
                    await fetchProfile();
                } else {
                    await fetchProfile();
                }
            } else {
                showToast("Session expired. Please login again", "error");
                window.location.href = "login.php";
            }
        });

        document.addEventListener("DOMContentLoaded", fetchProfile);

        function showToast(message, type = "success") {
            const toast = document.getElementById("toast");
            const toastMessage = document.getElementById("toast-message");
            const toastContent = document.getElementById("toast-content");

            toastMessage.textContent = message;

            if (type === "success") {
                toastContent.className = "flex items-center max-w-xs p-4 text-sm text-white bg-green-600 rounded-lg shadow-lg animate-slide-in";
                toastContent.querySelector("i").className = "fas fa-check-circle mr-2 text-white";
            } else if (type === "error") {
                toastContent.className = "flex items-center max-w-xs p-4 text-sm text-white bg-red-600 rounded-lg shadow-lg animate-slide-in";
                toastContent.querySelector("i").className = "fas fa-times-circle mr-2 text-white";
            }

            toast.classList.remove("hidden");
            setTimeout(() => {
                toast.classList.add("hidden");
            }, 5000);
        }

        //Notif toggle:
        let notificationsEnabled = false;

        function toggleNotifications() {
            const toggle = document.getElementById('notification-toggle');
            const status = document.getElementById('notification-status');
            const statusContainer = document.getElementById('notification-status-container');
            const toggleIcon = toggle.querySelector('.toggle-icon');

            notificationsEnabled = !notificationsEnabled;

            if (notificationsEnabled) {
                toggle.classList.add('active');
                statusContainer.classList.add('active');
                status.textContent = 'Push notifications has been enabled.';
                status.className = 'text-base text-gray-400';

                toggleIcon.innerHTML = `
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                `;
            } else {
                toggle.classList.remove('active');
                statusContainer.classList.remove('active');
                status.textContent = 'Enable push notifications to receive updates.';
                status.className = 'text-base text-gray-400';

                toggleIcon.innerHTML = `
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                `;
            }

            toggle.style.transform = 'scale(0.95)';
            setTimeout(() => {
                toggle.style.transform = 'scale(1)';
            }, 100);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const toggleIcon = document.querySelector('.toggle-icon');
            toggleIcon.innerHTML = `
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
            `;
        });

        async function logout() {
            try {
                localStorage.clear();
                sessionStorage.clear();

                document.cookie.split(";").forEach(function(c) {
                    document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
                });

                console.log("✅ Logout successful");
                window.location.href = "login.php";
            } catch (error) {
                console.error("❌ Logout failed:", error);
                window.location.href = "login.php";
            }
        }
    </script>
    <?php include '_footer.php'; ?>
</div>