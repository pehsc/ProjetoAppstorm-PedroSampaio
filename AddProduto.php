<?php
	header("Content-type: text/html; charset=utf-8");
	//inclui o arquivo de relacionamento com o bando de dados
	require_once("ConBanco.php");
	//instancia a classe Banco
	$banco = new Banco();
	
	//recebe dados do arquivo "Tela.html"
	$nomeprod = $_POST['txtNomeProd'];
	
	//envia os dados para a função de pegar o preço do produto no banco de dados contido no arquivo "ConBanco.php" e insere o valor retornado na variável preco
	$preco = $banco->PegaPreco($nomeprod);
	
	//envia os dados para a função de pegar os fornecedores do produto no banco de dados contido no arquivo "ConBanco.php" e insere o valor retornado na variável fornecedores
	$fornecedores = $banco->PegaForn($nomeprod);
	
	//retorna os dados ao arquivo "Tela.html" em formato de string
	echo $preco."-".$fornecedores;
?>