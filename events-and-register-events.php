<?php include '_header.php'; ?>

<div class="flex flex-col min-h-screen">

<div class="mt-20 px-5 py-20 text-center max-w-7xl mx-auto mb-0 relative">
    <h1 class="text-4xl sm:text-5xl font-extrabold text-[#b9da05] mb-4">Events</h1>
    <p class="text-[1.2rem] text-white/90 relative z-[1]">Track your upcoming, completed, and past events</p>
</div>

<div class="main-content">
    <div class="flex justify-center mb-10">
        <div class="filter-buttons">
            <button class="filter-btn active" data-section="upcomingSection">Upcoming</button>
            <button class="filter-btn" data-section="pastSection">Completed</button>
            <button class="filter-btn" onclick="window.location.href='previous-activities.php'">Past Activities</button>
        </div>
    </div>

    <main class="flex-grow pt-28 p-3 flex justify-center">
        <section id="upcomingSection" class="event-section">
            <div class="event-list">
            </div>
        </section>

        <section id="pastSection" class="event-section" style="display:none;">
            <div class="event-list">
            </div>
        </section>
    </main>
</div>

<div class="modal" id="eventModal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2 id="modalTitle"></h2>
        <p class="date" id="modalDate"></p>
        <p id="modalContent"></p>
        <button id="registerBtn" class="register-btn" style="display:none;">Register Now</button>
    </div>
</div>

<div id="messageModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="messageCloseBtn">&times;</span>
        <p id="messageText"></p>
    </div>
</div>

<script>
    const API_BASE = "/updated-msc-website/api";
    
    window.addEventListener('scroll', function() {
        const header = document.getElementById('main-header');
        if (window.scrollY > 50) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    });

    async function apiCall(endpoint, method = "GET", data = null, title = "") {
        try {
            const options = {
                method: method,
                headers: {
                    "Content-Type": "application/json"
                },
                credentials: "include",
            };
            if (data) options.body = JSON.stringify(data);

            const response = await fetch(`${API_BASE}${endpoint}`, options);
            const result = await response.json();
            return result;
        } catch (error) {
            console.error("API Error:", error);
            return null;
        }
    }

    function showEvent(index, sectionId) {
        const cards = document.querySelectorAll(`#${sectionId} .event-card`);
        if (!cards.length) return;

        if (index < 0) index = cards.length - 1;
        if (index >= cards.length) index = 0;

        cards.forEach(card => card.classList.remove("active"));
        cards[index].classList.add("active");

        document.getElementById(sectionId).dataset.currentIndex = index;
    }

    function prevEvent(sectionId) {
        const section = document.getElementById(sectionId);
        let currentIndex = parseInt(section.dataset.currentIndex || "0", 10);
        showEvent(currentIndex - 1, sectionId);
    }

    function nextEvent(sectionId) {
        const section = document.getElementById(sectionId);
        let currentIndex = parseInt(section.dataset.currentIndex || "0", 10);
        showEvent(currentIndex + 1, sectionId);
    }


    async function loadEvents() {
        try {
            const response = await apiCall("/events?page=1&limit=100", "GET");
            const events = response?.data?.events || [];
            if (!events.length) return;

            const today = new Date();
            const upcomingEvents = [];
            const completedEvents = [];
            const pastEvents = [];

            events.forEach(event => {
                const eventDate = new Date(event.event_date);

                if (event.event_status?.toLowerCase() === "upcoming") {
                    upcomingEvents.push(event);
                } else if (event.event_status?.toLowerCase() === "completed") {
                    completedEvents.push(event);
                } else if (eventDate < today) {
                    pastEvents.push(event);
                }
            });

            renderEvents(upcomingEvents, "upcomingSection");
            renderEvents(completedEvents, "completedSection");
            renderEvents(pastEvents, "pastSection");

            attachCardListeners();
        } catch (err) {
            console.error("Error loading events:", err);
        }
    }

    function renderEvents(eventsArray, sectionId) {
        const section = document.getElementById(sectionId).querySelector(".event-list");
        section.innerHTML = "";

        eventsArray.forEach((event, index) => {
            const card = document.createElement("div");
            card.classList.add("event-card");
            if (index === 0) card.classList.add("active");

            card.dataset.id = event.event_id;
            card.dataset.title = event.event_name;
            card.dataset.date = event.event_date;
            card.dataset.status = event.event_status;
            card.dataset.content = event.description;
            card.dataset.capacity = event.capacity || 0;
            card.dataset.registeredCount = event.attendants || 0;
            card.dataset.access = event.event_restriction || "public";

            card.innerHTML = `
                <div class="event-image">
                    ${event.event_batch_image   
                    ? `<img src="${event.event_batch_image}" alt="Event Badge" />`
                    : `<i class="bi bi-calendar-event"></i>`}
                </div>
                <div class="event-content">
                    <div>
                        <h3>${event.event_name}</h3>
                        <p class="date">${new Date(event.event_date).toLocaleDateString("en-US", { month: "long", day: "numeric", year: "numeric" })}</p>
                    </div>
                    <p class="excerpt">${event.description}</p>
                </div>
            `;

            card.addEventListener("click", () => {
                document.getElementById("modalTitle").textContent = card.dataset.title;
                document.getElementById("modalDate").textContent = card.dataset.date;
                document.getElementById("modalContent").textContent = card.dataset.content;

                const registerBtn = document.getElementById("registerBtn");
                registerBtn.dataset.eventId = card.dataset.id;
                registerBtn.style.display = (card.dataset.status.toLowerCase() === "upcoming") ?
                    "inline-block" :
                    "none";

                document.getElementById("eventModal").style.display = "flex";
            });

            section.appendChild(card);
        });

        if (eventsArray.length > 1) {

            const prevBtn = document.createElement("button");
            prevBtn.className = "nav-arrow prev";
            prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
            prevBtn.onclick = () => prevEvent(sectionId);

            const nextBtn = document.createElement("button");
            nextBtn.className = "nav-arrow next";
            nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
            nextBtn.onclick = () => nextEvent(sectionId);

            section.appendChild(prevBtn);
            section.appendChild(nextBtn);

            showEvent(0, sectionId);
        }
    }



    window.addEventListener("DOMContentLoaded", loadEvents);
