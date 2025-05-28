<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <title>Tabela de Publicações</title>

    <link rel="stylesheet" href="/public/css/pagina-de-posts-admin.css">
    <link rel="stylesheet" href="/public/css/modalVisualizar.css">
    <link rel="stylesheet" href="/public/css/modalEditar.css">
    <link rel="stylesheet" href="/public/css/modalCriar.css">
    <link rel="stylesheet" href="/public/css/modalExcluir.css">
    <link rel="stylesheet" href="../../../public/css/mapa.css" />
</head>
<body>
    <div class="pagina">
        <div class="descricao">
            <div class="nome-tabela">
                <div class="mascote">
                    <img src="/public/assets/Mascote.png" alt="Mascote">
                </div>
                <div>
                    <h1>Tabela de Posts</h1>
                </div>
            </div>
            <button class="botaoadicionar" onclick="abrirModal('fundo-modal-criar-post','id-modal-criar-post')">
                <div class="icone">
                    <i class="bi bi-plus-square-fill"></i>
                </div>
                <div class="texto-botao">
                    Criar Publicação
                </div>
            </button>
        </div>
        <div class="tabela">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Data</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($posts as $post): ?>
                    <tr class="post">
                        <td><?= $post->id ?></td>
                        <td><?= $post->titulo ?></td>
                        <td><?= $post->autor ?></td>
                        <td><?= $post->data ?></td>

                        <td class="operacoes">
                            <button><i class="bi bi-eye-fill" onclick="abrirModal('fundoVisualizar<?= $post->id ?>','idModalVisualizar<?= $post->id ?>')"></i></button>
                            <button><i class="bi bi-pencil-square" onclick="abrirModal('fundoEditar','idModalEditar')"></i></button>
                            <button><i class="bi bi-trash-fill" onclick="abrirModal('fundo-modal-excluir-post<?= $post->id ?>','modal-excluir-post<?= $post->id ?>',<?= $post->id ?> )"></i></button>
                        </td>
                    </tr>

                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php foreach($posts as $post): ?>   
    <!--Modal Criar-->
<div onclick="fecharModal('fundo-modal-criar-post','id-modal-criar-post')" class="overlay-criar-post" id="fundo-modal-criar-post"></div>
<form class="modal-criar-post" id="id-modal-criar-post" method="POST" action="/posts/create" enctype="multipart/form-data">
    <div class="titulo-modal-criar-post">
        <p>Criar Publicação</p>
    </div>

    <div class="container-superior-criar-post">
        <div class="adicionar-arte-criar-post">
            <div>Arte</div>
            <div class="input-arte-criar-post"> 
                <input id="inputArteCriar" class="custom-input-img" type="file" name="arte" style="display: none;">
                <label id="labelArteCriar" for="inputArteCriar" class="custom-label-art">
                    Selecionar imagem da arte 
                    <img id="imgPadraoArteCriar" src="/public/assets/icone-imagem.svg" /> 
                </label> 
                <img id="previewArteCriar" src="" alt="Pré-visualização" style="display: none;" />
            </div>
        </div>

        <div class="campos-superior-direita-criar">
            <div class="campo-titulo-criar-post">
                <p>Título</p>
                <input class="input-titulo-criar-post" type="text" placeholder="Insira o Título" name="titulo">
            </div>
            <div class="campo-autor-criar-post">
                <p>Autor</p>
                <input class="input-autor-criar-post" type="text" placeholder="Insira o Autor" name="autor">
            </div>
            <div class="adicionar-tag-criar-post">
                <p>Tag</p>
                <div class="input-tag-criar-post">
                    <input id="inputTagCriar" class="custom-input-img" type="file" name="tag" style="display: none;">
                    <label id="labelTagCriar" for="inputTagCriar" class="custom-label-tag">
                        Selecionar imagem da tag 
                        <img id="imgPadraoTagCriar" src="/public/assets/icone-imagem.svg" />
                    </label>
                    <img id="previewTagCriar" src="" alt="Pré-visualização" style="display: none;" />
                </div>
            </div>
        </div>
    </div>  

    <div class="campo-descricao-criar-post">
        <p>Descrição</p>
        <textarea class="input-descricao-criar-post" rows="3" cols="10" placeholder="Insira a Descrição" name="descricao"></textarea>
    </div>

    <div class="campo-materiais-criar-post">
        <p>Materiais</p>
        <textarea class="input-materiais-criar-post" rows="2" cols="10" placeholder="Insira os Materiais" name="materiais"></textarea>
    </div>

    <div class="local-e-data-criar">
        <div class="campo-local-criar-post">
            <p>Local</p>
            <button 
                type="button"
                onclick="abrirModal('idModalMapa','idConteudoMapaM')" 
                class="btn-mapa-modal-criar">
                <i class="icone-geo-mapa bi bi-geo-alt-fill"></i>
                Selecionar localização
            </button>
        </div>
        <div class="campo-data-criar-post">
            <p>Data</p>
            <input class="data-criar-post" type="date" readonly name="data">
        </div>
    </div>

    <div class="botoes-modal">
        <button type="submit" class="botao-modal botao-modal-criar">Criar</button>
        <button type="button" class="botao-modal botao-modal-cancelar" onclick="fecharModal('fundo-modal-criar-post','id-modal-criar-post')">Cancelar</button>
    </div>
