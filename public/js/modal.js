function abrirModal(idFundo, idModal){
    document.getElementById(idFundo).style.display="flex";
    document.getElementById(idModal).style.display = "block";
}
function fecharModal(idFundo, idModal){
    document.getElementById(idFundo).style.display = 'none';
    document.getElementById(idModal).style.display = 'none';
}