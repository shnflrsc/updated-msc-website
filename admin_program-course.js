// addMember.js
const programs = {
  "College of Architecture and Fine Arts": [
    "BS Architecture",
    "B Landscape Architecture",
    "B Fine Arts Major in Visual Communication",
  ],
  "College of Arts and Letters": [
    "BA Broadcasting",
    "BA Journalism",
    "B Performing Arts (Theater Track)",
    "B Sining sa Malikhaing Pagsulat",
  ],
  "College of Business Education and Accountancy": [
    "BS Accountancy",
    "BS Business Administration Major in Business Economics",
    "BS Business Administration Major in Financial Management",
    "BS Business Administration Major in Marketing Management",
    "BS Entrepreneurship",
  ],
  "College of Criminal Justice Education": [
    "BS Criminology",
    "BA Legal Management",
  ],
  "College of Hospitality and Tourism Management": [
    "BS Hospitality Management",
    "BS Tourism Management",
  ],
  "College of Information and Communications Technology": [
    "BS Information Technology",
    "BS Information System",
    "B Library and Information Science",
  ],
  "College of Industrial Technology": [
    "BIT with specialization in Automotive",
    "BIT with specialization in Computer",
    "BIT with specialization in Drafting",
    "BIT with specialization in Electrical",
    "BIT with specialization in Electronics & Communication Technology",
    "BIT with specialization in Electronics Technology",
    "BIT with specialization in Food Processing Technology",
    "BIT with specialization in HVACR",
    "BIT with specialization in Mechanical",
    "BIT with specialization in Mechatronics Technology",
    "BIT with specialization in Welding Technology",
  ],
  "College of Nursing": ["BS Nursing"],
  "College of Engineering": [
    "BS Civil Engineering",
    "BS Computer Engineering",
    "BS Electrical Engineering",
    "BS Electronics Engineering",
    "BS Industrial Engineering",
    "BS Manufacturing Engineering",
    "BS Mechanical Engineering",
    "BS Mechatronics Engineering",
  ],
  "College of Education": [
    "B Early Childhood Education",
    "B Elementary Education",
    "B Physical Education",
    "BSEd Major in English Minor in Mandarin",
    "BSEd in Filipino",
    "BSEd in Mathematics",
    "BSEd in Sciences",
    "BSEd in Social Studies",
    "BSEd in Values Education",
    "BTLEd Major in Home Economics",
    "BTLEd Major in Industrial Arts",
    "BTLEd Major in ICT",
  ],
  "College of Science": [
    "BS Biology",
    "BS Environmental Science",
    "BS Food Technology",
    "BS Math (Applied Statistics)",
    "BS Math (Business Applications)",
    "BS Math (Computer Science)",
  ],
  "College of Sports, Exercise and Recreation": [
    "BS ESS (Fitness & Sports Coaching)",
    "BS ESS (Fitness & Sports Management)",
  ],
  "College of Social Sciences and Philosophy": [
    "B Public Administration",
    "BS Psychology",
    "BS Social Work",
  ],
};

document.addEventListener("DOMContentLoaded", () => {
  const collegeSelect = document.getElementById("regCollege");
  const programSelect = document.getElementById("regProgram");
  const registrationForm = document.getElementById("registrationForm");

  // Populate colleges
  Object.keys(programs).forEach(college => {
    const opt = document.createElement("option");
    opt.value = college;
    opt.textContent = college;
    collegeSelect.appendChild(opt);
  });

  // Update programs when college changes
  collegeSelect.addEventListener("change", () => {
    programSelect.innerHTML = "";
    if (collegeSelect.value && programs[collegeSelect.value]) {
      programs[collegeSelect.value].forEach(prog => {
        const opt = document.createElement("option");
        opt.value = prog;
        opt.textContent = prog;
        programSelect.appendChild(opt);
      });
    } else {
      const opt = document.createElement("option");
      opt.textContent = "Select a College first";
      programSelect.appendChild(opt);
    }
  });

  // API helper
  const API_BASE = "/updated-msc-website/api";
  async function apiCall(endpoint, method = "GET", data = null) {
    const options = { method, headers: { "Content-Type": "application/json" } };
    if (data) options.body = JSON.stringify(data);
    const res = await fetch(`${API_BASE}${endpoint}`, options);
    return res.json();
  }

  // Form submission
  registrationForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = {
      username: document.getElementById("username").value,
      email: document.getElementById("email").value,
      password: document.getElementById("regPassword").value,
      first_name: document.getElementById("firstName").value,
      middle_name: document.getElementById("middleName").value,
      last_name: document.getElementById("lastName").value,
      name_suffix: document.getElementById("suffix").value,
      birthdate: document.getElementById("birthdate").value,
      gender: document.getElementById("gender").value,
      phone: document.getElementById("phone").value,
      student_no: document.getElementById("studentNo").value,
      college: collegeSelect.value,
      program: programSelect.value,
      year_level: document.getElementById("yearLevel").value,
      section: document.getElementById("section").value,
      facebook_link: document.getElementById("facebook").value,
      address: document.getElementById("address").value,
      is_adviser: document.getElementById("isAdviser").checked,
    };

    // Password match check
    const confirmPwd = document.getElementById("confirmPassword").value;
    if (formData.password !== confirmPwd) {
      alert("Passwords do not match!");
      return;
    }

    try {
      const result = await apiCall("/students/create", "POST", formData);

      if (result.success) {
        // ✅ SUCCESS HANDLING
        document.getElementById("addMemberModal").style.display = "none";
        document.getElementById("successModal").style.display = "block";
        registrationForm.reset();

        // Refresh table if function exists
        if (typeof fetchStudents === "function") fetchStudents();
      } else {
        console.log("Failed to add member: " + result.message);
      }
    } catch (err) {
      console.error(err);
      console.log("An error occurred while adding member.");
    }
  });
});
