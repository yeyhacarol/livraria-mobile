show databases;

use dbbookery;

show tables;

desc tblcategorias;

create table tblprodutos (idProduto int not null auto_increment primary key,
						  titulo varchar(75) not null,
                          autor varchar(100) not null,
                          descricao text(800) not null,
                          foto varchar(100) not null,
                          preco double not null,
                          desconto double,
                          destacar boolean,
                          idCategorias int not null,
                          
                          constraint FK_Categoria_Produto
                          foreign key(idCategorias)
                          references tblCategorias(idCategorias)); 
                          
desc tblprodutos;

select * from tblcategorias;

insert into tblprodutos (titulo, autor, descricao, foto, preco, desconto, destacar, idCategorias)
						values (
							'antologia dark',
                            'cesar bravo',
                            'coletânea de livros dark',
                            'antologia-dark.png',
                            54.90,
                            0,
                            true,
                            1);
                            
select * from tblprodutos;

create table testePorcentagem (id int auto_increment primary key,
								preco double not null,
                                desconto double,
                                precoDescontado double generated always as (preco - (preco * (desconto / 100))) virtual);
                                
insert into testePorcentagem (preco, desconto)
						values (600, 10);
                        
insert into testePorcentagem (preco, desconto)
						values (56.92, 62);
                        
select * from testePorcentagem;

alter table tblprodutos 
	add column precoDescontado double generated always as (preco - (preco * (desconto / 100))) virtual;


desc tblprodutos;

update tblprodutos set desconto = 20 where idproduto = 13;

drop table testePorcentagem;

show tables;

            