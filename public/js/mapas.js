
// -----Código compartilhado entre os dois mapas-----

let mapaModal, mapaPost, marcadorModal, marcadorPost;
const juizDeForaCoords = [-21.7645, -43.3495];

const iconeMarcador = L.icon({
        iconUrl: "../../../public/assets/marcador-mapa.svg",
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -40]
        });

        // Funções compartilhadas
function centralizarMapaNoMarcador(marcador, mapa) {
        const coords = marcador.getLatLng();
        mapa.setView(coords, mapa.getZoom());
        }

function atualizaMapaPost(lat, long) {
        if(marcadorPost) {
                marcadorPost.setLatLng([lat, long]);
                centralizarMapaNoMarcador(marcadorPost, mapaPost);
        }
}

// -----Código para mapa do post individual-----

function inicializarMapaPost() {
        // Só inicializa se não existir
        if (!mapaPost) {
                mapaPost = L.map('map2',{
                        dragging: false,          
                        touchZoom: false,         
                        scrollWheelZoom: false,   
                        doubleClickZoom: false,   
                        boxZoom: false,           
                        keyboard: false,          
                        zoomControl: true
                }).setView(juizDeForaCoords, 18);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapaPost);
        
                // Adiciona marcador apenas no mapa do post
                marcadorPost = L.marker(juizDeForaCoords, { icon: iconeMarcador }).addTo(mapaPost);
        }
}

// -----Código para o mapa do Modal-----
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


function inicializarMapaModal() {
        // Só inicializa se não existir
        if (!mapaModal) {
                mapaModal = L.map('map').setView(juizDeForaCoords, 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapaModal);

                marcadorModal = L.marker(juizDeForaCoords, { 
                draggable: true, 
                icon: iconeMarcador 
                }).addTo(mapaModal);

                mapaModal.on('click', atualizaMarcadorPorClique);
                marcadorModal.on('drag', atualizaMarcadorArrastando);
        }
}