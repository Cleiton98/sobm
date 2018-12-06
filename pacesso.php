<?php 
	$nivelPagina = 1;
	$nomePagina = "Primeiro acesso";
	require_once "seguranca.php";

	if($_SESSION['status'] == 0){
		$idUsuario = $_SESSION['id'];
		require_once "conecta.php";
?>
	<h3>Necessário redefinir sua senha</h3>
	<form method = "POST">
		<label>Senha:</label><br/>
		<input type="password" name="txtNovaSenha"><br/>
		<label>Redigite a Senha:</label><br/>
		<input type="password" name="txtConfirmaNovaSenha"><br/>
		<input type="submit" name="btnSalvar" value = "Salvar">
		
	</form>

<?php

		if($_POST){
			extract($_POST);
			if($txtNovaSenha == $txtConfirmaNovaSenha){
				$novaSenha = $txtNovaSenha;
				$sqlUpdate = $pdo->prepare("UPDATE usuario SET senha = :senha, status = 1 WHERE id = :id");
				$sqlUpdate->bindValue(":senha", md5($novaSenha));
				$sqlUpdate->bindValue(":id", $idUsuario);
				$sqlUpdate->execute();
				$_SESSION['status'] = 1 ;
				$mensagem = "Senha alterada com sucesso.";
				header("location:index.php");
			}else{$mensagem = "As senhas não coincidem";}
			if(isset($mensagem)){echo $mensagem;}
		}

	}else{
		header("location:index.php");
		exit();
	}

 ?>