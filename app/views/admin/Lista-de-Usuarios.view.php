<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: /login');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuários</title>

    <link rel="stylesheet" href="../../../public/css/Lista-de-Usuarios.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Staatliches&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="../../../public/assets/ratao.png">
</head>
<body>
    <div class="separa-conteudo">
    <?php include __DIR__ . '/../admin/sidebar.view.php' ?>
        <div id="tela"></div>
        <div class="pagina">
            <div class="descricao">
                <div class="nome-tabela">
                    <img class="mascote" src="../../../public/assets/LogoRastrosDeRua.png" alt="Logo Rastros de Rua Rato">
                    <h1>Tabela de Usuários</h1>
                </div>
                <div class="botaoadicionar" onclick="abrirModal('criar', null)">
                    <div class="icone-criar">
                        <i class="bi bi-plus-square-fill"></i>
                    </div>
                    <div class="texto-botao">
                        Criar Usuário
                    </div>
                </div>
            </div>
            <div class="tabela">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nome de Usuário</th>
                        <th>Email</th>
                        <th>Operações</th>
                    </tr>
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr class="Usuario">
                        <td><?= $usuario->id; ?></td> 
                        <td><?= $usuario->nome; ?></td>
                        <td><?= $usuario->email; ?></td>
                            
                        <td class="operacoes" >
                            <div class="btn-operacao">
                                <i class="bi bi-eye-fill" onclick="abrirModal('visualizar', <?= $usuario->id ?>)"></i>
                            </div>
                        <?php if ($_SESSION['adm'] == 1 || $usuario->id == $_SESSION['id']): ?>
                            <div class="btn-operacao">
                                <i class="bi bi-pencil-square" onclick="abrirModal('editar',<?= $usuario->id ?>)"></i>
                            </div>
                            <div class="btn-operacao">
                                <i class="bi bi-trash-fill" onclick="abrirModal('excluir',<?= $usuario->id ?>)"></i>
                            </div>
                        <?php else: ?>
                        <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            
            <!-- Modal Criar -->
            <form id="form-criar-usuario" class="modalUsuario modalUsuarioCriar" action="/usuarios/criar_usuario" method="POST">
                <div class="topo-info">
                    <div class="icone-info">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <div class="titulo-info">
                        <h2>Criar usuário</h2>
                    </div>
                </div>
                <div class="conteiner-info">
                    <div class="item-info">
                        <p class="titulo">Nome:</p>
                        <input type="text" class="boxCriar" name="nome" placeholder="Usuário" required>
                    </div>
                    <div class="item-info">
                        <p class="titulo">E-mail:</p>
                        <input type="email" class="boxCriar" name="email" placeholder="email@email.com" required>
                    </div>
                    <div id="msg-email" style="display:none">
                        <p>Esse e-mail já está sendo utilizado!</p>
                    </div>
                    <div class="item-info">
                        <p class="titulo">Senha:</p>
                        <div class="boxCriar senha-box-criar">
                            <input type="password" class="boxSenha" name="senha" placeholder="senha" id="senha-user-criar" required>
                            <div class="icone-senha">
                                <i id="olho-user-criar" class="bi bi-eye-fill" alt="Visualizar senha" onclick="mostrarSenha('senha-user-criar','olho-user-criar')"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="botao-modal">
                    <button type="submit" class="botao botao-salvar" id="salvar">salvar</button>
                    <button type="button" class="botao botao-cancelar" id="cancelar" onclick="fecharModal('criar',null)">cancelar</button>
                </div>
            </form>

            
            <?php foreach ($usuarios as $usuario): ?>
            <!-- Modal Visualizar -->
            <div id="form-visualizar-usuario-<?= $usuario->id ?>" class="modalUsuario modalUsuarioVisualizar">
                <div class="topo-info">
                    <div class="icone-info">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="titulo-info">
                        <h2>Informações</h2>
                    </div>
                </div>
                <div class="conteiner-info">
                    <div class="item-info">
                        <p class="titulo">ID:</p>
                        <div class="box"><?= $usuario->id ?></div>
                    </div>
                    <div class="item-info">
                        <p class="titulo">Nome:</p>
                        <div class="box"><?= $usuario->nome ?></div>
                    </div>
                    <div class="item-info">
                        <p class="titulo">E-mail:</p>
                        <div class="box"><?= $usuario->email ?></div>
                </div>
                </div>
                <div class="botao-modal">
                    <button class="botao" onclick="fecharModal('visualizar',<?= $usuario->id ?>)">fechar</button>
                </div>
            </div>
            
            <!-- Modal Editar -->
            <form id="form-editar-usuario-<?= $usuario->id ?>" action="/usuarios/editar_usuario" method="POST">
                <div id="editar-<?= $usuario->id ?>" class="modalUsuario modalUsuarioEditar">
                    <div class="topo-info">
                        <div class="icone-info">
                            <i class="bi bi-person-fill"></i>
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <div class="titulo-info">
                            <h2>Editar usuário</h2>
                        </div>
                    </div>
                    <div class="conteiner-info">
                        <div class="item-info">
                            <input type="hidden" value="<?= $usuario->id ?>" name="id">
                            <p class="titulo">Nome:</p>
                            <input type="text" class="boxEditar" name="nome" value="<?= $usuario->nome ?>" required>
                        </div>
                        <div class="item-info">
                            <p class="titulo">E-mail:</p>
                            <input type="text" class="boxEditar" name="email" value="<?= $usuario->email ?>" required>
                        </div>
                        <div id="msg-email2-<?= $usuario->id ?>" style="display:none">
                            <p>Esse e-mail já está sendo utilizado!</p>
                        </div>
                        <div class="item-info">
                            <p class="titulo">Senha:</p>
                            <div class="boxCriar senha-box-criar">
                                <input class="boxSenha" name="senha" type="password" id="senha-user-editar-<?= $usuario->id ?>" placeholder="Digite a nova senha">
                                <div class="icone-senha">
                                    <i id="olho-user-editar-<?= $usuario->id ?>" class="bi bi-eye-fill" alt="Editar senha" onclick="mostrarSenha('senha-user-editar-<?= $usuario->id ?>','olho-user-editar-<?= $usuario->id ?>')"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="botao-modal">
                        <button type="submit" class="botao botao-salvar" id="salvar-edicao-<?= $usuario->id ?>">salvar</button>
                        <button type="button" class="botao botao-cancelar" id="cancelar-edicao-<?= $usuario->id ?>" onclick="fecharModal('editar',
                        <?= $usuario->id ?>)">cancelar</button>
                    </div>
                </div>
            </form>

            <!-- Modal Excluir -->
            <form id="form-excluir-usuario-<?= $usuario->id ?>" action="/usuarios/excluir_usuario" method="POST">
            <div id="excluir-<?= $usuario->id ?>" class="modalUsuarioExcluir">
                <input type="hidden" value="<?= $usuario->id ?>" name="id">
                <div class="topo-excluir">
                    <div class="icone-excluir">
                        <i class="bi bi-trash-fill"></i>
                    </div>
                    <div class="titulo-excluir">
                        <h2>Excluir Usuário</h2>
                    </div>
                </div>
                <div class="pergunta">
                    <p>Tem certeza que deseja excluir o usuário?</p>
                </div>
                <div class="botoes-modal">
                    <button type="submit" class="excluir">Excluir</button>
                    <button type="button" class="cancelar" onclick="fecharModal('excluir',<?= $usuario->id ?>)">Cancelar</button>
                </div>
            </div> 
            </form>
            <?php endforeach; ?>

            <!-- Paginação -->
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
                <?php endforeach; ?> 
                <a class="skip page-item<?= $page >= $total_pages ? "-disabled" : ""?>" href="?paginacaoNumero=<?= $page + 1 ?>">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
</body>
<script src="../../../public/js/Lista-de-Usuarios.js"></script>
<script src="../../../public/js/login.js"></script>
</html>