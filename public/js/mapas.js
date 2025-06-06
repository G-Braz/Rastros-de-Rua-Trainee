// script dos mapas

// -----Código compartilhado entre os dois mapas-----

let mapaModal, mapaPost, marcadorModal, marcadorPost;
const juizDeForaCoords = [-21.7645, -43.3495]; // Coordenadas de Juiz de Fora

const iconeMarcador = L.icon({
    iconUrl: "../../../public/assets/marcador-mapa.svg", // Caminho para o seu ícone
    iconSize: [40, 40], // Tamanho do ícone
    iconAnchor: [20, 40], // Ponto do ícone que corresponderá à localização do marcador
    popupAnchor: [0, -40] // Ponto a partir do qual o popup deve abrir em relação ao iconAnchor
});


function buscarNomeDoLocalViaNominatim(latitude, longitude, callback) {

    const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}&addressdetails=1`;

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Falha na requisição ao Nominatim: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data && data.address && data.address.road) {
                callback(null, data.address.road, data); 
            } else if (data && data.display_name) {
                
                callback(null, data.display_name, data); 
            } else if (data && data.error) {
                callback('Erro do Nominatim: ' + data.error, null, data);
            } 
            else {
                callback('Nome da rua não encontrado ou resposta inesperada.', null, data);
            }
        })
        .catch(error => {
            console.error('Erro detalhado ao buscar o nome do local:', error);
            callback('Erro ao conectar com o serviço de geocodificação.', null, null);
        });
}


// Funções compartilhadas
function centralizarMapaNoMarcador(marcador, mapa) {
    if (marcador && mapa) {
        const coords = marcador.getLatLng();
        mapa.setView(coords, mapa.getZoom());
    }
}

function atualizaMapaPost(lat, long) {
    console.log("Atualizando mapa do post para:", lat, long);
    if (mapaPost && marcadorPost) { // Garante que o mapa e o marcador do post existam
        marcadorPost.setLatLng([lat, long]);
        centralizarMapaNoMarcador(marcadorPost, mapaPost);

        buscarNomeDoLocalViaNominatim(lat, long, (erro, nomeRua, dadosCompletos) => {
            const popup = erro ? "Não foi possível obter o nome do local." : nomeRua;
            if (erro) {
                console.error("Erro ao buscar nome para o post:", erro);
            } else {
                console.log("Nome da rua/local (Post):", nomeRua);
            }
            if (marcadorPost.getPopup()) {
                marcadorPost.setPopupContent(popup);
            } else {
                marcadorPost.bindPopup(popup).openPopup();
            }
        });
    }
}

// -----Código para mapa do post individual-----

function inicializarMapaPost() {
    if (!mapaPost && document.getElementById('map2')) {
        mapaPost = L.map('map2', {
            dragging: false,
            touchZoom: false,
            scrollWheelZoom: false,
            doubleClickZoom: false,
            boxZoom: false,
            keyboard: false,
            zoomControl: true 
        }).setView(juizDeForaCoords, 18); 

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapaPost);
        marcadorPost = L.marker(juizDeForaCoords, { icon: iconeMarcador }).addTo(mapaPost);
    }
}


// -----Código para o mapa do Modal de Edição/Criação-----
function atualizaCamposFormularioComLocal(lat, lng, nomeDaRuaOuDisplayName, erro, dadosCompletosNominatim) {
    const idSufixo = postIdAberto ? 'Editar' + postIdAberto : '';
    const inputLat = document.getElementById('latitude' + idSufixo);
    const inputLng = document.getElementById('longitude' + idSufixo);
    
    // ** LÓGICA ATUALIZADA PARA SELECIONAR O INPUT DE LOCAL CORRETO **
    let nomeLocalInputElement;
    if (postIdAberto) { // Estamos no modo de edição
        nomeLocalInputElement = document.getElementById('nomeDoLocalInputEditar' + postIdAberto);
    } else { // Estamos no modo de criação
        nomeLocalInputElement = document.getElementById('nomeDoLocalInput');
    }
    // ***************************************************************

    if (inputLat) inputLat.value = lat !== null ? lat.toFixed(6) : '';
    if (inputLng) inputLng.value = lng !== null ? lng.toFixed(6) : '';

    const valorParaInputLocal = dadosCompletosNominatim && dadosCompletosNominatim.address && dadosCompletosNominatim.address.road 
                                ? dadosCompletosNominatim.address.road 
                                : nomeDaRuaOuDisplayName;

    if (nomeLocalInputElement) {
        if (erro) {
            nomeLocalInputElement.value = ''; 
            console.error("Erro ao obter nome do local:", erro);
        } else if (valorParaInputLocal) { 
            nomeLocalInputElement.value = valorParaInputLocal;
            console.log("Nome do local (rua ou display_name) atualizado no input:", valorParaInputLocal);
        } else {
            nomeLocalInputElement.value = ''; 
        }
    }
    
    // ATUALIZA O TEXTO DO BOTÃO NO MODAL DE EDIÇÃO
    if (postIdAberto) {
        const botaoLocal = document.querySelector(`#idModalEditar${postIdAberto} .inputLocalEditar`);
        if (botaoLocal) {
            const icone = botaoLocal.querySelector('i.bi-geo-alt-fill');
            const novoTexto = erro ? "Local não encontrado" : (valorParaInputLocal || "Selecionar localização");
            botaoLocal.innerHTML = ''; // Limpa o botão
            if(icone) botaoLocal.appendChild(icone); // Adiciona o ícone de volta
            botaoLocal.appendChild(document.createTextNode(' ' + novoTexto)); // Adiciona o novo texto
        }
    }

    if (marcadorModal) {
        const popupContent = erro ? "Não foi possível obter o nome do local." : nomeDaRuaOuDisplayName || "Local selecionado";
        if (marcadorModal.getPopup()) {
            marcadorModal.setPopupContent(popupContent).openPopup();
        } else {
            marcadorModal.bindPopup(popupContent).openPopup();
        }
    }
}

