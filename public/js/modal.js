function abrirModal(idFundo, idModal){ // Abre o modal
    document.getElementById(idFundo).style.display="flex";
    document.getElementById(idModal).style.display = "flex";
    setTimeout(() => {
    document.getElementById(idFundo).classList.add('opacidade'); 
    }, 10);

    if(idModal==='idModalEditar' || idModal==='idModalVisualizar'){ //ajusta o tamanho dos campos descrição e materiais ao abrir o modal editar
    setTimeout(() => {
            console.log("Tentando ajustar textareas para o modal:", idModal); // Para depuração
            ajustarTextAreasInicialmente();
    }, 2);
    }
}
function fecharModal(idFundo, idModal){ // Fecha o modal
    document.getElementById(idFundo).classList.remove('opacidade');
    setTimeout(() => {
        document.getElementById(idFundo).style.display = 'none';
        document.getElementById(idModal).style.display = 'none';
    }, 200);
}
function autoResize(el) { // função para ajustar o tamanho
  el.style.height = 'auto';
  el.style.height = (el.scrollHeight) + 'px';
}

function ajustarTextAreasInicialmente() { // executa o reajuste de tamanho
  const textAreas = [
    document.getElementById('textAreaDescricao'),
    document.getElementById('textAreaMateriais'),
    document.getElementById('textAreaDescricaoEditar'),
    document.getElementById('textAreaMateriaisEditar')
  ];
  
  textAreas.forEach(textarea => {
    if (textarea) {
      // Ajusta inicialmente
      autoResize(textarea);
      
      // Futuras alterações
      textarea.addEventListener('input', () => autoResize(textarea));
    }
  });
}
