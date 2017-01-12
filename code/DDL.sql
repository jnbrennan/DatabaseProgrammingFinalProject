-- create and select the database
Drop database IF EXISTS lucbookshare;
Create database lucbookshare;
Use lucbookshare;

-- create the tables for the database
Create table student (
	username varchar(255) not null unique,
	psw varchar(255) not null,
	sfirstname varchar(25) not null,
	slastname varchar(25) not null,
	phone int(10) not null,
	street varchar(30),
	city varchar(20),
	state char(2),
	zipcode int(5),
	verified bit not null,
	secret varchar(255) not null,
	
	constraint student_pk Primary Key(username)
);

Create table book (
	bookid int(10) not null unique auto_increment,
	isbn int(13),
	title varchar(50),
	afirstname varchar(25),
	alastname varchar(25),
	publicationdate date,
	borrowed bit not null,
	active bit not null,
	username varchar(255) not null,
	
	Constraint book_pk Primary key (bookid),
	Constraint bstudent_fk Foreign key (username) references student(username)
);

Create table bookorder (
	orderid int(10) not null unique auto_increment,
	orderdate date,
	duration int(2),
	username varchar(255) not null,
	
	constraint order_pk Primary key (orderid),
	Constraint bostudent_fk Foreign key(username) references student(username)
);

Create table orderhistory (
	orderid int(10) not null,
	bookid int(10) not null,
	duedate date,

	Constraint orderhistory_pk Primary key (orderid, bookid),
	Constraint order_fk Foreign key (orderID) references bookorder(orderid),
	Constraint book_fk Foreign key (bookid) references book(bookid)
);		

Create table administrator (
	username varchar(255) not null unique,
	psw varchar(255) not null,
	sfirstname varchar(25) not null,
	slastname varchar(25) not null,
	phone int(10) not null,
	street varchar(30),
	city varchar(20),
	state char(2),
	zipcode int(5),
	secret varchar(255) not null,

	constraint administrator_pk Primary Key(username)
);