function atualizaMarcadorPorClique(evento) {
    let lat = evento.latlng.lat;
    let lng = evento.latlng.lng;

    if (marcadorModal) {
        marcadorModal.setLatLng([lat, lng]);
    }
    
    buscarNomeDoLocalViaNominatim(lat, lng, (erro, nomeDaRuaOuDisplayName, dadosCompletos) => {
        atualizaCamposFormularioComLocal(lat, lng, nomeDaRuaOuDisplayName, erro, dadosCompletos);
    });
}

function atualizaMarcadorArrastando(evento) {
    let lat = evento.target.getLatLng().lat; 
    let lng = evento.target.getLatLng().lng;
    
    buscarNomeDoLocalViaNominatim(lat, lng, (erro, nomeDaRuaOuDisplayName, dadosCompletos) => {
        atualizaCamposFormularioComLocal(lat, lng, nomeDaRuaOuDisplayName, erro, dadosCompletos);
    });
}


function inicializarMapaModal() {
    if (!mapaModal && document.getElementById('map')) {
        mapaModal = L.map('map').setView(juizDeForaCoords, 15); 

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapaModal);

        marcadorModal = L.marker(juizDeForaCoords, {
            draggable: true, 
            icon: iconeMarcador
        }).addTo(mapaModal);

        mapaModal.on('click', atualizaMarcadorPorClique);
        marcadorModal.on('dragend', atualizaMarcadorArrastando); 
    }
}

function atualizaMapaModal(lat, long) {
    if (mapaModal && marcadorModal) {
        const novaPosicao = [parseFloat(lat) || juizDeForaCoords[0], parseFloat(long) || juizDeForaCoords[1]];
        marcadorModal.setLatLng(novaPosicao);
        mapaModal.setView(novaPosicao, mapaModal.getZoom()); 

        buscarNomeDoLocalViaNominatim(novaPosicao[0], novaPosicao[1], (erro, nomeDaRuaOuDisplayName, dadosCompletos) => {
            atualizaCamposFormularioComLocal(novaPosicao[0], novaPosicao[1], nomeDaRuaOuDisplayName, erro, dadosCompletos);
        });
    }
}

let postIdAberto = null; 

function abrirModalMapaEditar(id, lat, lng) {
    postIdAberto = id; 
    abrirModal('idModalMapa', 'idConteudoMapaM'); 

    setTimeout(() => {
        if (!mapaModal) { 
            inicializarMapaModal();
        }
        if (mapaModal) {
            mapaModal.invalidateSize();
        }
        const latVal = parseFloat(lat) || juizDeForaCoords[0];
        const lngVal = parseFloat(lng) || juizDeForaCoords[1];
        atualizaMapaModal(latVal, lngVal); 
    }, 150); 
}

document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('map2')) { 
        inicializarMapaPost();
    }
});
