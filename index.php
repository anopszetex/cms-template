<?php
	include('Classes/TemplateLeitor.php');
	include('Classes/MySql.php');

	if(isset($_GET['url'])) {
		$url = $_GET['url'];
		$sql = MySql::connect()->prepare('SELECT * FROM paginas WHERE slug = ?');
		$sql->execute(array($url));

		if($sql->rowCount() > 0) {
			$conteudo    = $sql->fetch();
			$conteudoPag = file_get_contents('templates/'.$conteudo['template']);
			$campos		 = TemplateLeitor::pegaCampos($conteudoPag, '\{\{\!(.*?)\}\}');

			$conteudoEnd = explode('--!--', $conteudo['valores']);
			$conteudoPag = str_replace($campos['chave'], $conteudoEnd, $conteudoPag);
			echo $conteudoPag;
		} else {
			include('Painel.php');
		}

	} else {
		include('Painel.php');
	}
?>