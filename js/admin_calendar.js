function getEventColor(type) {
  switch (type) {
    case "online": return "bg-blue-600 text-white";
    case "onsite": return "bg-green-600 text-white";
    default: return "bg-white/20 text-white";
  }
}

let currentCalendarDate = new Date();
let calendarEvents = [];

const prevBtn = document.getElementById("prevWeek");
const nextBtn = document.getElementById("nextWeek");
const weekRange = document.getElementById("week-range");

prevBtn.addEventListener("click", () => {
  currentCalendarDate.setDate(currentCalendarDate.getDate() - 7);
  fetchCalendarEvents();
});

nextBtn.addEventListener("click", () => {
  currentCalendarDate.setDate(currentCalendarDate.getDate() + 7);
  fetchCalendarEvents();
});

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

async function fetchCalendarEvents() {
  const start = getStartOfWeek(currentCalendarDate);
  const end = new Date(start);
  end.setDate(start.getDate() + 6);

  weekRange.textContent = `${start.toLocaleDateString("en-US", { month: "short", day: "numeric" })} - ${end.toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" })}`;

  const startDate = formatDate(start);
  const endDate = formatDate(end);

  try {
    const res = await fetch(`${API_BASE}?start=${startDate}&end=${endDate}`, { credentials: "include" });
    const data = await res.json();

    if (data.success && Array.isArray(data.data.events)) {
      calendarEvents = data.data.events.map(event => ({
        id: event.id || event.event_id,
        title: event.event_name,
        date: event.event_date,
        time: event.event_time_start || "00:00",
        type: event.event_type || "",
        location: event.location || "",
        color: getEventColor(event.event_type),
        description: event.description || ""
      }));
    } else {
      calendarEvents = [];
    }

    renderWeek();
  } catch (err) {
    console.error("Calendar fetch error:", err);
  }
}

function renderWeek() {
  const grid = document.getElementById("calendar-grid");
  grid.innerHTML = "";

  const start = getStartOfWeek(currentCalendarDate);
  const daysOfWeek = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

  for (let i = 0; i < 7; i++) {
    const day = new Date(start);
    day.setDate(start.getDate() + i);
    const dateStr = formatDate(day);

    const dayEvents = calendarEvents.filter(e => e.date === dateStr);

    const card = document.createElement("div");
    card.className = "relative flex items-start justify-between p-4 gap-3 bg-[#0b1035] border border-white/20 rounded-md hover:bg-[#132659] transition-colors";

    const addButton = document.createElement("button");
    addButton.className = "absolute top-2 right-2 px-2 py-1 text-xs font-bold bg-[#b9da05] text-[#011538] rounded hover:bg-[#9abc04] transition";
    addButton.innerHTML = `<i class="fa-solid fa-plus"></i>`;
    addButton.title = "Add Event";
    addButton.addEventListener("click", () => openNewEventModal(day));
    card.appendChild(addButton);

    const left = document.createElement("div");
    left.className = "min-w-[100px] flex flex-col items-start gap-1";
    left.innerHTML = `<div class="text-gray-300 font-semibold">${daysOfWeek[i]}</div>
                      <div class="text-white font-bold text-lg">${day.getDate()}</div>`;
    card.appendChild(left);

    const right = document.createElement("div");
    right.className = "flex flex-wrap gap-2 items-start flex-1";

    if (dayEvents.length > 0) {
      const maxVisible = 5;
      dayEvents.slice(0, maxVisible).forEach(evt => {
        const badge = document.createElement("div");
        badge.className = `px-2 py-1 text-xs font-semibold rounded ${getEventColor(evt.type)} cursor-pointer`;
        badge.textContent = evt.title;

        badge.addEventListener("click", () => openSingleEventModal(evt));

        right.appendChild(badge);
      });

      if (dayEvents.length > maxVisible) {
        const moreBadge = document.createElement("div");
        moreBadge.className = "px-2 py-1 text-xs font-semibold rounded bg-gray-600 text-white cursor-pointer";
        moreBadge.textContent = `+${dayEvents.length - maxVisible} more`;
        moreBadge.addEventListener("click", () => openMultipleEventsModal(dayEvents, day));

        right.appendChild(moreBadge);
      }
    } else {
      const noEvent = document.createElement("div");
      noEvent.className = "text-gray-400 text-xs italic";
      noEvent.textContent = "—";
      right.appendChild(noEvent);
    }

    card.appendChild(right);
    grid.appendChild(card);
  }
}

