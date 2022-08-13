<?php
	header("Content-type: text/html; charset=utf-8");
	
	//importa arquivo que conecta ao bando
	require_once("ConBanco.php");
	
	//cria conexão com o banco
	$banco = new Banco();
	
	//recebe o cep digitado
	$cep = $_POST['txtCEP'];
	
	// formatar o cep removendo caracteres nao numericos
	$cep = preg_replace("/[^0-9]/", "", $cep);
	
	//verifica validez do cep (tratamento de erros)
	if(strlen($cep) == 8){
		
		//procura o cep no site ViaCEP
		$url = "http://viacep.com.br/ws/$cep/xml/";
		$xml = simplexml_load_file($url);
		
		//adquire os dados do respectivo cep
		$cep = $xml->cep;
		$uf = $xml->uf;
		$cidade = $xml->localidade;
		$bairro = $xml->bairro;
		$rua = $xml->logradouro;
		
		//elimina o hífen do cep
		$cep = str_replace("-", "", $cep);
		
		//chama a função que verifica se o cep ja está cadastrado no banco de dados passando-o como parâmetro
		$veriftbl = 0;
		$veriftbl = $banco->VerificaCEP($cep);
		
		//verifica o valor retornado
		if($veriftbl != 1){
			//insere os dados do endereço no banco caso estes não estejam cadastrados
			$banco->InserirEndereco($cep, $uf, $cidade, $bairro, $rua);
		}
		
		//retorna os dados ao arquivo "Tela.html" em formato de string
		echo $cep.",".$uf.",".$cidade.",".$bairro.",".$rua;
	}
?>