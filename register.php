<?php
require_once __DIR__ . '/api/middleware/AuthMiddleware.php';
AuthMiddleware::guestOnly();

include '_header.php';
?>

<style>
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .form-grid-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .password-wrapper {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        font-size: 16px;
    }

    .toggle-password:hover {
        color: #b9da05;
    }

    #status-message {
        display: none;
        /* hidden by default */
        text-align: center;
        transition: all 0.3s ease;
        padding-top: 16px;
        padding-bottom: 16px;
    }

    #status-message.success {
        background-color: #1a2e1a;
        color: #b9da05;
        border: 1px solid #b9da05;
    }

    #status-message.error {
        background-color: #2a1a1a;
        color: #ff5c5c;
        border: 1px solid #ff5c5c;
    }
</style>

<main class="flex-grow flex items-center justify-center pt-28 px-4">
    <div
        class="w-full max-w-4xl bg-[#18181b] text-white p-8 rounded-2xl shadow-lg border border-[#27272a] border-2">
        <h2 class="text-3xl font-bold mb-6 text-center" style="font-family: 'Veonika', sans-serif;">Create Your
            Account</h2>
        <div id="status-message" class="hidden mb-4 px-4 py-8 rounded text-sm text-white font-medium mb-4"></div>
        <div id="error-box"
            class="hidden mb-4 text-white border border-red-500 bg-[#27272a] px-4 py-3 rounded text-sm"></div>
        <form id="registrationForm">
            <div class="form-grid mb-6">
                <div>
                    <label for="regFirstName" class="block text-sm font-semibold mb-1">First Name</label>
                    <input id="regFirstName" type="text" required
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                </div>
                <div>
                    <label for="regMiddleName" class="block text-sm font-semibold mb-1">Middle Name</label>
                    <input id="regMiddleName" type="text"
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                </div>
                <div>
                    <label for="regLastName" class="block text-sm font-semibold mb-1">Last Name</label>
                    <input id="regLastName" type="text" required
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                </div>
            </div>

            <div class="form-grid mb-6">
                <div>
                    <label for="regSuffix" class="block text-sm font-semibold mb-1">Name Suffix:</label>
                    <!-- <input id="regUsername" type="text" required class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]"> -->
                    <!-- <p class="text-xs text-gray-400 mt-1">Must be at least 3 characters</p> -->
                    <select id="regSuffix"
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                        <option value="">None</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                    </select>
                </div>
                <div>
                    <label for="regBirthDate">Birthdate:</label>
                    <input type="date" name="regBirthDate" id="regBirthDate" class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                </div>
                <div>
                    <label for="regGender">Gender:</label>
                    <select id="regGender" name="regGender" required class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div>
                    <label for="regPhone">Phone Number:</label>
                    <input type="tel" id="regPhone" name="regPhone" placeholder="e.g. 09123456789" required class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                </div>
                <div>
                    <label for="regEmail" class="block text-sm font-semibold mb-1">Email Address</label>
                    <input id="regEmail" type="email" required
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    <!-- <p class="text-xs text-gray-400 mt-1">Please enter a valid email address</p> -->
                </div>
                <div>
                    <label for="regFacebook">Facebook Username:</label>
                    <input type="text" id="regFacebook" name="regFacebook" class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                </div>
            </div>

            <!-- <div class="form-grid-2 mb-6">
                    <div>
                        <label for="regPassword" class="block text-sm font-semibold mb-1">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="regPassword" placeholder="Enter your password" required
                                class="w-full px-4 py-3 pr-12 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                            <button type="button" class="toggle-password" data-target="regPassword">👁</button>
                        </div>
                        <small id="passwordHint" style="color: red; display: none;" class="text-xs">Password must
                            contain at least one uppercase letter, one lowercase letter, and one number.</small>
                        <p class="text-xs text-gray-400 mt-1">Must be at least 8 characters</p>
                    </div>
                    <div>
                        <label for="confirmPassword" class="block text-sm font-semibold mb-1">Confirm Password</label>
                        <div class="password-wrapper">
                            <input id="confirmPassword" type="password" required
                                class="w-full px-4 py-3 pr-12 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                            <button type="button" class="toggle-password" data-target="confirmPassword">👁</button>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Please re-enter your password</p>
                    </div>
                </div> -->

            <!-- <div class="form-grid-2 mb-6">
                    <div>
                        <label for="regBirthdate" class="block text-sm font-semibold mb-1">Birthdate</label>
                        <input id="regBirthdate" type="date" required
                            class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    </div>
                    <div>
                        <label for="regGender" class="block text-sm font-semibold mb-1">Gender</label>
                        <select id="regGender" required
                            class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div> -->

            <div class="form-grid mb-6">
                <div>
                    <label for="regStudentNo" class="block text-sm font-semibold mb-1">Student No.</label>
                    <input id="regStudentNo" type="text" required
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                </div>
                <div>
                    <label for="regSection" class="block text-sm font-semibold mb-1">Section</label>
                    <input id="regSection" type="text" required
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                </div>
                <div>
                    <label for="regYearLevel" class="block text-sm font-semibold mb-1">Year Level</label>
                    <select id="regYearLevel" required
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                        <option value="">Select Year Level</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                </div>
                <div>
                    <label for="regCollege" class="block text-sm font-semibold mb-1">College</label>
                    <select id="regCollege" required
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                        <option value="">Select College</option>
                    </select>
                </div>
                <div>
                    <label for="regProgram" class="block text-sm font-semibold mb-1">Program</label>
                    <select id="regProgram" required
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                        <option value="">Select a College first</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="regAddress">Address:</label>
                <textarea id="regAddress" name="regAddress" rows="2" class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]"></textarea>
            </div>

            <!-- <div class="flex items-start mb-6">
                    <input type="checkbox" id="terms" class="mt-1 mr-2 accent-[#b9da05]">
                    <label for="terms" class="text-sm text-gray-300">I agree to the <a href="#" class="text-[#b9da05] hover:underline">Terms of Service</a> and <a href="#" class="text-[#b9da05] hover:underline">Privacy Policy</a>.</label>
                </div> -->

            <button type="submit"
                class="w-full bg-[#b9da05] text-[#00071c] text-m font-bold py-3 rounded-md hover:bg-[#8fae04] hover:text-[#00071c] transition-colors shadow-md">Create
                Account</button>
        </form>

        <!-- <div class="flex flex-col items-center text-center mt-6">
                <div class="flex justify-center items-center gap-1">
                    <p>Already have an account?</p>
                    <a href="login.html" class="text-[#b9da05] hover:underline">Sign in here</a>
                </div>
                <small class="text-gray-400 mt-2">Powered by <b>BulSU MSC</b></small>
            </div> -->
    </div>
