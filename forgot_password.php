<?php
include '_header.php';
?>

<main class="flex-grow pt-28 flex items-center justify-center min-h-screen p-4 sm:p-6">
  <div class="w-full max-w-sm mx-auto p-6 sm:p-8 bg-[#011538] border border-[#b9da05] text-white rounded-2xl shadow-2xl">
    <h2 class="section-title">Forgot Password</h2>
    <p class="text-center text-sm -mt-6 mb-10">Enter your student number and type your new password.</p>

    <form id="forgotPasswordForm" class="space-y-4" novalidate>
      <div>
        <label for="student_no" class="block text-sm font-medium text-gray-200 mb-1">Student Number</label>
        <input id="student_no" name="student_no" type="text" required
               class="w-full px-4 py-3 rounded-md bg-[#071b3a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" />
      </div>

      <div>
        <label for="new_password" class="block text-sm font-medium text-gray-200 mb-1">New Password</label>
        <input id="new_password" name="new_password" type="password" required
               class="w-full px-4 py-3 rounded-md bg-[#071b3a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" />
      </div>

      <button type="submit" class="w-full bg-[#b9da05] text-[#00071c] font-bold py-3 rounded-md hover:bg-[#8fae04] transition">Reset Password</button>
    </form>
  </div>
</main>

<script>
const API_BASE = "/updated-msc-website/api";

async function apiCall(endpoint, method = "GET", data = null) {
    const options = {
        method,
        headers: { "Content-Type": "application/json" },
        credentials: "include"
    };
    if (data) options.body = JSON.stringify(data);

    try {
        const res = await fetch(`${API_BASE}${endpoint}`, options);
        const json = await res.json();
        return { ok: res.ok, status: res.status, json };
    } catch (err) {
        console.error(err);
        return { ok: false, error: err };
    }
}

document.getElementById("forgotPasswordForm").addEventListener("submit", async (e) => {
    e.preventDefault();
    const student_no = document.getElementById("student_no").value.trim();
    const new_password = document.getElementById("new_password").value;

    if (!student_no || !new_password) {
        alert("Please fill in all fields.");
        return;
    }

    const result = await apiCall("/auth/forgot-password", "POST", { student_no, new_password });
    if (!result.ok) {
        const msg = result.json?.message || "Failed to reset password.";
        alert(msg);
        return;
    }

    alert(result.json?.message || "Password reset successful.");
    window.location.href = "/updated-msc-website/login.php";
});
</script>

<?php include '_footer.php'; ?>