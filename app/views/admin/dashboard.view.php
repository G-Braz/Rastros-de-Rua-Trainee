<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: /login');
    }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../../public/css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="../../../public/assets/ratao.png">
</head>
<body>
    <div class="conteudo"> 
        <img src="../../../public/assets/Frame 10.png" class="logo">    
        <div class="container">
            <form action="/usuarios" class="caixaBotao">
                <button class="botao" type="submit">
                    <i class="bi bi-people-fill"></i>
                    <p class="titulo" type="submit">Usuários</p>
                </button>
            </form>
            <form action="/posts" class="caixaBotao" >
                <button class="botao" type="submit">
                    <i class="bi bi-file-post-fill"></i>
                    <p class="titulo" type="submit">Posts</p>
                </button>
            </form>
            <form action="/logout" method="POST" class="caixaBotao" >
                <button class="botao" type="submit">
                    <i class="bi bi-door-open-fill"></i>
                    <p class="titulo" type="submit">Logout</p>
                </button>
            </form>
        </div>
    </div>
</body>
</html>