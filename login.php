<?php
include '_header.php';
?>

<style>
 .password-wrapper .relative {
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
 padding: 4px;
 display: flex;
 align-items: center;
 z-index: 10;
 }

 .toggle-password:hover {
 color: #b9da05;
 }

 .toggle-password i {
 font-size: 1.2rem;
 }

 #loginPassword {
 padding-right: 40px !important;
 }
</style>


<main class="flex-grow pt-28 flex items-center justify-center min-h-screen p-4 sm:p-6">
 <div class="w-full max-w-sm mx-auto p-6 sm:p-8 bg-[#011538] border border-[#b9da05] text-white rounded-2xl shadow-2xl page-auth-container">
 <h2 class="section-title">Login</h2>

 <div id="response" class="hidden mb-4 text-white border border-red-500 bg-[#27272a] px-4 py-3 rounded text-sm"></div>

 <form id="loginForm" class="space-y-4" novalidate>
 <div>
 <label for="loginUsername" class="block text-sm font-semibold mb-1">Username</label>
 <input type="text" id="loginUsername" placeholder="Enter your username"
class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" />
 <p id="usernameError" class="text-red-500 text-xs mt-1 hidden"></p>
 </div>

 <div class="password-wrapper">
 <label for="loginPassword" class="block text-sm font-semibold mb-1">Password</label>
 <div class="relative">
 <input type="password" id="loginPassword" placeholder="Enter your password"
 class="w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" />
 <button type="button" class="toggle-password" id="togglePasswordBtn" aria-label="Toggle password visibility">
 <i class="bi bi-eye-fill"></i>
 </button>
 </div>
 <p id="passwordError" class="text-red-500 text-xs mt-1 hidden"></p>
 </div>

 <button type="submit"
 id="loginBtn"
 class="w-full bg-[#b9da05] text-[#00071c] text-m font-bold py-3 rounded-md hover:bg-[#8fae04] hover:text-[#00071c] transition-colors shadow-md">
 Sign In
 </button>
 </form>

 <div class="flex flex-col items-center text-center mt-4">
 <small class="text-gray-400 mt-2">Powered by <b>BulSU MSC</b></small>
 <a href="forgot_password.php" class="text-[#b9da05] mt-2 text-sm">Forgot password?</a>
 </div>
 </div>
</main>

<script>
const API_BASE = "/updated-msc-website/api";

const togglePasswordBtn = document.getElementById("togglePasswordBtn");
const passwordInput = document.getElementById("loginPassword");
const toggleIcon = togglePasswordBtn?.querySelector("i");

togglePasswordBtn?.addEventListener("click", () => {
 if (passwordInput.type === "password") {
 passwordInput.type = "text";
 toggleIcon?.classList.remove("bi-eye-fill");
 toggleIcon?.classList.add("bi-eye-slash-fill");
 } else {
 passwordInput.type = "password";
 toggleIcon?.classList.remove("bi-eye-slash-fill");
 toggleIcon?.classList.add("bi-eye-fill");
 }
});

function showError(message) {
 const box = document.getElementById('response');
 box.textContent = message;
 box.classList.remove('hidden');
}

function clearErrors() {
 document.getElementById('response').classList.add('hidden');
 document.getElementById('usernameError').classList.add('hidden');
 document.getElementById('passwordError').classList.add('hidden');
}

document.getElementById('loginForm').addEventListener('submit', async (e) => {
 e.preventDefault();
 clearErrors();

 const username = document.getElementById('loginUsername').value.trim();
 const password = document.getElementById('loginPassword').value;
 let hasError = false;

 if (!username) {
 const el = document.getElementById('usernameError');
 el.textContent = "Please enter your username.";
 el.classList.remove('hidden');
 hasError = true;
 }
 if (!password) {
 const el = document.getElementById('passwordError');
 el.textContent = "Please enter your password.";
 el.classList.remove('hidden');
 hasError = true;
 }
 if (hasError) return;

 const btn = document.getElementById('loginBtn');
 btn.disabled = true;
 const originalText = btn.textContent;
 btn.textContent = 'Signing in...';

 try {
 const res = await fetch(`${API_BASE}/auth/login`, {
 method: "POST",
 headers: { "Content-Type": "application/json" },
 credentials: "include",
 body: JSON.stringify({ username, password }),
 });

 const data = await res.json();

 if (res.ok && data.success) {
 const role = data.data?.role;
 if (role === "admin") {
 window.location.href = "admin_dashboard.html";
 } else if (role === "member" || role === "officer") {
 window.location.href = "dashboard.php";
 } else {
 showError("Unknown role. Please contact support.");
 }
 } else {
 showError(data.message || "Login failed.");
 }
 } catch (err) {
 showError(`Network error: ${err.message}`);
 } finally {
 btn.disabled = false;
 btn.textContent = originalText;
 }
});
</script>

<?php include '_footer.php'; ?>