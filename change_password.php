<?php
include '_header.php';
?>

<style>

  /* Password field eye icon styling */
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

  .password-input {
    padding-right: 40px !important;
  }
</style>

<div class="flex flex-col min-h-screen">
<main class="flex-grow flex items-center justify-center pt-28 pb-8 px-4">
  <div class="w-full max-w-md mx-auto p-8 bg-[#011538] border border-[#b9da05] text-white rounded-2xl shadow-2xl">
    <h2 class="section-title">Change Password</h2>
    
    <div id="response" class="hidden mb-4 text-white border border-red-500 bg-[#27272a] px-4 py-3 rounded text-sm"></div>

    <form id="changePasswordForm" class="space-y-4">
      <div class="password-wrapper">
        <label for="currentPassword" class="block text-sm font-semibold mb-1">Old Password</label>
        <div class="relative">
          <input type="password" id="currentPassword" placeholder="Enter your old password" required
                 class="password-input w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" />
          <button type="button" class="toggle-password" onclick="togglePassword('currentPassword')" aria-label="Toggle password visibility">
            <i class="bi bi-eye-fill"></i>
          </button>
        </div>
      </div>

      <div class="password-wrapper">
        <label for="newPassword" class="block text-sm font-semibold mb-1">New Password</label>
        <div class="relative">
          <input type="password" id="newPassword" placeholder="Enter your new password" required
                 class="password-input w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" />
          <p class="text-xs text-gray-400 mt-1">Must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.</p>
          <button type="button" class="toggle-password" onclick="togglePassword('newPassword')" aria-label="Toggle password visibility">
            <i class="bi bi-eye-fill"></i>
          </button>
        </div>
      </div>

      <div class="password-wrapper">
        <label for="confirmPassword" class="block text-sm font-semibold mb-1">Confirm Password</label>
        <div class="relative">
          <input type="password" id="confirmPassword" placeholder="Confirm your new password" required
                 class="password-input w-full px-4 py-3 rounded-md bg-[#27272a] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b9da05]" />
          <button type="button" class="toggle-password" onclick="togglePassword('confirmPassword')" aria-label="Toggle password visibility">
            <i class="bi bi-eye-fill"></i>
          </button>
        </div>
      </div>

      <button type="submit"
              class="w-full bg-[#b9da05] text-[#00071c] text-m font-bold py-3 rounded-md hover:bg-[#8fae04] hover:text-[#00071c] transition-colors shadow-md">
        Change Password
      </button>
    </form>
  </div>
</main>

<script>
const API_BASE = "/updated-msc-website/api";

function togglePassword(inputId) {
  const input = document.getElementById(inputId);
  const icon = input.nextElementSibling.querySelector('i');
  
  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove("bi-eye-fill");
    icon.classList.add("bi-eye-slash-fill");
  } else {
    input.type = "password";
    icon.classList.remove("bi-eye-slash-fill");
    icon.classList.add("bi-eye-fill");
  }
}

function showError(message) {
  const box = document.getElementById('response');
  box.textContent = message;
  box.classList.remove('hidden');
}

document.getElementById('changePasswordForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  
  const currentPassword = document.getElementById('currentPassword').value;
  const newPassword = document.getElementById('newPassword').value;
  const confirmPassword = document.getElementById('confirmPassword').value;

  if (newPassword !== confirmPassword) {
    showError('New passwords do not match');
    return;
  }

  const data = {
    current_password: currentPassword,
    new_password: newPassword
  };

  try {
    const response = await fetch(`${API_BASE}/auth/change-password`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify(data)
    });

    const result = await response.json();

    if (!response.ok) {
      showError(result.message || 'Failed to change password');
      return;
    }

    alert('Password changed successfully');
    window.location.href = 'dashboard.php';
  } catch (error) {
    console.error('API Error:', error);
    showError('Network error occurred');
  }
});
</script>

<?php include '_footer.php'; ?>
</div>