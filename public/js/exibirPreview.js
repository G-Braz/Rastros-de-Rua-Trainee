/*
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
         this.value = '';
      });
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
*/