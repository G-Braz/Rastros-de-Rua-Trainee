<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../../public/css/login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<div class="fundo">
    <div class="texto">
        <h1>Login</h1>
    </div>
    <div class="msgErro">
        <p>
            <?php
            session_start();
            if (isset($_SESSION['erro'])) {
                echo $_SESSION['erro'];
                unset($_SESSION['erro']);
            }
            ?>
        </p>
    </div>
    <form class="infos" method="POST" action="/login">
        <div class="email">
            <p class="tituloEmail">Email</p>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="senha">
            <label class="tituloSenha">Senha</label>
            <div class="caixaSenha">
            <input type="password" id="senha" name="senha" required>
            <i class="bi bi-eye-fill" id="olinho" onclick="mostrarSenha('senha','olinho')"></i>
            </div>
        </div>

        <div class="botao">
            <button type="submit" class="entrarBotao">
                <div class="textoBotao">Entrar</div>
            </button>
        </div>
    </form>
</div>


</body>

<script src="../../../public/js/login.js"></script>
</script>

</html>