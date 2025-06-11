<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Página Inicial</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	<link rel="stylesheet" href="../../../public/css/paginaInicial.css">
</head>

<body>
	<?php include __DIR__ . '/../site/navbar.view.php' ?>
	<div class="conteudo-pag-inicial">
		<div class="grade-pag-inicial">
			<div class="heroSection-pag-inicial">
				<p class="titulo-pag-inicial">Lorem Ipsum</p>
				<p class="descricao-pag-inicial">Lorem Ipsum has been the industry's standard dummy text ever since the
					1500s, Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. </p>
				<button class="botaoVerMais-pag-inicial">Ver Mais</button>
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
								<div class="imagem-card-pag-inicial">
									<img class="imagem-obra-pag-inicial"
										src="<?= $post->img_arte ?>">
								</div>
								<h2 class="titulo-card-pag-inicial"> <?= $post->titulo ?> </h2>
								<p class="descricao-card-pag-inicial"><?= $post->descricao ?></p>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="navegacao-baixo-pag-inicial swiper-button-next"></div>
			</div>
		</div>
		<script src="../../../public/js/paginaInicial.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
	</div>
	<?php include __DIR__ . '/../site/footer.view.php' ?>
</body>
</html>