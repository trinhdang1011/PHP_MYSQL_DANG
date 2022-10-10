-- create and select the database
DROP DATABASE IF EXISTS students_manager;
CREATE DATABASE students_manager;
USE students_manager;  -- MySQL command

-- create the tables
CREATE TABLE chuyennganh (
  chuyenNganhID       INT(11)        NOT NULL   AUTO_INCREMENT,
  chuyenNganhName     VARCHAR(255)   NOT NULL,
  PRIMARY KEY (chuyenNganhID)
);

CREATE TABLE students (
  studentID        INT(11)        NOT NULL   AUTO_INCREMENT,
  chuyenNganhID       INT(11)        NOT NULL,
  studentCode      VARCHAR(10)    NOT NULL   UNIQUE,
  studentName     VARCHAR(255)   NOT NULL,
  birthDay        INT (4) NOT NULL,
  PRIMARY KEY (studentID)
);

CREATE TABLE orders (
  orderID        INT(11)        NOT NULL   AUTO_INCREMENT,
  customerID     INT            NOT NULL,
  orderDate      DATETIME       NOT NULL,
  PRIMARY KEY (orderID)
);

-- insert data into the database
INSERT INTO chuyennganh VALUES
(1, 'Design'),
(2, 'IT'),
(3, 'Maketing');

INSERT INTO students VALUES
(1, 1, 'DS001', 'Nguyễn Trung Được', '1996'),
(2, 1, 'DS002', 'Lê Trung Tín', '1986'),
(3, 1, 'DS003', 'Nguyễn Nhật Hưng', '1985'),
(4, 1, 'DS004', 'Nguyễn Hoàng Nhật', '1999'),
(5, 1, 'DS005', 'Trần Minh Quân', '2002'),
(6, 1, 'DS006', 'Nguyễn Viết Hoàng', '2002'),
(7, 2, 'IT001', 'Trần Duy Thư', '2001'),
(8, 2, 'IT002', 'Lê Anh Quân', '1996'),
(9, 3, 'MT001', 'Mạch Mãnh Cường', '2000'),
(10, 3, 'MT002', 'Nguyễn Thái Bình', '1997');

-- create the users and grant priveleges to those users

CREATE USER 'mgs_user'@'localhost' IDENTIFIED BY 'pa55word';
GRANT SELECT, INSERT, DELETE, UPDATE
ON students_manager.*
TO mgs_user@localhost;

CREATE USER 'mgs_tester'@'localhost' IDENTIFIED BY 'pa55word';
GRANT SELECT
ON students
TO mgs_tester@localhost;