</script>
<script>
    document.addEventListener("DOMContentLoaded", async () => {
        try {
            const eventsData = await apiCall("/events?page=1&limit=100", "GET");
            const events = eventsData?.data?.events || [];

            events.forEach(event => {
                console.log(event.event_id, event.event_name, event.event_date, event.event_status);
            });

            if (!eventsData || !eventsData.data) {
                console.error("❌ No event data received");
                return;
            }

            const today = new Date();

            const pastEvents = [];
            const completedEvents = [];
            const upcomingEvents = [];

            events.forEach(event => {
                const now = new Date();
                const eventEnd = new Date(`${event.event_date}T${event.event_time_end}`);
                if (eventEnd > now) {
                    upcomingEvents.push(event);
                } else if (event.event_status && event.event_status.toLowerCase() === "completed") {
                    completedEvents.push(event);
                } else {
                    pastEvents.push(event);
                }
            });

            const pastCards = document.querySelectorAll("#pastSection .event-card");
            const completedCards = document.querySelectorAll("#completedSection .event-card");
            const upcomingCards = document.querySelectorAll("#upcomingSection .event-card");

            function updateCard(card, event) {
                card.dataset.id = event.event_id || "unknown";
                card.dataset.title = event.event_name || "Untitled Event";
                card.dataset.date = event.event_date || "Unknown Date";
                card.dataset.time = `${event.event_time_start || "???"} - ${event.event_time_end || "???"}`;
                card.dataset.location = event.location || "TBA";
                card.dataset.description = event.description || "No description available.";
                card.querySelector("h3").textContent = event.event_name || "Untitled Event";
                card.querySelector("p.date").textContent = event.event_date || "Unknown Date";
                card.querySelector("p.excerpt").textContent = event.description.substring(0, 50) + "...";
            }

            pastEvents.forEach((event, i) => {
                if (pastCards[i]) updateCard(pastCards[i], event);
            });

            completedEvents.forEach((event, i) => {
                if (completedCards[i]) updateCard(completedCards[i], event);
            });

            upcomingEvents.forEach((event, i) => {
                if (upcomingCards[i]) updateCard(upcomingCards[i], event);
            });

        } catch (err) {
            console.error("⚠ Error loading events:", err);
        }
    });
