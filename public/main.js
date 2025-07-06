document.addEventListener("DOMContentLoaded", () => {
  const table = document.querySelector("#studentTable tbody");
  const rows = Array.from(table.querySelectorAll("tr"));
  const rowsPerPage = 5;
  const pagination = document.createElement("div");
  pagination.className = "pagination";
  table.parentNode.appendChild(pagination);

  function showPage(page) {
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    rows.forEach((row, index) => {
      row.style.display = index >= start && index < end ? "" : "none";
    });

    pagination.innerHTML = "";
    const totalPages = Math.ceil(rows.length / rowsPerPage);
    for (let i = 1; i <= totalPages; i++) {
      const btn = document.createElement("button");
      btn.textContent = i;
      btn.className = i === page ? "active" : "";
      btn.addEventListener("click", () => showPage(i));
      pagination.appendChild(btn);
    }
  }

  showPage(1);

  const searchInput = document.querySelector("#searchInput");
  searchInput.addEventListener("input", () => {
    const keyword = searchInput.value.toLowerCase();

    if (keyword) {
      rows.forEach((row) => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? "" : "none";
      });
      pagination.style.display = "none";
    } else {
      rows.forEach((row) => (row.style.display = ""));
      pagination.style.display = "block";
      showPage(1); 
    }
  });


  const modal = document.getElementById("detailModal");
  const modalBody = document.getElementById("modalBody");
  const closeBtn = modal.querySelector(".close");

  document.querySelectorAll(".details").forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      e.preventDefault();
      const id = btn.dataset.id;
      modal.classList.remove("hidden");
      modalBody.innerHTML = "Đang tải...";

      try {
        const res = await fetch(`details.php?id=${id}`);
        const html = await res.text();
        modalBody.innerHTML = html;
      } catch (err) {
        modalBody.innerHTML = "Lỗi tải dữ liệu.";
      }
    });
  });

  closeBtn.addEventListener("click", () => modal.classList.add("hidden"));
});
