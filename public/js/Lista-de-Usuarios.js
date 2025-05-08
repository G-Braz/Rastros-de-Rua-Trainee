// Pagination logic for a table displaying users
document.addEventListener("DOMContentLoaded", () => {
    const rowsPerPage = 5; // Number of rows per page
    const maxPageNumbers = 4; // Number of page numbers to display
    const tableBody = document.querySelector("#userTable tbody");
    const paginationContainer = document.querySelector("#pagination");

    let currentPage = 1;
    let totalRows = tableBody.rows.length;
    let totalPages = Math.ceil(totalRows / rowsPerPage);

    function renderTable() {
        // Hide all rows
        Array.from(tableBody.rows).forEach((row, index) => {
            row.style.display = "none";
        });

        // Show rows for the current page
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        Array.from(tableBody.rows).slice(start, end).forEach(row => {
            row.style.display = "";
        });
    }

    function renderPagination() {
        paginationContainer.innerHTML = "";

        // Add "Previous" button
        const prevButton = document.querySelector("#prevButton");
        if (prevButton) {
            prevButton.disabled = currentPage === 1;
            prevButton.addEventListener("click", () => {
                currentPage = Math.max(1, currentPage - 1);
                updateTableAndPagination();
            });
        }

        // Add page numbers dynamically
        const pageNumbersContainer = document.querySelector("#pageNumbers");
        if (pageNumbersContainer) {
            pageNumbersContainer.innerHTML = "";
            const startPage = Math.max(1, currentPage - Math.floor(maxPageNumbers / 2));
            const endPage = Math.min(totalPages, startPage + maxPageNumbers - 1);

            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement("button");
                pageButton.textContent = i;
                pageButton.className = i === currentPage ? "active" : "";
                pageButton.addEventListener("click", () => {
                    currentPage = i;
                    updateTableAndPagination();
                });
                pageNumbersContainer.appendChild(pageButton);
            }
        }

        // Add "Next" button
        const nextButton = document.querySelector("#nextButton");
        if (nextButton) {
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener("click", () => {
                currentPage = Math.min(totalPages, currentPage + 1);
                updateTableAndPagination();
            });
        }
    }

    function updateTableAndPagination() {
        renderTable();
        renderPagination();
    }

    // Initialize table and pagination
    updateTableAndPagination();
});

// Abrir e Fechar Modal 
const tela = document.querySelector('#tela');

function abrirModal(idModal){
    document.getElementById(idModal).style.display="flex";
    tela.style.display = "block";
}

function fecharModal(idModal){
    document.getElementById(idModal).style.display="none";
    tela.style.display = "none";
}