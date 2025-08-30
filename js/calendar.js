let currentCalendarDate = new Date();

function navigateCalendar(monthOffset) {
  currentCalendarDate.setMonth(currentCalendarDate.getMonth() + monthOffset);
  fetchCalendarEvents();
}

function fetchCalendarEvents() {
  renderMSCCalendar();
}

function renderMSCCalendar() {
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

    cell.classList.add(
      "flex", "flex-col", "items-center", "justify-start",
      "p-1", "border", "border-white/10",
      "bg-[#011538]", "hover:bg-white/10", "transition-colors",
      "overflow-hidden", "day-cell"
    );

    const dayLabel = document.createElement("div");
    dayLabel.textContent = day;

    const today = new Date();
    const isToday = date.toDateString() === today.toDateString();

    dayLabel.classList.add(
      "w-7", "h-7", "flex", "items-center", "justify-center",
      "font-semibold", "text-sm", "mx-auto", "rounded-full"
    );

    if (isToday) {
      dayLabel.classList.add("bg-[#b9da05]", "text-[#011538]");
    } else {
      dayLabel.classList.add("text-white");
    }

    cell.appendChild(dayLabel);
    grid.appendChild(cell);
  }
}


function goToToday() {
  currentCalendarDate = new Date();
  fetchCalendarEvents();
}

document.addEventListener("DOMContentLoaded", fetchCalendarEvents);
