
    // script dos mapas

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
        console.log(lat, long);
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
    let lat = evento.latlng.lat;
    let lng = evento.latlng.lng;

    let inputLat = document.getElementById('latitudeEditar' + postIdAberto) || document.getElementById('latitude');
    let inputLng = document.getElementById('longitudeEditar' + postIdAberto) || document.getElementById('longitude');

    inputLat.value = lat;
    inputLng.value = lng;

    marcadorModal.setLatLng([lat, lng]);
    atualizaMapaPost(lat, lng);
}

function atualizaMarcadorArrastando(evento) {
    let lat = evento.latlng.lat;
    let lng = evento.latlng.lng;

    let inputLat = document.getElementById('latitudeEditar' + postIdAberto) || document.getElementById('latitude');
    let inputLng = document.getElementById('longitudeEditar' + postIdAberto) || document.getElementById('longitude');

    inputLat.value = lat;
    inputLng.value = lng;

    marcadorModal.setLatLng([lat, lng]);
    atualizaMapaPost(lat, lng);
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
function atualizaMapaModal(lat, long) {
    if (mapaModal && marcadorModal) {
        marcadorModal.setLatLng([lat, long]);
        mapaModal.setView([lat, long], mapaModal.getZoom());
    }
}
let postIdAberto = null;

function abrirModalMapaEditar(id, lat, lng) {
    postIdAberto = id;
    abrirModal('idModalMapa','idConteudoMapaM');
    setTimeout(() => atualizaMapaModal(lat, lng), 50);
}