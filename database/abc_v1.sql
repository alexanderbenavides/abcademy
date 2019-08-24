CREATE DATABASE abc_v1;
CREATE TABLE students (
    studentID int AUTO_INCREMENT,
    firstName varchar(50),
    lastName varchar(50),
    email varchar(150)  NOT NULL,
    password varchar(150),
    verCode varchar(150),
    verified tinyint(1) DEFAULT 0,
    suspended tinyint(1) DEFAULT 0,
    PRIMARY KEY (studentID)
);
ALTER TABLE students ADD UNIQUE (email)
CREATE TABLE teachers (
    teacherID int AUTO_INCREMENT,
    firstName varchar(50),
    lastName varchar(50),
    email varchar(150) NOT NULL,
    password varchar(150),
    verCode varchar(150),
    verified tinyint(1) DEFAULT 0,
    suspended tinyint(1) DEFAULT 0,
    PRIMARY KEY (teacherID)
);
CREATE TABLE courses (
    courseID int AUTO_INCREMENT,
    courseTitle varchar(150) NOT NULL,
    courseDescription varchar(250) NOT NULL,
    published tinyint(1) DEFAULT 0,
    icon varchar(50) NOT NUll,
    PRIMARY KEY (courseID)

);
CREATE TABLE modules (
    moduleID int AUTO_INCREMENT,
    moduleTitle varchar(150) NOT NULL,
    courseID int NOT NULL,
    position int NOT NULL DEFAULT 1,
    published tinyint(1) DEFAULT 0,
    PRIMARY KEY (moduleID),
    FOREIGN KEY (courseID) REFERENCES courses(courseID)
);
CREATE TABLE topics (
    topicID int AUTO_INCREMENT,
    topicTitle varchar(150) NOT NULL,
    topicContent text NOT NULL,
    moduleID int NOT NULL,
    position int NOT NULL DEFAULT 1,
    published tinyint(1) DEFAULT 0,
    PRIMARY KEY (topicID),
    FOREIGN KEY (moduleID) REFERENCES modules(moduleID)
);
CREATE TABLE questions (
    questionID int AUTO_INCREMENT,
    questionTitle text NOT NULL,
    typeQuestion varchar(50) NOT NULL,
    answer text NOT NULL,
    explanation text NOT NULL,
    topicID int NOT NULL,
    position int NOT NULL DEFAULT 1,
    published tinyint(1) DEFAULT 1,
    PRIMARY KEY (questionID),
    FOREIGN KEY (topicID) REFERENCES topics(topicID)
);
CREATE TABLE classrooms (
    classroomID int AUTO_INCREMENT,
    classroomName varchar(150) NOT NULL,
    teacherID int NOT NULL,
    courseID int NOT NULL,
    PRIMARY KEY (classroomID),
    FOREIGN KEY (teacherID) REFERENCES teachers(teacherID),
    FOREIGN KEY (courseID) REFERENCES courses(courseID)
);
CREATE TABLE admins (
    adminID int AUTO_INCREMENT,
    firstName varchar(50) NOT NULL,
    lastName varchar(50) NOT NULL,
    email varchar(150)  NOT NULL,
    password varchar(150),
    verCode varchar(150),
    verified tinyint(1) DEFAULT 0,
    suspended tinyint(1) DEFAULT 0,
    PRIMARY KEY (adminID)
);
