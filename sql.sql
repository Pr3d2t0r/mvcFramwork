create database if not exists bleet;
use bleet;
create table if not exists user(
    id int(11) primary key auto_increment,
    username varchar(80) not null,
    password varchar(255) not null,
    permissions longtext not null
);
create table if not exists loginTokens(
    id int(11) primary key auto_increment,
    userId int(11) not null,
    token varchar(255) unique not null
);