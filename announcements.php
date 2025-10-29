<?php include '_header.php'; ?>

<div class="flex flex-col min-h-screen">

<div class="hero-section">
    <h1>BulSU MSC Announcements</h1>
    <p>Stay updated with the latest from BulSU MSC</p>
</div>

<div class="main-content">
    <main class="flex-grow pt-28 p-3 flex justify-center">
        <section id="upcomingSection" class="announcement-section">
            <div class="announcement-list">
            </div>
        </section>
    </main>

    <div class="modal" id="eventModal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2 id="modalTitle"></h2>
            <p class="date" id="modalDate"></p>
            <p id="modalContent"></p>
        </div>
    </div>
</div>

<script>
    const API_BASE = "/updated-msc-website/api";

    async function apiCall(endpoint, method = "GET", data = null) {
        try {
            const response = await fetch(API_BASE + endpoint, {
                method,
                headers: {
                    "Content-Type": "application/json",
                },
                body: data ? JSON.stringify(data) : null
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return await response.json();
        } catch (err) {
            console.error("API call error:", err);
            return null;
        }
    }

    // Header scroll effect
    window.addEventListener('scroll', function() {
        const header = document.getElementById('main-header');
        if (window.scrollY > 50) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    });

    let currentAnnouncementIndex = 0;
    let announcements = [];

    function showAnnouncement(index) {
        const cards = document.querySelectorAll('.announcement-card');
        cards.forEach((card, i) => {
            card.classList.toggle('active', i === index);
        });

        const prevBtn = document.querySelector('.nav-arrow.prev');
        const nextBtn = document.querySelector('.nav-arrow.next');

        if (prevBtn && nextBtn) {
            prevBtn.disabled = index === 0;
            nextBtn.disabled = index === cards.length - 1;
        }
    }

    function nextAnnouncement() {
        if (currentAnnouncementIndex < announcements.length - 1) {
            currentAnnouncementIndex++;
            showAnnouncement(currentAnnouncementIndex);
        }
    }

    function prevAnnouncement() {
        if (currentAnnouncementIndex > 0) {
            currentAnnouncementIndex--;
            showAnnouncement(currentAnnouncementIndex);
        }
    }

    // Load recent announcements and render dynamically
    async function loadAnnouncements() {
        try {
            const response = await apiCall("/announcements/recent", "GET", null, "🔥 Load Recent Announcements");
            announcements = response?.data || [];

            const listContainer = document.querySelector(".announcement-list");
            listContainer.innerHTML = "";

            if (!announcements.length) {
                listContainer.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-megaphone"></i>
                        <h3>No Announcements Yet</h3>
                        <p>Stay tuned! We'll post important updates and announcements here as they become available.</p>
                    </div>
                `;
                console.warn("⚠ No recent announcements found");
                return;
            }

            if (announcements.length > 1) {
                listContainer.innerHTML = `
                    <button class="nav-arrow prev" onclick="prevAnnouncement()">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="nav-arrow next" onclick="nextAnnouncement()">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                `;
            }

            console.log(announcements);

            announcements.forEach((announcement, index) => {
                const card = document.createElement("div");
                card.classList.add("announcement-card");
                if (index === 0) card.classList.add("active");
                card.dataset.title = announcement.title;
                card.dataset.date = new Date(announcement.date_posted).toLocaleDateString("en-US", {
                    month: "long",
                    day: "numeric",
                    year: "numeric"
                });
                card.dataset.content = announcement.content;

                const imgSrc = `${API_BASE}/${announcement.image_url}`;

                card.innerHTML = `
                    <div class="announcement-image">
                        ${announcement.image_url ?
                        `<img src="${imgSrc}" alt="Announcement Image" />`
                        : `<i class="bi bi-megaphone"></i>`}
                    </div>
                    <div class="announcement-content">
                        <div>
                            <h3>${announcement.title}</h3>
                            <p class="date">${new Date(announcement.date_posted).toLocaleDateString("en-US", { month: "long", day: "numeric", year: "numeric" })}</p>
                        </div>
                        <p class="excerpt">${announcement.content}</p>
                    </div>
                `;
                listContainer.appendChild(card);
            });

            console.log(`✅ Rendered ${announcements.length} announcements`);

            if (announcements.length > 1) {
                showAnnouncement(0);
            }

            // Attach modal click logic
            const modal = document.getElementById("eventModal");
            const closeBtn = document.querySelector(".close-btn");

            document.querySelectorAll(".announcement-card").forEach(card => {
                card.addEventListener("click", () => {
                    document.getElementById("modalTitle").textContent = card.dataset.title;
                    document.getElementById("modalDate").textContent = card.dataset.date;
                    document.getElementById("modalContent").textContent = card.dataset.content;
                    modal.style.display = "flex";
                });
            });

            closeBtn.addEventListener("click", () => modal.style.display = "none");
            modal.addEventListener("click", e => {
                if (e.target === modal) modal.style.display = "none";
            });

        } catch (err) {
            console.error("Error loading announcements:", err);
        }
    }

    // Load on page ready
    window.addEventListener("DOMContentLoaded", loadAnnouncements);
</script>

<?php include '_footer.php'; ?>
</div>