let clickCount = 0;
const icon = document.getElementById('mascote-secreto');

if (icon) {
    icon.addEventListener('click', function () {
        clickCount++;
        if (clickCount === 5) {
            document.getElementById('id-pagina-secreta').style.display = 'block';
            tela.style.display = "block";
            
            window.scrollTo({
                top: (document.body.scrollHeight - window.innerHeight) / 2,
                behavior: 'smooth'
            });
        }
        // Opcional: reseta o contador após 5 cliques
        setTimeout(() => { clickCount = 0; }, 2000); // reseta após 2 segundos sem clicar
    });
}