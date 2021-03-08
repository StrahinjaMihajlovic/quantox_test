create database if not exists user_db;
use user_db;

drop table if exists users;

create table users(
	id int UNSIGNED not null AUTO_INCREMENT,
	username varchar(15) not null,
	pass_hash char(72) not null,
	email varchar(30) not null unique,
	primary key(id)
)ENGINE=InnoDB;