</script>
<script>
        function attachCardListeners() {
            const modal = document.getElementById("eventModal");
            const closeBtn = document.querySelector(".close-btn");
            const registerBtn = document.getElementById("registerBtn");

        document.querySelectorAll(".event-card").forEach(card => {
        card.addEventListener("click", async () => {
            const modal = document.getElementById("eventModal");
            const modalTitle = document.getElementById("modalTitle");
            const modalDate = document.getElementById("modalDate");
            const modalDesc = document.getElementById("modalContent");
            const registerBtn = document.getElementById("registerBtn");

            // Set event info
            modalTitle.textContent = card.dataset.title;
            modalDate.textContent = card.dataset.date;
            modalDesc.textContent = card.dataset.content;

            registerBtn.dataset.eventId = card.dataset.id;
            registerBtn.style.display = (card.dataset.status?.toLowerCase() === "upcoming") ? "inline-block" : "none";

            // ✅ Check login and registration status immediately
            let isRegistered = false;
            try {
                const authStatus = await apiCall("/auth/check-login", "GET");
                if (authStatus?.success && authStatus?.data?.logged_in) {
                    const regStatus = await apiCall(`/events/${card.dataset.id}/is-registered`, "GET");
                    if (regStatus?.success && regStatus?.data?.registered) {
                        isRegistered = true;
                        card.dataset.registered = "true";
                    }
                }
            } catch (err) {
                console.warn("Could not verify registration status:", err);
            }

            // ✅ Create cancel button if it doesn’t exist
            let cancelBtn = document.getElementById("cancelPreRegister");
            if (!cancelBtn) {
                cancelBtn = document.createElement("button");
                cancelBtn.id = "cancelPreRegister";
                cancelBtn.textContent = "Cancel Pre-Registration";
                cancelBtn.className = "register-btn"; // reuse button style
                modalContent.appendChild(cancelBtn);
            }

            // Always show the Cancel Pre-Register button if the user is registered
            cancelBtn.style.display = isRegistered ? "inline-block" : "none";

            // Cancel button logic (leave as-is)
            cancelBtn.onclick = async () => {
                const authStatus = await apiCall("/auth/check-login", "GET");
                if (!authStatus?.success || !authStatus?.data?.logged_in) {
                    showMessage('Please <a href="login.php" class="text-blue-500">log in</a> first.');
                    return;
                }
                const userId = authStatus.data.user_id;
                const result = await apiCall(`/events/${card.dataset.id}/cancel-pre-registration`, "POST", { user_id: userId });
                if (result?.success) {
                    showMessage(result.message || "✅ Registration canceled.");
                    cancelBtn.style.display = "none";
                    registerBtn.style.display = "inline-block";
                    card.dataset.registered = "false";
                } else {
                    showMessage(result?.message || "Cancellation failed.");
                }
            };

            modal.style.display = "flex";
        });
        });


            closeBtn.addEventListener("click", () => modal.style.display = "none");
            modal.addEventListener("click", e => { if (e.target === modal) modal.style.display = "none"; });

            registerBtn.addEventListener("click", async () => {
                const eventId = registerBtn.dataset.eventId;
                const eventCard = document.querySelector(`.event-card[data-id='${eventId}']`);
                if (!eventId || !eventCard) {
                    showMessage("⚠ Event not found.");
                    return;
                }

                // ✅ Check login
                const authStatus = await apiCall("/auth/check-login", "GET");
                const isLoggedIn = authStatus?.success && authStatus.data?.logged_in;

                // Access level map
                const accessMap = {
                    public: "open for public",
                    members: "members only",
                    bulsuans: "BulSUans only",
                    inviteOnly: "invite only"
                };
                const eventAccess = accessMap[eventCard.dataset.access] || "open for public";

                // Not logged in → show appropriate form
                if (!isLoggedIn) {
                    if (eventCard.dataset.access === "public") return showPreRegisterFormInsideModal(eventId);
                    if (eventCard.dataset.access === "bulsuans") return showBulSUPreRegisterForm(eventId);
                    if (eventCard.dataset.access === "members")
                        return showMessage('This event is for members only. Please <a href="login.php" class="text-blue-500">log in</a> to register.');
                    return showMessage(`🚫 This event is restricted to "${eventAccess}" users only.`);
                }

                // ✅ If user is logged in, continue with registration
                if (parseInt(eventCard.dataset.registeredCount) >= parseInt(eventCard.dataset.capacity)) {
                    showMessage("⚠ Sorry, this event is already full.");
                    return;
                }

                // ✅ Logged-in users
                let payload = {};

                try {
                    // Get user info
                    const userId = authStatus.data.user.id;
                    const studentRes = await apiCall(`/students/${userId}`, "GET");

                    if (studentRes.success && studentRes.data) {
                        const s = studentRes.data;
                        payload = {
                            first_name: s.first_name,
                            last_name: s.last_name,
                            middle_name: s.middle_name || "",
                            suffix: s.name_suffix || "",
                            gender: s.gender,
                            email: s.email,
                            phone: s.phone || "",
                            facebook: s.facebook_link || "",
                            student_id: s.student_no,
                            program: s.program || "",
                            college: s.college || "",
                            year_level: s.year_level || "",
                            section: s.section || "",
                            user_type: s.role || "bulsuan",
                        };
                    } else {
                        console.warn("Could not fetch student info — using fallback empty data.");
                    }
                } catch (err) {
                    console.error("Error fetching student profile:", err);
                }

                // Prevent empty data
                if (!payload.first_name || !payload.last_name || !payload.email) {
                    showMessage("⚠ Could not load your BulSU profile. Please re-login and try again.");
                    return;
                }

                // ✅ Send registration data
                const result = await apiCall(`/events/${eventId}/register`, "POST", payload);

                if (result?.success) {
                    showMessage(result.message || "Registered successfully!");
                    eventCard.dataset.registered = "true";
                } else {
                    showMessage(result?.message || "Registration failed.");
                }
            });

        function showPreRegisterFormInsideModal(eventId) {
            const modal = document.getElementById("eventModal");
            const modalContent = document.querySelector("#eventModal .modal-content");

            // ✅ Hide the original event info while the form is active
            const modalTitle = document.getElementById("modalTitle");
            const modalDate = document.getElementById("modalDate");
            const modalDesc = document.getElementById("modalContent");
            const registerBtn = document.getElementById("registerBtn");

            [modalTitle, modalDate, modalDesc, registerBtn].forEach(el => {
                if (el) el.style.display = "none";
            });

            // ✅ Create form container
            const formContainer = document.createElement("div");
            formContainer.classList.add("pre-register-container");

            formContainer.innerHTML = `
                <h2>Pre-Register for Event</h2>
                <p class="subtitle">This event is open for public participants. Please fill out your information below:</p>

                <!-- 🆕 Participant Type field -->
                <div class="single-select">
                    <label>Participant Type*</label>
                    <select id="participantType" required>
                        <option value="" disabled selected>Select Type</option>
                        <option value="Guest">Guest</option>
                        <option value="BulSUan">BulSUan</option>
                    </select>
                </div>

                <div class="form-grid">
                    <div class="left-col">
                        <label>First Name*</label>
                        <input type="text" id="firstName" required>

                        <label>Last Name*</label>
                        <input type="text" id="lastName" required>

                        <label>Email*</label>
                        <input type="email" id="email" required>

                        <label>Gender*</label>
                        <select id="gender" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div class="right-col">
                        <label>Middle Name</label>
                        <input type="text" id="middleName">

                        <label>Suffix</label>
                        <select id="suffix">
                            <option>None</option>
                            <option>Jr.</option>
                            <option>I</option>
                            <option>II</option>
                            <option>III</option>
                        </select>

                        <label>Phone Number</label>
                        <input type="text" id="phone">

                        <label>Facebook Profile Name</label>
                        <input type="text" id="facebook">
                    </div>
                </div>

                <div class="form-actions">
                    <button id="submitPreRegister">Submit</button>
                    <button id="cancelPreRegister">Cancel</button>
                </div>
            `;

            // ✅ Remove previous form (safety)
            const existingForm = document.querySelector(".pre-register-container");
            if (existingForm) existingForm.remove();

            modalContent.appendChild(formContainer);
            modal.style.display = "flex";

            // ✅ Cancel button: remove form + restore event details
            document.getElementById("cancelPreRegister").addEventListener("click", () => {
                formContainer.remove();
                [modalTitle, modalDate, modalDesc, registerBtn].forEach(el => {
                    if (el) el.style.display = ""; // restore visibility
                });
            });

            // ✅ Submit logic
            document.getElementById("submitPreRegister").addEventListener("click", async () => {
                const data = {
                    first_name: document.getElementById("firstName").value,
                    last_name: document.getElementById("lastName").value,
                    middle_name: document.getElementById("middleName").value,
                    suffix: document.getElementById("suffix").value,
                    gender: document.getElementById("gender").value,
                    email: document.getElementById("email").value,
                    phone: document.getElementById("phone").value,
                    facebook: document.getElementById("facebook").value,
                    user_type: "guest",
                };

                if (!data.first_name || !data.last_name || !data.email || !data.gender) {
                    alert("Please fill in all required fields.");
                    return;
                }

                const result = await apiCall(`/events/${eventId}/register`, "POST", data);
                if (result && result.success) {
                    showMessage(result.message || "Pre-registration successful!");
                    formContainer.remove();
                    window.location.reload();
                } else {
                    showMessage(result?.message || "Pre-registration failed.");
                }
            });
        }

        function showBulSUPreRegisterForm(eventId) {
            const modal = document.getElementById("eventModal");
            const modalContent = document.querySelector("#eventModal .modal-content");

            // Hide the original event info
            const modalTitle = document.getElementById("modalTitle");
            const modalDate = document.getElementById("modalDate");
            const modalDesc = document.getElementById("modalContent");
            const registerBtn = document.getElementById("registerBtn");

            [modalTitle, modalDate, modalDesc, registerBtn].forEach(el => {
                if (el) el.style.display = "none";
            });

            // Create form container
            const formContainer = document.createElement("div");
            formContainer.classList.add("pre-register-container");

            formContainer.innerHTML = `
                <h2>Pre-Register for BulSUans Only Event</h2>
                <p class="subtitle">This event is restricted to BulSU participants. Please fill out your information below:</p>

                <div class="form-grid">
                    <div class="left-col">
                        <label>First Name*</label>
                        <input type="text" id="firstName" required>

                        <label>Last Name*</label>
                        <input type="text" id="lastName" required>

                        <label>Email*</label>
                        <input type="email" id="email" required>

                        <label>Gender*</label>
                        <select id="gender" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div class="right-col">
                        <label>Middle Name</label>
                        <input type="text" id="middleName">

                        <label>Suffix</label>
                        <select id="suffix">
                            <option>None</option>
                            <option>Jr.</option>
                            <option>I</option>
                            <option>II</option>
                            <option>III</option>
                        </select>

                        <label>Phone Number</label>
                        <input type="text" id="phone">

                        <label>Facebook Profile Name</label>
                        <input type="text" id="facebook">
                    </div>
                </div>

                <!-- BulSU Information -->
                <h3>BulSU Information</h3>
                <div class="form-grid">
                    <div class="left-col">
                        <label>Student/Employee ID*</label>
                        <input type="text" id="studentId" required>

                        <label>Program*</label>
                        <input type="text" id="program" required>
                    </div>
                    <div class="right-col">
                        <label>College*</label>
                        <input type="text" id="college" required>

                        <label>Year Level*</label>
                        <select id="yearLevel" required>
                            <option value="" disabled selected>Select Year Level</option>
                            <option>1st year</option>
                            <option>2nd year</option>
                            <option>3rd year</option>
                            <option>4th year</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid">
                    <label>Section</label>
                    <input type="text" id="section">
                </div>

                <div class="form-actions">
                    <button id="submitBulSUPreRegister">Submit</button>
                    <button id="cancelBulSUPreRegister">Cancel</button>
                </div>
            `;

            // Remove any previous form
            const existingForm = document.querySelector(".pre-register-container");
            if (existingForm) existingForm.remove();

            modalContent.appendChild(formContainer);
            modal.style.display = "flex";

            // Cancel button
            document.getElementById("cancelBulSUPreRegister").addEventListener("click", () => {
                formContainer.remove();
                [modalTitle, modalDate, modalDesc, registerBtn].forEach(el => {
                    if (el) el.style.display = "";
                });
            });

            // Submit logic
            document.getElementById("submitBulSUPreRegister").addEventListener("click", async () => {
                const data = {
                    first_name: document.getElementById("firstName").value,
                    last_name: document.getElementById("lastName").value,
                    middle_name: document.getElementById("middleName").value,
                    suffix: document.getElementById("suffix").value,
                    gender: document.getElementById("gender").value,
                    email: document.getElementById("email").value,
                    phone: document.getElementById("phone").value,
                    facebook: document.getElementById("facebook").value,
                    student_id: document.getElementById("studentId").value,
                    program: document.getElementById("program").value,
                    college: document.getElementById("college").value,
                    year_level: document.getElementById("yearLevel").value,
                    section: document.getElementById("section").value,
                    user_type: "bulsuan",
                };

                // Required field validation
                if (!data.first_name || !data.last_name || !data.email || !data.gender || !data.student_id || !data.program || !data.college || !data.year_level) {
                    alert("Please fill in all required fields.");
                    return;
                }

                const result = await apiCall(`/events/${eventId}/register`, "POST", data);
                if (result && result.success) {
                    showMessage(result.message || "Pre-registration successful!");
                    formContainer.remove();
                    window.location.reload();
                } else {
                    showMessage(result?.message || "Pre-registration failed.");
                }
            });
        }

        async function handleMembersOnlyRegistration(eventId) {
            const modal = document.getElementById("eventModal");
            const modalContent = document.querySelector("#eventModal .modal-content");
            const modalTitle = document.getElementById("modalTitle");
            const modalDate = document.getElementById("modalDate");
            const modalDesc = document.getElementById("modalContent");
            let registerBtn = document.getElementById("registerBtn");

            // Show event info
            [modalTitle, modalDate, modalDesc].forEach(el => {
                if (el) el.style.display = "";
            });

            // Setup Register button (logic intact)
            registerBtn.style.display = "inline-block";
            registerBtn.textContent = "Register Now";
            registerBtn.dataset.eventId = eventId;

            const newRegisterBtn = registerBtn.cloneNode(true);
            registerBtn.parentNode.replaceChild(newRegisterBtn, registerBtn);
            registerBtn = newRegisterBtn;

            registerBtn.onclick = async () => {
                const authStatus = await apiCall("/auth/check-login", "GET");
                if (!authStatus?.success || !authStatus?.data?.logged_in) {
                    showMessage('Please <a href="login.php" class="text-blue-500">log in</a> first to register.');
                    return;
                }

                const result = await apiCall(`/events/${eventId}/register`, "POST", {}, `Register for Event #${eventId}`);
                if (result?.success) {
                    showMessage(result.message || "✅ Registered successfully!");
                } else {
                    showMessage(result?.message || "Registration failed.");
                }
            };

            // --- Always show Cancel Pre-Register button ---
            let cancelPreBtn = document.getElementById("cancelPreRegister");
            if (!cancelPreBtn) {
                cancelPreBtn = document.createElement("button");
                cancelPreBtn.id = "cancelPreRegister";
                cancelPreBtn.textContent = "Cancel Pre-Registration";
                cancelPreBtn.className = "register-btn"; // reuse button style
                modalContent.appendChild(cancelPreBtn);
            }

            // **Display by default**
            cancelPreBtn.style.display = "inline-block";

            // Cancel button logic (leave as-is)
            cancelPreBtn.onclick = async () => {
                const authStatus = await apiCall("/auth/check-login", "GET");
                if (!authStatus?.success || !authStatus?.data?.logged_in) {
                    showMessage('Please <a href="login.php" class="text-blue-500">log in</a> first.');
                    return;
                }

                const userId = authStatus.data.user_id;

                const result = await apiCall(`/events/${eventId}/cancel-pre-registration`, "POST", { user_id: userId });
                if (result?.success) {
                    showMessage(result.message || "✅ Registration canceled.");
                } else {
                    showMessage(result?.message || "Cancellation failed.");
                }
            };

            modal.style.display = "flex";
        }

        function showMessage(msg) {
            const eventModal = document.getElementById("eventModal");
            eventModal.style.display = "none";

            const messageModal = document.getElementById("messageModal");
            const messageText = document.getElementById("messageText");
            messageText.innerHTML = msg;
            messageModal.style.display = "flex";

            const closeBtn = document.getElementById("messageCloseBtn");
            closeBtn.onclick = () => messageModal.style.display = "none";

            messageModal.onclick = e => {
                if (e.target === messageModal) messageModal.style.display = "none";
            };
        }

        function checkEventStatus() {
            const now = new Date();

            document.querySelectorAll(".event-card[data-registered='true']").forEach(card => {
                const eventEnd = new Date(`${card.dataset.date}T${card.dataset.time.split(' - ')[1]}`);
                if (now > eventEnd) {
                    const completedSection = document.querySelector("#completedSection .event-list");
                    completedSection.appendChild(card);

                    card.dataset.status = "completed";
                }
            });
        }

        setInterval(checkEventStatus, 30000);

        document.querySelectorAll(".filter-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");

                document.querySelectorAll(".event-section").forEach(section => {
                    section.style.display = "none";
                });

                const targetSection = document.getElementById(btn.dataset.section);
                if (targetSection) {
                    targetSection.style.display = "block";
                }
            });
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        attachCardListeners();
    });
</script>
<?php include '_footer.php'; ?>
</div>