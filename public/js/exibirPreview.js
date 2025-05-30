
function exibirPreview(inputArquivo, labelArquivo, preview, imagemPadrao) {
      inputArquivo.addEventListener('change', function () {
         const file = this.files[0];
   
         if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
               preview.src = e.target.result;
               preview.style.display = 'flex';
               imagemPadrao.style.display = 'none';
            };
            reader.readAsDataURL(file);
            labelArquivo.textContent = 'Imagem selecionada:';
   
         } else {
            preview.style.display = 'none';
            preview.src = '';
            imagemPadrao.style.display = 'block';
            labelArquivo.textContent = "Selecione uma imagem";
         }
      });
   }


function trocaImagem(id){
   const painel = document.querySelector('#labelArte'+id);
   const inputImagem = document.querySelector('#inputArte' +id);
   const spanImage = painel.querySelector('#imagemAtualEditar'+id);
   if (inputImagem) {
        
           const arquivo = inputImagem.files[0];
           if (arquivo) {
               const reader = new FileReader();
               reader.addEventListener('load', function(e) {
                   const readerTarget = e.target;
                   spanImage.src = readerTarget.result;
               });
               reader.readAsDataURL(arquivo);
           } else {
               spanImage.src = "../../../public/assets/profile-picture-973460_1280.webp";
           }
   };
}

function trocaImagemTag(id){
   const painel = document.querySelector('#labelTag'+id);
   const inputImagem = document.querySelector('#inputTag' +id);
   const spanImage = painel.querySelector('#imagemAtualTag'+id);
   if (inputImagem) {
        
           const arquivo = inputImagem.files[0];
           if (arquivo) {
               const reader = new FileReader();
               reader.addEventListener('load', function(e) {
                   const readerTarget = e.target;
                   spanImage.src = readerTarget.result;
               });
               reader.readAsDataURL(arquivo);
           } else {
               spanImage.src = "../../../public/assets/profile-picture-973460_1280.webp";
           }
   };
}

exibirPreview(
   document.getElementById('inputArteCriar'),
   document.getElementById('labelArteCriar'),
   document.getElementById('previewArteCriar'),
   document.getElementById('imgPadraoArteCriar')
);

exibirPreview(
   document.getElementById('inputTagCriar'),
   document.getElementById('labelTagCriar'),
   document.getElementById('previewTagCriar'),
   document.getElementById('imgPadraoTagCriar')
);
