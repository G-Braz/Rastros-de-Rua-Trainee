// -----Código para o mapa do Modal de publicação-----
function atualizaMarcadorPorClique(evento) {
        const latitude = evento.latlng.lat;
        const longitude = evento.latlng.lng;

        marcadorModal.setLatLng([latitude, longitude]);
        atualizaMapaPost(latitude, longitude);
}

function atualizaMarcadorArrastando(evento) {
        const posicao = evento.target.getLatLng();
        atualizaMapaPost(posicao.lat, posicao.lng);
}

document.addEventListener("DOMContentLoaded", function () {
        // Inicializa apenas o mapa modal
        mapaModal = L.map('map').setView(juizDeForaCoords, 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapaModal);

        // Adiciona marcador apenas no mapa modal
        marcadorModal = L.marker(juizDeForaCoords, { 
                draggable: true, 
                icon: iconeMarcador 
        }).addTo(mapaModal);

        // Registra eventos específicos do modal
        mapaModal.on('click', atualizaMarcadorPorClique);
        marcadorModal.on('drag', atualizaMarcadorArrastando);
});