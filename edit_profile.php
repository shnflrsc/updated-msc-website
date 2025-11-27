<?php include '_header.php'; ?>

<div class="flex flex-col min-h-screen">
    <main class="flex-grow flex items-center justify-center pt-20 sm:pt-28 px-2 sm:px-4 pb-4 sm:pb-8">
        <div class="w-full max-w-4xl bg-[#18181b] text-white p-4 sm:p-6 md:p-8 rounded-lg sm:rounded-2xl shadow-lg border-[#27272a] border-2">
            <h3 class="section-title text-xl sm:text-2xl md:text-3xl mb-4">Edit Your Profile</h3>
            <div id="error-box" class="hidden mb-4 text-white border border-red-500 bg-[#27272a] px-4 py-3 rounded text-sm"></div>

            <form id="editProfileForm" enctype="multipart/form-data" novalidate class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="mscCode" class="block text-xs sm:text-sm font-semibold mb-1">MSC Code</label>
                        <input id="mscCode" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" readonly>
                    </div>
                    <div>
                        <label for="studentNumber" class="block text-xs sm:text-sm font-semibold mb-1">Student Number</label>
                        <input id="studentNumber" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" readonly>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="lastName" class="block text-xs sm:text-sm font-semibold mb-1">Last Name</label>
                        <input id="lastName" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" readonly>
                    </div>
                    <div>
                        <label for="firstName" class="block text-xs sm:text-sm font-semibold mb-1">First Name</label>
                        <input id="firstName" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" readonly>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="middleName" class="block text-xs sm:text-sm font-semibold mb-1">Middle Name</label>
                        <input id="middleName" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" readonly>
                    </div>
                    <div>
                        <label for="extension" class="block text-xs sm:text-sm font-semibold mb-1">Extension</label>
                        <input id="extension" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" readonly>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="college" class="block text-xs sm:text-sm font-semibold mb-1">College</label>
                        <input id="college" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" readonly>
                    </div>
                    <div>
                        <label for="programMajor" class="block text-xs sm:text-sm font-semibold mb-1">Program and Major</label>
                        <input id="programMajor" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" readonly>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="year" class="block text-xs sm:text-sm font-semibold mb-1">Year</label>
                        <input id="year" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" readonly>
                    </div>
                    <div>
                        <label for="section" class="block text-xs sm:text-sm font-semibold mb-1">Section</label>
                        <input id="section" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" readonly>
                    </div>
                </div>

                <!-- Contact Information Header spans both columns -->
                <div class="col-span-1 md:col-span-2">
                    <div class="section-divider">
                        <h3 class="card-title text-base sm:text-lg md:text-xl">Contact Information</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 col-span-1 md:col-span-2">
                    <div>
                        <label for="contactNumber" class="block text-xs sm:text-sm font-semibold mb-1">Contact Number</label>
                        <input id="contactNumber" type="tel" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    </div>
                    <div>
                        <label for="personalEmail" class="block text-xs sm:text-sm font-semibold mb-1">Personal Email</label>
                        <input id="personalEmail" type="email" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none" readonly>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="bulsuEmail" class="block text-xs sm:text-sm font-semibold mb-1">BulSU Email</label>
                        <input id="bulsuEmail" type="email" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    </div>
                    <div>
                        <label for="facebookLink" class="block text-xs sm:text-sm font-semibold mb-1">Facebook Profile Link</label>
                        <input id="facebookLink" type="url" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    </div>
                </div>

                <!-- Personal Information Header spans both columns -->
                <div class="col-span-1 md:col-span-2">
                    <div class="section-divider">
                        <h3 class="card-title text-base sm:text-lg md:text-xl">Personal Information</h3>
                    </div>
                    <div class="flex flex-col items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                        <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full shadow-md overflow-hidden border-4 border-[#b9da05]" id="profile-picture-preview">
                            <!-- Preview will be inserted here -->
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <label for="profile" class="cursor-pointer px-3 py-2 sm:px-4 text-xs sm:text-sm bg-[#27272a] text-white rounded-md hover:bg-[#3f3f46] transition-colors text-center">
                                <i class="fas fa-camera mr-2"></i>Change Profile Picture
                            </label>
                            <input type="file" id="profile" name="profilePicture" class="hidden" accept="image/*" style="display: none !important; position: absolute; opacity: 0; pointer-events: none;">
                            <p class="text-xs sm:text-sm text-gray-400 text-center px-2">Maximum file size: 2MB. Supported formats: JPG, PNG</p>
                        </div>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="currentAddress" class="block text-xs sm:text-sm font-semibold mb-1">Current Address</label>
                        <input id="currentAddress" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    </div>
                    <div>
                        <label for="birthdate" class="block text-xs sm:text-sm font-semibold mb-1">Birthdate</label>
                        <input id="birthdate" type="date" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="age" class="block text-xs sm:text-sm font-semibold mb-1">Age</label>
                        <input id="age" type="number" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    </div>
                    <div>
                        <label for="gender" class="block text-xs sm:text-sm font-semibold mb-1">Gender</label>
                        <select id="gender" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- Guardian Information Header spans both columns -->
                <div class="col-span-1 md:col-span-2">
                    <div class="section-divider">
                        <h3 class="card-title text-base sm:text-lg md:text-xl">Guardian Information</h3>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="guardianName" class="block text-xs sm:text-sm font-semibold mb-1">Name of Guardian</label>
                        <input id="guardianName" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    </div>
                    <div>
                        <label for="guardianRelationship" class="block text-xs sm:text-sm font-semibold mb-1">Relationship to the Guardian</label>
                        <input id="guardianRelationship" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="guardianContact" class="block text-xs sm:text-sm font-semibold mb-1">Contact Number of the Guardian</label>
                        <input id="guardianContact" type="tel" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    </div>
                    <div>
                        <label for="guardianAddress" class="block text-xs sm:text-sm font-semibold mb-1">Address of the Guardian</label>
                        <input id="guardianAddress" type="text" class="w-full px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <button type="submit" class="w-full bg-[#b9da05] text-[#00071c] text-sm sm:text-base font-bold py-2.5 sm:py-3 rounded-md hover:bg-[#8fae04] hover:text-[#00071c] transition-colors shadow-md mt-2">Save Changes</button>
                </div>
            </form>

            <div class="mt-4 sm:mt-6 text-center text-xs sm:text-sm text-gray-400 px-2">
                <p>To change your Name, College, Program, Student No., or Email Address, please contact BulSU MSC.<br class="hidden sm:block">
                    <span class="inline-block mt-1 sm:mt-0">To change your password, <a href="change_password.php" class="text-[#b9da05] hover:underline">click here</a>.</span>
                </p>
            </div>

            <div class="flex flex-col items-center text-center mt-4 sm:mt-6">
                <small class="text-xs sm:text-sm text-gray-400">Powered by <b>BulSU MSC</b></small>
            </div>
        </div>
    </main>

    <div id="toast" class="fixed bottom-6 right-6 z-50 hidden">
        <div id="toast-content"
            class="flex items-center max-w-xs p-4 text-sm text-white bg-green-600 rounded-lg shadow-lg animate-slide-in"
            role="alert">
            <i class="fas fa-check-circle mr-2 text-white"></i>
            <div id="toast-message"></div>
        </div>
    </div>

    <script>
        const API_BASE = "/updated-msc-website/api";

        /**
         * Reusable API Call Function
         */
        async function apiCall(endpoint, method = "GET", data = null) {
            const options = {
                method,
                headers: {
                    "Content-Type": "application/json"
                },
                credentials: "include", // keep cookies/session
            };

            if (data) options.body = JSON.stringify(data);

            try {
                const res = await fetch(`${API_BASE}${endpoint}`, options);
                const json = await res.json();
                return json;
            } catch (error) {
                console.error("❌ API call failed:", error);
                return {
                    success: false,
                    message: "Network error"
                };
            }
        }

        let studentId = null;

        /**
         * Fetch Logged-in User & Autofill Profile
         */
        document.addEventListener("DOMContentLoaded", async () => {
            console.log("🔍 Checking login status...");

            const auth = await apiCall("/auth/check-login", "GET");
            console.log("📡 Raw auth response:", auth);

            if (auth.success && auth.data?.logged_in) {
                studentId = auth.data.user.id;
                console.log("✅ User is logged in!");
                console.log("👤 User Data:", auth.data.user);
                console.log("🆔 Student ID:", studentId);

                // Fetch and autofill profile
                await loadProfileData(studentId);
            } else {
                console.warn("⚠️ Not logged in or session expired.");
                alert("⚠️ Please log in first.");
                window.location.href = "login.php";
            }
        });

        /**
         * Load and Autofill Profile Data
         */
        async function loadProfileData(id) {
            console.log("📥 Fetching profile data for ID:", id);
            const profileRes = await apiCall(`/students/${id}`, "GET");

            if (profileRes.success && profileRes.data) {
                console.log("📄 Profile data received:", profileRes.data);
                const d = profileRes.data;

                // ✅ Match database column names
                document.getElementById("mscCode").placeholder = d.msc_id || "";
                document.getElementById("studentNumber").placeholder = d.student_no || "";
                document.getElementById("lastName").placeholder = d.last_name || "";
                document.getElementById("firstName").placeholder = d.first_name || "";
                document.getElementById("middleName").placeholder = d.middle_name || "";
                document.getElementById("extension").placeholder = d.name_suffix || "";
                document.getElementById("college").placeholder = d.college || "";
                document.getElementById("programMajor").placeholder = d.program || "";
                document.getElementById("year").placeholder = d.year_level || "";
                document.getElementById("section").placeholder = d.section || "";
                document.getElementById("contactNumber").value = d.phone || "";
                document.getElementById("personalEmail").placeholder = d.email || "";
                document.getElementById("bulsuEmail").value = d.bulsu_email || "";
                document.getElementById("facebookLink").value = d.facebook_link || "";
                document.getElementById("currentAddress").value = d.address || "";
                document.getElementById("birthdate").value = d.birthdate || "";
                document.getElementById("age").value = d.age || "";
                document.getElementById("gender").value = d.gender || "";
                document.getElementById("guardianName").value = d.guardian_name || "";
                document.getElementById("guardianRelationship").value = d.relationship || "";
                document.getElementById("guardianContact").value = d.guardian_phone || "";
                document.getElementById("guardianAddress").value = d.guardian_address || "";

                const profilePreview = document.getElementById("profile-picture-preview");
                if (profilePreview) {
                    profilePreview.innerHTML = "";

                    if (d.profile_image_path) {
                        let fullUrl = d.profile_image_path;
                        if (fullUrl.startsWith("/uploads")) {
                            fullUrl = `${API_BASE.replace("/api", "")}${fullUrl}`;
                        }

                        const img = document.createElement("img");
                        img.src = fullUrl;
                        img.alt = "Profile Picture";
                        img.className = "w-full h-full object-cover";

                        profilePreview.appendChild(img);
                    } else {
                        const initials = `${d.first_name?.charAt(0) || ""}${d.last_name?.charAt(0) || ""}`.toUpperCase();
                        profilePreview.innerHTML = `
                            <div class="w-full h-full rounded-full bg-[#03378f] text-white flex items-center justify-center text-4xl font-bold">
                                ${initials}
                            </div>
                        `;
                    }
                }
                console.log("✅ Profile autofill complete!");
            } else {
                console.error("⚠️ Failed to fetch profile data:", profileRes.message);
                alert("Could not load your profile data. Please try again later.");
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            const profileInput = document.getElementById("profile");
            const profilePreview = document.getElementById("profile-picture-preview");
            const profileLabel = document.querySelector('label[for="profile"]');

            // Manually trigger file input on label click (ensures it works even if label connection fails)
            profileLabel.addEventListener("click", function(e) {
                e.preventDefault();
                profileInput.click();
            });

            profileInput.addEventListener("change", function() {
                const file = this.files[0];
                if (!file) return;

                if (file.size > 5 * 1024 * 1024) {
                    console.log("File is too large. Maximum size is 5MB.");
                    this.value = "";
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    profilePreview.innerHTML = `<img src="${e.target.result}" alt="Profile Preview" class="w-full h-full object-cover">`;
                };
                reader.readAsDataURL(file);

                uploadProfilePicture(file);
            });

            async function uploadProfilePicture(file) {
                if (!studentId) {
                    alert("User not loaded yet. Please wait a moment.");
                    return;
                }

                const formData = new FormData();
                formData.append("profile", file);

                try {
                    const res = await fetch(`${API_BASE}/students/upload-profile/${studentId}`, {
                        method: "POST",
                        body: formData,
                        credentials: "include",
                    });

                    const result = await res.json();
                    console.log("📸 Upload response:", result);

                    if (result.success) {
                        console.log("Profile picture updated successfully!");
                        if (result.newPath) {
                            profilePreview.innerHTML = `<img src="${API_BASE}${result.newPath}" alt="Profile Picture" class="w-full h-full object-cover">`;
                        }
                    } else {
                        console.error("Failed to upload image: " + (result.message || "Unknown error"));
                    }
                } catch (err) {
                    console.error("Upload error:", err);
                }
            }
        });

        /**
         * Handle Edit Profile Form Submission
         */
        document.getElementById("editProfileForm").addEventListener("submit", async (e) => {
            e.preventDefault();

            // Remove previous error messages
            document.querySelectorAll('.field-error-message').forEach(el => el.remove());

            if (!studentId) {
                alert("User not loaded yet. Please wait a moment.");
                console.warn("🚫 Attempted to update profile before login check completed.");
                return;
            }

            // List of required field IDs (excluding readonly fields)
            const requiredFields = [
                "contactNumber",
                "bulsuEmail",
                "facebookLink",
                "currentAddress",
                "birthdate",
                "age",
                "gender",
                "guardianName",
                "guardianRelationship",
                "guardianContact",
                "guardianAddress"
            ];
            let hasError = false;

            requiredFields.forEach(id => {
                const field = document.getElementById(id);
                let value = field.value;
                // For select, check value
                if (field.tagName.toLowerCase() === 'select') {
                    if (!value) {
                        hasError = true;
                        showFieldError(field);
                    }
                } else {
                    if (!value || value.trim() === "") {
                        hasError = true;
                        showFieldError(field);
                    }
                }
            });

            if (hasError) {
                // Scroll to first error
                const firstError = document.querySelector('.field-error-message');
                if (firstError) {
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
                return;
            }

            // Only send editable fields (do not send readonly fields)
            const formData = {
                phone: document.getElementById("contactNumber").value,
                bulsu_email: document.getElementById("bulsuEmail").value,
                facebook_link: document.getElementById("facebookLink").value,
                address: document.getElementById("currentAddress").value,
                birthdate: document.getElementById("birthdate").value,
                age: document.getElementById("age").value,
                gender: document.getElementById("gender").value,
                guardian_name: document.getElementById("guardianName").value,
                relationship: document.getElementById("guardianRelationship").value,
                guardian_phone: document.getElementById("guardianContact").value,
                guardian_address: document.getElementById("guardianAddress").value,
            };

            console.log("📝 Submitting form data:", formData);

            try {
                const result = await apiCall(`/students/profile/${studentId}`, "PUT", formData);
                console.log("📬 Server response:", result);

                if (result.success) {
                    //alert("✅ Profile updated successfully!");
                    showToast("Profile updated successfully!", "success");
                } else {
                    //alert("⚠️ Update failed: " + (result.message || "Unknown error"));
                    console.log("Update failed: " + (result.message || "Unknown error"))
                    showToast("Failed to update profile.", "error");
                }
            } catch (err) {
                console.error("❌ Update error:", err);
                alert("❌ Something went wrong while updating your profile.");
            }
        });

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

        function showFieldError(field) {
            // Only add if not already present
            if (field.parentNode.querySelector('.field-error-message')) return;
            const error = document.createElement('div');
            error.className = 'field-error-message text-xs text-red-500 mt-1';
            error.textContent = 'This field is required.';
            field.parentNode.appendChild(error);
            // Remove error on input/change
            field.addEventListener('input', removeFieldError, {
                once: true
            });
            field.addEventListener('change', removeFieldError, {
                once: true
            });
        }

        function removeFieldError(e) {
            const error = e.target.parentNode.querySelector('.field-error-message');
            if (error) error.remove();
        }
    </script>
    <?php include '_footer.php'; ?>
</div>