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

async function renderRegisteredMembersPerCollegeChart() {
    try {
        const res = await fetch(`${API_BASE}/students/registered-members-distribution`, { credentials: "include" });
        const data = await res.json();
        if (!data.success) throw new Error(data.message);

        const sortedData = data.data.sort((a, b) => b.total - a.total);

        const labels = sortedData.map(item => collegeCodeMap[item.college] || item.college);
        const values = sortedData.map(item => item.total);

        const ctx = document.getElementById('registeredMembersPerCollegeChart').getContext('2d');
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
                indexAxis: 'x',
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
        console.error("Chart error (college):", error.message);
    }
}

//reg per day
async function renderRegistrationsPerDayChart() {
    try {
        const res = await fetch(`${API_BASE}/students/daily-registrations`, { credentials: "include" });
        const data = await res.json();

        if (!data.success) throw new Error(data.message);

        const regMap = {};
        data.data.forEach(item => {
            regMap[item.reg_date] = Number(item.total_registrations); 
        });

        const allDates = data.data.map(item => new Date(item.reg_date));
        const minDate = new Date(Math.min(...allDates));
        const maxDate = new Date(Math.max(...allDates));


        const labels = [];
        const totals = [];
        for (let dt = new Date(minDate); dt <= maxDate; dt.setDate(dt.getDate() + 1)) {
            const dateStr = dt.toISOString().split('T')[0]; // 'YYYY-MM-DD'
            labels.push(dateStr);
            totals.push(regMap[dateStr] || 0); 
        }

        const ctx = document.getElementById('regPerDayChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'No. of registration',
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
                    legend: { display: false },
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
    renderRegisteredMembersPerCollegeChart();
    renderRegistrationsPerDayChart();
});