</form>
    <!-- Modal Excluir -->
    <div onclick="fecharModal('fundo-modal-excluir-post<?= $post->id ?>','modal-excluir-post<?= $post->id ?>')" class="overlay-excluir-post" id="fundo-modal-excluir-post<?= $post->id ?>"></div>
    <form class="modal-excluir-post" id="modal-excluir-post<?= $post->id ?>" method="POST" action="/posts/delete" enctype="multipart/form-data">
        
        <div class="cabecalho-modal-excluir-post">
            <div class="icone-modal-excluir-post">
                <i class="bi bi-trash-fill"></i>
            </div>
            <div class="titulo-modal-excluir-post">
                <h2>Excluir Publicação</h2>
            </div>
        </div>
        <div class="mensagem-modal-excluir-post">
            <p>Tem certeza que deseja excluir a publicação?</p>
        </div>
        <input type="hidden" name="id" id="input-id-excluir">
        <div class="botoes-modal-excluir-post">
            <button class="botao-modal-excluir-post confirmar">Excluir</button>
            <button class="botao-modal-excluir-post cancelar"
                onclick="fecharModal('fundo-modal-excluir-post<?= $post->id ?>','modal-excluir-post<?= $post->id ?>')">Cancelar</button>
        </div>
    </form>
    <!--Modal visualizar-->
    
    <div onclick="fecharModal('idModalVisualizar<?= $post->id ?>','fundoVisualizar<?= $post->id ?>')" class="modalVisualizar" id="fundoVisualizar<?= $post->id ?>"> </div>
        <div class="visualizar" id="idModalVisualizar<?= $post->id ?>">
            <div class="tituloModalVisualizar">
                <p>Visualizar Publicação</p>
            </div>
            <div class="imagensVisualizar">
                <div class="arteVisualizar">
                    <div class="arteContent">Arte</div>
                    <div class="conteudoArteVisualizar"> 
                        <img src="../../../public/assets/imagemTeste.jpg" alt="Arte" name="arteVisualizar">
                    </div>
                </div>
                <div class="campos">
                    <div class="tituloPublicacaoVisualizar">
                        <p class="TituloTituloVisualizar">Titulo</p>
                        <p class="conteudoTituloVisualizar"><?= $post->titulo ?></p>
                    </div>
                    <div class="autorVisualizar">
                        <p class="tituloAutorVisualizar">Autor</p>
                        <p class="conteudoAutorVisualizar"><?=$post->autor?></p>
                    </div>
                    <div class="tagVisualizar">
                        <p>Tag</p>
                        <div class="conteudoTagVisualizar">
                            <img src="../../../public/assets/Tag.png" alt="Tag">
                        </div>
                    </div>
                </div>
            </div>  
            <div class="descricaoModalVisualizar">
                <p class="tituloDescricaoVisualizar">Descrição</p>
                <textarea class="conteudoDescricaoVisualizar" id= "textAreaDescricao"readonly ><?=$post->descricao?></textarea>

            </div>
            <div class="materiaisModalVisualizar">
                <p class="tituloMateriaisVisualizar">Materiais</p>
                <textarea class="conteudoMateriaisVisualizar" id="textAreaMateriais" readonly ><?=$post->materiais?></textarea>
            </div>
            <div class="dataLocalVisualizar">
                <div class="localVisualizar">
                    <p class="TituloLocalVisualizar">Local</p>
                    <button onclick="abrirModal('idMapaPost','idConteudoMapaP')" class="conteudoLocalVisualizar">
                        <i class=" icone-geo-mapa bi bi-geo-alt-fill"></i>
                        Visualizar no mapa
                    </button>
                </div>
                <div class="dataVisualizar">
                    <p class="visualizarData">Data de Criação</p>
                    <p class="conteudoDataVisualizar"><?=$post->data?></p>
                </div>
            </div>
            <div class="botaoVisualizar">
                <button class="visualizarBotao" onclick="fecharModal('fundoVisualizar<?= $post->id ?>','idModalVisualizar<?= $post->id ?>')">Fechar</button>
            </div>
        </div>
    </div>
    <!--Modal editar-->
