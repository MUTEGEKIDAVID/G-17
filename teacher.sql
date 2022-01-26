CREATE TABLE teacher (
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(40) NOT NULL,
    email VARCHAR(60) NOT NULL,
    teacher_ID VARCHAR(40) NOT NULL ,
    pass CHAR(40) NOT NULL,
    PRIMARY KEY (teacher_ID),
    UNIQUE (teacher_ID)
);