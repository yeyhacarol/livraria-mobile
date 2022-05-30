
show databases;

use dbbookery;

select * from tblContatos;

create table tblCategorias (idCategorias int not null auto_increment primary key, nome varchar(45) not null);

#renomeando campo de nome para genero, pois palavra genero possui mais semântica
alter table tblCategorias
	rename column nome to genero;

show tables;

select * from tblCategorias;

insert into tblCategorias(nome)
	values('ficção');
    
insert into tblCategorias(genero)
	values('terror');



