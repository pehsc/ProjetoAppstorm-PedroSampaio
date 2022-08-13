<?php
	header("Content-type: text/html; charset=utf-8");
	//classe para realizar tarefas com o banco de dados
	class Banco{
		private $host = "localhost";
		private $user = "root";
		private $pass = "";
		private $db = "sitedevendas";
		private $con = null;
		
		//método construtor que conecta com o banco
		function __construct(){
			$this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
		}
		
		//método que ferifica se ja existe um cep específico cadastrado no banco de dados
		function VerificaCEP($cep){
			//verifica se o cep passado está vazio
			if($cep != null){
				//realiza a seleção na tabela endereço no banco de dados onde o cep é o passado como referencia
				$sql = "select * from endereco where cep = ".$cep.";";
				$res = mysqli_query($this->con, $sql);
				//verifica se houve algum resultado
				$result = mysqli_num_rows($res);
				if($result == 1){
					//caso o cpf ja esteja cadastrado, retorna 1
					return 1;
				}
			}
		}
		
		//método que insere os dados na tabela endereço
		function InserirEndereco($cep, $uf, $cidade, $bairro, $rua){
			if($cep != null){
				//realiza a inclusão dos dados passados como parâmetro na tabela endereço
				$sql = "insert into endereco (cep, uf, cidade, bairro, rua) values ('".$cep."', '".$uf."', '".$cidade."', '".$bairro."', '".$rua."');";
				$res = mysqli_query($this->con, $sql);
			}
		}
		
		//método que insere os dados na tabela venda
		function InserirVenda($data, $valor, $endereco){
			//realiza a inclusão dos dados passados como parâmetro na tabela venda
			$sql = "insert into venda (data_venda, valor_venda, endereco_entrega) values ('".$data."', ".$valor.", '".$endereco."');";
			$res = mysqli_query($this->con, $sql);
			return 1;
		}
		
		//método que retorna o preço do produto
		function PegaPreco($nomeprod){
			//realizando select no banco de dados
			$sql = "select preco_produto from produtos where nome_produto = '".$nomeprod."';";
			$query = mysqli_query($this->con, $sql);
			//verificando se houve algum resultado no select
			$result = mysqli_num_rows($query);
			if($result = 1){
				//percorrendo a tabela, extraindo do banco o preço do produto e atribuindo-o à variável preco
				$preco = 0;
				$dados = mysqli_fetch_array($query);
				$preco = $dados['preco_produto'];
				//retornando o preço do produto
				return $preco;
			}
		}
		
		//método que retorna os fornecedores do produto
		function PegaForn($nomeprod){
			//realizando select no banco de dados para pegar a referencia do produto
			$sql1 = "select referencia_produto from produtos where nome_produto = '".$nomeprod."';";
			$query = mysqli_query($this->con, $sql1);
			//verificando se houve algum resultado no select
			$result = mysqli_num_rows($query);
			if($result = 1){
				//adquirindo a referencia do produto
				$ref = "";
				while($dados = mysqli_fetch_array($query)){
					$ref = $dados['referencia_produto'];
				}
				//realizando select no banco de dados para pegar os nomes dos fornecedores do produto o qual adquiriu-se a referencia anteriormente
				$sql2 = "select nome_fornecedor from fornecimento where referencia_produto = ".$ref.";";
				$query = mysqli_query($this->con, $sql2);
				//verificando se houve algum resultado no select
				$result = mysqli_num_rows($query);
				if($result = 1){
					//adquirindo os fornecedores
					$forns = "";
					while($f = mysqli_fetch_array($query)){
						$forns .= $f['nome_fornecedor'].",";
					}
					//retornando os fornecedores
					return $forns;
				}
			}
		}
	}
?>