//mostrar senha
function mostrarSenha(idImput,idOlinho){
    const input = document.getElementById(idImput); // campo senha
    const Olinho =document.getElementById(idOlinho); // icone do olho

    //verifica o estado do texto
    if(input.type==="password"){
        input.setAttribute("type","text") // muda o campo senha para texto
        olinho.classList.replace('bi-eye-fill','bi-eye-slash-fill') // muda o olho
    }else{
        input.setAttribute("type","password") // muda o campo texto para senha
        olinho.classList.replace("bi-eye-slash-fill","bi-eye-fill")
    }

}