<div onclick="fecharModal('idModalEditar','fundoEditar')" class="modalEditar" id="fundoEditar"></div>
<form class="editar" id="idModalEditar" method="POST" action="/posts/edit" enctype="multipart/form-data">
    <div class="tituloModalEditar">
        <p>Editar Publicação</p>
    </div>
    <div class="imagensEditar">
        <div class="arteEditar">
            <p>Arte</p>
            <div class="arteInput"> 
                <input id="inputArte" class="inputImg" type="file" name="arte">
                <label id="labelArte" for="inputArte" class="labelImgArte">
                    <img src="../../../public/assets/imagemTeste.jpg"/>
                    <div class="conteudoArteInput">
                        <p>Selecionar nova imagem</p>
                        <i class="bi bi-upload"></i>
                    </div>
                </label>
                <img id="previewArte" src="" alt="Pré-visualização" style="display: none;" />
            </div>
        </div>
        <div class="camposEditar">
            <div class="tituloPublicacaoEditar">
                <p>Título</p>
                <input class="tituloInput" id="tituloPublicacaoEditar" type="text" value="Lorem ipsum" name="titulo">
            </div>
            <div class="autorEditar">
                <p>Autor</p>
                <input class="inputAutor" id="inputAutor" type="text" value="Lorem ipsum" name="autor">
            </div>
            <div class="tagEditar">
                <p>Tag</p>
                <div class="tagInput">
                    <input id="inputTag" class="inputImg" type="file" name="tag">
                    <label id="labelTag" for="inputTag" class="labelImgTag">
                        <img src="../../../public/assets/Tag.png"/>
                        <div class="conteudoTagInput">
                            <p>Selecionar nova tag</p>
                            <i class="bi bi-upload"></i>
                        </div>
                    </label>
                    <img id="previewTag" src="" alt="Pré-visualização" style="display: none;" />
                </div>
            </div>
        </div>
    </div>  

    <div class="descricaoModalEditar">
        <p>Descrição</p>
        <textarea class="inputDescricaoEditar" id="textAreaDescricaoEditar" name="descricao" oninput="autoResize(this)">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione eius molestiae voluptas nihil reiciendis quasi fugiat, quas corrupti impedit distinctio praesentium? Delectus, expedita? Praesentium quia sequi alias neque natus esse?</textarea>
    </div>

    <div class="MateriaisModalEditar">
        <p>Materiais</p>
        <textarea class="inputMateriaisEditar" id="textAreaMateriaisEditar" name="materiais" oninput="autoResize(this)">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione eius molestiae voluptas nihil reiciendis quasi fugiat, quas corrupti impedit distinctio praesentium? Delectus, expedita? Praesentium quia sequi alias neque natus esse?</textarea>
    </div>

    <div class="dataLocalEditar">
        <div class="localEditar">
            <p>Local</p>
            <button onclick="abrirModal('idModalMapa','idConteudoMapaM')" class="inputLocalEditar" type="button">
                <i class="icone-geo-mapa bi bi-geo-alt-fill"></i>
                Selecionar localização
            </button>
        </div>
        <div class="dataEditar">
            <p>Data de Criação</p>
            <p class="conteudoDataEditar">16/05/2025</p>
        </div>
    </div>

    <div class="botoesEditar">
        <button class="botaoModal botaoSalvar" type="submit">Salvar</button>
        <button class="botaoModal botaoCancelar" type="button" onclick="fecharModal('fundoEditar','idModalEditar')">Cancelar</button>
    </div>
</form>
<?php endforeach ?>
        <!-- -----Modal do Mapa Criar/Editar----- -->
        <div class="pagina-mapa" id="idModalMapa">
            <div class="conteudo-pagina-mapa" id="idConteudoMapaM">
                <div class="instrucoes-mapa">
                    <i class="icone-lampada-mapa bi bi-lightbulb"></i>
                    <p class="titulo-instrucoes-mapa">Como selecionar o local da arte de rua</p>
                    <ol>
                        <li><strong>Clique no mapa:</strong> selecione o local exato da arte de rua. O marcador será movido
                            automaticamente.</li>
                        <li><strong>(Opcional) Arraste o marcador:</strong> você pode ajustar a posição manualmente.</li>
                        <li><strong>Salve ou confirme:</strong> continue com o formulário normalmente.</li>
                    </ol>
                    <p class="dica"> Use o zoom do mapa para mais precisão.</p>
                    <button onclick="fecharModal('idModalMapa','idConteudoMapaM')" class="btn-salvar-mapa">Salvar</button>
                </div>
                <div id="map"></div>
            </div>
        </div>

        <!-- -----Modal Mapa Visualizar----- -->
        <div id="idMapaPost" class="mapaPostFundo">
            <div id="idConteudoMapaP" class="pag-mapa-post">
                <div class="titulo-mapa-post">
                    <p>Visualizar localização da arte</p>
                </div>
                <div class="conteudo-mapa-post">
                    <div id="map2"></div>
                </div>
                <button onclick="fecharModal('idMapaPost','idConteudoMapaP')" class="btn-fechar-mapa">Fechar</button>
            </div>
        </div>
    <!--PAGINAÇÃO-->
    <div class="paginacao">
            <a href="" class="skip">
                <i class="bi bi-skip-backward"></i>
            </a href="">
                <a href="" class="paginas">
                    <p> 1 </p>
                </a href="">
                <a href="" class="paginas">
                    <p> 2 </p>
                </a href="">
                <a href="" class="paginas">
                    <p> 3 </p>
                </a href="">
                <a href="" class="paginas">
                    <p> 4 </p>
                </a href="">
            <a href="" class="skip">
                <i class="bi bi-skip-forward"></i>
            </a href="">
        </div>
    </div>
</body>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="../../../public/js/mapas.js"></script>
<script src="../../../public/js/modal.js"></script>
<script src="../../../public/js/exibirPreview.js"></script>
</html>