<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Página Inicial</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	<link rel="stylesheet" href="../../../public/css/paginaInicial.css">

	<link rel="icon" type="image/png" href="../../../public/assets/ratao.png">
</head>
<body>
	<div class="tela-fundo" id="tela"></div>
	<div class="pagina-inicial">
		<?php include __DIR__ . '/../site/navbar.view.php' ?>
		<div class="conteudo-pag-inicial">
			<div class="grade-pag-inicial">
				<div class="heroSection-pag-inicial">
					<p class="titulo-pag-inicial">Das Ruas Nascem Novos Rastros</p>
					<p class="descricao-pag-inicial">Conheça artistas incríveis, veja as intervenções urbanas que transformam paisagens cinzas em verdadeiras galerias a céu aberto e descubra as histórias por trás de cada traço.</p>
					<form action="/listaPosts" class="caixaBotaoVerMais">
						<button class="botaoVerMais-pag-inicial">Ver Mais</button>
					</form>
				</div>
				<div class="ultimasPublicacoes-pag-inicial">
					<h1 class="titulo-carrossel-pag-inicial">Últimas Publicações</h1>
					<div class="navegacao-cima-pag-inicial swiper-button-prev"></div>
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php
							$ultimos5 = array_slice($posts, 0, 5);
							foreach ($ultimos5 as $post) : ?>
							<div class="swiper-slide">
								<div class="card-carrossel-pag-inicial">
									<a href="/listaPosts/<?=$post->id?>" style="text-decoration: none; color: inherit;">
										<div class="imagem-card-pag-inicial">
											<img class="imagem-obra-pag-inicial"
												src="<?= $post->img_arte ?>">
										</div>
										<h2 class="titulo-card-pag-inicial"> <?= $post->titulo ?> </h2>
										<p class="descricao-card-pag-inicial"> <?= $post->descricao ?></p>
									</a>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="navegacao-baixo-pag-inicial swiper-button-next"></div>
				</div>
			</div>
		</div>
		<div class="pagina-secreta" id="id-pagina-secreta" style="display: none;" onclick="fecharPaginaSecreta()">
			<img src="/public/assets/gifRato.gif" alt="Rato Secreto" style="width: 70%; height: auto; margin: 0 auto; display: block;">
			<audio id="musica" src="/public/assets/musicaRespeitaOPai.mp3"></audio>
		</div>
		<?php include __DIR__ . '/../site/footer.view.php' ?>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
		<script>
			const postsCount = <? count($ultimos5) ?>;
		</script>
		<script src="../../../public/js/paginaInicial.js"></script>
<script src="../../../public/js/paginaSecreta.js"></script>
</html>