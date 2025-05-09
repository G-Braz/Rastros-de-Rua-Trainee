function abrirModal(idFundo, idModal){
    document.getElementById(idFundo).style.display="flex";
    document.getElementById(idModal).style.display = "flex";
    setTimeout(() => {
    document.getElementById(idFundo).classList.add('opacidade'); 
    }, 10);
}
function fecharModal(idFundo, idModal){
    document.getElementById(idFundo).classList.remove('opacidade');
    setTimeout(() => {
        document.getElementById(idFundo).style.display = 'none';
        document.getElementById(idModal).style.display = 'none';
    }, 200);
}