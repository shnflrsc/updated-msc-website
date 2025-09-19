const grid = document.getElementById("univ-calendar-grid");
const weekRange = document.getElementById("week-range");
const prevBtn = document.getElementById("prevWeek");
const nextBtn = document.getElementById("nextWeek");

let currentDate = new Date();
let universityEvents = [];

function getStartOfWeek(date) {
    const day = date.getDay();
    const diff = (day === 0 ? -6 : 1) - day;
    const monday = new Date(date);
    monday.setDate(date.getDate() + diff);
    return monday;
}

function formatDate(date) {
    return date.toISOString().split("T")[0];
}

function getUnivColorByType(type) {
    switch (type) {
        case "Academic Holiday": return "bg-red-600 text-white";
        case "Academic Event": return "bg-green-600 text-white";
        //case "University Event": return "bg-green-600 text-white";
        default: return "bg-white/20 text-white";
    }
}

async function fetchUniversityCalendarEvents() {
    const start = getStartOfWeek(currentDate);
    const end = new Date(start);
    end.setDate(start.getDate() + 6);

    const startDate = formatDate(start);
    const endDate = formatDate(end);

    try {
        const data = await apiCall(`/events/university-calendar?start=${startDate}&end=${endDate}`, "GET");

        if (data && data.success && Array.isArray(data.data)) {
            universityEvents = data.data.map(evt => ({
                title: evt.event_name,
                date: evt.event_date,
                type: evt.event_type,
                color: getUnivColorByType(evt.event_type),
                school_year: evt.school_year
            }));
        } else {
            universityEvents = [];
        }

        renderWeek(currentDate);
    } catch (err) {
        console.error("University Calendar fetch error:", err);
        universityEvents = [];
        renderWeek(currentDate);
    }
}

function renderWeek(date) {
    grid.innerHTML = "";

    const start = getStartOfWeek(date);
    const end = new Date(start);
    end.setDate(start.getDate() + 6);

    weekRange.textContent = `${start.toLocaleDateString("en-US", {
        month: "short",
        day: "numeric"
    })} - ${end.toLocaleDateString("en-US", {
        month: "short",
        day: "numeric",
        year: "numeric"
    })}`;

    const daysOfWeek = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

    for (let i = 0; i < 7; i++) {
        const day = new Date(start);
        day.setDate(start.getDate() + i);

        const dateStr = formatDate(day);
        const dayEvents = universityEvents.filter(e => e.date === dateStr);

        const today = new Date();
        const isToday = dateStr === formatDate(today);

        const cell = document.createElement("div");
        //cell.className = "flex items-center gap-3 border border-white/20 rounded-md p-4 mb-2 bg-[#0b1a3d] hover:bg-[#132659] transition-colors duration-200";
        cell.className = "flex items-center gap-3 border border-white/20 rounded-md p-4 mb-2 hover:bg-[#132659] transition-colors duration-200";

        // apply highlight: if active day
        if (isToday) {
            cell.classList.add("bg-[#b9da05]/30", "font-bold", "text-[#b9da05]");
        } else {
            cell.classList.add("bg-[#0b1a3d]");
        }

        // Left section: day + divider + date
        const header = document.createElement("div");
        //header.className = "flex items-center gap-3 min-w-[120px]";
        header.className = "flex items-center gap-3 flex-shrink-0";

        const dayLabel = document.createElement("div");
        dayLabel.className = "text-sm sm:text-base font-semibold w-12";
        dayLabel.textContent = daysOfWeek[i];

        const divider = document.createElement("div");
        divider.className = "h-6 w-px bg-gray-500";

        const dateEl = document.createElement("div");
        dateEl.className = "text-sm sm:text-base font-bold";
        dateEl.textContent = day.getDate();

        if (isToday) {
            dayLabel.classList.add("text-[#b9da05]");
            dateEl.classList.add("text-[#b9da05]");
        } else {
            dayLabel.classList.add("text-gray-300");
            dateEl.classList.add("text-white");
        }

        header.appendChild(dayLabel);
        header.appendChild(divider);
        header.appendChild(dateEl);

        cell.appendChild(header);

        // Right section: events beside the date
        const eventsContainer = document.createElement("div");
        eventsContainer.className = "flex flex-wrap gap-2 items-center";

        // if (dayEvents.length > 0) {
        //     dayEvents.forEach(evt => {
        //         const badge = document.createElement("div");
        //         badge.className = `px-2 py-1 rounded text-xs font-semibold ${evt.color} truncate`;
        //         badge.textContent = evt.title;
        //         eventsContainer.appendChild(badge);
        //     });
        // } else {
        //     const noEvent = document.createElement("div");
        //     noEvent.className = "text-xs text-gray-400 italic";
        //     //noEvent.textContent = "No available event.";
        //     eventsContainer.appendChild(noEvent);
        // }

        if (dayEvents.length > 0) {
            const maxVisible = 2; // show only 2 events inline
            dayEvents.slice(0, maxVisible).forEach(evt => {
                const badge = document.createElement("div");
                badge.className = `px-2 py-1 rounded text-xs font-semibold ${evt.color} flex-shrink-0`;

                badge.textContent = evt.title;
                eventsContainer.appendChild(badge);
            });

            if (dayEvents.length > maxVisible) {
                const moreBadge = document.createElement("div");
                moreBadge.className = "px-2 py-1 text-sm rounded font-semibold bg-gray-600 text-white cursor-pointer";
                moreBadge.textContent = `+${dayEvents.length - maxVisible} more`;

                // moreBadge.addEventListener("click", () => {
                //     openUnivEventsModal(dayEvents);
                // });
                moreBadge.addEventListener("click", () => {
                    openUnivEventsModal(dayEvents, day);
                });


                eventsContainer.appendChild(moreBadge);
            }
        } else {
            const noEvent = document.createElement("div");
            noEvent.className = "text-xs text-gray-400 italic";
            noEvent.textContent = "—"; // dash if no events for a day
            eventsContainer.appendChild(noEvent);
        }

        cell.appendChild(eventsContainer);
        grid.appendChild(cell);
    }
}

