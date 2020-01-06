<!DOCTYPE html>
<html>
<head>
	<title>Painel CMS</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<div class="center">
		<div class="logo"><a href="">Painel CMS</a></div><!--logo-->

		<div class="menu">
			<a href="#">Cadastrar Página</a>
			<a href="#">Listar Página</a>
		</div><!--menu-->

		<div class="clear"></div><!--clear-->
		</div><!--center-->
	</header>

	<div class="main">
		<div class="center">
			<?php
				if(isset($_POST['acao'])) {

					if(!isset($_POST['nome_arquivo']) or !isset($_POST['nome_pagina']))
						die('404 Forbidden');

					$nomeArquivo = trim($_POST['nome_arquivo']);
					$nomePagina  = trim($_POST['nome_pagina']);
					$conteudoPag = '';

					foreach($_POST as $key => $value) {
						if($key != 'acao' && $key != 'nome_pagina' && $key != 'nome_arquivo') {
							$conteudoPag.= $value;
							$conteudoPag.= '--!--';	
						}
					}

					if(!empty($nomeArquivo) && !empty($nomePagina)) {
						$sql = MySql::connect()->prepare('SELECT id FROM paginas WHERE slug = ?');
						$sql->execute(array($nomePagina));
						if($sql->rowCount() == 1) {
							$exec = MySql::connect()->prepare('UPDATE paginas SET valores = ? WHERE slug = ?');
							$exec->execute(array($conteudoPag, $nomePagina));
						} else {
							$sql = MySql::connect()->prepare('INSERT INTO paginas VALUES (null, ?, ?, ?)');
							$sql->execute(array($nomePagina, $nomeArquivo, $conteudoPag));
						}
					}
				}

				if(isset($_POST['etapa_2'])) {
					if(!isset($_POST['nome_pagina']))
						die('404 Forbidden');
					else if(htmlspecialchars(trim(stripcslashes($_POST['nome_pagina']))) == '')
						die('Nome da página não pode ser vazio!');
				}

				if(!isset($_POST['etapa_2']))
					include('forms/formulario-1.php');
				else
					include('forms/formulario-2.php');
			?>
		</div><!--center-->
	</div><!--main-->
</body>
</html>