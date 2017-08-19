
drop table if exists xxx;
create table xxx (
  id int not null primary key auto_increment,
  no int not null,
  disabled boolean not null default 0
);

insert into xxx values (1, 1, 0);
insert into xxx values (2, 2, 1);
insert into xxx values (3, 3, 0);
insert into xxx values (4, 4, 1);
