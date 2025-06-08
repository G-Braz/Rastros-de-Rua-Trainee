//funcionamento do hamburguer
function clickMenu() {
    //caso ja esteja sendo mostrado, esconde
    if(links.style.display === 'flex') {
        links.style.display = 'none';
    } else { // caso esteja escondido, mostra
        links.style.display = 'flex';
    }
}