<form method="post">
	<select name="arquivo">
	<?php 
		$diretorio = glob('templates/*.html');
		foreach($diretorio as $key => $value) {
			$arquivos     = explode('/', $value);
			$nomeArquivos = $arquivos[count($arquivos) - 1];
			echo '<option value="'.$nomeArquivos.'">'.$nomeArquivos.'</option>';
		}
	?>
	</select>
	<input type="text" name="nome_pagina" placeholder="Nome da sua página">
	<input type="submit" name="etapa_2" value="Próxima Etapa">
</form>