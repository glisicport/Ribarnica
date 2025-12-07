
const searchInput = document.getElementById("employee-search");
const positionSelect = document.getElementById("employee-position");
const cards = document.querySelectorAll(".card");

function filterEmployees() {
    let nameValue = searchInput.value.toLowerCase();
    let posValue = positionSelect.value.toLowerCase();

    cards.forEach(card => {
        let matchName = card.dataset.name.includes(nameValue);
        let matchPos = posValue === "" || card.dataset.position === posValue;

        card.style.display = (matchName && matchPos) ? "block" : "none";
    });
}

searchInput.addEventListener("input", filterEmployees);
positionSelect.addEventListener("change", filterEmployees);


function openEmployeeModal() {
    document.getElementById("employeeModal").classList.remove("modal-hidden");
}

function closeEmployeeModal() {
    document.getElementById("employeeModal").classList.add("modal-hidden");
}


function editEmployee(emp) {

    document.getElementById("employeeModalTitle").innerText = "Izmeni zaposlenog";

    document.getElementById("employeeMethod").value = "PUT";

    const form = document.getElementById("employeeForm");
    form.action = `/admin/employees/${emp.id}`;

    document.getElementById("employeeId").value = emp.id;
    document.getElementById("empName").value = emp.name;
    document.getElementById("empLastName").value = emp.last_name;
    document.getElementById("empPosition").value = emp.position;
    document.getElementById("empBio").value = emp.bio ?? "";

    openEmployeeModal();
}


function openEmployeeModalNew() {

    const form = document.getElementById("employeeForm");

    form.reset();
    form.action = "/admin/employees";

    document.getElementById("employeeId").value = "";
    document.getElementById("employeeMethod").value = "POST";
    document.getElementById("employeeModalTitle").innerText = "Novi Zaposleni";

    openEmployeeModal();
}
