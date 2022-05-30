/* arquivo de script do banco de dados; autora: Carolina Silva; data de criação: 31/03/2022/ versão: 1.0 */

#criando tabela da livraria
create database dbBookery;

#mosntrando quais bancos existem, inclusive o dbBookery
show databases;

#utilizando o banco
use dbBookery;

#criando tabela de contatos, definindo os atributos: nome, email e mensagem sendo que nome e email não podem ser nulas
create table contatos (idContato int not null auto_increment primary key,
nome varchar(161) not null, email varchar(345), mensagem text(500) not null);

#renomeando a tabela inserindo TBL para obter maior semântica
rename table contatos to tblContatos;

#mostrando as tabelas criadas
show tables;

#fazendo primeiro insert na tabela 
insert into tblContatos(nome, email, mensagem)
	values('Carol', 'carol@gmail.com', 'teste de inserção');

#verificando tudo que foi inserido na tabela, se é que houve insert
select * from tblContatos;