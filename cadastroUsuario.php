<meta charset="utf-8">
<head>
	
</head>
<?php 

	$nomePagina = "Cadastro de usuários";

	$nivelPagina = 5;

	require "seguranca.php";

	require "conecta.php";
?>
	<fieldset style = "width : 50%; border-radius: 10px;">
		<legend>Cadastro de usuários</legend>
		<form method = "POST">
			<label>Nome:</label><br/>
			<input type = "text" name = "txtNome" required=""><br/>
			<label>e-mail:</label><br/>
			<input type = "email" name="txtEmail" required=""><br/>
			<label>Nível</label><br/>
			<input type = "number" name = "txtNivel"><br/>
			<input type = "submit" name ="btnSalvar" value = "Cadastrar">
		</form>
		<div id = "mensagem"><?php if(isset($mensagem)){echo $mensagem;} ?></div>
	</fieldset>
<?php

	if($_POST){
		if(isset($_POST['btnDeletar'])){
			foreach ($_POST['checkbox'] as $checkbox) {
				$sqlDelete = $pdo->prepare("DELETE FROM usuario WHERE id = :id");
				$sqlDelete->bindValue(":id", $checkbox);
				$sqlDelete->execute();
			} //foreach

		}// IF btnDeletar

		if(isset($_POST['btnSalvar'])){

			extract($_POST);
			if(empty($txtNivel)){$txtNivel = 1;}
			$sqlInsert = $pdo->prepare("INSERT INTO usuario (nome, email, senha, nivel) VALUES(:nome, :email, :senha, :nivel)");
			$sqlInsert->bindValue(":nome",$txtNome);
			$sqlInsert->bindValue(":email", $txtEmail);
			$sqlInsert->bindValue(":senha", md5("123456"));
			$sqlInsert->bindValue(":nivel", $txtNivel);
			$sqlInsert->execute();
		}//IF btnSalvar
	}//IF POST

	$htmlTabela = "<form method = 'POST'>";
	$htmlTabela .= "<table border = 1>";
	$htmlTabela .= "<tr>";
	$htmlTabela .= "<th>Ações</th>";
	$htmlTabela .= "<th>ID</th>";
	$htmlTabela .= "<th>Nome</th>";
	$htmlTabela .= "<th>E-mail</th>";
	$htmlTabela .= "<th>Nível</th>";
	$htmlTabela .= "<th>Status</th>";
	$htmlTabela .= "</tr>";

	$sqlConsulta = "SELECT * FROM usuario";
	$pdoSQL = $pdo ->query($sqlConsulta);
	$qdtUsuarios = $pdoSQL->rowCount();

	while($registro = $pdoSQL->fetch()){
		
		$htmlTabela .= "<tr>";
		$htmlTabela .= "<td><input type = 'checkbox' name = 'checkbox[]' id = {$registro['id']} value = {$registro['id']} /></td>";
		$htmlTabela .= "<td>". $registro['id'] . "</td>";
		$htmlTabela .= "<td>". utf8_encode($registro['nome']) . "</td>";
		$htmlTabela .= "<td>". utf8_encode($registro['email']) . "</td>";
		$htmlTabela .= "<td>". utf8_encode($registro['nivel']) . "</td>";
		$htmlTabela .= "<td>". utf8_encode($registro['status']) . "</td>";
		$htmlTabela .= "</tr>";
	}

	$htmlTabela .= "</table>";
	$htmlTabela .= "<input type = 'submit' name = 'btnDeletar' value = 'Deletar'>";
	$htmlTabela .= "</form>";
	echo "Usuários cadastrados " . $qdtUsuarios;
	echo $htmlTabela;
	echo "Usuários cadastrados " . $qdtUsuarios;

?>