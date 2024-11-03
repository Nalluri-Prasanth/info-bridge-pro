-- Create tables
CREATE TABLE IF NOT EXISTS DEPARTMENT (
  dname varchar(50) NOT NULL,
  dnumber bigint PRIMARY KEY,
  mgrssn char(9) NOT NULL,
  mgrstartdate timestamp,
  KEY (dname)
);

CREATE TABLE IF NOT EXISTS PROJECT (
  pname varchar(50) NOT NULL UNIQUE,
  pnumber bigint PRIMARY KEY,
  plocation varchar(255),
  dnum bigint NOT NULL,
  createdAt timestamp,
  updatedAt timestamp,
  FOREIGN KEY (dnum) REFERENCES DEPARTMENT(dnumber)
);

CREATE TABLE IF NOT EXISTS DEPT_LOCATIONS (
  dnumber bigint,
  dlocation varchar(255),
  PRIMARY KEY (dnumber, dlocation),
  FOREIGN KEY (dnumber) REFERENCES DEPARTMENT(dnumber)
);

CREATE TABLE IF NOT EXISTS EMPLOYEE (
  fname varchar(50) NOT NULL,
  minit varchar(1),
  lname varchar(50) NOT NULL,
  ssn char(9) PRIMARY KEY,
  bdate date,
  address varchar(255),
  sex char,
  salary int,
  superssn char(9),
  dno bigint,
  createdAt timestamp,
  updatedAt timestamp,
  FOREIGN KEY (dno) REFERENCES DEPARTMENT(dnumber)
);

CREATE TABLE IF NOT EXISTS DEPENDENT (
  essn char(9),
  dependent_name varchar(50),
  sex char,
  bdate date,
  relationship varchar(20),
  PRIMARY KEY (essn, dependent_name),
  FOREIGN KEY (essn) REFERENCES EMPLOYEE(ssn)
);

CREATE TABLE IF NOT EXISTS WORKS_ON (
  essn char(9),
  pno bigint,
  hours decimal(4,2),
  PRIMARY KEY (essn, pno),
  FOREIGN KEY (essn) REFERENCES EMPLOYEE(ssn),
  FOREIGN KEY (pno) REFERENCES PROJECT(pnumber)
);

-- Load data from .dat files
LOAD DATA INFILE '/var/lib/mysql-files/department.dat' INTO TABLE DEPARTMENT;
LOAD DATA INFILE '/var/lib/mysql-files/employee.dat' INTO TABLE EMPLOYEE;
LOAD DATA INFILE '/var/lib/mysql-files/dloc.dat' INTO TABLE DEPT_LOCATIONS;
LOAD DATA INFILE '/var/lib/mysql-files/dependent.dat' INTO TABLE DEPENDENT;
LOAD DATA INFILE '/var/lib/mysql-files/project.dat' INTO TABLE PROJECT;
LOAD DATA INFILE '/var/lib/mysql-files/worksOn.dat' INTO TABLE WORKS_ON;
