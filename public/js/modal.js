function abrirModal(idFundo, idModal){ // Abre o modal
    document.getElementById(idFundo).style.display="flex";
    document.getElementById(idModal).style.display = "flex";
    setTimeout(() => {
    document.getElementById(idFundo).classList.add('opacidade'); 
    }, 10);

    if(idModal==='modalEditar' || idModal==='modalVisualizar'){ //ajusta o tamanho dos campos descrição e materiais ao abrir o modal editar
      ajustarTextAreasInicialmente();
    }
}
function fecharModal(idFundo, idModal){ // Fecha o modal
    document.getElementById(idFundo).classList.remove('opacidade');
    setTimeout(() => {
        document.getElementById(idFundo).style.display = 'none';
        document.getElementById(idModal).style.display = 'none';
    }, 200);
}
function salvarAlteracoes() {
    // Valores inseridos no input
    const titulo = document.getElementById('tituloPublicacaoEditar').value;
    const autor = document.getElementById('inputAutor').value;
    const data = document.getElementById('inputData').value;
    const local= document.getElementById('inputLocal').value;
    const descricao = document.getElementById('inputDescricao').value;
    const arte = document.getElementById('previewArte').src;
    const tag = document.getElementById('previewTag').src;

    // Atualiza para os novos valores inseridos
    document.getElementById('tituloPublicacaoEditar').textContent = titulo;
    document.getElementById('inputAutor').textContent = autor;
    document.getElementById('inputData').textContent = data;
    document.getElementById('inputLocal').textContent = local;
    document.getElementById('inputDescricao').textContent = descricao;
    document.getElementById('previewArte').src = arte;
    document.getElementById('previewTag').src=tag;

    alert('Alterações salvas com sucesso!'); // Mensagem de sucesso

    fecharModal('fundoEditar','modalEditar'); // Fecha o modal
}

function autoResize(el) { // função para ajustar o tamanho
  el.style.height = 'auto';
  el.style.height = (el.scrollHeight) + 'px';
}

function ajustarTextAreasInicialmente() { // executa o reajuste de tamanho
  const textAreas = [
    document.getElementById('textAreaDescricao'),
    document.getElementById('textAreaMateriais'),
    document.getElementById('')
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
