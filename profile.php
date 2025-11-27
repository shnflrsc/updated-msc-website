<?php include '_header.php'; ?>

<div class="flex flex-col min-h-screen pt-28">
  <main class="flex flex-col items-center flex-grow mb-8">
    <section class="w-11/12 max-w-6xl flex flex-col lg:flex-row gap-5 items-stretch">
      <!-- Left Section -->
      <div class="w-full lg:w-5/12 bg-[#011538] border border-[#b9da05] rounded-2xl flex flex-col">
        <div class="px-4 sm:px-6 py-4 sm:py-6 flex flex-col items-center">
          <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full shadow-md overflow-hidden border-4 border-[#b9da05]" id="profile-picture-container"></div>
          <div class="w-20 h-20 sm:w-24 sm:h-24 bg-white p-1.5 sm:p-2 rounded-lg flex items-center justify-center mt-3">
            <div id="qr-code" class="w-full h-full flex items-center justify-center"></div>
          </div>
          <p id="msc_id" class="text-gray-200 text-sm sm:text-md tracking-wide mt-2"></p>
          <h2 class="text-xl sm:text-2xl text-gray-300 font-bold tracking-wide mt-3 sm:mt-4 text-center px-2" id="profileFullName"></h2>
          <p class="text-xs sm:text-sm text-gray-300 tracking-wide" id="student_no"></p>
          <div class="w-full h-px bg-[#b9da05] opacity-50 my-4 sm:my-6"></div>
          <div class="flex flex-col items-center gap-1.5 sm:gap-2">
            <p class="text-gray-200 text-base sm:text-lg font-semibold text-center px-2" id="program"></p>
            <p class="text-gray-300 text-sm sm:text-base font-light text-center px-2" id="college"></p>
            <p class="text-gray-300 text-sm sm:text-base font-light" id="year_level"></p>
          </div>
          <div class="flex flex-wrap gap-2 mt-3 sm:mt-4 justify-center">
            <span class="bg-[#03850a] text-white px-4 py-1 rounded-2xl text-md font-semibold">Active</span>
            <span class="bg-[#03378f] text-white px-4 py-1 rounded-full text-md font-semibold" id="role"></span>
          </div>
        </div>
      </div>

      <!-- Right Section -->
      <div class="w-full lg:w-7/12 bg-[#011538] border border-[#b9da05] rounded-2xl flex flex-col">
        <div class="px-4 sm:px-6 py-4 sm:py-6 flex flex-col gap-3 sm:gap-4">
          <h2 class="text-lg sm:text-2xl font-bold text-white mb-2 sm:mb-4">Personal Information</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
            <div>
              <p class="text-md text-gray-200">Section:</p>
              <p id="section" class="text-white text-md mb-1">...</p>
            </div>
            <div>
              <p class="text-md text-gray-200">Member Since:</p>
              <p id="member_since" class="text-md text-gray-200 mb-1">..</p>
            </div>
            <div>
              <p class="text-md text-gray-200">Username:</p>
              <p id="username" class="text-md text-gray-200 mb-1">...</p>
            </div>
            <div>
              <p class="text-md text-gray-200">Email:</p>
              <p id="email" class="text-white text-md mb-1">...</p>
            </div>
            <div>
              <p class="text-md text-gray-200">Date of Birth:</p>
              <p id="birthdate" class="text-md text-gray-200 mb-1">...</p>
            </div>
            <div>
              <p class="text-md text-gray-200">Gender:</p>
              <p id="gender" class="text-white text-md mb-1"></p>
            </div>
            <div>
              <p class="text-md text-gray-200">Address:</p>
              <p id="address" class="text-md text-gray-200 mb-1"></p>
            </div>
            <div>
              <p class="text-md text-gray-200">Phone:</p>
              <p id="phone" class="text-md text-gray-200 mb-1"></p>
            </div>
            <div>
              <p class="text-sm sm:text-md text-gray-200 font-medium">Social Media:</p>
              <div class="flex items-center gap-2">
                <a id="facebookBtn" href="#" target="_blank" class="text-white cursor-pointer text-xl sm:text-2xl hover:text-blue-700">
                  <i class="fa-brands fa-square-facebook"></i>
                </a>
              </div>
            </div>
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

  async function fetchProfile() {
    const data = await apiCall("/auth/profile");
    console.log("Profile API", data);
    if (!data || !data.success) return (window.location.href = "login.php");
    document.documentElement.classList.remove("loading");

      const user = data.data;
      generateQRCode(user.msc_id || user.student_no);
      document.getElementById("msc_id").textContent = user.msc_id;
      document.getElementById("profileFullName").textContent = `${user.first_name} ${user.last_name}`;
      document.getElementById("student_no").textContent = user.student_no;
      document.getElementById("program").textContent = user.program;
      document.getElementById("college").textContent = user.college;
      document.getElementById("year_level").textContent = user.year_level;
      document.getElementById("role").textContent = user.role;
      document.getElementById("username").textContent = user.username || "N/A";
      document.getElementById("section").textContent = user.section || "N/A";
      document.getElementById("email").textContent = user.email || "N/A";
      document.getElementById("member_since").textContent = new Date(user.created_at).toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric"
      });
      document.getElementById("birthdate").textContent = user.birthdate || "N/A";
      document.getElementById("gender").textContent = user.gender || "N/A";
      document.getElementById("phone").textContent = user.phone || "N/A";
      document.getElementById("address").textContent = user.address || "N/A";
      document.getElementById("facebookBtn").href = user.facebook_link || "#";

      const fbBtn = document.getElementById("facebookBtn");
      if (user.facebook_link && user.facebook_link.trim() !== "") {
        fbBtn.href = user.facebook_link;
        fbBtn.target = "_blank";
      } else {
        fbBtn.removeAttribute("href");
        fbBtn.style.opacity = "0.5";
        fbBtn.style.pointerEvents = "none";
      }

      const initials = `${user.first_name?.[0] || ""}${user.last_name?.[0] || ""}`.toUpperCase();
      renderProfilePicture(user.profile_image_path, initials);
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

    function generateQRCode(data) {
      const qrContainer = document.getElementById("qr-code");
      qrContainer.innerHTML = "";
      
      // Responsive QR code size
      const isMobile = window.innerWidth < 640;
      const qrSize = isMobile ? 80 : 96;
      
      new QRCode(qrContainer, {
        text: data,
        width: qrSize,
        height: qrSize,
        colorDark: "#06047b",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H,
      });
      
      // Center the QR code
      const qrImg = qrContainer.querySelector('img');
      if (qrImg) {
        qrImg.style.margin = 'auto';
        qrImg.style.display = 'block';
      }
    }

    function formatDate(dateStr) {
      const date = new Date(dateStr);
      return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "short",
        day: "numeric"
      });
    }

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
    document.addEventListener("DOMContentLoaded", fetchProfile);
  </script>

  <?php include '_footer.php'; ?>

</div>