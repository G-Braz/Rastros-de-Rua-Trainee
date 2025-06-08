// Abrir e Fechar Modal 
const tela = document.querySelector('#tela');

function abrirModal(tipo, id = null) {
    if (tipo === 'criar') {
        document.getElementById('form-criar-usuario').style.display = 'block';
        tela.style.display = "block";
    } else if (tipo === 'editar'){
        document.getElementById(`editar-${id}`).style.display = 'flex';
        tela.style.display = "block";
    }
    else if(tipo === 'visualizar'){
        document.getElementById(`form-visualizar-usuario-${id}`).style.display = 'flex';
        tela.style.display = "block";
    }
    else if(tipo === 'excluir'){
        document.getElementById(`excluir-${id}`).style.display = 'flex';
        tela.style.display = "block";
    }
}

function fecharModal(tipo, id = null) {
    if (tipo === 'criar') {
        document.getElementById('form-criar-usuario').style.display = 'none';
        document.getElementById('msg-email').style.display="none";
        tela.style.display = "none";
    } else if (tipo === 'editar'){
        document.getElementById(`editar-${id}`).style.display = 'none';
        document.getElementById(`msg-email2-${id}`).style.display="none";
        tela.style.display = "none";
    } else if (tipo === 'visualizar'){
        document.getElementById(`form-visualizar-usuario-${id}`).style.display = 'none';
        tela.style.display = "none";
    } else if (tipo === 'excluir'){
        document.getElementById(`excluir-${id}`).style.display = 'none';
        tela.style.display = "none";
    }
    
}

document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('submit', function(e) {
        const formId = e.target.id;

        // Formulário de criação
        if (formId === 'form-criar-usuario') {
            e.preventDefault();

            const formData = new FormData(e.target);

            fetch(e.target.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    fecharModal('criar');
                    window.location.href = data.redirect;
                } else {
                    document.getElementById('msg-email').style.display = "flex";
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Ocorreu um erro ao processar sua requisição');
            });
        }
    });
});

document.querySelectorAll("form[id^='form-editar-usuario-']").forEach(form => {
    form.addEventListener("submit", async function (e) {
        console.log("Tipo de form:", form);
        console.log("form.id:", form.id);
        console.log("typeof form.id:", typeof form.id);
        e.preventDefault();

        const formData = new FormData(form);
        const response = await fetch(form.action, {
        method: "POST",
        body: formData,
        });

        const result = await response.json();
        const usuarioId = formData.get('id');
        console.log(result.success);
        console.log(form.id);
        if (result.success && result.redirect) {
            window.location.href = result.redirect;
        } else if (!result.success){
            document.getElementById(`msg-email2-${usuarioId}`).style.display = "flex";
        }
    });
    });
