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

</head>
<body>
    <div id="tela"></div>
    <div class="fundo">
        <div class="descricao">
            <div class="Titulo">
                <img src="../../../public/assets/LogoRastrosDeRua.png" alt="Logo Rastros de Rua Rato">
                <h1>Tabela de Usuários</h1>
            </div>
            <div class="createButton" onclick="abrirModal('criar')">
                <i class="bi bi-plus-square-fill"></i>
                Criar Usuário
            </div>
        </div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Nome de Usuário</th>
                    <th>Operações</th>
                </tr>
                <?php foreach ($usuarios as $usuario): ?>
                <tr class="Usuario">
                    <td><?= $usuario->id; ?></td>
                    <td><?= $usuario->email; ?></td>
                    <td><?= $usuario->nome; ?></td>
                    
                    <td class="operacoes" >
                        <i class="bi bi-eye-fill" onclick="abrirModal('visualizar', <?= $usuario->id; ?>)"></i>
                        <i class="bi bi-pencil-square" onclick="abrirModal('editar', <?= $usuario->id; ?>)"></i>
                        <i class="bi bi-trash-fill" onclick="abrirModal('excluir', <?= $usuario->id; ?>)"></i>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        
        
        <!-- Modal Visualizar -->
        <div id="visualizar" class="modalUsuario">
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
                    <div class="box">ID</div>
                </div>
                <div class="item-info">
                    <p class="titulo">Nome:</p>
                    <div class="box">Usuário</div>
                </div>
                <div class="item-info">
                    <p class="titulo">E-mail:</p>
                    <div class="box">email@email.com</div>
                </div>
                <div class="item-info">
                    <p class="titulo">Senha:</p>
                    <div class="box senha-box">
                        <p>senha</p>
                        <div class="icone-senha">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="botao-modal">
                <button class="botao" onclick="fecharModal('visualizar')">fechar</button>
            </div>
        </div> 
        </form>   
        
        
        <!-- Modal Criar -->
        <form id="criar" class="modalUsuario" action="/usuarios/criar_usuario" method="POST">
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
                    <input type="text" class="boxCriar" name="nome" placeholder="Usuário">
                </div>
                <div class="item-info">
                    <p class="titulo">E-mail:</p>
                    <input type="text" class="boxCriar" name="email" placeholder="email@email.com">
                </div>
                <div class="item-info">
                    <p class="titulo">Senha:</p>
                    <div class="boxCriar senha-box-criar">
                        <input type="text" class="boxSenha" name="senha" placeholder="senha">
                        <div class="icone-senha">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="botao-modal">
                <button type="submit" class="botao" id="salvar">salvar</button>
                <button type="button" class="botao" id="cancelar" onclick="fecharModal('criar')">cancelar</button>
            </div>
        </form>

        <!-- Modal Editar -->
        <form id="form-editar" action="/usuarios/editar_usuario" method="POST">
        <div id="editar" class="modalUsuario">
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
                    
                    <p class="titulo">Nome:</p>
                    <input type="text" class="boxEditar" name="nome" value="Usuário">
                </div>
                <div class="item-info">
                    <p class="titulo">E-mail:</p>
                    <input type="text" class="boxEditar" name="email" value="email@email.com">
                </div>
                <div class="item-info">
                    <p class="titulo">Senha:</p>
                    <div class="boxCriar senha-box-criar">
                        <input type="text" class="boxSenha" name="senha" value="senha">
                        <div class="icone-senha">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="botao-modal">
                <button type="submit" class="botao" id="salvar">salvar</button>
                <button type="button" class="botao" id="cancelar" onclick="fecharModal('editar')">cancelar</button>
            </div>
        </div>
        </form>

        <!-- Modal Excluir -->
        <div id="excluir" class="modalUsuarioExcluir">
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
                <button class="excluir">Excluir</button>
                <button class="cancelar" onclick="fecharModal('excluir')">Cancelar</button>
            </div>
        </div> 

        <!-- Paginação -->
        <div class="paginacao"> 
            <a class="skip">
                <i class="bi bi-skip-backward"></i>
            </a>
                <a class="paginas">
                    <p> 1 </p>
                </a>
                <a class="paginas">
                    <p> 2 </p>
                </a>
                <a class="paginas">
                    <p> 3 </p>
                </a>
                <a class="paginas">
                    <p> 4 </p>
                </a >
            <a class="skip">
                <i class="bi bi-skip-forward"></i>
            </a>
        </div>
    </div>
</body>
<script src="../../../public/js/Lista-de-Usuarios.js"></script>
</html>