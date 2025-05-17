let mapaModal;
let mapaPost;
let marcadorModal;
let marcadorPost;

// -------- Mapa da Página de Post Individual --------

// Função que centraliza o mapa no marcador, facilitando a visualização
function centralizarMapaNoMarcador(marcador, mapa) {
        const coords = marcador.getLatLng();
        mapa.setView(coords, mapa.getZoom());
}

// Função para atualizar as coordenadas do marcador do mapa da página de post
function atualizaMapaPost(lat, long) {
        marcadorPost.setLatLng([lat, long]);
        centralizarMapaNoMarcador(marcadorPost, mapaPost);
}

// -------- Mapa dos Modais de Posts --------

// Função que atualiza o marcador do mapa do modal ao clicar no mapa
function atualizaMarcadorPorClique(evento) {
        const latitude = evento.latlng.lat;
        const longitude = evento.latlng.lng;

        // Move o marcador para a nova posição clicada
        marcadorModal.setLatLng([latitude, longitude]);

        // Atualiza o marcador do mapa da página de post
        atualizaMapaPost(latitude, longitude);
}

// Função que atualiza o marcador ao ser arrastado
function atualizaMarcadorArrastando(evento) {
        const posicao = evento.target.getLatLng();

        // Atualiza o marcador do mapa da página de post
        atualizaMapaPost(posicao.lat, posicao.lng);
}

document.addEventListener("DOMContentLoaded", function () {
const juizDeForaCoords = [-21.7645, -43.3495];

const iconeMarcador = L.icon({
        iconUrl: "../../../public/assets/marcador-mapa.svg",
        iconSize: [40, 40],       // Tamanho do ícone [largura, altura]
        iconAnchor: [20, 40],     // Ponto de ancoragem do ícone no mapa
        popupAnchor: [0, -40]     // Ponto onde o popup abrirá em relação ao ícone
});

// Cria os mapas e define a visão inicial
        mapaModal = L.map('map').setView(juizDeForaCoords, 15);
        mapaPost = L.map('map2').setView(juizDeForaCoords, 15);

        // Adiciona as camadas de mapa base (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapaModal);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapaPost);

        // Adiciona os marcadores iniciais
        marcadorModal = L.marker(juizDeForaCoords, { draggable: true, icon: iconeMarcador }).addTo(mapaModal);
        marcadorPost = L.marker(juizDeForaCoords, { icon: iconeMarcador }).addTo(mapaPost);

        // Registra os eventos:
        // Clique no mapa do modal para mover o marcador
        mapaModal.on('click', atualizaMarcadorPorClique);

        // Arraste do marcador no modal para atualizar a posição
        marcadorModal.on('drag', atualizaMarcadorArrastando);
});
