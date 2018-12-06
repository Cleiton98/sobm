<?php 

	session_start();
	if(!$_SESSION['logado'] == 1){
		header("location: login.php");
		exit();
	}

	//$nivelPagina = null;
	if($_SESSION['nivelUsuario'] == 0){
		
		$acesso = "<h3> <a href='index.php'>Home</a> &rsaquo; $nomePagina - Acesso permitido ao usuário  com perfil de administrador.</h3><br/>";

	}else if 

		($_SESSION['nivelUsuario'] >= $nivelPagina){

			$acesso = "<h4> <a href='index.php'>Home</a> &rsaquo; $nomePagina - Acesso permitido.</h4><br/>";
		}else{
			$acesso = "<h2>Acesso negado.</h2><br/>";
			header("location:index.php");
			exit();
		}

	echo $acesso;


 ?>
