<?php include '_header.php'; ?>

<style>
    /* Grid Layout Styles */
    .announcement-list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        padding: 2rem 4rem;
        max-width: 100%;
        width: 100%;
        margin: 0;
        box-sizing: border-box;
    }

    @media (max-width: 1024px) {
        .announcement-list {
            grid-template-columns: repeat(2, 1fr);
            padding: 2rem 3rem;
        }
    }

    @media (max-width: 768px) {
        .announcement-list {
            grid-template-columns: 1fr;
            gap: 1.5rem;
            padding: 1rem 1.5rem;
        }
    }

    .announcement-card {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(185, 218, 5, 0.2);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        height: 100%;
        min-height: 350px;
        width: 100%;
        opacity: 1 !important;
        transform: none !important;
        position: relative !important;
    }

    .announcement-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 15px 40px rgba(185, 218, 5, 0.4);
        border-color: rgba(185, 218, 5, 0.6);
    }

    .announcement-image {
        width: 100%;
        height: 0;
        padding-bottom: 100%; /* This creates a square aspect ratio */
        background: linear-gradient(135deg, #0f3460 0%, #16213e 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .announcement-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .announcement-image i {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 3.5rem;
        color: #b9da05;
    }

    .announcement-content {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        flex-grow: 1;
    }

    .announcement-content h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #b9da05;
        margin: 0;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .announcement-content .date {
        color: #ffffff;
        font-size: 0.85rem;
        opacity: 0.9;
        font-weight: 500;
    }

    .announcement-content .excerpt {
        color: #ffffff;
        opacity: 0.75;
        line-height: 1.6;
        font-size: 0.9rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Remove arrow button styles since we're not using them */
    .nav-arrow {
        display: none !important;
    }

    /* Main content area */
    .main-content {
        min-height: 60vh;
        padding: 2rem 0;
        width: 100%;
        max-width: 100%;
    }

    main.flex-grow {
        width: 100%;
        max-width: 100%;
        padding: 0 !important;
    }

    #upcomingSection {
        width: 100%;
        max-width: 100%;
        padding: 0;
    }

    /* Empty state */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        color: white;
    }

    .empty-state i {
        font-size: 4rem;
        color: #b9da05;
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        font-size: 1.8rem;
        color: #b9da05;
        margin-bottom: 1rem;
    }

    .empty-state p {
        font-size: 1.1rem;
        opacity: 0.8;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        padding: 2rem;
        border-radius: 16px;
        max-width: 600px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        position: relative;
        border: 2px solid rgba(185, 218, 5, 0.3);
    }

    .modal-content h2 {
        color: #b9da05;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .modal-content .date {
        color: #ffffff;
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
    }

    .modal-content p {
        color: #ffffff;
        line-height: 1.7;
        font-size: 1.05rem;
    }

    .close-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 2rem;
        color: #b9da05;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .close-btn:hover {
        transform: rotate(90deg);
    }
</style>

<div class="flex flex-col min-h-screen">

<div class="mt-20 px-5 py-20 text-center max-w-7xl mx-auto mb-0 relative">
    <h1 class="text-4xl sm:text-5xl font-extrabold text-[#b9da05] mb-4">Announcements</h1>
    <p class="text-[1.2rem] text-white/90 relative z-[1]">Stay updated with the latest from BulSU MSC</p>
</div>

<div class="main-content">
    <main class="flex-grow pt-10 p-3 flex justify-center">
        <section id="upcomingSection" class="w-full m-0">
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

    let announcements = [];

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

            console.log(announcements);

            announcements.forEach((announcement, index) => {
                const card = document.createElement("div");
                card.classList.add("announcement-card");
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