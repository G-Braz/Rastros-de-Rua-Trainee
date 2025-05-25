function apagarTexto(idInput){
    document.getElementById(idInput).value="";
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