document.addEventListener("DOMContentLoaded", () => {
  const membersTableBody = document.getElementById("membersTableBody");
  const selectAll = document.getElementById("selectAll");
  const bulkAction = document.getElementById("bulkAction");

  let members = []; // will be filled from API

  // Render members
  function renderTable(data) {
    membersTableBody.innerHTML = "";
    data.forEach(member => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td><input type="checkbox" class="rowCheckbox" data-id="${member.id}"></td>
        <td>${member.msc_id || ""}</td>
        <td>${member.first_name || ""}</td>
        <td>${member.middle_name || ""}</td>
        <td>${member.last_name || ""}</td>
        <td>${member.name_suffix || ""}</td>
        <td>${member.email || ""}</td>
        <td>${member.phone || ""}</td>
        <td>${member.gender || ""}</td>
        <td>${member.role || ""}</td>
        <td>${member.student_no || ""}</td>
        <td>${member.program || ""}</td>
        <td>${member.year_level || ""}</td>
        <td>${member.college || ""}</td>
        <td>${member.section || ""}</td>
        <td>${member.address || ""}</td>
        <td>${member.facebook_link ? `<a href="${member.facebook_link}" target="_blank">Link</a>` : ""}</td>
        <td>
          <button class="editBtn" data-id="${member.id}">Edit</button>
        </td>
      `;
      membersTableBody.appendChild(row);
    });

    // Attach edit button listeners
    document.querySelectorAll(".editBtn").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = btn.dataset.id;
        const member = members.find(m => m.id == id);

        if (member) {
          // Prefill modal form
          document.getElementById("editFirstName").value = member.first_name || "";
          document.getElementById("editMiddleName").value = member.middle_name || "";
          document.getElementById("editLastName").value = member.last_name || "";
          document.getElementById("editEmail").value = member.email || "";
          document.getElementById("editGender").value = member.gender || "";
          document.getElementById("editPosition").value = member.role || "";
          document.getElementById("editStudentNo").value = member.student_no || "";
          document.getElementById("editCollege").value = member.college || "";
          document.getElementById("editProgram").value = member.program || "";
          document.getElementById("editYear").value = member.year_level || "";

          // Show modal
          document.getElementById("editMemberModal").classList.remove("hidden");
        }
      });
    });

    // update filters count
    document.getElementById("filterBtn").innerHTML =
      `<i class="fas fa-filter"></i> Filters (${data.length} Members)`;
  }

  // Fetch from API
  async function loadStudents(page = 1, limit = 20) {
    try {
      const response = await fetch(`/updated-msc-website/api/students?page=${page}&limit=${limit}`, {
        method: "GET",
        headers: { "Content-Type": "application/json" },
        credentials: "include",
      });

      const result = await response.json();
      if (result.success) {
        members = result.data.students;
        renderTable(members);
      } else {
        console.error("Failed to load students:", result.message);
      }
    } catch (error) {
      console.error("API Error:", error);
    }
  }

  // Select all checkboxes
  selectAll.addEventListener("change", () => {
    document.querySelectorAll(".rowCheckbox").forEach(cb => {
      cb.checked = selectAll.checked;
    });
  });

  // Bulk Action
  document.getElementById("applyBtn").addEventListener("click", () => {
    const selected = [...document.querySelectorAll(".rowCheckbox:checked")].map(cb => cb.dataset.id);
    alert(`Applying action: ${bulkAction.value} to IDs: ${selected.join(", ")}`);
  });

  // Sort last name
  let asc = true;
  document.getElementById("sortLastName").addEventListener("click", () => {
    const sorted = [...members].sort((a, b) => {
      if (asc) return (a.last_name || "").localeCompare(b.last_name || "");
      else return (b.last_name || "").localeCompare(a.last_name || "");
    });
    asc = !asc;
    renderTable(sorted);
  });

  // Close modal
  document.getElementById("closeEditModal").addEventListener("click", () => {
    console.log("Close button clicked!");
    document.getElementById("editMemberModal").classList.add("hidden");
  });

  // Load students on page ready
  loadStudents();
});
