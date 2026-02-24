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
    .el {
            background: conic-gradient(from 180deg at 50% 70%,hsla(0,0%,98%,1) 0deg,#b9da05 72.0000010728836deg,#0051ff 144.0000021457672deg,#0095ff 216.00000858306885deg,#b9da05 288.0000042915344deg,hsla(0,0%,98%,1) 1turn);
            width: 100%;
            height: 100%;
            mask:
                radial-gradient(circle at 50% 50%, white 2px, transparent 2.5px) 50% 50% / var(--size) var(--size),
                url("https://assets.codepen.io/605876/noise-mask.png") 256px 50% / 256px 256px;
            mask-composite: intersect;
            animation: flicker 20s infinite linear;
            position: fixed;
            z-index: 0;
            top: 0;
            left: -10;
        }

    header, footer {
        position: relative;
        z-index: 0;
    }

    @keyframes flicker {
        to {
            mask-position: 50% 50%, 0 50%;
            }
    }
</style>

<main class="flex-grow flex items-center justify-center pt-28 px-4 mb-8">
    <div class="el"></div>

    <div
        class="w-full max-w-4xl bg-[#18181b] text-white p-8 rounded-2xl shadow-lg border-[#27272a] border-2 z-0">
        <h2 class="text-3xl font-bold mb-6 text-center" style="font-family: 'Veonika', sans-serif;">Create Your
            Account</h2>
        <div id="status-message" class="hidden px-4 py-8 rounded text-sm text-white font-medium mb-4"></div>
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
                <div class="w-full">
                    <label for="regEmail" class="block text-sm font-semibold mb-1">Email Address</label>
                    <input id="regEmail" type="email" required
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                    <!-- <p class="text-xs text-gray-400 mt-1">Please enter a valid email address</p> -->
                </div>    
                <div class="w-full">
                    <label for="regPhone" class="block text-sm font-semibold mb-1">Phone Number</label>
                    <input type="tel" id="regPhone" name="regPhone" placeholder="e.g. 09123456789" required class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                </div>
            </div>

            <div>
                <label for="regFacebook" class="block text-sm font-semibold mb-1">Facebook Username (Optional)</label>
                <input type="text" id="regFacebook" name="regFacebook" class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
            </div>

            <div class="form-grid mb-6">
                <div>
                    <label for="regSuffix" class="block text-sm font-semibold mb-1">Name Suffix</label>
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
                    <label for="regBirthDate" class="block text-sm font-semibold mb-1">Birthdate</label>
                    <input type="date" name="regBirthDate" id="regBirthDate" class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05] [color-scheme:dark]">
                </div>
                <div>
                    <label for="regGender" class="block text-sm font-semibold mb-1">Gender</label>
                    <select id="regGender" name="regGender" required class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>

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
            </div>

            <div class="form-grid mb-6">
                <div>
                    <label for="regYearLevel" class="block text-sm font-semibold mb-1">Year Level</label>
                    <select id="regYearLevel" required
                        class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]">
                        <option value="">Select Year Level</option>
                        <option value="Freshman (First Year)">1st Year</option>
                        <option value="Sophomore (Second Year)">2nd Year</option>
                        <option value="Junior (Third Year)">3rd Year</option>
                        <option value="Senior (Fourth Year)">4th Year</option>
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
                <label for="regAddress" class="block text-sm font-semibold mb-1">Address (Optional)</label>
                <textarea id="regAddress" name="regAddress" rows="2" class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-[#b9da05]"></textarea>
            </div>

            <div class="flex items-start mb-6">
                <input type="checkbox" id="terms" class="mt-1 mr-2 accent-[#b9da05]" required>
                <label for="terms" class="text-sm text-gray-300">I agree to the <a href="terms_of_service.php" class="text-[#b9da05] hover:underline">Terms of Service</a> and <a href="privacy_policy.php" class="text-[#b9da05] hover:underline">Privacy Policy</a>.</label>
            </div>

            <button type="submit"
                id="regSubmit"
                class="w-full bg-[#b9da05] text-[#00071c] text-m font-bold py-3 rounded-md hover:bg-[#8fae04] hover:text-[#00071c] transition-colors shadow-md cursor-pointer">Create Account</button>
            
            <div class="flex flex-col items-center text-center mt-6">
                <div class="flex justify-center items-center gap-1">
                    <p>Already have an account?</p>
                    <a href="login.php" class="text-[#b9da05] hover:underline">Sign in here</a>
                </div>
                <small class="text-gray-400 mt-2">Powered by <b>BulSU MSC</b></small>
            </div>
        </form>
    </div>
</main>

<script src="program-and-course.js"></script>
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

            // console.log(`🚀 ${method} ${endpoint}:`, data);

            const response = await fetch(`${API_BASE}${endpoint}`, options);
            const result = await response.json();
            // console.log(result);

            return result;
        } catch (error) {
            // console.error("API Error:", error);
            showStatusMessage("⚠ Network Error", `Network error during ${title}`, false);
            return null;
        }
    }

    async function generateNextMscId() {
        try {
            const res = await fetch(`${API_BASE}/students/next-msc-id`, {
                method: "GET",
                credentials: "include"
            });
            const responseData = await res.json();
            // console.log("Generated MSC ID:", responseData);
            return responseData.data.msc_id;
        } catch (err) {
            // console.error("Failed to fetch MSC ID:", err);
            showStatusMessage("⚠ Error", "Failed to generate MSC ID. Please try again.", false);
            return undefined;
        }
    }

    async function loginAndRedirect(username, password) {
        try {
            const res = await fetch(`${API_BASE}/auth/login`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                credentials: "include",
                body: JSON.stringify({ username, password }),
        });

        const data = await res.json();

        // console.log("Login after registration:", data);

        if (res.ok && data.success) {
            window.location.href = "dashboard.php";
        } else {
            showStatusMessage(data.message || "Login failed after registration. Please try logging in manually.", false);
        }
    } catch (err) {
        showStatusMessage(data.message || "Login failed after registration. Please try logging in manually.", false);
    }
}

    const collegeAbbreviations = {
        "College of Architecture and Fine Arts": "CAFA",
        "College of Arts and Letters": "CAL",
        "College of Business Education and Accountancy": "CBEA",
        "College of Criminal Justice Education": "CCJE",
        "College of Hospitality and Tourism Management": "CHTM",
        "College of Information and Communications Technology": "CICT",
        "College of Industrial Technology": "CIT",
        "College of Nursing": "CN",
        "College of Engineering": "COE",
        "College of Professional Teacher Education": "CPTED",
        "College of Science": "CS",
        "College of Sports, Exercise and Recreation": "CSER",
        "College of Social Sciences and Philosophy": "CSSP",
    };

    async function register() {
        const mscId = await generateNextMscId();
        const studentNo = document.getElementById("regStudentNo").value;
        const college = collegeAbbreviations[document.getElementById("regCollege").value.trim()] || document.getElementById("regCollege").value;

        const data = {
            username: mscId,
            email: document.getElementById("regEmail").value,
            facebook_link: document.getElementById("regFacebook").value,
            password: studentNo,
            first_name: document.getElementById("regFirstName").value,
            middle_name: document.getElementById("regMiddleName").value,
            last_name: document.getElementById("regLastName").value,
            name_suffix: document.getElementById("regSuffix").value,
            birthdate: document.getElementById("regBirthDate").value,
            gender: document.getElementById("regGender").value,
            phone: document.getElementById("regPhone").value,
            student_no: studentNo,
            section: document.getElementById("regSection").value,
            year_level: document.getElementById("regYearLevel").value,
            college: college,
            program: document.getElementById("regProgram").value,
            address: document.getElementById("regAddress").value
        };

        try {
            const result = await apiCall("/students/createMember", "POST", data);

            if (result.success) {
                showStatusMessage(result.message || "You have registered successfully!", true);
                document.getElementById("registrationForm").reset();
                document.getElementById("regProgram").innerHTML = "<option>Select a College first</option>";
                
                document.getElementById("regSubmit").disabled = true;
                document.getElementById("regSubmit").textContent = "Redirecting...";
                document.getElementById("regSubmit").classList.add("cursor-not-allowed", "bg-[#6e8100]", "hover:bg-[#6e8100]", "text-gray-400", "hover:text-gray-400");

                setTimeout(() => {
                    loginAndRedirect(data.username, data.password);
                }, 5000)
            } else {
                showStatusMessage(result?.message || "An error occurred during registration.", false);
            }

        } catch (err) {
            showStatusMessage(err || "An error occurred during registration. Please try again.", false);
            document.getElementById("regSubmit").disabled = false;
            document.getElementById("regSubmit").textContent = "Create Account";
            document.getElementById("regSubmit").classList.remove("cursor-not-allowed", "bg-[#6e8100]", "hover:bg-[#6e8100]", "text-gray-400", "hover:text-gray-400");
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
        }, 5000);
    }
</script>   

<?php include '_footer.php'; ?>