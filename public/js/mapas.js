
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