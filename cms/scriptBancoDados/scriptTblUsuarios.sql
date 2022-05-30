show databases;

use dbbookery;

create table tblUsuarios (idUsuario int not null auto_increment primary key, 
	nome varchar(45) not null, login varchar(45) not null, 
		senha varchar(45) not null);
    
show tables;

select * from tblUsuarios;

insert into tblUsuarios (nome, login, senha)
						values('carolina', 'root', '123');

insert into tblUsuarios (nome, login, senha)
						values('lucas', 'root', '456');




