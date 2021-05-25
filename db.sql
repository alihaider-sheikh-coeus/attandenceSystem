# db attandence_system
create database attandence_system;
#designations table
create table if not exists designations(id INT NOT NULL AUTO_INCREMENT  PRIMARY KEY, name varchar(255) not null);
alter table designations rename column id to designation_id;

#employees table
create table if not exists employees(employee_id int not null auto_increment PRIMARY KEY, email varchar(255) not null,password varchar(255) not null,salary  varchar(255) default null,dept varchar(255) default null ,boss_name varchar(255) default null,image varchar(255) default null,designation_id int default null,foreign key(designation_id) references designations(designation_id));
alter table employees  add column name varchar(255) default null after email;
# roll_in table
create table if not exists roll_in (id int auto_increment not null primary key, employee_id int not null,time_in varchar(255) default null,time_out varchar(255) default null,today_attandence date default
    null,foreign key(employee_id) references employees(employee_id) );
alter table roll_in  add column status  varchar(255) default null;
alter table roll_in modify id int not null;
ALTER TABLE roll_in DROP PRIMARY KEY;