-- insert data into the tables
Insert into administrator(username, psw, sfirstname, slastname, phone, street, city, state, zipcode, secret)
	values('jbrennan5', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Jessica', 'Brennan', 3125551234, '123 Main St', 'Chicago', 'IL', 60626, 'SECRET'),
		  ('hmbugi', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Harrison', 'Mbugi', 3125552345, '30 Terrace Dr', 'Chicago', 'IL', 60601, 'SECRET');
		  
Insert into student(username, psw, sfirstname, slastname, phone, street, city, state, zipcode, verified, secret)
	values('bharry', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Ben', 'Harry', 6305556129, '428 Butterfly Rd', 'Chicago', 'IL', 60626, 1, 'SECRET'),
		  ('mcosmos', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Miranda', 'Cosmos', 8155556756, '3700 W Lunt', 'Chicago', 'IL', 60645, 1, 'SECRET'),
		  ('jpenny', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Jenny', 'Penny', 7125559089, '389 E Chicago', 'Chicago', 'IL', 60601, 1, 'SECRET'),
		  ('cnorth', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Chris', 'North', 6125551300, '1212 W Jarvis Ave', 'Chicago', 'IL', 60626, 1, 'SECRET'),
		  ('ekrozel', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Elizabeth', 'Krozel', 7305550000, '1900 Biel Ave', 'Chicago', 'IL', 60601, 1, 'SECRET'),
		  ('bstuchl', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Brianna', 'Stuchl', 6305554144, '3 E HWY 1', 'Chicago', 'IL', 60655, 1, 'SECRET'),
		  ('rdowney', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Robert', 'Downey', 8885554289, '4 Hollywood Ln', 'Chicago', 'IL', 60543, 1, 'SECRET'),
		  ('nsmith', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Nancy', 'Smith', 7085559899, '5 101st St', 'Chicago', 'IL', 60789, 1, 'SECRET'),
		  ('ngomez', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Nina', 'Gomez', 4735559876, '3478 Wabash', 'Chicago', 'IL', 60601, 1, 'SECRET'),
		  ('jhamlin', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Jacob', 'Hamlin', 7735552345, '8000 N Lind St', 'Chicago', 'IL', 60654, 1, 'SECRET'),
		  ('nflanders', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Ned', 'Flanders', 6305554433, '809 N State St', 'Chicago', 'IL', 60644, 0, 'SECRET'),
		  ('pcarlisle', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Penny', 'Carlisle', 7775553000, '14989 Fullerton', 'Chicago', 'IL', 60543, 0, 'SECRET'),
		  ('jlewis', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Jerry', 'Lewis', 8095554747, '300 Sherwin Ave', 'Chicago', 'IL', 60626, 0, 'SECRET'),
		  ('bvandamm', '$2y$10$bu1N35MIzi1ky.0tC6q32eFsJTZa6IZ.LtzpSjC2M7Q0lVye6nb0W', 'Bradley', 'Vandamm', 7085550000, '546 E Erie St', 'Chicago', 'IL', 60654, 0, 'SECRET');
		  
Insert into book(bookid, isbn, title, afirstname, alastname, publicationdate, borrowed, active, username)
	values(100000001, 9781464171703, 'Abnormal Psychology', 'Ronald', 'Comer', '2015-02-13', 1, 1, 'bharry'),
		  (100000002, 9789814738255, 'Global Business Today', 'Charles', 'Hill', '2015-01-14', 1, 1, 'ekrozel'),
		  (100000003, 9780077729141, 'Principles of Auditing', 'Ray', 'Whittington', '2015-01-20', 1, 1, 'ngomez'),
		  (100000004, 9780133856460, 'Marketing Management 15th Edition', 'Phillip', 'Kolter', '2015-01-09', 1, 1, 'jpenny'),
		  (100000005, 9780030995743, 'Holt McDougal Algebra 1', 'Edward', 'Burger', '2011-05-20', 1, 1, 'mcosmos'),
		  (100000006, 9781610020244, 'Textbook of Neonatal Resuscitation', 'Gary', 'Weiner', '2016-05-06', 0, 1, 'cnorth'),
		  (100000007, 9780133915389, 'Engineering Mechanics Dynamics', 'Russell', 'Hibbeler', '2015-04-10', 0, 1, 'jhamlin'),
		  (100000008, 9780321890238, 'Elementary Statistics', 'Mario', 'Triola', '2014-12-21', 0, 1, 'bharry'),
		  (100000009, 9780321910417, 'Chemistry The Central Science 13th Edition', 'Theodore', 'Brown', '2014-01-11', 0, 1, 'bharry'),
		  (100000010, 9780443070839, 'Textbook of General and Oral Surgery', 'David', 'Wray', '2003-08-18', 0, 1, 'cnorth'),
		  (100000011, 9780078023163, 'Understanding Business', 'William', 'Nickels', '2015-01-09', 0, 1, 'ekrozel'),
		  (100000012, 9780078023163, 'The Art of Public Speaking', 'Stephen', 'Lucas', '2014-10-09', 0, 1, 'mcosmos'),
		  (100000013, 9780078023163, 'Computer Science Illuminated', 'Nell', 'Dale', '2015-01-14', 0, 1, 'jhamlin'),
		  (100000014, 9781590282410, 'Python Programming', 'John', 'Zelle', '2010-05-07', 0, 1, 'nsmith');
		  
Insert into bookorder(orderid, orderdate, duration, username)
	values(100000001, '2016-12-04', 14, 'nsmith'),
		  (100000002, '2016-12-05', 14, 'bharry'),
		  (100000003, '2016-12-06', 14, 'ekrozel'),
		  (100000004, '2016-12-07', 14, 'bharry'),
		  (100000005, '2016-12-08', 14, 'bharry');
		  
Insert into orderhistory(orderid, bookid, duedate)
	values(100000001, 100000001, '2016-12-18'),
		  (100000002, 100000002, '2016-12-19'),
		  (100000003, 100000003, '2016-12-20'),
		  (100000004, 100000004, '2016-12-21'),
		  (100000005, 100000005, '2016-12-22');
		  
-- Create users
GRANT SELECT, INSERT, UPDATE, DELETE
ON *
TO jbrennan5
IDENTIFIED BY 'Password1';

GRANT SELECT, INSERT, UPDATE, DELETE
ON *
TO hmbugi
IDENTIFIED BY 'Password1';