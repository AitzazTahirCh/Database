create database school;
use school;
create table logins(
     user_id varchar(10) primary key,
     pass varchar(200) not null,
     flag enum('admin','student','teacher') not null);
create table teachers(
     teacher_id varchar(10) primary key,
     f_name varchar(10) not null,
     l_name varchar(10) not null,
     CNIC varchar(20) unique not null,
     DOB DATE not null,
     gender enum('M','F') not null,
     age numeric(2) not null,
     phone_no numeric(15) not null,
     user_id varchar(10) not null,
     constraint user_fk foreign key(user_id) references logins(user_id));
create table students(
     roll_no varchar(10) primary key,
     f_name varchar(10) not null,
     l_name varchar(10) not null,
     DOB DATE not null,
     city varchar(10) not null,
     CNIC varchar(20) unique not null,
     gender enum('M','F') not null,
     age numeric(2) not null,
     class_no varchar(5) not null,
     user_id varchar(10) not null,
     constraint users_fk foreign key(user_id) references logins(user_id));
create table subject(
     subject_id varchar(10) primary key,
     subject_name varchar(10) not null,
     teacher_id varchar(10) ,
     constraint teacher_fk foreign key(teacher_id) references teachers(teacher_id) On Delete Cascade);
create table transcript(
     obtained_marks numeric(3) default 0,
     total_marks numeric(3) default 100,
     subject_id varchar(10) not null,
     constraint subject_fk foreign key(subject_id) references subject(subject_id)  On Delete Cascade,
     roll_no varchar(10) not null,
     constraint rollno_fk foreign key(roll_no) references students(roll_no) On Delete Cascade,
     constraint pk_tr primary key(subject_id,roll_no),
     remark varchar(50));
create table attendance(
     roll_no varchar(10) not null,
     status enum('P','A','L','-') not null default '-',
     date DATE not null,
     constraint pk_att primary key(roll_no, date),
     constraint roll_no_fk foreign key(roll_no) references students(roll_no) On Delete Cascade) ;

insert into logins(user_id,pass,flag) values ("1",SHA1("zaz123"),"admin");

insert into logins(user_id,pass,flag) values ("St01",SHA1("tree01"),"student");
insert into logins(user_id,pass,flag) values ("St02",SHA1("tree02"),"student");
insert into logins(user_id,pass,flag) values ("St03",SHA1("tree03"),"student");
insert into logins(user_id,pass,flag) values ("St04",SHA1("tree04"),"student");

insert into students(roll_no,f_name,l_name,DOB,city,CNIC,gender,age,class_no,user_id) values ("St01","Muhammad","Ahmed","2002-10-1","Islamabad","17881-9345342-3","M",18,11,"St01");
insert into students(roll_no,f_name,l_name,DOB,city,CNIC,gender,age,class_no,user_id) values ("St02","Muhammad","Rashid","2002-02-1","Islamabad","17801-10003563-4","M",18,11,"St02");
insert into students(roll_no,f_name,l_name,DOB,city,CNIC,gender,age,class_no,user_id) values ("St03","Khurram","Manzoor","2001-03-21","Islamabad","17801-89303842-5","M",18,11,"St03");
insert into students(roll_no,f_name,l_name,DOB,city,CNIC,gender,age,class_no,user_id) values ("St04","Bilal","Ashraf","1999-01-02","Islamabad","17201-2200021-5","M",21,11,"St04");


insert into logins(user_id,pass,flag) values ("Te01",SHA1("alpha01"),"teacher");
insert into logins(user_id,pass,flag) values ("Te02",SHA1("alpha02"),"teacher");
insert into logins(user_id,pass,flag) values ("Te03",SHA1("alpha03"),"teacher");
insert into logins(user_id,pass,flag) values ("Te04",SHA1("alpha04"),"teacher");


insert into teachers(teacher_id,f_name,l_name,CNIC,DOB,gender,age,phone_no,user_id) values ("Te01","Alam","Khan","18821-993345-4","1970-02-12","M",51,03045050325,"Te01");
insert into teachers(teacher_id,f_name,l_name,CNIC,DOB,gender,age,phone_no,user_id) values ("Te02","Mursaleen","Paracha","19121-9324098-2","1990-12-01","M",30,03001124675,"Te02");
insert into teachers(teacher_id,f_name,l_name,CNIC,DOB,gender,age,phone_no,user_id) values ("Te03","Saima","Ambreen","20334-89302741-1","1985-05-22","F",35,03129900882,"Te03");
insert into teachers(teacher_id,f_name,l_name,CNIC,DOB,gender,age,phone_no,user_id) values ("Te04","Haider","Haider","34952-15199319-2","1994-01-01","M",26,03334502987,"Te04");



insert into subject(subject_id,subject_name,teacher_id) values ("MT1","Calulus 1","Te01");
insert into subject(subject_id,subject_name,teacher_id) values ("HU2","Urdu","Te02");
insert into subject(subject_id,subject_name,teacher_id) values ("HU1","English","Te03");
insert into subject(subject_id,subject_name,teacher_id) values ("GS02","Physics","Te04");


insert into attendance(roll_no,status,date) values("St01","A","2021-01-01");
insert into attendance(roll_no,status,date) values("St02","A","2021-01-01");
insert into attendance(roll_no,status,date) values("St03","P","2021-01-01");
insert into attendance(roll_no,status,date) values("St04","L","2021-01-01");
insert into attendance(roll_no,status,date) values("St01","A","2021-01-02");
insert into attendance(roll_no,status,date) values("St02","P","2021-01-02");
insert into attendance(roll_no,status,date) values("St03","P","2021-01-02");
insert into attendance(roll_no,status,date) values("St04","P","2021-01-02");
insert into attendance(roll_no,status,date) values("St01","P","2021-01-03");
insert into attendance(roll_no,status,date) values("St02","P","2021-01-03");
insert into attendance(roll_no,status,date) values("St03","A","2021-01-03");
insert into attendance(roll_no,status,date) values("St04","L","2021-01-03");
insert into attendance(roll_no,status,date) values("St01","P","2021-01-04");
insert into attendance(roll_no,status,date) values("St02","A","2021-01-04");
insert into attendance(roll_no,status,date) values("St03","P","2021-01-04");
insert into attendance(roll_no,status,date) values("St04","P","2021-01-04");



insert into transcript values (55,100,"MT1","St01","Satisfactory");
insert into transcript values (80,100,"HU2","St01","Good Job");
insert into transcript values (72,100,"HU1","St01","Good");
insert into transcript values (90,100,"GS02","St01","Excellent");



insert into transcript values (80,100,"MT1","St02","Good Job");
insert into transcript values (55,100,"HU2","St02","Satisfactory Effort");
insert into transcript values (72,100,"HU1","St02","Good");
insert into transcript values (88,100,"GS02","St02","Excellent");



insert into transcript values (73,100,"MT1","St03","Good");
insert into transcript values (52,100,"HU2","St03","Satisfactory Effort");
insert into transcript values (76,100,"HU1","St03","Good");
insert into transcript values (52,100,"GS02","St03","Work Hard!");


insert into transcript values (44,100,"MT1","St04","Poor Performance");
insert into transcript values (62,100,"HU2","St04","Average Performance");
insert into transcript values (93,100,"HU1","St04","Excellent");
insert into transcript values (90,100,"GS02","St04","Very well done");

