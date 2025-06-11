<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$post['titulo']?></title>
    <link rel="stylesheet" href="../../../public/css/mapa.css" />
    <link rel="stylesheet" href="/public/css/postIndividual.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
</head>
<body>
    <?php include __DIR__ . '/../site/navbar.view.php' ?>
    <div class="pagina">
        <div class="publicacao">
            <div class="conteudo-principal">
                <div class="imagem-post">
                    <img src="/<?=$post['img_arte']?>" alt="Imagem da Publicação">
                </div>
                <div class="informacoes">
                    <h1 class="titulo-post"><?=$post['titulo']?></h1>
                    <div class="dados">
                        <p class="autor"><strong>Autor:</strong> <?=$post['autor']?></p>
                        <p class="data"><strong>Data:</strong> <?=(new DateTime($post['data']))->format('d/m/Y')?></p>
                        <p class="local"><strong>Local:</strong> <?=$post['local']?></p>
                        <div class="conteudo-btn-mapa-post">
                            <button onclick="abrirModal('idMapaPost','idConteudoMapaP'); setTimeout(() => atualizaMapaPost(<?= (double)$post['latitude'] ?>, <?= (double)$post['longitude'] ?>), 100)" class="btn-local-mapa">
                                <i class="bi bi-geo-alt-fill"></i>
                                Visualizar no mapa
                            </button>
                        </div>
                    </div>
                    <div class="tag">
                        <img src="/<?= $post['img_tag']?>" alt="Imagem da Tag">
                    </div>
                </div>
            </div>
            <div class="conteudo-complementar">
                <div class="materiais">
                    <h2 class="titulo-complementar">Materiais Utilizados</h2>
                    <p class="texto-complementar"><?=$post['materiais']?></p>
                </div>
                <div class="descricao">
                    <h2 class="titulo-complementar">Descrição</h2>
                    <p class="texto-complementar"><?=$post['descricao']?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- -----Modal Mapa Post----- -->
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
    <?php include __DIR__ . '/../site/footer.view.php' ?>
</body>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="../../../public/js/mapas.js"></script>
<script src="../../../public/js/modal.js"></script>
</html>
