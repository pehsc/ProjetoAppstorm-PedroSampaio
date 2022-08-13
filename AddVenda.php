<?php
	header("Content-type: text/html; charset=utf-8");
	//inclui o arquivo de relacionamento com o bando de dados
	require_once("ConBanco.php");
	//instancia a classe Banco
	$banco = new Banco();
	
	//recebe dados do arquivo "Tela.html"
	$data = $_POST['data'];
	$valor = $_POST['valor'];
	$endereco = $_POST['endereco'];
	
	//envia os dados para a função de inserir venda no banco de dados contido no arquivo "ConBanco.php"
	$res = $banco->InserirVenda($data, $valor, $endereco);
?>