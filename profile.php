<?php include '_header.php'; ?>

<div class="flex flex-col min-h-screen">
<main class="flex-grow pt-28 p-3 flex justify-center">
  <section id="header"
    class="w-11/12 max-w-7xl mx-auto mb-8 bg-transparent flex flex-col lg:flex-row gap-5 items-stretch rounded-2xl">
    <div class="w-full lg:w-5/12 rounded-2xl bg-[#011538] border border-[#b9da05] self-stretch">
      <div class="px-4 sm:px-6 py-4">
        <div class="flex justify-center">
          <div class="flex flex-col h-auto p-2 gap-2 items-center w-full">
            <div class="w-32 h-32 rounded-full shadow-md overflow-hidden border-4 border-[#b9da05]"
              id="profile-picture-container">
            </div>
            <div class="w-24 h-24 bg-white p-2 rounded-lg flex items-center justify-center">
              <div id="qr-code" class="w-full h-full"></div>
            </div>
            <p id="msc_id" class="text-gray-200 text-md tracking-wide"></p>
          </div>
        </div>
        <div class="flex flex-col items-center justify-center text-center mb-4">
          <h2 class="text-2xl text-gray-300 font-bold tracking-wide" id="fullName"></h2>
          <p class="text-sm  text-gray-300 tracking-wide" id="student_no"></p>
        </div>
        <div class="w-full h-px bg-[#b9da05] opacity-50 my-6"></div>
        <div class="w-full h-auto flex flex-col items-center gap-2 mt-4">
          <p class="text-gray-200 text-lg font-semibold" id="program"></p>
          <p class="text-gray-300 text-base font-light" id="college"></p>
          <p class="text-gray-300 text-base font-light" id="year_level"></p>
        </div>
        <div class="flex flex-col items-center justify-center text-center mt-4">
          <div class="flex gap-2">
            <span class="bg-[#03850a] text-white px-4 py-1 rounded-2xl text-md font-semibold">
              Active
            </span>
            <span class="bg-[#03378f] text-white px-4 py-1 rounded-full text-md font-semibold" id="role">
            </span>
          </div>
        </div>
      </div>
    </div>

    <section id="rightSection" class="w-full lg:w-8/12 flex flex-col self-stretch rounded-2xl">
      <section id="editContainer" class="w-full h-full rounded-2xl border border-[#b9da05]">
        <div class="bg-[#011538] pt-4 px-4 sm:px-6 pb-6 rounded-2xl h-full relative">
          <h2 class="mb-4 text-lg sm:text-2xl font-bold text-white">Personal Information</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-2">
            <div class="md:col-span-2">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-4">
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
                  <p class="text-md text-gray-200">Social Media:</p>
                  <div class="flex content-center items-center gap-2">
                    <a id="facebookBtn" href="#" target="_blank"
                      class="text-white cursor-pointer text-2xl hover:text-blue-700">
                      <i class="fa-brands fa-square-facebook"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </section>

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
    if (!data || !data.success) return (window.location.href = "login.html");
    document.documentElement.classList.remove("loading");

    const user = data.data;
    generateQRCode(user.msc_id || user.student_no);
    document.getElementById("msc_id").textContent = user.msc_id;
    document.getElementById("fullName").textContent = `${user.first_name} ${user.last_name}`;
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
    new QRCode(qrContainer, {
      text: data,
      width: 120,
      height: 120,
      colorDark: "#06047b",
      colorLight: "#ffffff",
      correctLevel: QRCode.CorrectLevel.H,
    });
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