</main>

<div id="statusModal" class="status-modal hidden">
    <div class="status-modal-content">
        <span id="statusModalClose" class="status-modal-close">&times;</span>
        <h3 id="statusModalTitle"></h3>
        <p id="statusModalMessage"></p>
    </div>
</div>

<script src="program-and-course.js"></script>
<script>
    // Toggle Password Visibility
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                this.getAttribute('data-target');
                const input = document.getElementById(this.getAttribute('data-target'));
                if (!input) return;

                if (input.type === 'password') {
                    this.textContent = "🙈"; // change icon
                } else {
                    this.textContent = "👁"; // change icon back
                }
            });
        });
    });

    // password strength hint
    /*
    const regPassword = document.getElementById("regPassword");
    const hint = document.getElementById("passwordHint");

    regPassword.addEventListener("input", function () {
        const password = this.value;
        const valid = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/.test(password);

        if (!valid && password.length > 0) {
            hint.style.display = "block";
        } else {
            hint.style.display = "none";
        }
    });
    */


    const API_BASE = "/updated-msc-website/api";

    function openStatusModal(title, message, isSuccess) {
        const modal = document.getElementById("statusModal");
        document.getElementById("statusModalTitle").innerText = title;
        document.getElementById("statusModalMessage").innerText = message;
        document.getElementById("statusModalTitle").style.color = isSuccess ? "green" : "red";
        modal.style.display = "flex";
    }

    document.getElementById("statusModalClose").onclick = function() {
        document.getElementById("statusModal").style.display = "none";
    };

    window.onclick = function(e) {
        if (e.target === document.getElementById("statusModal")) {
            document.getElementById("statusModal").style.display = "none";
        }
    };

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

            console.log(`🚀 ${method} ${endpoint}:`, data);

            const response = await fetch(`${API_BASE}${endpoint}`, options);
            const result = await response.json();
            console.log(result);

            if (!response.ok) {
                openStatusModal("❌ " + title + " Failed", result.message || `${title} failed`, false);
            } else {
                openStatusModal("✅ " + title + " Successful", result.message || `${title} successful`, true);
                // window.location.href = "login.php";
            }

            return result;
        } catch (error) {
            console.error("API Error:", error);
            openStatusModal("⚠ Network Error", `Network error during ${title}`, false);
            return null;
        }
    }

    /*
    birthdate: document.getElementById("regBirthdate").value,
    gender: document.getElementById("regGender").value,
    password: document.getElementById("regPassword").value,
    */

    async function generateNextMscId() {
        try {
            const res = await fetch(`${API_BASE}/students/next-msc-id`, {
                method: "GET",
                credentials: "include"
            });
            const responseData = await res.json();
            console.log("Generated MSC ID:", responseData);
            return responseData.data.msc_id;
        } catch (err) {
            console.error("Failed to fetch MSC ID:", err);
            return undefined;
        }
    }

    async function testRegister() {
        const mscId = await generateNextMscId();

        const data = {
            msc_id: mscId,
            username: mscId,
            email: document.getElementById("regEmail").value,
            password: mscId,
            first_name: document.getElementById("regFirstName").value,
            middle_name: document.getElementById("regMiddleName").value,
            last_name: document.getElementById("regLastName").value,
            name_suffix: document.getElementById("regSuffix").value,
            role: 'member',
            student_no: document.getElementById("regStudentNo").value,
            year_level: document.getElementById("regYearLevel").value,
            college: document.getElementById("regCollege").value,
            program: document.getElementById("regProgram").value,
        };

        const result = await apiCall("/auth/admin-register", "POST", data, "📝 User Registration");

        if (result && result.success) {
            showStatusMessage(result.message || "User registered successfully!", true);
            document.getElementById("registrationForm").reset();
            document.getElementById("regProgram").innerHTML = "<option>Select a College first</option>";
        } else {
            showStatusMessage(result?.message || "An error occurred during registration.", false);
        }
    }

    async function register() {
        const mscId = await generateNextMscId();

        const data = {
            username: mscId,
            email: document.getElementById("regEmail").value,
            facebook_link: document.getElementById("regFacebook").value,
            password: document.getElementById("regStudentNo").value,
            first_name: document.getElementById("regFirstName").value,
            middle_name: document.getElementById("regMiddleName").value,
            last_name: document.getElementById("regLastName").value,
            name_suffix: document.getElementById("regSuffix").value,
            birthdate: document.getElementById("regBirthDate").value,
            gender: document.getElementById("regGender").value,
            phone: document.getElementById("regPhone").value,
            student_no: document.getElementById("regStudentNo").value,
            section: document.getElementById("regSection").value,
            year_level: document.getElementById("regYearLevel").value,
            college: document.getElementById("regCollege").value,
            program: document.getElementById("regProgram").value,
            address: document.getElementById("regAddress").value
        };

        try {
            const result = await apiCall("/students/createMember", "POST", data);

            if (result.success) {
                showStatusMessage(result.message || "User registered successfully!", true);
                document.getElementById("registrationForm").reset();
                document.getElementById("regProgram").innerHTML = "<option>Select a College first</option>";
            } else {
                showStatusMessage(result?.message || "An error occurred during registration.", false);
            }

        } catch (err) {
            console.error(err);
            console.log("An error occurred while adding member.");
        }

    }

    document.getElementById("registrationForm").addEventListener("submit", function(e) {
        e.preventDefault();
        register();
    });

    function showStatusMessage(message, isSuccess = false) {
        const msgBox = document.getElementById("status-message");
        msgBox.textContent = message;
        msgBox.classList.remove("hidden", "success", "error");
        msgBox.classList.add(isSuccess ? "success" : "error");
        msgBox.style.display = "block";

        setTimeout(() => {
            msgBox.style.display = "none";
        }, 8000);
    }
</script>

<?php include '_footer.php'; ?>