// Single event modal
function openSingleEventModal(event) {
  const modal = document.getElementById("single-event-modal");
  modal.classList.remove("hidden");

  document.getElementById("single-modal-title").textContent = event.title;

  const dateTimeString = `${event.date}T${event.time}`;
  const date = new Date(dateTimeString);

  const formattedDate = date.toLocaleDateString('en-US', {
    weekday: 'long',
    month: 'long',
    day: 'numeric'
  });

  /*
  const formattedTime = date.toLocaleTimeString('en-GB', {
    hour: '2-digit',
    minute: '2-digit',
    hour12: false
  });
  */

  document.getElementById("event-day-time").textContent = `${formattedDate}`; //${formattedTime}
  document.getElementById("event-location").textContent = event.location;

  const participantsBtn = document.querySelector("#single-event-modal #view-participants-btn");
  const newBtn = participantsBtn.cloneNode(true);
  participantsBtn.parentNode.replaceChild(newBtn, participantsBtn);

  newBtn.addEventListener("click", () => {
    sessionStorage.setItem("selectedEventId", event.id);
    closeSingleEventModal();
    window.location.href = "admin_event_participants.html";
  });
}

function openMultipleEventsModal(events, date) {
  const modal = document.getElementById("multiple-events-modal");
  modal.classList.remove("hidden");

  const modalTitle = document.getElementById("multiple-modal-title");
  modalTitle.textContent = date.toLocaleDateString("en-US", { month: "long", day: "numeric", year: "numeric" });

  const modalContent = document.getElementById("multiple-modal-content");
  modalContent.innerHTML = "";

  events.forEach(e => {
    const div = document.createElement("div");
    div.className = `mb-2 p-2 rounded ${getEventColor(e.type)} cursor-pointer`;
    div.textContent = `${e.title} (${e.type})`;

    div.addEventListener("click", () => {
      closeMultipleEventsModal();
      openSingleEventModal(e);
    });

    modalContent.appendChild(div);
  });
}

function closeSingleEventModal() {
  document.getElementById("single-event-modal").classList.add("hidden");
}

function closeMultipleEventsModal() {
  document.getElementById("multiple-events-modal").classList.add("hidden");
}

function goToToday() {
  currentCalendarDate = new Date();
  fetchCalendarEvents();
}

document.addEventListener("DOMContentLoaded", fetchCalendarEvents);

function openNewEventModal(date) {
  document.getElementById("new-event-modal").classList.remove("hidden");
  const dateInput = document.getElementById("event-date");
  dateInput.value = date.toISOString().split("T")[0];

  document.getElementById("event-time-start").value = "07:00";
  document.getElementById("event-time-end").value = "08:00";
}

function closeNewEventModal() {
  document.getElementById("new-event-modal").classList.add("hidden");
  document.getElementById("new-event-form").reset();
}

document.getElementById("cancel-event").addEventListener("click", closeNewEventModal);

document.getElementById("new-event-form").addEventListener("submit", async (e) => {
  e.preventDefault();

  const typeMap = {
    meeting: "Meeting",
    seminar: "Seminar",
    workshop: "Workshop",
    other: "Other"
  };

  const newEvent = {
    event_name: document.getElementById("event-name").value,
    event_date: document.getElementById("event-date").value,
    event_time_start: document.getElementById("event-time-start").value,
    event_time_end: document.getElementById("event-time-end").value,
    location: document.getElementById("location").value,
    event_type: typeMap[document.getElementById("event-type").value],
    description: document.getElementById("event-description").value,
    registration_required: 0,
    event_status: "upcoming",
    event_restriction: "public"
  };

  try {
    const res = await fetch(`${API_BASE}`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(newEvent),
    });
    const result = await res.json();

    if (result.success) {
      showToast("Event created successfully!", "success");

      const modal = document.getElementById("new-event-modal");
      modal.classList.remove("animate-fadeIn");
      modal.classList.add("animate-fadeOut");

      modal.addEventListener("animationend", () => {
        modal.classList.add("hidden");
        modal.classList.remove("animate-fadeOut");
        document.getElementById("new-event-form").reset();
        fetchCalendarEvents();
      }, { once: true });

    } else {
      showToast("Failed: " + result.message, "error");
      console.error(result.errors || result);
    }
  } catch (err) {
    showToast("Error creating event.", "error");
    console.error(err);
  }
});

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
  setTimeout(() => toast.classList.add("hidden"), 2000);
}




