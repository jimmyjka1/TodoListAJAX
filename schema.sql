create database todoList;
use todoList;


create table todoList.todo (
    id serial primary key,
    title varchar(255) not null,
    description varchar(255) not null,
    status INT not null
);


CREATE USER 'user1'@localhost IDENTIFIED BY 'password1';
GRANT ALL PRIVILEGES ON todoList.* TO 'user1'@localhost;

