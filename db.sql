create database HW1;
use HW1;

create table utente(
ID integer primary key auto_increment,
name varchar(255) not null,
lastname varchar(255) not null,
username varchar(16) not null unique,
email varchar(255) not null unique,
password varchar(255) not null,
img varchar(255) 
)Engine= InnoDB;

create table shop(
ID integer primary key auto_increment,
user_id integer not null,
foreign key (user_id) references utente(ID),
name varchar(255),
info varchar(255),
image varchar(255),
prezzo integer
)Engine= InnoDB;
