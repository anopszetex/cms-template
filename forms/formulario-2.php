<?php
	if(!isset($_POST['etapa_2']))
		die('404 Forbidden');

	$nomeArquivo  = $_POST['arquivo'];
	$nomePagina   = $_POST['nome_pagina'];
	$pegaConteudo = file_get_contents('templates/'.$nomeArquivo);
	$campos 	  = TemplateLeitor::pegaCampos($pegaConteudo, '\{\{\!(.*?)\}\}');
	if(empty($campos['chave']))
		die('arquivo vazio :(');
		
?>

	<h2>Editando página: <?= $nomePagina; ?> | Arquivo base: <?= $nomeArquivo; ?></h2>
	<form method="post">
	<div class="box">
	<?php
		for($x = 0; $x < count($campos['chave']); $x++) {
			echo '<input type="text" name="'.$campos['campo'][$x].'" placeholder="'.$campos['campo'][$x].'">';
		}
	?>
		<input type="hidden" name="nome_pagina" value="<?= $nomePagina; ?>">
		<input type="hidden" name="nome_arquivo" value="<?= $nomeArquivo; ?>">
		<input type="submit" name="acao" value="Salvar">
	</div><!--box-->
	</form>