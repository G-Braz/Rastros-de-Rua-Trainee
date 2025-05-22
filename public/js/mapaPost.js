document.addEventListener("DOMContentLoaded", function () {
        // Inicializa apenas o mapa do post
        mapaPost = L.map('map2',{dragging:false}).setView(juizDeForaCoords, 18);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapaPost);

        // Adiciona marcador apenas no mapa do post
        marcadorPost = L.marker(juizDeForaCoords, { icon: iconeMarcador }).addTo(mapaPost);
});