prevBtn.addEventListener("click", () => {
    currentDate.setDate(currentDate.getDate() - 7);
    fetchUniversityCalendarEvents();
});

nextBtn.addEventListener("click", () => {
    currentDate.setDate(currentDate.getDate() + 7);
    fetchUniversityCalendarEvents();
});

/*
function openUnivEventsModal(events) {
    const modal = document.getElementById("modal-overlay");
    const modalTitle = document.getElementById("modal-title");
    const modalContent = document.getElementById("modal-content");

    modalTitle.textContent = "Day Events";
    modalContent.innerHTML = "";

    events.forEach(evt => {
        const item = document.createElement("div");
        item.className = `mb-2 p-2 rounded ${evt.color}`;
        item.textContent = `${evt.title} (${evt.type})`;
        modalContent.appendChild(item);
    });

    modal.classList.remove("hidden");
}
*/

function openUnivEventsModal(events, date) {
    const modal = document.getElementById("univ-modal-overlay");
    const inner = modal.querySelector("div");

    modal.classList.remove("hidden");
    inner.classList.remove("animate-fadeOut");
    inner.classList.add("animate-fadeIn");

    const formattedDate = date.toLocaleDateString("en-US", {
        month: "long",
        day: "numeric",
        year: "numeric"
    });
    document.getElementById("univ-modal-title").textContent = formattedDate;

    const content = document.getElementById("univ-modal-content");
    content.innerHTML = "";
    events.forEach(evt => {
        const item = document.createElement("div");
        item.className = `mb-2 p-2 rounded ${evt.color}`;
        item.textContent = `${evt.title} (${evt.type})`;
        content.appendChild(item);
    });
}

function closeUnivCalendarModal() {
    const modal = document.getElementById("univ-modal-overlay");
    const inner = modal.querySelector("div");

    inner.classList.remove("animate-fadeIn");
    inner.classList.add("animate-fadeOut");

    inner.addEventListener("animationend", () => {
        modal.classList.add("hidden");
    }, { once: true });
}


document.addEventListener("DOMContentLoaded", fetchUniversityCalendarEvents);
