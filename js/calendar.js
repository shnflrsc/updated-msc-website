let currentCalendarDate = new Date();
let upcomingEvents = [];//

function navigateCalendar(monthOffset) {
  currentCalendarDate.setMonth(currentCalendarDate.getMonth() + monthOffset);
  fetchCalendarEvents();
}

async function fetchCalendarEvents() {
  const data = await apiCall("/events/universityCalendar", "GET");
  if (data?.success) {
    upcomingEvents = data.data.map(evt => evt.event_date);
  } else {
    upcomingEvents = [];
  }
  renderCalendar();
}

function renderCalendar() {
  const grid = document.getElementById("calendar-grid");
  const monthTitle = document.getElementById("calendar-month-title");
  const month = currentCalendarDate.getMonth();
  const year = currentCalendarDate.getFullYear();

  const firstDay = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  monthTitle.textContent = currentCalendarDate.toLocaleString("default", {
    month: "long",
    year: "numeric"
  });
  grid.innerHTML = "";

  for (let i = 0; i < firstDay; i++) {
    const cell = document.createElement("div");
    grid.appendChild(cell);
  }

  for (let day = 1; day <= daysInMonth; day++) {
    const cell = document.createElement("div");
    const date = new Date(year, month, day);
    const dateStr = date.getFullYear() + "-" +
      String(date.getMonth() + 1).padStart(2, "0") + "-" +
      String(date.getDate()).padStart(2, "0");

    cell.classList.add(
      "flex", "flex-col", "items-center", "justify-start",
      "p-2", "border", "border-white/10",
      "bg-[#011538]", "hover:bg-white/10", "transition-colors",
      "overflow-hidden", "cursor-pointer", "day-cell"
    );

    const dayLabel = document.createElement("div");
    dayLabel.textContent = day;
    dayLabel.classList.add(
      "w-7", "h-7", "flex", "items-center", "justify-center",
      "font-semibold", "text-sm", "mx-auto", //"rounded-full"
    );

    const today = new Date();
    const isToday = date.toDateString() === today.toDateString();

    if (isToday) {
      cell.classList.add("bg-[#b3da05]/30", "text-[#b9da05]"); //bg-b3da05, text-b9da05
    } else {
      dayLabel.classList.add("text-white");
    }

    cell.appendChild(dayLabel);

    if (upcomingEvents.includes(dateStr)) {
      const dot = document.createElement("div");
      dot.classList.add("w-2", "h-2", "rounded-full", "bg-[#b9da05]", "mt-1");
      cell.appendChild(dot);
    }

    grid.appendChild(cell);
  }
}

function navigateCalendar(monthOffset) {
  currentCalendarDate.setMonth(currentCalendarDate.getMonth() + monthOffset);
  fetchCalendarEvents();
}


function goToToday() {
  currentCalendarDate = new Date();
  fetchCalendarEvents();
}

document.addEventListener("DOMContentLoaded", fetchCalendarEvents);
