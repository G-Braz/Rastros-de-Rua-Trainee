function apagarTexto(idInput){
    document.getElementById(idInput).value="";
    pesquisarPostsTitulo();
}
const tela = document.querySelector('#tela');

function abrirFiltro(idFiltro){
    document.getElementById(idFiltro).style.display="flex";
    tela.style.display="block";
    
}
function fecharFiltro(idFiltro){
    document.getElementById(idFiltro).style.display="none";
    tela.style.display="none";
}

function pesquisarPostsTitulo(page = 1) {
    const inputPesquisa = document.getElementById('idInputPesquisa');
    const filtro = inputPesquisa.value;

    fetch(`/listaPosts/buscaPorTitulo?termo=${encodeURIComponent(filtro)}&paginacaoNumero=${page}`)
        .then(response => response.json())
        .then(data => {
            document.querySelector('.listaDePosts').innerHTML = data.html;
            atualizarPaginacao(data.total_pages, data.page, filtro);
        });
}

function pesquisarPostsTipo(tipo, page = 1) {
    console.log("entrou");
    fetch(`/listaPosts/buscaPorTipo?tipo=${encodeURIComponent(tipo)}&paginacaoNumero=${page}`)
        .then(response => response.json())
        .then(data => {
            document.querySelector('.listaDePosts').innerHTML = data.html;
            atualizarPaginacaoFiltro(data.total_pages, data.page, tipo);
        });
}


function atualizarPaginacao(totalPages, currentPage, termo) {
    let paginacaoHtml = '';

    paginacaoHtml += `<a class="skip page-item${currentPage <= 1 ? "-disabled" : ""}" href="#" onclick="pesquisarPostsTitulo(${currentPage - 1}, '${termo}');return false;"><i class="bi bi-chevron-left"></i></a>`;

    // Range de páginas (igual ao PHP)
    const range = 1;
    let showPages = [];

    showPages.push(1);
    for (let i = currentPage - range; i <= currentPage + range; i++) {
        if (i > 1 && i < totalPages) {
            showPages.push(i);
        }
    }
    if (totalPages > 1) {
        showPages.push(totalPages);
    }

    // Remove duplicados e ordena
    showPages = [...new Set(showPages)].sort((a, b) => a - b);

    let prev = 0;
    showPages.forEach(pageNumber => {
        if (prev && pageNumber > prev + 1) {
            // Se quiser, pode adicionar "..." aqui para indicar páginas puladas
            // paginacaoHtml += `<span class="ellipsis">...</span>`;
        }
        paginacaoHtml += `<a class="paginas${pageNumber === currentPage ? " active" : ""}" href="#" onclick="pesquisarPostsTitulo(${pageNumber}, '${termo}');return false;">${pageNumber}</a>`;
        prev = pageNumber;
    });

    paginacaoHtml += `<a class="skip page-item${currentPage >= totalPages ? "-disabled" : ""}" href="#" onclick="pesquisarPostsTitulo(${currentPage + 1}, '${termo}');return false;"><i class="bi bi-chevron-right"></i></a>`;

    document.querySelector('.paginacao').innerHTML = paginacaoHtml;
}

function atualizarPaginacaoFiltro(totalPages, currentPage, tipo) {
    let paginacaoHtml = '';

    paginacaoHtml += `<a class="skip page-item${currentPage <= 1 ? "-disabled" : ""}" href="#" onclick="pesquisarPostsTipo('${tipo}', ${currentPage - 1});return false;"><i class="bi bi-chevron-left"></i></a>`;

    for (let i = 1; i <= totalPages; i++) {
        paginacaoHtml += `<a class="paginas${i === currentPage ? " active" : ""}" href="#" onclick="pesquisarPostsTipo('${tipo}', ${i});return false;">${i}</a>`;
    }

    paginacaoHtml += `<a class="skip page-item${currentPage >= totalPages ? "-disabled" : ""}" href="#" onclick="pesquisarPostsTipo('${tipo}', ${currentPage + 1});return false;"><i class="bi bi-chevron-right"></i></a>`;

    document.querySelector('.paginacao').innerHTML = paginacaoHtml;
}