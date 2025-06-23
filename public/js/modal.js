

function abrirModal(idFundo, idModal, postID = null){ 

  if (!idFundo || !idModal) {
      console.error('Elementos do modal não encontrados! IDs:', idFundo, idModal);
      return; 
  }
  else{
    document.getElementById(idFundo).style.display="flex";
    document.getElementById(idModal).style.display = "flex";
  }
  //funcao para redimensionar o mapa apos a abertura de modais
  setTimeout(() => {
    if(idFundo==="idModalMapa"){
      inicializarMapaModal();   
      if(mapaModal) {
          mapaModal.invalidateSize();
          console.log("Mapa redimensionado para o modal:", idModal);
      }
    }
    else if(idFundo==="idMapaPost"){
      inicializarMapaPost();
      if(mapaPost) {
        mapaPost.invalidateSize();
        console.log("Mapa redimensionado para o post:", idModal);
      }
    }
  }, 20);

  if(idModal.startsWith('idModalEditar') || idModal.startsWith('idModalVisualizar')) {
    setTimeout(() => {
      ajustarTextAreasInicialmente();
    }, 20);
  }

  setTimeout(() => {
    document.getElementById(idFundo).classList.add('opacidade'); 
  }, 10);
}
function fecharModal(idFundo, idModal){ // Fecha o modal
    document.getElementById(idFundo).classList.remove('opacidade');
    setTimeout(() => {
        document.getElementById(idFundo).style.display = 'none';
        document.getElementById(idModal).style.display = 'none';
    }, 200);
}
function salvarModalMapa(idFundo, idModal){ // Fecha o modal
  document.getElementById(idFundo).classList.remove('opacidade');
  setTimeout(() => {
      document.getElementById(idFundo).style.display = 'none';
      document.getElementById(idModal).style.display = 'none';
  }, 200);

    // Altera o texto do botão de seleção de localização
    var btnLocalizacao = document.querySelector('.btn-mapa-modal-criar');
    if (btnLocalizacao) {
        // Substitui o ícone e o texto
        btnLocalizacao.innerHTML = '<i class="icone-geo-mapa bi bi-check-circle-fill"></i> Localização selecionada';
    }
}
function autoResize(el) { // função para ajustar o tamanho
  el.style.height = 'auto';
  el.style.height = (el.scrollHeight) + 'px';
}

function ajustarTextAreasInicialmente() {
  // Seleciona todos os textareas visíveis no modal aberto
  document.querySelectorAll('.visualizar[style*="display: flex"] textarea, .editar[style*="display: flex"] textarea').forEach(textarea => {
    autoResize(textarea);
    textarea.addEventListener('input', () => autoResize(textarea));
  });
}