const collegeCodeMap = {
    "College of Architecture and Fine Arts (CAFA)": "CAFA",
    "College of Arts and Letters (CAL)": "CAL",
    "College of Business Education and Accountancy (CBEA)": "CBEA",
    "College of Criminal Justice Education (CCJE)": "CCJE",
    "College of Hospitality and Tourism Management (CHTM)": "CHTM",
    "College of Information and Communications Technology (CICT)": "CICT",
    "College of Industrial Technology (CIT)": "CIT",
    "College of Nursing (CON)": "CON",
    "College of Engineering (COE)": "COE",
    "College of Education (COED)": "COED",
    "College of Science (CS)": "CS",
    "College of Sports, Exercise and Recreation (CSER)": "CSER",
    "College of Social Sciences and Philosophy (CSSP)": "CSSP"
};

function createGradient(ctx, hexColor) {
    const r = parseInt(hexColor.slice(1, 3), 16);
    const g = parseInt(hexColor.slice(3, 5), 16);
    const b = parseInt(hexColor.slice(5, 7), 16);
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, `rgba(${r},${g},${b},0.8)`);
    gradient.addColorStop(1, `rgba(${r},${g},${b},0.3)`);
    return gradient;
}

const collegeColors = [
    '#60A5FA', '#34D399', '#FBBF24', '#F87171', '#A78BFA',
    '#F472B6', '#4ADE80', '#818CF8', '#FCD34D', '#10B981',
    '#8B5CF6', '#EF4444', '#3B82F6'
];

const yearLevelColors = ['#60A5FA', '#34D399', '#FBBF24', '#F87171'];

// --- Students per College ---
async function renderStudentsPerCollegeChart() {
    try {
        const res = await fetch(`${API_BASE}/students/college-distribution`, { credentials: "include" });
        const data = await res.json();
        if (!data.success) throw new Error(data.message);

        const sortedData = data.data.sort((a, b) => b.total - a.total);

        const labels = sortedData.map(item => collegeCodeMap[item.college] || item.college);
        const values = sortedData.map(item => item.total);

        const ctx = document.getElementById('studentsPerCollegeChart').getContext('2d');
        const colors = collegeColors.map(c => createGradient(ctx, c));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'No. of Students',
                    data: values,
                    backgroundColor: colors,
                    borderRadius: 10,
                    barPercentage: 0.6
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#fbbf24',
                        bodyColor: '#fff',
                        callbacks: {
                            title: tooltipItem => sortedData[tooltipItem[0].dataIndex].college
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255,255,255,0.1)' },
                        ticks: { color: '#fff', precision: 0 }
                    },
                    y: {
                        grid: { color: 'rgba(255,255,255,0.1)' },
                        ticks: { color: '#fff' }
                    }
                },
                animation: { duration: 1000, easing: 'easeOutQuart' }
            }
        });

    } catch (error) {
        console.error("Chart error (college):", error);
    }
}

// --- Students per Year Level ---
async function renderStudentsPerYearLevelChart() {
    try {
        const res = await fetch(`${API_BASE}/students/yearLevel-distribution`, { credentials: "include" });
        const data = await res.json();
        if (!data.success) throw new Error(data.message);

        const yearOrder = ["1st Year", "2nd Year", "3rd Year", "4th Year"];
        const sortedData = data.data.sort(
            (a, b) => yearOrder.indexOf(a.year_level) - yearOrder.indexOf(b.year_level)
        );

        const labels = sortedData.map(item => item.year_level);
        const values = sortedData.map(item => item.total);

        const ctx = document.getElementById('studentsPerYearLevelChart').getContext('2d');
        const colors = yearLevelColors.map(c => createGradient(ctx, c));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'No. of Students',
                    data: values,
                    backgroundColor: colors,
                    borderRadius: 10,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#fbbf24',
                        bodyColor: '#fff',
                        callbacks: {
                            title: tooltipItem => labels[tooltipItem[0].dataIndex]
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(255,255,255,0.1)' },
                        ticks: { color: '#fff' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255,255,255,0.1)' },
                        ticks: { color: '#fff', precision: 0 }
                    }
                },
                animation: { duration: 1000, easing: 'easeOutQuart' }
            }
        });

    } catch (error) {
        console.error("Chart error (year level):", error);
    }
}

const eventStatusColors = {
    'upcoming': '#60A5FA',
    'completed': '#34D399',
    'canceled': '#F87171'
};

// --- Events Status ---
async function renderEventStatusChart() {
    try {
        const res = await fetch(`${API_BASE}/events/status-count`, { credentials: "include" });
        const data = await res.json();
        if (!data.success) throw new Error(data.message);

        const labels = data.data.map(item => item.event_status);
        const values = data.data.map(item => item.total);

        const ctx = document.getElementById('eventStatusChart').getContext('2d');
        const colors = labels.map(status => createGradient(ctx, eventStatusColors[status] || '#818CF8'));

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels,
                datasets: [{
                    //label: 'No. of Events',
                    data: values,
                    backgroundColor: colors,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            color: '#fff',
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'box'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#fbbf24',
                        bodyColor: '#fff',
                        callbacks: {
                            // Remove default title
                            title: () => null,
                            label: function (context) {
                                const dataset = context.dataset.data;
                                const total = dataset.reduce((a, b) => a + b, 0);
                                const value = context.parsed;
                                const percentage = ((value / total) * 100).toFixed(1);

                                const status = context.chart.data.labels[context.dataIndex];
                                return `No. of ${status} events: ${value}`; //(${percentage}%)
                            }
                        }
                    }
                },
                animation: { duration: 1000, easing: 'easeOutQuart' }
            }
        });

    } catch (error) {
        console.error("Chart error:", error);
    }
}

// --- Events per Month ---
async function renderEventsPerMonthChart() {
    try {
        const res = await fetch(`${API_BASE}/events/monthly-distribution`, { credentials: "include" });
        const data = await res.json();

        if (!data.success) throw new Error(data.message);

        const monthLabels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        const totals = new Array(12).fill(0);
        data.data.forEach(item => {
            const index = parseInt(item.month, 10) - 1;
            totals[index] = parseInt(item.total, 10);
        });

        const ctx = document.getElementById('eventsPerMonthChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Events per Month',
                    data: totals,
                    fill: true,
                    backgroundColor: 'rgba(185, 218, 5, 0.2)',
                    borderColor: '#b9da05',
                    tension: 0.3,
                    pointBackgroundColor: '#b9da05',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#fbbf24',
                        bodyColor: '#fff'
                    }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(255,255,255,0.1)' },
                        ticks: { color: '#fff' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255,255,255,0.1)' },
                        ticks: { color: '#fff', precision: 0 }
                    }
                },
                animation: { duration: 1000, easing: 'easeOutQuart' }
            }
        });

    } catch (error) {
        console.error("Chart error:", error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    renderStudentsPerCollegeChart();
    renderStudentsPerYearLevelChart();
    //renderEventStatusChart();
    //renderEventsPerMonthChart();
});
