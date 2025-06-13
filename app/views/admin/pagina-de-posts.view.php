<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: /login');
    }
?>

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
    <div class="separa-conteudo">
        <?php include __DIR__ . '/../admin/sidebar.view.php' ?>
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
                            <td><?= (new DateTime($post->data))->format('d/m/Y')?></td> 

                            <td class="operacoes">
                                <button><i class="bi bi-eye-fill" onclick="abrirModal('fundoVisualizar<?= $post->id ?>','idModalVisualizar<?= $post->id ?>')"></i></button>
                                <button><i class="bi bi-pencil-square" onclick="abrirModal('fundoEditar<?= $post->id ?>','idModalEditar<?= $post->id ?>',<?= $post->id ?>)"></i></button>
                                <button><i class="bi bi-trash-fill" onclick="abrirModal('fundo-modal-excluir-post<?= $post->id ?>','modal-excluir-post<?= $post->id ?>',<?= $post->id ?> )"></i></button>
                            </td>
                        </tr>

                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <!--PAGINAÇÃO-->
        <div class="paginacao"> 
            <a class="skip page-item<?= $page <= 1 ? "-disabled" : ""?>" href="?paginacaoNumero=<?= $page - 1 ?>">
                <i class="bi bi-chevron-left"></i>
            </a>
            <?php
                $range = 1; // Quantas páginas mostrar antes/depois da atual
                $show_pages = [];

                $show_pages[] = 1;
                for ($i = $page - $range; $i <= $page + $range; $i++) {
                    if ($i > 1 && $i < $total_pages) {
                        $show_pages[] = $i;
                    }
                }
                if ($total_pages > 1) {
                    $show_pages[] = $total_pages;
                }

                $show_pages = array_unique($show_pages);
                sort($show_pages);

                $prev = 0;
                foreach ($show_pages as $page_number):
                    if ($prev && $page_number > $prev + 1):
                ?>
                <?php
                    endif;
                    $prev = $page_number;
                ?>
                <a class="paginas page-link<?= $page_number == $page ? "-active" : "" ?>" href="?paginacaoNumero=<?= $page_number ?>">
                    <p><?= $page_number ?></p>
                </a>
                <?php endforeach; 
            ?>    
            <a class="skip page-item<?= $page >= $total_pages ? "-disabled" : ""?>" href="?paginacaoNumero=<?= $page + 1 ?>">
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
        <!--Modal Criar-->
        <div onclick="fecharModal('fundo-modal-criar-post','id-modal-criar-post')" class="overlay-criar-post" id="fundo-modal-criar-post"></div>
        <form class="modal-criar-post" id="id-modal-criar-post" method="POST" action="/posts/create" enctype="multipart/form-data">
            <input type="hidden" name="latitude" id="latitude" value="0" required>
            <input type="hidden" name="longitude" id="longitude" value="0" required>
            <input type="hidden" name="local" id="nomeDoLocalInput">
            <input type="hidden" name="usuarios_id" value="<?php echo ($_SESSION['id']); ?>">
            <div class="titulo-modal-criar-post">
                <p>Criar Publicação</p>
            </div>

            <div class="container-superior-criar-post">
                <div class="adicionar-arte-criar-post">
                    <div>Arte</div>
                    <div class="input-arte-criar-post"> 
                        <input id="inputArteCriar" class="custom-input-img" type="file" name="img_arte" onchange="exibirPreview('inputArteCriar', 'previewArteCriar', 'imgPadraoArteCriar')" style="display: none;" required>
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
                        <input class="input-titulo-criar-post" type="text" placeholder="Insira o Título" name="titulo" required>
                    </div>
                    <div class="campo-autor-criar-post">
                        <p>Autor</p>
                        <input class="input-autor-criar-post" type="text" placeholder="Insira o Autor" name="autor" required>
                    </div>
                    <div class="adicionar-tag-criar-post">
                        <p>Tag</p>
                        <div class="input-tag-criar-post">
                            <input id="inputTagCriar" class="custom-input-img" type="file" name="img_tag" onchange="exibirPreview('inputTagCriar', 'previewTagCriar', 'imgPadraoTagCriar')" style="display: none;" required>
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
                <textarea class="input-descricao-criar-post" rows="3" cols="10" placeholder="Insira a Descrição" name="descricao" required></textarea>
            </div>

            <div class="campo-materiais-criar-post">
                <p>Materiais</p>
                <textarea class="input-materiais-criar-post" rows="2" cols="10" placeholder="Insira os Materiais" name="materiais" required></textarea>
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
                    <p>Estilo</p>
                    <select class="data-criar-post" name="tipo" required>
                        <option value="#" selected>Selecione um estilo</option>
                        <option value="1">Tag / Pixo</option>
                        <option value="2">Throw-up</option>
                        <option value="3">Bubble Style</option>
                        <option value="4">Wildstyle</option>
                        <option value="5">3D Style</option>
                        <option value="6">Realismo</option>
                        <option value="7">Characters (Personagens)</option>
                        <option value="8">Fades / Degradê</option>
                    </select>
                </div>
            </div>

            <div class="botoes-modal">
                <button type="submit" class="botao-modal botao-modal-criar">Criar</button>
                <button type="button" class="botao-modal botao-modal-cancelar" onclick="fecharModal('fundo-modal-criar-post','id-modal-criar-post')">Cancelar</button>
            </div>
        </form>
        <?php foreach($posts as $post): ?>   
        
        <!-- Modal Excluir -->
        <div onclick="fecharModal('fundo-modal-excluir-post<?= $post->id ?>','modal-excluir-post<?= $post->id ?>')" class="overlay-excluir-post" id="fundo-modal-excluir-post<?= $post->id ?>"></div>
        <form class="modal-excluir-post" id="modal-excluir-post<?= $post->id ?>" method="POST" action="/posts/delete" enctype="multipart/form-data">
            <input type="hidden" name="id" id="input-id-excluir" value="<?= $post->id ?>">
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
            <div class="botoes-modal-excluir-post">
                <button class="botao-modal-excluir-post confirmar" type="submit">Excluir</button>
                <button class="botao-modal-excluir-post cancelar" type="button" onclick="fecharModal('fundo-modal-excluir-post<?= $post->id ?>','modal-excluir-post<?= $post->id ?>')">Cancelar</button>
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
                            <img src="/<?= $post->img_arte?>" alt="Arte" name="arteVisualizar">
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
                                <img src="/<?= $post->img_tag?>" alt="Tag">
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
                        <button onclick="abrirModal('idMapaPost','idConteudoMapaP'); setTimeout(() => atualizaMapaPost(<?= (double)$post->latitude ?>, <?= (double)$post->longitude ?>), 100)" class="conteudoLocalVisualizar">
                            <i class=" icone-geo-mapa bi bi-geo-alt-fill"></i>
                            <?=$post->local ?>
                        </button>
                    </div>
                    <div class="dataVisualizar">
                        <p class="visualizarData">Estilo</p>
                        <p class="data-criar-post"><?=$post->tipo?></p>
                    </div>
                </div>
                <div class="botaoVisualizar">
                    <button class="visualizarBotao" onclick="fecharModal('fundoVisualizar<?= $post->id ?>','idModalVisualizar<?= $post->id ?>')">Fechar</button>
                </div>
            </div>
        </div>
        <!--Modal editar-->
        <div onclick="fecharModal('idModalEditar<?= $post->id ?>','fundoEditar<?= $post->id ?>')" class="modalEditar" id="fundoEditar<?= $post->id ?>"></div>
        <form class="editar" id="idModalEditar<?= $post->id ?>" method="POST" action="/posts/edit" enctype="multipart/form-data">
            <input type="hidden" name="latitude" id="latitudeEditar<?= $post->id ?>" value="0" required>
            <input type="hidden" name="longitude" id="longitudeEditar<?= $post->id ?>" value="0" required>
                
            <input type="hidden" name="img_arte_atual" value="<?= $post->img_arte ?>">
            <input type="hidden" name="img_tag_atual" value="<?= $post->img_tag ?>">
                
            <input type="hidden" name="local" id="nomeDoLocalInputEditar<?= $post->id ?>" value="<?= $post->local ?>">
                
            <input type="hidden" name="tipo" value="<?= $post->tipo ?>">

            <input type="hidden" name="id" value="<?= $post->id ?>">
            <div class="tituloModalEditar">
                <p>Editar Publicação</p>
            </div>
            <div class="imagensEditar">
                <div class="arteEditar">
                    <p>Arte</p>
                    <div class="arteInput"> 
                        <input id="inputArte<?= $post->id?>" class="inputImg" type="file" name="img_arte" onchange="trocaImagem('<?= $post->id?>')">
                        <label id="labelArte<?= $post->id?>" for="inputArte<?= $post->id?>" class="labelImgArte">
                            <img id="imagemAtualEditar<?= $post->id?>" src="<?= $post->img_arte ?>"/>
                            <div class="conteudoArteInput">
                                <p>Selecionar nova imagem</p>
                                <i class="bi bi-upload"></i>
                            </div>
                        </label>
                        <img id="previewArte<?= $post->id?>" src="" alt="Pré-visualização" style="display: none;" />
                    </div>
                </div>
                <div class="camposEditar">
                    <div class="tituloPublicacaoEditar">
                        <p>Título</p>
                        <input class="tituloInput" id="tituloPublicacaoEditar" type="text" value="<?=$post->titulo ?>" name="titulo"required>
                    </div>
                    <div class="autorEditar">
                        <p>Autor</p>
                        <input class="inputAutor" id="inputAutor" type="text" value="<?=$post->autor ?>" name="autor"required>
                    </div>
                    <div class="tagEditar">
                        <p>Tag</p>
                        <div class="tagInput">
                            <input id="inputTag<?= $post->id?>" class="inputImg" type="file" name="img_tag" onchange="trocaImagemTag('<?= $post->id?>')">
                            <label id="labelTag<?= $post->id?>" for="inputTag<?= $post->id?>" class="labelImgTag">
                                <img id="imagemAtualTag<?= $post->id?>"src="<?= $post->img_tag ?>"/>
                                <div class="conteudoTagInput">
                                    <p>Selecionar nova tag</p>
                                    <i class="bi bi-upload"></i>
                                </div>
                            </label>
                            <img id="previewTag<?= $post->id?>" src="" alt="Pré-visualização" style="display: none;" />
                        </div>
                    </div>
                </div>
            </div>  

            <div class="descricaoModalEditar">
                <p>Descrição</p>
                <textarea class="inputDescricaoEditar" id="textAreaDescricaoEditar" name="descricao" oninput="autoResize(this)"required><?=$post->descricao ?></textarea>
            </div>

            <div class="MateriaisModalEditar">
                <p>Materiais</p>
                <textarea class="inputMateriaisEditar" id="textAreaMateriaisEditar" name="materiais" oninput="autoResize(this)"required><?=$post->materiais ?></textarea>
            </div>

            <div class="dataLocalEditar">
                <div class="localEditar">
                    <p>Local</p>
                    <button onclick="abrirModalMapaEditar(<?= $post->id ?>, <?= (double)$post->latitude ?>, <?= (double)$post->longitude ?>)" class="inputLocalEditar" type="button">
                        <i class="icone-geo-mapa bi bi-geo-alt-fill"></i>
                        <?=$post->local ?>
                    </button>
                </div>
                <div class="dataEditar">
                    <p>Estilo</p>
                    <select class="data-criar-post" name="tipo" required>
                        <option value="#" selected><?=$post->tipo?></option>
                        <option value="1">Tag / Pixo</option>
                        <option value="2">Throw-up</option>
                        <option value="3">Bubble Style</option>
                        <option value="4">Wildstyle</option>
                        <option value="5">3D Style</option>
                        <option value="6">Realismo</option>
                        <option value="7">Personagens</option>
                        <option value="8">Fades / Degradê</option>
                    </select>
                </div>
            </div>
            <div class="botoesEditar">
                <button class="botaoModal botaoSalvar" type="submit">Salvar</button>
                <button class="botaoModal botaoCancelar" type="button" onclick="fecharModal('fundoEditar<?= $post->id ?>','idModalEditar<?= $post->id ?>',<?= $post->id ?>)">Cancelar</button>
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
                    <button onclick="salvarModalMapa('idModalMapa','idConteudoMapaM')" class="btn-salvar-mapa">Salvar</button>
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
    </div>
</body>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="../../../public/js/modal.js"></script>
<script src="../../../public/js/exibirPreview.js"></script>
<script src="../../../public/js/mapas.js"></script>
</html>