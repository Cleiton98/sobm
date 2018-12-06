<?php 
	$nomePagina = "Index";
	$nivelPagina = 1;
	
	include "menu.html";
	require "seguranca.php";
	
	
	if($_SESSION['status'] == 0){
		//Redirecionar para alterar a senha padão
		header("location:pacesso.php");
	}
 ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>SOBM - Index</title>
</head>

<body>
	<div class="container">

		Bem vindo,
		<?php echo utf8_encode($_SESSION['nome']) . " - Nível " . $_SESSION['nivelUsuario'];?> <a href="logout.php">(Sair)</a>
		<hr />
		<div id="menu">
			<ul>
				<li><a href="cadastroUsuario.php">Cadastro de usuários</a></li>
				<li><a href="registroOcorrencia.php">Registro de ocorrências</a></li>
				<li><a href="#">Relatórios</a></li>
				<li><a href="#">Configurações</a></li>
			</ul>
		</div>
	</div>
</body>

</html>