// admin_edit_program-course.js
const editrprograms = {
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
  const editCollegeSelect = document.getElementById("editCollege");
  const editProgramSelect = document.getElementById("editProgram");
  const registrationForm = document.getElementById("editMemberForm");
  const editMemberModal = document.getElementById("editMemberModal");

  let editingStudentId = null; // keep track of current editing ID

    // Populate colleges
    Object.keys(editrprograms).forEach(college => {
    const opt = document.createElement("option");
    opt.value = college;
    opt.textContent = college;
    editCollegeSelect.appendChild(opt);
    });

    // Update programs when college changes
    editCollegeSelect.addEventListener("change", () => {
    editProgramSelect.innerHTML = "";
    if (editrprograms[editCollegeSelect.value]) {
        editrprograms[editCollegeSelect.value].forEach(prog => {
        const opt = document.createElement("option");
        opt.value = prog;
        opt.textContent = prog;
        editProgramSelect.appendChild(opt);
        });
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

  // Open modal and prefill data
  window.openEditModal = function(student) {
    editMemberModal.dataset.studentId = student.id;

    // Prefill inputs
    document.getElementById("editUsername").value = student.username || "";
    document.getElementById("editEmail").value = student.email || "";
    document.getElementById("editFirstName").value = student.first_name || "";
    document.getElementById("editMiddleName").value = student.middle_name || "";
    document.getElementById("editLastName").value = student.last_name || "";
    document.getElementById("editSuffix").value = student.name_suffix || "";
    document.getElementById("editBirthdate").value = student.birthdate || "";
    document.getElementById("editGender").value = student.gender || "";
    document.getElementById("editPhone").value = student.phone || "";
    document.getElementById("editStudentNo").value = student.student_no || "";
    document.getElementById("editPassword").value = student.password || "";
    document.getElementById("editConfirmPassword").value = student.password || "";


    // Load college & program properly
    editCollegeSelect.value = student.college || "";
    editCollegeSelect.dispatchEvent(new Event("change")); // trigger program load
    editProgramSelect.value = student.program || "";

    document.getElementById("editYearLevel").value = student.year_level || "";
    document.getElementById("editSection").value = student.section || "";
    document.getElementById("editFacebook").value = student.facebook_link || "";
    document.getElementById("editAddress").value = student.address || "";
    document.getElementById("editIsAdviser").checked = student.is_adviser === 1;

    // Show modal
    document.getElementById("editMemberModal").style.display = "block";
  };

  // Form submission
  registrationForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const studentId = editMemberModal.dataset.studentId;
    if (!studentId) return;

    const newPassword = document.getElementById("editPassword").value;
    const confirmPassword = document.getElementById("editConfirmPassword").value;

    if (newPassword && newPassword !== confirmPassword) {
        alert("Passwords do not match!");
        return;
    }

    const formData = {
        username: document.getElementById("editUsername").value || null,
        email: document.getElementById("editEmail").value || null,
        first_name: document.getElementById("editFirstName").value || null,
        middle_name: document.getElementById("editMiddleName").value || null,
        last_name: document.getElementById("editLastName").value || null,
        name_suffix: document.getElementById("editSuffix").value || null, // <--- important
        birthdate: document.getElementById("editBirthdate").value,
        gender: document.getElementById("editGender").value,
        phone: document.getElementById("editPhone").value,
        student_no: document.getElementById("editStudentNo").value,
        college: editCollegeSelect.value,
        program: editProgramSelect.value,
        year_level: document.getElementById("editYearLevel").value || null,
        section: document.getElementById("editSection").value || null,
        facebook_link: document.getElementById("editFacebook").value || null,
        address: document.getElementById("editAddress").value || null,
        is_adviser: document.getElementById("editIsAdviser").checked,
    };

    if (newPassword) formData.password = newPassword;

    try {
      const result = await apiCall(`/students/profile/${studentId}`, "PUT", formData);
      console.log("Payload being sent:", formData);
      if (result.success) {
        document.getElementById("editMemberModal").style.display = "none";
        document.getElementById("editsuccessModal").style.display = "block";
        registrationForm.reset();

        if (typeof fetchStudents === "function") fetchStudents();
      } else {
        console.log("Failed to update member: " + result.message);
      }
    } catch (err) {
      console.error(err);
      console.log("An error occurred while editing member.");
    }
  });
});

