MySQL Commands
create table userlog(id int(3) unsigned primary key not null auto_increment,username varchar(30) not null,password varchar(15) not null,email varchar(40) not null);
create table games(name varchar(40),price int(5),id varchar(50),source varchar(30),category varchar(40),platform varchar(10),copies int(3));
create table products(name varchar(40),price int(5),id varchar(50),source varchar(30),category varchar(40),copies int(3),description varchar(30),pages varchar(4),author varchar(40),edition varchar(40));
create table query(query varchar(300),user varchar(20));
create table review(name varchar(30),paste varchar(100),seller varchar(30),product varchar(30),rating double(2,1));
create table sellerg(name varchar(50),quote int(5),id varchar(50),copies int(3),rating double(2,1));
create table sellers(name varchar(50),quote int(5),id varchar(50),copies int(3),rating double(2,1));
create table trans(name varchar(40),product varchar(40),created date,seller varchar(30),id varchar(50));
PS:Please execute create.php and create1.php to initialize the products
