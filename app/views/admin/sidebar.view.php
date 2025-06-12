<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/sidebar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <title>Sidebar</title>
</head>

<body>
    <div class="sidebar">
        <div class="conteudo-sidebar">
            <div class="logotipo">
                <img src="../../../public/assets/logo-sidebar.png">
            </div>
            <div class="conteudo-interno-sidebar">
                <div class="redirecionamento-sidebar">
                    <a class="dashboard-sidebar" href="admin/dashboard" >
                        <i class="bi bi-columns-gap 
                        icones-sidebar
                        icone-dashboard-sidebar"></i>
                        <span class="texto-sidebar">Dashboard</span>
                    </a>
                    <a class="publicacoes-sidebar" href="/posts">
                        <i class="bi bi-file-earmark-richtext
                        icones-sidebar
                        icone-publicacoes-sidebar"></i>
                        <span class="texto-sidebar">Publicações</span>
                    </a>
                    <a class="usuarios-sidebar" href="/usuarios">
                        <i class="bi bi-people-fill
                        icones-sidebar
                        icone-usuarios-sidebar"></i>
                        <span class="texto-sidebar">Usuários</span>
                    </a>
                </div>
                <form class="botao-logout-sidebar" action="/logout" method="POST">
                    <button class="botao-logout">
                        <div logo-logout>
                            <i class="bi bi-box-arrow-right
                            icones-sidebar
                            icone-logout-sidebar"></i>
                        </div>
                        <span class="texto-botao-sidebar">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>