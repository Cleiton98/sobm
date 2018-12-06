<?php 
	$dbname = "sobm";
	$host = "localhost";
	$usuario = "root";
	$senha = "";

	$sql  = "SELECT * FROM usuario";// Variavel para teste da consulta


	try {
		$pdo = new PDO("mysql:dbname=$dbname; host=$host", $usuario, $senha);
	} catch (PDOException $e) {
		$mensagem = "Erro ao conectar com o banco de dados <br/>";
		$mensagem .= $e->getMessage();
	}
	if(isset($mensagem)){
		echo $mensagem;
		exit();
	}

	function consultaTeste($sql){
		global $pdo;
		$consulta = $pdo->query($sql);
		$registro = $consulta->fetch();
		echo "<pre>";
		print_r($registro);
		echo  "</pre>";

	}
	//consultaTeste($sql);

	
 ?>