function exibirPreview( inputArquivo, labelArquivo, preview){
   inputArquivo.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
         if (file.type.startsWith('image/')) {
         const reader = new FileReader();
         reader.onload = function (e) {
         preview.src = e.target.result;
         preview.style.display = 'flex';
         };
         labelArquivo.textContent = 'Imagem selecionada:';
         
         reader.readAsDataURL(file);

         } else {
         preview.style.display = 'none';
         preview.src = '';
         }
      } else {
      preview.style.display = 'none';
      preview.src = '';
      }
   });
}

exibirPreview(
   document.getElementById('inputArte'),
   document.getElementById('labelArte'),
   document.getElementById('previewArte')
);

exibirPreview(
   document.getElementById('inputTag'),
   document.getElementById('labelTag'),
   document.getElementById('previewTag')
);
