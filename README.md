# ProjAppstorm
/* Teste Pratico de PHP para cadastro de colaboradores de Pedro Henrique Sampaio Coelho para a empresa Appstorm */

/*** CRIACAO BANCO DE DADOS ***/

/* De inicio, segue abaixo o codigo de criacao do banco de dados utilizado para o projeto, levando-se em consideracao que utiliza-se o usuario padrao: "root", nao contem senha (senha:""), host: "localhost" e database: "sitedevendas". */

create database sitedevendas;
use sitedevendas;
create table endereco(
cep varchar(9) primary key not null,
uf varchar(2) not null,
cidade varchar(50) not null,
bairro varchar(50) not null,
rua varchar(50) not null
);
create table venda(
id_venda int primary key not null auto_increment,
data_venda varchar(10) not null,
valor_venda float not null,
endereco_entrega varchar(8) not null,
foreign key (endereco_entrega) references endereco(cep)
);
create table produtos(
referencia_produto int not null primary key,
nome_produto varchar(50) not null,
preco_produto float not null
);
create table fornecedores(
nome_fornecedor varchar(50) not null primary key
);
create table fornecimento(
nome_fornecedor varchar(50) not null,
referencia_produto int not null,
foreign key (nome_fornecedor) references fornecedores(nome_fornecedor),
foreign key (referencia_produto) references produtos(referencia_produto)
);

/* Entao, apos a criacao das tabelas, insere-se os produtos, fornecedores e a relacao entre estes, utilizando o codigo abaixo: */

insert into produtos values (1, "A", 2.5);
insert into produtos values (2, "B", 10);
insert into produtos values (3, "C", 5);
insert into fornecedores values ("A");
insert into fornecedores values ("B");
insert into fornecedores values ("C");
insert into fornecedores values ("D");
insert into fornecimento values ("A", 1);
insert into fornecimento values ("B", 1);
insert into fornecimento values ("C", 2);
insert into fornecimento values ("D", 3);

/*** TESTE DA TELA DE VENDA ***/

/*
Ao clicar em um dos 3 botoes localizados na parte superior da tela ("PRODUTO A", "PRODUTO B", "PRODUTO C"), adiciona-se o preco deste ao valor total demonstrado na caixa de texto destinada a tal, que se encontra acima da tabela. Alem disso, este evento adiciona o nome, preco e fornecedores do produto selecionado na tabela.
Para adicionar o endereco de entrega da venda basta digitar o CEP no local indicado e desfocar o elemento. Caso este seja encontrado, todas as outras areas marcadas como: "UF", "CIDADE", "BAIRRO" e "RUA" serao completadas com o respectivo endereco e realizara o cadastro deste no banco de dados.
Para completar a venda deve-se clicar no botao indicando "CONCLUIR VENDA". Para que este evento seja concluido um CEP deve ter sido anteriormente inserido na caixa de texto. Apos o clicar do botao, pega-se a data do ocorrido, valor total da compra e cep do endereco e adiciona-os ao banco de dados.
*/