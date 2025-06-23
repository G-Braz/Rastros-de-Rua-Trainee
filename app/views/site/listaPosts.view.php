<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Publicações</title>
    <link rel="stylesheet" href="../../../public/css/listaPosts.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="../../../public/assets/ratao.png">
</head>
<body>
    <div>
        <?php include __DIR__ . '/../site/navbar.view.php' ?>
        <div id="tela" onclick="fecharFiltro('tiposFiltro')"></div>
        <div class="conteudo">
            <div class="topo">
                <div class="barraDePesquisa">
                    <div class="caixaDePesquisa">
                            <i class="bi bi-search"></i>
                            <input type="text" class="inputPesquisa" id="idInputPesquisa" name="text" value="" placeholder="Buscar Post" onkeyup="pesquisarPostsTitulo()" >
                            </input>
                            <i class="bi bi-x-lg" onclick= "apagarTexto('idInputPesquisa')"></i>
                    </div>
                </div>
                <div class="filtro" onclick="abrirFiltro('tiposFiltro')">
                    <i class="bi bi-filter-circle-fill"></i>
                    <p class="textoFiltro">Filtro</p>
                </div>
                <div class="tiposFiltro" id="tiposFiltro">
                        <p onclick="pesquisarPostsTipo(''); apagarTexto('idInputPesquisa')">Todos</p>
                        <p onclick="pesquisarPostsTipo('Tag / Pixo')">Tag / Pixo</p>
                        <p onclick="pesquisarPostsTipo('Throw-up')">Throw-up</p>
                        <p onclick="pesquisarPostsTipo('Bubble Style')">Bubble Style</p>
                        <p onclick="pesquisarPostsTipo('Wildstyle')">Wildstyle</p>
                        <p onclick="pesquisarPostsTipo('3D Style')">3D Style</p>
                        <p onclick="pesquisarPostsTipo('Realismo')">Realismo</p>
                        <p onclick="pesquisarPostsTipo('Characters (Personagens)')">Characters (Personagens)</p>
                        <p onclick="pesquisarPostsTipo('Fades / Degradê')">Fades / Degradê</p>
                </div>
            </div>
            <ul class="listaDePosts">
                <?php foreach($posts as $post): ?>
                    <li>
                        <a href="/listaPosts/<?=$post->id?>" class="post">
                            <img src="/<?= $post->img_arte?>" class="fotoCapa">
                            <img src="/<?= $post->img_tag?>" class="fotoTag">
                            <div class="textoPost">
                                <h1><?= $post-> titulo ?></h1>
                                <p><?= $post-> descricao ?></p>
                            </div>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        <!-------Paginação------->
        <div class="paginacao"> 
            <a class="skip page-item<?= $page <= 1 ? "-disabled" : ""?>" href="?paginacaoNumero=<?= $page - 1 ?>">
                <i class="bi bi-chevron-left"></i>
            </a>
            <?php
                $range = 1;
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
        <script src="../../../public/js/listaPosts.js"></script>
    </div>
    <?php include __DIR__ . '/../site/footer.view.php' ?>
</body>
</html>